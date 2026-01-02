@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $inSidebar = $inSidebar ?? false;

    // Colors
    $accentColor = $page->accent_color ?? '#6366f1';

    // Display type
    $displayType = $data['display_type'] ?? 'numbers';
    
    // Section title, subtitle & description
    $sectionTitle = $data['section_title'] ?? '';
    $sectionSubtitle = $data['section_subtitle'] ?? '';
    $description = $data['description'] ?? '';
    $hasDescription = !empty(trim(strip_tags($description)));

    // Parse stats
    $stats = [];
    $rawStats = $data['stats'] ?? '';
    if (!empty($rawStats)) {
        foreach(explode("\n", $rawStats) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = array_map('trim', explode('|', $line));
            if (count($parts) >= 2) {
                $numericValue = floatval(preg_replace('/[^0-9.]/', '', $parts[0])) ?: 10;
                $stats[] = [
                    'number' => $parts[0], 
                    'label' => $parts[1],
                    'value' => $numericValue
                ];
            }
        }
    }
    
    // Beautiful color palette
    $colors = [
        '#6366f1', '#ec4899', '#14b8a6', '#f59e0b', '#8b5cf6', '#06b6d4',
        '#ef4444', '#10b981', '#f97316', '#8b5cf6'
    ];
    $colorsLight = [
        '#eef2ff', '#fce7f3', '#ccfbf1', '#fef3c7', '#ede9fe', '#cffafe'
    ];
    
    $totalValue = array_sum(array_column($stats, 'value')) ?: 1;
    $blockId = 'stats-' . uniqid();
    
    // Prepare data for Chart.js
    $chartLabels = json_encode(array_column($stats, 'label'));
    $chartValues = json_encode(array_column($stats, 'value'));
    $chartColors = json_encode(array_slice($colors, 0, count($stats)));
@endphp

@if(count($stats) === 0)
    <div style="padding: 40px; text-align: center; color: #9ca3af;">
        <i class="fas fa-chart-bar" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
        <p>Belum ada data statistik</p>
    </div>
@elseif($inSidebar)
    {{-- Sidebar compact --}}
    <div style="padding: 20px;">
        @foreach(array_slice($stats, 0, 4) as $index => $stat)
            <div style="display: flex; align-items: center; gap: 12px; padding: 14px; margin-bottom: 10px; background: {{ $colorsLight[$index % 6] }}; border-radius: 12px; border-left: 4px solid {{ $colors[$index % 6] }};">
                <div style="font-size: 22px; font-weight: 800; color: {{ $colors[$index % 6] }};">{{ $stat['number'] }}</div>
                <div style="font-size: 13px; color: #374151; font-weight: 500;">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>
