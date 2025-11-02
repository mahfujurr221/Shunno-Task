<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:list-class', ['only' => ['index']]);
        $this->middleware('can:create-class', ['only' => ['store']]);
        $this->middleware('can:edit-class', ['only' => ['update']]);
        $this->middleware('can:delete-class', ['only' => ['destroy']]);
    }

    public function index()
    {
        $classes = StudentClass::orderBy('id', 'desc')->get();
        return view('backend.pages.class.index', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);
        StudentClass::create($validated);
        toast('Class Created Successfully!', 'success');
        return redirect()->route('classes.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = StudentClass::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_classes,name,' . $class->id,
        ]);
        $class->update($validated);
        toast('Class Updated Successfully!', 'success');
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = StudentClass::findOrFail($id);
        $class->delete();
        toast('Class Deleted Successfully!', 'success');
        return redirect()->route('classes.index');
    }
}
