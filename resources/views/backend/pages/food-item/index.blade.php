@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search by name -->
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name" name="name"
                        value="{{ request()->name }}">
                </div>

                <!-- Search by Type -->
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">Select Type</option>
                        <option value="regular" {{ request()->type == 'regular' ? 'selected' : '' }}>Regular</option>
                        <option value="new" {{ request()->type == 'new' ? 'selected' : '' }}>New Arrival</option>
                        <option value="popular" {{ request()->type == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="special" {{ request()->type == 'special' ? 'selected' : '' }}>Special</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('food-items.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Food Item List</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('food-items.create') }}">
                    <i class="bi bi-plus"></i> Add New Food Item
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table
            :columns="['#', 'Image', 'Name', 'Category', 'Price', 'Type',  'Serial', 'Action']">
            @forelse($foodItems as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 + ($foodItems->currentPage() - 1) * $foodItems->perPage() }}</td>
                <td>
                    <img src="{{ asset($data->image) }}" alt="{{ $data->name }}" width="50">
                </td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->category->name }}</td>
                <td>{{ $data->price }} Tk</td>
                <td>
                    @if($data->type == 'new')
                    <span class="badge bg-primary">New Arrival</span>
                    @elseif($data->type == 'popular')
                    <span class="badge bg-info">Popular</span>
                    @elseif($data->type == 'special')
                    <span class="badge bg-success">Special</span>
                    @else
                    <span class="badge bg-secondary">Regular</span>
                    @endif
                </td>
                <td>
                    @if($data->serial==1000)
                    <span class="badge bg-warning">Not Set</span>
                    @else
                    {{ $data->serial }}
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('food-items.edit', $data->id) }}" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('food-items.destroy', $data->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure to delete?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
            @endforelse
        </x-table>
        <div class="d-flex justify-content-end">
            {{ $foodItems->links() }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
@endpush