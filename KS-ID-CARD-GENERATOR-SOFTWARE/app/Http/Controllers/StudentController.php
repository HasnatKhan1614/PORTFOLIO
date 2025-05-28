<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\Student;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PDF;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware(): array
    {
        return [
            'permission:list-student|create-student|edit-student|delete-student' => ['only' => ['index', 'store']],
            'permission:create-student' => ['only' => ['create', 'store']],
            'permission:edit-student' => ['only' => ['edit', 'update']],
            'permission:delete-student' => ['only' => ['destroy']],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $editUrl = route('students.edit', $row->id);
                $deleteUrl = route('students.destroy', $row->id);

                // Only using icons without button labels
                $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">';
                $btn .= '<i class="fas fa-edit"></i>';
                $btn .= '</a>';

                $btn .= ' <a href="' . $deleteUrl . '" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">';
                $btn .= '<i class="fas fa-trash-alt"></i>';
                $btn .= '</a>';

                $btn .= ' <button class="view btn btn-info btn-sm" data-id="' . $row->id . '" data-toggle="modal" data-target="#viewStudentModal">';
                $btn .= '<i class="fas fa-eye"></i>';
                $btn .= '</button>';

                return $btn;
            })



                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.students.index');
    }

    public function students_registration(Request $request)
    {
        if ($request->ajax()) {
            // Check if a class filter is provided
            $classFilter = $request->input('class_filter');

            // Query to get registered students
            $query = Student::where('is_registered', 1);

            // Apply class filter if it's passed
            if ($classFilter) {
                $query->where('class', $classFilter);
            }

            $data = $query->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn() // Automatically adds an index column
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="student-checkbox" value="' . $row->id . '">';
                })
                ->addColumn('updated_at', function ($row) {
                    return $row->updated_at->format('M d, Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    // Start the button container with center alignment
                    $btn = '<div class="d-flex justify-content-center align-items-center">';

                    // View button with modal trigger
                    $btn .= '<button class="view btn btn-info btn-sm mr-2" data-id="' . $row->id . '" data-toggle="modal" data-target="#viewStudentModal">';
                    $btn .= '<i class="fas fa-eye"></i>';
                    $btn .= '</button>';

                    // Delete Registration button with a form or a delete request
                    $btn .= '<form action="' . route('students.deleteRegistration', $row->id) . '" method="POST" class="d-inline">';
                    $btn .= csrf_field(); // Include CSRF token for security
                    $btn .= method_field('DELETE'); // Use DELETE method
                    $btn .= '<button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this registration?\')">';
                    $btn .= '<i class="fas fa-trash-alt"></i>'; // Trash icon for delete
                    $btn .= '</button>';
                    $btn .= '</form>';

                    $btn .= '</div>'; // Close button container div
                    return $btn;
                })

                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('pages.students.students-registration');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            // Get the validated data from the request
            $validatedData = $request->validated();


            // Handle image upload and save storage link
            if ($request->hasFile('image')) {
                // Store the image in 'public/images'
                $imagePath = $request->file('image')->store('images', 'public');

                // Get ASSET_URL from the .env file and concatenate it with the image path
                $assetUrl = env('ASSET_URL', url('/'));  // Fallback to base URL if ASSET_URL is not set
                $validatedData['image'] = $assetUrl . '/storage/' . $imagePath; // Use the full ASSET_URL for the image
            }

            // Correct the space in the 'is_registered' key
            $validatedData['is_registered'] = $request->input('is_registered') == '1' ? 0 : 1;

            // Create new student
            $student = Student::create($validatedData);

            // Debugging - check if validated data is correct



            // Return success response
            return response()->json([
                'message' => 'Student created successfully',
                'student' => $student, // Optionally return student details
            ], 200);
        } catch (ValidationException $e) {

            // Return validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Return general error
            return response()->json([
                'message' => 'Failed to create student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            // Find the student by ID or fail
            $student = Student::findOrFail($id);

            // Get the validated data from the request
            $validatedData = $request->validated();

            // Handle image upload and update storage link
            if ($request->hasFile('image')) {
                // Delete the old image if a new one is uploaded
                if ($student->image) {
                    $oldImagePath = str_replace('/storage/', '', $student->image);
                    Storage::disk('public')->delete($oldImagePath); // Delete the old image
                }

                // Store new image
                $imagePath = $request->file('image')->store('images', 'public'); // Store new image

                // Get ASSET_URL from the .env file and concatenate it with the image path
                $assetUrl = env('ASSET_URL', url('/'));  // Fallback to base URL if ASSET_URL is not set
                $validatedData['image'] = $assetUrl . '/storage/' . $imagePath; // Use the full ASSET_URL for the new image
            }

            $validatedData['is_registered'] = $request->input('is_registered') == '1' ? 0 : 1;



            // Update the student's data
            $student->update($validatedData);

            // Return success response
            return response()->json([
                'message' => 'Student updated successfully',
                'student' => $student, // Optionally return updated student data
            ], 200);
        } catch (ValidationException $e) {
            // Return validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Return general error
            return response()->json([
                'message' => 'Failed to update student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return response()->json(['message' => 'Student deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Student', 'error' => $e->getMessage()], 500);
        }
    }

    public function import(Request $request)
    {
        // Update the validation to allow both CSV and Excel files
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls', // Allow CSV and Excel files
        ]);


        try {
            // Import the file using Laravel Excel
            Excel::import(new StudentsImport, $request->file('file'));

            return back()->with('success', 'Students imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to import students: ' . $e->getMessage());
        }
    }

    public function userRegistration(Request $request)
    {
        try {
            if ($request->has('student_id')) {
                // Admin updating an existing student
                $student = Student::findOrFail($request->student_id);

                $validatedData = $request->validate([
                    'student_name' => 'required|string|max:255',
                    'father_name' => 'required|string|max:255',
                    'phone' => 'required|string|min:8',
                    'dob' => 'required|string|min:8',
                    'address' => 'required|string|min:8',
                    'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validation for image

                ]);

                // Handle image upload and save storage link
                if ($request->hasFile('image')) {
                    // Store the image in 'public/images'
                    $imagePath = $request->file('image')->store('images', 'public');

                    // Get ASSET_URL from the .env file and concatenate it with the image path
                    $assetUrl = env('ASSET_URL', url('/'));  // Fallback to base URL if ASSET_URL is not set
                    $validatedData['image'] = $assetUrl . '/storage/' . $imagePath; // Use the full ASSET_URL for the image
                }




                // Set is_registered to 1
                $validatedData['is_registered'] = 1; // Add this line to set the value to 1

                $student->update($validatedData);

                return redirect()->route('registration')->with('message', 'Student registered successfully');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Validation failed')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operation failed');
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return response()->json($student);
    }

    public function getStudentsByClass($classId,$campus)
    {
        $students = Student::where('class', $classId)->where('campus', $campus)->get();
        return response()->json(['students' => $students]);
    }

    public function studentView($id)
    {
        $student = Student::findOrFail($id);

        return view('pages.students.student-id', compact('student'));
    }
    public function parentView($id)
    {
        $student = Student::findOrFail($id);

        return view('pages.students.parent-id', compact('student'));
    }

    public function handleSelectedStudents(Request $request)
    {
        $type = $request->type;
        // Retrieve the selected IDs from the form submission
        $selectedIds = $request->input('selected_ids');
        // Convert the comma-separated string back into an array
        $idsArray = explode(',', $selectedIds);

        // // Retrieve the students from the database using the array of IDs
        $students = Student::whereIn('id', $idsArray)->get();
        // Return the view with the selected students
        return view('pages.students.print-view', compact('students', 'type'));
    }

    public function classList(Request $request)
    {
        if ($request->ajax()) {
            // Define the class names array
            $classes = [
                ['name' => 'Beginner'],
                ['name' => 'Junior'],
                ['name' => 'Grade 1'],
                ['name' => 'Grade 2'],
                ['name' => 'Grade 3'],
                ['name' => 'Grade 4 Girls'],
                ['name' => 'Grade 4 Boys'],
                ['name' => 'Senior'],
                ['name' => 'Hifz Boys'],
                ['name' => 'Hifz Girls']
            ];

            // Manually create an array to simulate data
            $data = collect($classes);

            return DataTables::of($data) // Convert array to a collection
                ->addIndexColumn() // Automatically adds an index column
                ->addColumn('class_name', function ($row) {
                    return $row['name']; // Access the class name from the array
                })
                ->addColumn('action', function ($row) {
                    // Create the "View" button, passing the class name as a filter
                    return '<a href="' . route('students.registration', ['class_filter' => $row['name']]) . '" class="btn btn-info btn-sm">View</a>';
                })
                ->rawColumns(['class_name', 'action']) // Allow raw HTML in the action column
                ->make(true);
        }

        return view('pages.students.class-list');
    }

    public function deleteRegistration($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Update the student fields by setting them to null or 0
        $student->update([
            'is_registered' => 0,
            'father_name' => null,         // Assuming dob is a date, set it to null
            'dob' => null,         // Assuming dob is a date, set it to null
            'phone' => null,       // Assuming phone is a string or integer, set to null
            'address' => null,       // Assuming phone is a string or integer, set to null
            'image' => null,       // Set image to null
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Registration deleted successfully.');
    }






}
