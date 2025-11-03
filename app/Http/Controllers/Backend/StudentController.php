<?php

namespace App\Http\Controllers\Backend;

use App\Exports\StudentsExport;
use App\Exports\StudentsTemplateExport;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentSection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{

    // Constructor to apply middleware for permissions
    public function __construct()
    {
        $this->middleware('can:list-student', ['only' => ['index']]);
        $this->middleware('can:create-student', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-student', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-student', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = StudentClass::orderBy('id', 'desc')->get();
        $sections = StudentSection::orderBy('id', 'desc')->get();

        $students = Student::with('user', 'class', 'section')
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($request->phone, function ($query, $phone) {
                $query->whereHas('user', function ($q) use ($phone) {
                    $q->where('phone', 'like', "%{$phone}%");
                });
            })
            ->when($request->class_id, function ($query, $class_id) {
                $query->where('class_id', $class_id);
            })
            ->when($request->section_id, function ($query, $section_id) {
                $query->where('section_id', $section_id);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.pages.student.index', compact('students', 'classes', 'sections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = StudentSection::orderBy('id', 'desc')->get();
        $classes = StudentClass::orderBy('id', 'desc')->get();
        return view('backend.pages.student.create', compact('sections', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'address' => 'required|string',
            'dob' => 'required|date',
            'class_id' => 'required',
            'section_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/students'), $imageName);
                $imagePath = 'uploads/students/' . $imageName;
            }

            // Create user
            $user = User::create([
                'type' => 'student',
                'fname' => $validated['fname'],
                'lname' => $validated['lname'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
            ]);
            $user->assignRole('Student');

            // Create student
            Student::create([
                'user_id' => $user->id,
                'name' => trim($validated['fname'] . ' ' . ($validated['lname'] ?? '')),
                'address' => $validated['address'],
                'dob' => $validated['dob'],
                'class_id' => $validated['class_id'],
                'section_id' => $validated['section_id'],
                'image' => $imagePath,
            ]);

            DB::commit();

            toast('Student created successfully!', 'success');
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $sections = StudentSection::orderBy('id', 'desc')->get();
        $classes = StudentClass::orderBy('id', 'desc')->get();
        return view('backend.pages.student.edit', compact('student', 'sections', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user;

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'address' => 'required|string',
            'dob' => 'required|date',
            'class_id' => 'required',
            'section_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            $user->update([
                'fname' => $validated['fname'],
                'lname' => $validated['lname'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($student->image && file_exists(public_path($student->image))) {
                    unlink(public_path($student->image));
                }
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/students'), $imageName);
                $student->image = 'uploads/students/' . $imageName;
            }

            // Update student
            $student->update([
                'name' => trim($validated['fname'] . ' ' . ($validated['lname'] ?? '')),
                'address' => $validated['address'],
                'dob' => $validated['dob'],
                'class_id' => $validated['class_id'],
                'section_id' => $validated['section_id'],
            ]);

            DB::commit();

            toast('Student updated successfully!', 'success');
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $student = Student::findOrFail($id);
            $user = $student->user;

            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }
            $student->delete();
            $user->delete();

            DB::commit();

            toast('Student deleted successfully!', 'success');
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    ///////////////////////////// Bulk Upload Form ////////////////////////////
    public function bulkUploadForm()
    {
        return view('backend.pages.student.bulk-upload');
    }

    //////////////////////////// Download CSV Template ////////////////////////////

    // public function downloadTemplate()
    // {
    //     $headers = ['name', 'email', 'phone', 'address', 'dob', 'password', 'class', 'section'];

    //     $callback = function () use ($headers) {
    //         $file = fopen('php://output', 'w');

    //         fputcsv($file, $headers);

    //         fclose($file);
    //     };

    //     $fileName = 'students_template.csv';

    //     return Response::stream($callback, 200, [
    //         "Content-Type" => "text/csv; charset=UTF-8",
    //         "Content-Disposition" => "attachment; filename={$fileName}",
    //         "Cache-Control" => "no-store, no-cache, must-revalidate, max-age=0",
    //         "Pragma" => "no-cache",
    //     ]);
    // }

    public function downloadTemplate()
    {
        return Excel::download(new StudentsTemplateExport, 'students_template.xlsx');
    }

    //////////////////////////// Import Students from CSV ////////////////////////////

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            $import = new StudentsImport;
            Excel::import($import, $request->file('file'));

            toast('Students imported successfully!', 'success');

            // Show skipped rows if any
            if (!empty($import->skipped)) {
                $messages = collect($import->skipped)->map(function ($row) {
                    return $row['email'] ?? $row['name'] . ' - ' . $row['reason'];
                })->implode(', ');

                toast('Skipped: ' . $messages, 'warning', ['timeOut' => 10000]);
            }

            return redirect()->route('students.index');
        } catch (\Exception $e) {
            toast('Import failed: check the excel file and try again', 'error');
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    
    ///////////////////////////// Export Students to Excel ////////////////////////////
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }
}
