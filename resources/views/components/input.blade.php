@props([
'id'=>'',
'name'=>'',
'class' => '',
'type' => 'text',
'placeholder' => '',
'value' => null,
'required' => false
])

<input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" class="form-control my-1 {{ $class }}"
    placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" @if($required) required @endif>
