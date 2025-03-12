@props([
    'name',
    'value' => null,
    'type' => 'text',
    ])

<input 
    class="form-control @error($name) is-invalid @enderror" 
    id="{{$name}}" 
    type={{$type}} 
    name={{$name}} 
    @if($value) value="{{$value}}" @endif 
    {{$attributes}}
    />
@error($name)
<div id="{{$name}}Error" class="invalid-feedback">{{$errors->first($name) ?? 'Invalid Input'}}</div>
@enderror