@else
    <div id="{{ $blockId }}" style="padding: 24px 0;">
        {{-- Block Header --}}
        @if($sectionTitle || $sectionSubtitle)
            <div style="margin-bottom: 24px; display: flex; align-items: flex-start; gap: 14px;">
                <div style="width: 4px; min-height: 36px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
                <div>
                    @if($sectionTitle)
                        <h3 style="font-size: clamp(18px, 2.5vw, 22px); font-weight: 700; margin: 0 0 6px; color: #1f2937;">{{ $sectionTitle }}</h3>
                    @endif
                    @if($sectionSubtitle)
                        <p style="font-size: 14px; color: #64748b; margin: 0; line-height: 1.5;">{{ $sectionSubtitle }}</p>
                    @endif
                </div>
            </div>
        @endif

        @if($displayType === 'numbers')
            {{-- ANGKA BESAR dengan Count Up Animation --}}
            <div class="stats-numbers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px;">
                @foreach($stats as $index => $stat)
                    <div class="stat-card" style="background: {{ $colors[$index % 10] }}; border-radius: 16px; padding: 28px 20px; text-align: center; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; transform: translateY(20px);"
                         onmouseover="this.style.transform='translateY(-4px) scale(1.02)'"
                         onmouseout="this.style.transform='translateY(0) scale(1)'">
                        <div style="position: absolute; top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                        <div style="position: absolute; bottom: -20px; left: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
                        <div style="position: relative;">
                            <div class="stat-number" data-target="{{ $stat['value'] }}" data-suffix="{{ preg_replace('/[0-9.,]+/', '', $stat['number']) }}" style="font-size: 40px; font-weight: 900; color: #fff; margin-bottom: 6px;">0</div>
                            <div style="font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.9);">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <script>
            (function() {
                const container = document.querySelector('#{{ $blockId }} .stats-numbers-grid');
                if (!container) return;
                
                const cards = container.querySelectorAll('.stat-card');
                const numbers = container.querySelectorAll('.stat-number');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Animate cards appearing
                            cards.forEach((card, i) => {
                                setTimeout(() => {
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0)';
                                }, i * 100);
                            });
                            
                            // Count up animation
                            numbers.forEach((num, i) => {
                                setTimeout(() => {
                                    const target = parseFloat(num.dataset.target) || 0;
                                    const suffix = num.dataset.suffix || '';
                                    const duration = 1500;
                                    const start = performance.now();
                                    
                                    function update(currentTime) {
                                        const elapsed = currentTime - start;
                                        const progress = Math.min(elapsed / duration, 1);
                                        const eased = 1 - Math.pow(1 - progress, 4); // easeOutQuart
                                        const current = Math.floor(eased * target);
                                        
                                        num.textContent = current.toLocaleString() + suffix;
                                        
                                        if (progress < 1) {
                                            requestAnimationFrame(update);
                                        } else {
                                            num.textContent = target.toLocaleString() + suffix;
                                        }
                                    }
                                    requestAnimationFrame(update);
                                }, i * 100);
                            });
                            
                            observer.disconnect();
                        }
                    });
                }, { threshold: 0.2 });
                
                observer.observe(container);
            })();
            </script>

        @elseif($displayType === 'cards')
            {{-- CARDS with animation --}}
            <div class="stats-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
                @foreach($stats as $index => $stat)
                    <div class="stat-card-item" style="background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; transform: translateY(25px) scale(0.95);"
                         onmouseover="this.style.transform='translateY(-4px) scale(1.02)'; this.style.boxShadow='0 12px 32px rgba(0,0,0,0.12)'"
                         onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div class="stat-icon-box" style="width: 52px; height: 52px; background: {{ $colorsLight[$index % 6] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                <i class="fas fa-{{ ['chart-line', 'users', 'trophy', 'star', 'rocket', 'gem'][$index % 6] }}" style="font-size: 22px; color: {{ $colors[$index % 6] }}; transition: transform 0.3s ease;"></i>
                            </div>
                            <div>
                                <div class="stat-number-card" data-target="{{ $stat['value'] }}" data-suffix="{{ preg_replace('/[0-9.,]+/', '', $stat['number']) }}" style="font-size: 30px; font-weight: 800; color: {{ $colors[$index % 6] }}; transition: all 0.3s ease;">0</div>
                                <div style="font-size: 14px; font-weight: 500; color: #64748b;">{{ $stat['label'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <script>
            (function() {
                const container = document.querySelector('#{{ $blockId }} .stats-cards-grid');
                if (!container) return;
                
                const cards = container.querySelectorAll('.stat-card-item');
                const numbers = container.querySelectorAll('.stat-number-card');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Animate cards appearing with staggered delay
                            cards.forEach((card, i) => {
                                setTimeout(() => {
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0) scale(1)';
                                }, i * 120);
                            });
                            
                            // Count up animation for numbers
                            numbers.forEach((num, i) => {
                                setTimeout(() => {
                                    const target = parseFloat(num.dataset.target) || 0;
                                    const suffix = num.dataset.suffix || '';
                                    const duration = 1200;
                                    const start = performance.now();
                                    
                                    function update(currentTime) {
                                        const elapsed = currentTime - start;
                                        const progress = Math.min(elapsed / duration, 1);
                                        const eased = 1 - Math.pow(1 - progress, 4);
                                        const current = Math.floor(eased * target);
                                        
                                        num.textContent = current.toLocaleString() + suffix;
                                        
                                        if (progress < 1) {
                                            requestAnimationFrame(update);
                                        } else {
                                            num.textContent = target.toLocaleString() + suffix;
                                        }
                                    }
                                    requestAnimationFrame(update);
                                }, i * 120 + 200);
                            });
                            
                            observer.disconnect();
                        }
                    });
                }, { threshold: 0.15 });
                
                observer.observe(container);
            })();
            </script>
            
            <style>
            #{{ $blockId }} .stat-card-item:hover .stat-icon-box {
                background: {{ $colors[0] }} !important;
            }
            #{{ $blockId }} .stat-card-item:hover .stat-icon-box i {
                color: #fff !important;
                transform: scale(1.1);
            }
            #{{ $blockId }} .stat-card-item:hover .stat-number-card {
                transform: scale(1.05);
            }
            </style>

        @elseif($displayType === 'progress')
            {{-- PROGRESS BAR --}}
            @if($hasDescription)
                {{-- Dengan deskripsi: dalam card putih --}}
                <div style="background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05);">
                    <div style="display: flex; flex-wrap: wrap; gap: 32px;">
                        <div style="flex: 1; min-width: 280px;">
                            @foreach($stats as $index => $stat)
                                @php $percent = min(100, $stat['value']); @endphp
                                <div style="margin-bottom: {{ $loop->last ? '0' : '18px' }};">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 14px; font-weight: 600; color: #374151;">{{ $stat['label'] }}</span>
                                        <span style="font-size: 16px; font-weight: 700; color: {{ $colors[$index % 6] }};">{{ $stat['number'] }}</span>
                                    </div>
                                    <div style="height: 8px; background: #f1f5f9; border-radius: 4px; overflow: hidden;">
                                        <div class="progress-bar-animate" style="height: 100%; width: 0%; background: linear-gradient(90deg, {{ $colors[$index % 6] }}, {{ $colors[$index % 6] }}cc); border-radius: 4px; transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);" data-width="{{ $percent }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="flex: 1; min-width: 220px; padding-left: 24px; border-left: 1px solid #f1f5f9;">
                            <div style="font-size: 14px; color: #64748b; line-height: 1.7;">{!! $description !!}</div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Tanpa deskripsi: FULL WIDTH dengan card --}}
                <div style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05);">
                    @foreach($stats as $index => $stat)
                        @php $percent = min(100, $stat['value']); @endphp
                        <div style="margin-bottom: {{ $loop->last ? '0' : '18px' }};">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 15px; font-weight: 600; color: #374151;">{{ $stat['label'] }}</span>
                                <span style="font-size: 18px; font-weight: 700; color: {{ $colors[$index % 6] }};">{{ $stat['number'] }}</span>
                            </div>
                            <div style="height: 12px; background: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                <div class="progress-bar-animate" style="height: 100%; width: 0%; background: linear-gradient(90deg, {{ $colors[$index % 6] }}, {{ $colors[$index % 6] }}cc); border-radius: 6px; transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);" data-width="{{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        @elseif(in_array($displayType, ['pie', 'donut', 'bar']))
            {{-- CHART.JS CHARTS --}}
            <div style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05);">
                @if($hasDescription)
                    {{-- Dengan deskripsi: 2 kolom --}}
                    <div style="display: flex; flex-wrap: wrap; gap: 32px; align-items: center;">
                        <div style="flex: 1; min-width: 280px;">
                            <div style="position: relative; {{ $displayType === 'bar' ? 'height: 280px;' : 'max-width: 320px; margin: 0 auto;' }}">
                                <canvas id="chart-{{ $blockId }}"></canvas>
                            </div>
                        </div>
                        <div style="flex: 1; min-width: 220px; padding-left: 24px; border-left: 1px solid #f1f5f9;">
                            <div style="font-size: 14px; color: #64748b; line-height: 1.7;">{!! $description !!}</div>
                        </div>
                    </div>
                @else
                    {{-- Tanpa deskripsi: FULL WIDTH --}}
                    <div style="position: relative; width: 100%; {{ $displayType === 'bar' ? 'height: 350px;' : 'max-width: 400px; margin: 0 auto;' }}">
                        <canvas id="chart-{{ $blockId }}"></canvas>
                    </div>
                @endif
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
            <script>
            (function() {
                const ctx = document.getElementById('chart-{{ $blockId }}');
                if (!ctx) return;

                const labels = {!! $chartLabels !!};
                const values = {!! $chartValues !!};
                const colors = {!! $chartColors !!};
                const displayType = '{{ $displayType }}';

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            createChart();
                            observer.disconnect();
                        }
                    });
                }, { threshold: 0.2 });

                observer.observe(ctx);

                function createChart() {
                    @if($displayType === 'bar')
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: colors.map(c => c + 'cc'),
                                    borderColor: colors,
                                    borderWidth: 2,
                                    borderRadius: 8,
                                    borderSkipped: false,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: {
                                        backgroundColor: '#1f2937',
                                        padding: 12,
                                        cornerRadius: 8,
                                        titleFont: { size: 14, weight: '600' },
                                        bodyFont: { size: 13 }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: { display: false },
                                        ticks: { font: { size: 12, weight: '500' }, color: '#64748b' }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: { color: '#f1f5f9' },
                                        ticks: { font: { size: 12 }, color: '#94a3b8' }
                                    }
                                },
                                animation: {
                                    duration: 1500,
                                    easing: 'easeOutQuart'
                                }
                            }
                        });
                    @elseif($displayType === 'pie')
                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: colors,
                                    borderColor: '#fff',
                                    borderWidth: 3,
                                    hoverOffset: 12
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            padding: 16,
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            font: { size: 12, weight: '500' }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: '#1f2937',
                                        padding: 12,
                                        cornerRadius: 8
                                    }
                                },
                                animation: {
                                    animateRotate: true,
                                    animateScale: true,
                                    duration: 1500,
                                    easing: 'easeOutQuart'
                                }
                            }
                        });
                    @elseif($displayType === 'donut')
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: colors,
                                    borderColor: '#fff',
                                    borderWidth: 3,
                                    hoverOffset: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                cutout: '65%',
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            padding: 16,
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            font: { size: 12, weight: '500' }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: '#1f2937',
                                        padding: 12,
                                        cornerRadius: 8
                                    }
                                },
                                animation: {
                                    animateRotate: true,
                                    animateScale: true,
                                    duration: 1500,
                                    easing: 'easeOutQuart'
                                }
                            }
                        });
                    @endif
                }
            })();
            </script>
        @endif
    </div>

    @if($displayType === 'progress')
    <script>
    (function() {
        const block = document.getElementById('{{ $blockId }}');
        if (!block) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    block.querySelectorAll('.progress-bar-animate').forEach((el, i) => {
                        setTimeout(() => el.style.width = el.dataset.width, 100 + i * 150);
                    });
                    observer.disconnect();
                }
            });
        }, { threshold: 0.3 });
        
        observer.observe(block);
    })();
    </script>
    @endif
@endif
