<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StudentSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:list-section', ['only' => ['index']]);
        $this->middleware('can:create-section', ['only' => ['store']]);
        $this->middleware('can:edit-section', ['only' => ['update']]);
        $this->middleware('can:delete-section', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = StudentSection::orderBy('id', 'desc')->get();
        return view('backend.pages.section.index', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:student_sections,name',
        ]);

        StudentSection::create($validated);

        toast('Section Created Successfully!', 'success');
        return redirect()->route('sections.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = StudentSection::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:student_sections,name,' . $section->id,
        ]);

        $section->update($validated);

        toast('Section Updated Successfully!', 'success');
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = StudentSection::findOrFail($id);
        $section->delete();

        toast('Section Deleted Successfully!', 'success');
        return redirect()->route('sections.index');
    }
}
