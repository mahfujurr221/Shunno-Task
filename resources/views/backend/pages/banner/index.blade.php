@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">Banner List</h4>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                        <i class="bi bi-plus"></i> Add New Banner
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body">
            <x-table :columns="['#', 'Image','Title', 'Small Title', 'Button Text', 'Embed Code', 'Status', 'Action']">
                @forelse($banners as $key => $data)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if ($data->image_url)
                                <img src="{{ asset($data->image_url) }}" alt="{{ $data->title }}"
                                    style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $data->title ?? '' }}</td>
                        <td>{{ $data->small_title ?? '' }}</td>
                        <td>{{ $data->btnText ?? '' }}</td>
                        <td>{{ $data->videoUrl ?? '' }}</td>

                        <td>
                            @if ($data->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <!-- Action Buttons -->
                        <td>
                            <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                                data-bs-target="#editBannerModal" data-id="{{ $data->id }}"
                                data-title="{{ $data->title }}" data-small_title="{{ $data->small_title }}" data-image_url="{{ $data->image_url }}"
                                data-btn_text="{{ $data->btnText }}" data-video_text="{{ $data->videoText }}"
                                data-video_url="{{ $data->videoUrl }}" data-btn_url="{{ $data->btnUrl }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            {{-- <a href="{{ route('banners.edit', $data->id) }}" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addBannerModal" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a> --}}
                            {{-- <form action="{{ route('banners.destroy', $data->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure to delete?')" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Data Found</td>
                    </tr>
                @endforelse
            </x-table>
        </div>

    </div>


    {{-- Add Modal --}}
    <x-modal id="addBannerModal" title="Add New Banner" modalSize="modal-lg" action="{{ route('banners.store') }}">
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </x-slot>
        <div class="mb-2 form-group">
            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
            <x-input type="text" name="title" placeholder="Enter Course Title" required />
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="small_title">Small Text<span class="text-danger">*</span></label>
            <x-input type="text" name="small_title" placeholder="Enter Small Title" required />
            @error('code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="mb-2 form-group">
                    <label class="form-label" for="buttonText"> Button Text</label>
                    <x-input type="text" name="btnText" placeholder="Button Text" required />
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-2 form-group">
                    <label class="form-label" for="videoText"> Video Text</label>
                    <x-input type="text" name="videoText" placeholder="Video Text" />
                </div>

            </div>
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="buttonText"> Button Url <span class="text-danger">*</span></label>
            <x-input type="text" name="btnUrl" placeholder="Video Text" />
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="videoUrl"> Video Embed Code <span class="text-danger">*</span></label>
            <x-input type="text" name="videoUrl" placeholder="Video embed code" />
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="image">Image <span class="text-danger">*</span></label>
            <x-input type="file" name="image_url" required />
            @error('image_url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </x-modal>

    {{-- edit modal --}}
    <x-modal id="editBannerModal" title="Update Banner" modalSize="modal-lg" method="POST" encytpe="multipart/form-data">
        @csrf
        @method('PUT')
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update changes</button>
        </x-slot>
        <div class="mb-2 form-group">
            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
            <x-input type="text" name="title" placeholder="Enter Course Title" id="edit_title" required />
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="small_title">Small Text<span class="text-danger">*</span></label>
            <x-input type="text" name="small_title" placeholder="Enter Small Title" id="edit_small_title" required />
            @error('code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="mb-2 form-group">
                    <label class="form-label " for="buttonText"> Button Text</label>
                    <x-input type="text" name="btnText" placeholder="Button Text" id="edit_btnText"  />
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-2 form-group">
                    <label class="form-label " for="videoText"> Video Text</label>
                    <x-input type="text" name="videoText" placeholder="Video Text" id="edit_videoText"  />
                </div>

            </div>
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="buttonText"> Button Url <span class="text-danger">*</span></label>
            <x-input type="text" name="btnUrl" placeholder="Video Text" id="edit_btnUrl" />
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="videoUrl"> Video Embed Code <span class="text-danger">*</span></label>
            <x-input type="text" name="videoUrl" placeholder="Video embed code" id="edit_videoUrl" />
        </div>

        <div class="mb-2 form-group">
            <label class="form-label" for="image">Image <span class="text-danger">*</span></label>
            <x-input type="file" name="image_url"  class="mb-1 form-group" required />


            <img src="" id="edit_image_url" alt="Image" style="width: 60px; height: 60px; object-fit: cover;">

            @error('image_url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </x-modal>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.editButton', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var small_title = $(this).data('small_title');
            var btnText = $(this).data('btn_text');
            var videoText = $(this).data('video_text');
            var videoUrl = $(this).data('video_url');
            var btnUrl = $(this).data('btn_url');
            var image_url = $(this).data('image_url');
            // alert(videoUrl);
            var url = "{{ route('banners.update', ':id') }}";
            url = url.replace(':id', id);

            $('#edit_title').val(title);
            $('#edit_small_title').val(small_title);
            $('#edit_btnText').val(btnText);
            $('#edit_videoText').val(videoText);
            $('#edit_videoUrl').val(videoUrl);
            $('#edit_btnUrl').val(btnUrl);
            $('#edit_image_url').attr('src', '{{ asset('') }}' + image_url);
            $('#editBannerModal').find('form').attr('action', url);

        });
    </script>
@endpush
