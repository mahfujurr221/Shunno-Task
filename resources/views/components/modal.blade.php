
@props([
    'id',
    'title' => 'Default Title',
    'modalSize' => '',
    'footer' => '',
    'action' => '#', // Default action
    'method' => 'POST',
    'role' => null
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog {{$modalSize}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data" role="{{ $role }}">
                @csrf
                @if($method === 'PUT')
                    @method('PUT')
                @endif
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            </form>
        </div>
    </div>
</div>
