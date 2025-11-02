@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">31 Dofa Gallery List</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('galleries.create') }}">
                    <i class="bi bi-plus"></i> Add Gallery
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Image','Title', 'Action']">
            @foreach($galleries as $key => $gallery)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset($gallery->image) }}" alt="Gallery Image" style="max-width: 50px;">
                </td>
                <td>{{ $gallery->title }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('galleries.edit', $gallery->id) }}">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure to delete?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </x-table>
    </div>
</div>
@endsection