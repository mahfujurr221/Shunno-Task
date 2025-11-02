<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:list-subject', ['only' => ['index']]);
        $this->middleware('can:create-subject', ['only' => ['store']]);
        $this->middleware('can:edit-subject', ['only' => ['update']]);
        $this->middleware('can:delete-subject', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::orderBy('id', 'desc')->get();
        return view('backend.pages.subject.index', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name',
        ]);

        Subject::create($validated);

        toast('Subject Created Successfully!', 'success');
        return redirect()->route('subjects.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:subjects,name,' . $subject->id,
        ]);

        $subject->update($validated);

        toast('Subject Updated Successfully!', 'success');
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        toast('Subject Deleted Successfully!', 'success');
        return redirect()->route('subjects.index');
    }
}
