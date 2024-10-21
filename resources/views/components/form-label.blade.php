@props([
    'for',
    ])
<label for={{$for}} {{$attributes->merge(['class' => 'input-label']) }} {{$attributes}}>{{$slot}}</label>