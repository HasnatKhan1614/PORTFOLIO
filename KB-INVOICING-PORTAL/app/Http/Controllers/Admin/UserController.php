<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.users.edit', $row->id);

                    // Update Delete Button (Remove href, use data-url attribute instead)
                    // $btn = '<a  data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">';
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">';
                    $btn .= '<i class="fas fa-edit"></i>';
                    $btn .= '</a>';

                    $btn .= ' <a href="#" data-id="' . $row->id . '" data-url="' . route('admin.users.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">';
                    $btn .= '<i class="fas fa-trash-alt"></i>';
                    $btn .= '</a>';

                    return $btn;
                })



                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Store the data in the database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Encrypt password
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'description' => $validatedData['description'],
        ]);

        // Return a JSON response or redirect as needed
        return response()->json(['success' => true, 'message' => 'User registered successfully']);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    // Fetch user data
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
        // return response()->json($user);
    }

    // Update user data
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the user from the database
        $user->delete();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }
}
