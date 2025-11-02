@props(['columns', 'rows','class'=>'table table-bordered table-striped table-hover'])
<table id="table" class="{{ $class }}">
    <thead>
        <tr class="text-center">
            @foreach ($columns as $column)
                {{-- <th class="bg-info">{{ $column }}</th> --}}
                <th>{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>