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
                <div class="col-md-3">
                    <select name="subject_id" class="form-select">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request()->subject_id == $subject->id ? 'selected' : ''
                            }}>
                            {{ $subject->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Teachers List</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Teacher
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Image', 'Name', 'Email', 'Phone', 'Subject', 'Action']">
            @forelse($teachers as $key => $teacher)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset($teacher->image ?? 'uploads/teachers/default.png') }}" alt="Image"
                        class="rounded-circle" style="width:50px; height:50px; object-fit:cover;">
                </td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->user->email }}</td>
                <td>{{ $teacher->user->phone }}</td>
                <td>{{ $teacher->subject->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
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
    </div>
</div>

@endsection