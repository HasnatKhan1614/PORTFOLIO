<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf;  // Ensure this matches the package you're using





Route::get('/registration', function () {
    $students = Student::where('is_registered',0)->get();
    return view('registration',compact('students'));
})->name('registration');

Route::post('/submit-form', [App\Http\Controllers\StudentController::class, 'userRegistration'])->name('user.registration');

Route::get('/get-students-by-class/{class_id}/{campus}', [App\Http\Controllers\StudentController::class, 'getStudentsByClass']);


Route::get('students/download-pdf', [App\Http\Controllers\StudentController::class, 'downloadPdf'])->name('students.download-pdf');


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        return response()->json(['message' => 'Storage link created successfully!']);
    }); // Add middleware for authentication if needed

    // Route::get('attachments/{id}/download', [App\Http\Controllers\EmployeeController::class, 'download'])->name('attachments.download');


    Route::get('branches', [App\Http\Controllers\BranchController::class, 'index'])->name('branches.index');
    Route::get('branches/create', [App\Http\Controllers\BranchController::class, 'create'])->name('branches.create');
    Route::post('branches', [App\Http\Controllers\BranchController::class, 'store'])->name('branches.store');
    Route::get('branches/{id}/edit', [App\Http\Controllers\BranchController::class, 'edit'])->name('branches.edit');
    Route::put('branches/{id}', [App\Http\Controllers\BranchController::class, 'update'])->name('branches.update');
    Route::get('branches/{id}', [App\Http\Controllers\BranchController::class, 'destroy'])->name('branches.destroy');

    Route::get('students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
    Route::get('students-registration', [App\Http\Controllers\StudentController::class, 'students_registration'])->name('students.registration');

    Route::get('students/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
    Route::post('students', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
    Route::get('students/{id}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
    Route::put('students/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
    Route::delete('students/{id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('students.destroy'); // Use DELETE method for destroy
    Route::get('students/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('students.show');

    Route::get('students/import', [App\Http\Controllers\StudentController::class, 'importForm'])->name('students.importForm');
    Route::post('students/import', [App\Http\Controllers\StudentController::class, 'import'])->name('students.import');
    // Route::get('student-print-view/{id}', [App\Http\Controllers\StudentController::class, 'studentView'])->name('student.print.view');
    // Route::get('parent-print-view/{id}', [App\Http\Controllers\StudentController::class, 'parentView'])->name('parent.print.view');


    Route::post('/students/handle-selected', [App\Http\Controllers\StudentController::class, 'handleSelectedStudents'])->name('students.handleSelected');


    Route::get('class-list', [App\Http\Controllers\StudentController::class, 'classList'])->name('students.class.list');

    Route::delete('students/delete-registration/{id}', [App\Http\Controllers\StudentController::class, 'deleteRegistration'])->name('students.deleteRegistration');


    





    
    
    
    
    
});

require __DIR__ . '/auth.php';
