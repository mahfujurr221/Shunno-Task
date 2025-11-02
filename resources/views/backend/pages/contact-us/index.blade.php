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
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Read</option>
                        <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>Unread</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('contact-us.index') }}" class="btn btn-danger">Clear</a>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Contact Us</h4>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Name', 'Phone', 'Message', 'Status']">
            @forelse($contactUs as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->phone }}</td>
                <td>
                    {{ Str::limit($data->message, 50) }}
                </td>
                <td>
                    <form action="{{ route('contact.update-status', $data->id) }}" method="POST">
                        @csrf
                        <select name="status" class="form-select" onchange="this.form.submit()" required>
                            <option value="0" {{ (int) $data->status === 0 ? 'selected' : '' }}>Unread</option>
                            <option value="1" {{ (int) $data->status === 1 ? 'selected' : '' }}>Read</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
            @endforelse
        </x-table>
    </div>

</div>

@endsection
