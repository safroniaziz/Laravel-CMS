@props(['block'])

<div class="block-text {{ $block['settings']['className'] ?? '' }}" 
     data-block-id="{{ $block['id'] }}"
     style="{{ $block['settings']['customStyle'] ?? '' }}">
    
    @if(($block['settings']['tag'] ?? 'p') === 'h1')
        <h1 style="color: {{ $block['settings']['color'] ?? 'inherit' }}; 
                   font-size: {{ $block['settings']['fontSize'] ?? 'inherit' }}; 
                   text-align: {{ $block['settings']['textAlign'] ?? 'left' }};">
            {!! $block['content'] ?? '' !!}
        </h1>
    @elseif(($block['settings']['tag'] ?? 'p') === 'h2')
        <h2 style="color: {{ $block['settings']['color'] ?? 'inherit' }}; 
                   font-size: {{ $block['settings']['fontSize'] ?? 'inherit' }}; 
                   text-align: {{ $block['settings']['textAlign'] ?? 'left' }};">
            {!! $block['content'] ?? '' !!}
        </h2>
    @elseif(($block['settings']['tag'] ?? 'p') === 'h3')
        <h3 style="color: {{ $block['settings']['color'] ?? 'inherit' }}; 
                   font-size: {{ $block['settings']['fontSize'] ?? 'inherit' }}; 
                   text-align: {{ $block['settings']['textAlign'] ?? 'left' }};">
            {!! $block['content'] ?? '' !!}
        </h3>
    @else
        <p style="color: {{ $block['settings']['color'] ?? 'inherit' }}; 
                  font-size: {{ $block['settings']['fontSize'] ?? 'inherit' }}; 
                  text-align: {{ $block['settings']['textAlign'] ?? 'left' }};">
            {!! $block['content'] ?? '' !!}
        </p>
    @endif
</div>
