@php
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? '';
    $style = $data['style'] ?? 'accordion';
    $blockBg = $data['settings']['bg_color'] ?? '#ffffff';
    $blockText = $data['settings']['text_color'] ?? '#1f2937';
    $placement = $block['settings']['placement'] ?? 'main';
@endphp

@if($placement === 'sidebar')
    {{-- Compact FAQ untuk sidebar --}}
    <div style="background: {{ $blockBg }}; border-radius: 12px; padding: 1.25rem; border-left: 4px solid #1e3a8a;">
        @if($title)
            <h4 style="color: {{ $blockText }}; font-weight: 700; margin-bottom: 1rem; font-size: 1rem;">
                <i class="fas fa-question-circle text-primary me-2"></i>{{ $title }}
            </h4>
        @endif
        <div class="faq-items-sidebar">
            @foreach(array_filter(explode("\n", $items)) as $index => $item)
                @php
                    $parts = explode('|', $item);
                    $question = trim($parts[0] ?? '');
                    $answer = trim($parts[1] ?? '');
                @endphp
                @if($question && $answer)
                    <div style="margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb;">
                        <div style="font-weight: 600; color: {{ $blockText }}; font-size: 0.85rem; margin-bottom: 0.25rem;">{{ $question }}</div>
                        <div style="color: #6b7280; font-size: 0.8rem; line-height: 1.5;">{{ $answer }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@else
    {{-- Full FAQ untuk main content --}}
    <div style="background: {{ $blockBg }}; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
        @if($title)
            <h2 style="color: {{ $blockText }}; font-weight: 800; margin-bottom: 2rem; font-size: clamp(1.5rem, 3vw, 2rem); text-align: center;">
                <i class="fas fa-question-circle text-primary me-2"></i>{{ $title }}
            </h2>
        @endif
        
        @if($style === 'accordion')
            <div class="accordion" id="faq-accordion-{{ $block['order'] ?? 0 }}">
                @foreach(array_filter(explode("\n", $items)) as $index => $item)
                    @php
                        $parts = explode('|', $item);
                        $question = trim($parts[0] ?? '');
                        $answer = trim($parts[1] ?? '');
                        $accordionId = 'faq-' . ($block['order'] ?? 0) . '-' . $index;
                    @endphp
                    @if($question && $answer)
                        <div class="accordion-item" style="border: none; background: transparent; margin-bottom: 1rem;">
                            <h3 class="accordion-header">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}"
                                        style="background: #f8fafc; border-radius: 12px; font-weight: 600; color: {{ $blockText }}; padding: 1.25rem; box-shadow: none;">
                                    <i class="fas fa-chevron-right me-3" style="font-size: 0.75rem; transition: transform 0.2s;"></i>
                                    {{ $question }}
                                </button>
                            </h3>
                            <div id="{{ $accordionId }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                 data-bs-parent="#faq-accordion-{{ $block['order'] ?? 0 }}">
                                <div class="accordion-body" style="padding: 1.25rem 1.5rem; color: #6b7280; line-height: 1.7;">
                                    {{ $answer }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <style>
                .accordion-button:not(.collapsed) i { transform: rotate(90deg); }
                .accordion-button:focus { box-shadow: none; }
            </style>
        @else
            {{-- Simple style - all open --}}
            <div class="faq-simple">
                @foreach(array_filter(explode("\n", $items)) as $index => $item)
                    @php
                        $parts = explode('|', $item);
                        $question = trim($parts[0] ?? '');
                        $answer = trim($parts[1] ?? '');
                    @endphp
                    @if($question && $answer)
                        <div style="background: #f8fafc; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem;">
                            <h4 style="color: {{ $blockText }}; font-weight: 700; margin-bottom: 0.75rem; font-size: 1.1rem;">
                                <i class="fas fa-question-circle text-primary me-2"></i>{{ $question }}
                            </h4>
                            <p style="color: #6b7280; margin: 0; line-height: 1.7;">{{ $answer }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endif
