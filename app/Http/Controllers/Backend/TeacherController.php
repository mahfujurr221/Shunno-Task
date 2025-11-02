<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    // Constructor to apply middleware for permissions
    public function __construct()
    {
        $this->middleware('can:list-teacher', ['only' => ['index']]);
        $this->middleware('can:create-teacher', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-teacher', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-teacher', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subjects = Subject::orderBy('id', 'desc')->get();

        $teachers = Teacher::with('user', 'subject')
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($request->phone, function ($query, $phone) {
                $query->whereHas('user', function ($q) use ($phone) {
                    $q->where('phone', 'like', "%{$phone}%");
                });
            })
            ->when($request->subject_id, function ($query, $subject_id) {
                $query->where('subject_id', $subject_id);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.pages.teacher.index', compact('teachers', 'subjects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('backend.pages.teacher.create', compact('subjects'));
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
            'subject_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/teachers'), $imageName);
                $imagePath = 'uploads/teachers/' . $imageName;
            }

            // Create user
            $user = User::create([
                'type' => 'teacher',
                'fname' => $validated['fname'],
                'lname' => $validated['lname'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
            ]);
            $user->assignRole('Teacher');

            // Create teacher
            Teacher::create([
                'user_id' => $user->id,
                'name' => trim($validated['fname'] . ' ' . ($validated['lname'] ?? '')),
                'address' => $validated['address'],
                'subject_id' => $validated['subject_id'],
                'image' => $imagePath,
            ]);

            DB::commit();

            toast('Teacher created successfully!', 'success');
            return redirect()->route('teachers.index');
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
        
        $teacher = Teacher::with('user')->findOrFail($id);
        $subjects = Subject::all();
        return view('backend.pages.teacher.edit', compact('teacher', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'address' => 'required|string',
            'subject_id' => 'required',
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
                if ($teacher->image && file_exists(public_path($teacher->image))) {
                    unlink(public_path($teacher->image));
                }
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/teachers'), $imageName);
                $teacher->image = 'uploads/teachers/' . $imageName;
            }

            // Update teacher
            $teacher->update([
                'name' => trim($validated['fname'] . ' ' . ($validated['lname'] ?? '')),
                'address' => $validated['address'],
                'subject_id' => $validated['subject_id'],
            ]);

            DB::commit();

            toast('Teacher updated successfully!', 'success');
            return redirect()->route('teachers.index');
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
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        try {
            DB::beginTransaction();
            if ($teacher->image && file_exists(public_path($teacher->image))) {
                unlink(public_path($teacher->image));
            }
            $teacher->delete();

            if ($user) {
                $user->delete();
            }

            DB::commit();

            toast('Teacher deleted successfully!', 'success');
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
