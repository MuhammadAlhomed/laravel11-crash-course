@props([
    'for',
    ])
<label 
    {{$attributes->merge(['class' => 'input-label']) }} 
    for={{$for}} 
    {{$attributes}}
    >
    
    {{$slot}}
</label>