@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name" name="name"
                        value="{{ request()->name }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Phone" name="phone"
                        value="{{ request()->phone }}">
                </div>
                <div class="col-md-2">
                    <select name="class_id" class="form-select">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request()->class_id == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="section_id" class="form-select">
                        <option value="">Select Section</option>
                        @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ request()->section_id == $section->id ? 'selected' : ''
                            }}>
                            {{ $section->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('students.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Student List</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('students.export') }}" class="btn btn-success ms-2">
                    <i class="bi bi-download"></i> Export Students
                </a>

                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Student
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Image', 'Name', 'Email', 'Phone', 'DOB', 'Class', 'Section', 'Action']">
            @forelse($students as $key => $student)
            <tr class="text-center">
                <td>{{ $students->firstItem() + $key }}</td>
                <td>
                    <img src="{{ asset($student->image ?? 'uploads/students/default.png') }}" alt="Image"
                        class="rounded-circle" style="width:50px; height:50px; object-fit:cover;">
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->user->email }}</td>
                <td>{{ $student->user->phone }}</td>
                <td>{{ $student->dob }}</td>
                <td>{{ $student->class->name ?? '-' }}</td>
                <td>{{ $student->section->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                        style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No students found</td>
            </tr>
            @endforelse
        </x-table>
        <div class="mt-3 d-flex justify-content-end">
            {{ $students->links() }}
        </div>
    </div>
</div>

@endsection