@props([
    'name',
    'value' => null,
    'type' => 'text',
    ])
@if($type === 'textarea')
<textarea
    class="form-control @error($name) is-invalid @enderror"
    id="{{$name}}"
    type={{$type}}
    name={{$name}}
    {{$attributes}}
    >{{$value}}</textarea>

@else

<input
    class="form-control @error($name) is-invalid @enderror"
    id="{{$name}}"
    type={{$type}}
    name={{$name}}
    @if($value) value="{{$value}}" @endif
    {{$attributes}}
    />
@endif
@error($name)
<div id="{{$name}}Error" class="invalid-feedback">{{$errors->first($name) ?? 'Invalid Input'}}</div>
@enderror
