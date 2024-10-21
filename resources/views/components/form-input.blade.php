@props([
    'name',
    'type' => 'text',
    ])

<input id="{{$name}}" class="form-control @error($name) is-invalid @enderror" type={{$type}} name={{$name}} {{$attributes}}>
@error($name)
<div id="{{$name}}Error" class="invalid-feedback">{{$errors->first($name) ?? 'Invalid Input'}}</div>
@enderror