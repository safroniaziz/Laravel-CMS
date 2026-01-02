@php
    $data = $block['data'] ?? [];
    $settings = $block['settings'] ?? [];
    $title = $data['title'] ?? '';
    $accentColor = $page->accent_color ?? '#6366f1';
    $searchable = ($data['searchable'] ?? 'true') === 'true';
    $perPage = intval($data['per_page'] ?? 10);
    $headers = [];
    $rows = [];
    
    // Parse headers
    $rawHeaders = $data['headers'] ?? '';
    if (!empty($rawHeaders)) {
        $headers = array_map('trim', explode('|', $rawHeaders));
    }
    
    // Parse rows
    $rawItems = $data['items'] ?? '';
    if (!empty($rawItems)) {
        foreach(explode("\n", $rawItems) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $rows[] = array_map('trim', explode('|', $line));
        }
    }
    
    $blockId = 'tbl' . uniqid();
    $totalRows = count($rows);
@endphp

@if($totalRows > 0)
<div id="{{ $blockId }}" style="width: 100%;">
    @if($title)
        <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 4px; min-height: 28px; background: {{ $accentColor }}; border-radius: 2px; flex-shrink: 0;"></div>
            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #1f2937;">{{ $title }}</h3>
        </div>
    @endif
    
    <div style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; border: 1px solid #e5e7eb;">
        {{-- Search & Info Bar --}}
        @if($searchable || $perPage > 0)
        <div style="padding: 16px 20px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; background: #f9fafb;">
            @if($searchable)
            <div style="position: relative; flex: 1; max-width: 280px;">
                <input type="text" id="{{ $blockId }}-search" placeholder="Cari..." 
                    style="width: 100%; padding: 8px 12px 8px 36px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 13px; outline: none;"
                    oninput="filterTable{{ $blockId }}(this.value)">
                <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 12px;"></i>
            </div>
            @endif
            <div style="font-size: 13px; color: #6b7280;">
                <span id="{{ $blockId }}-info">{{ $totalRows }} data</span>
            </div>
        </div>
        @endif
        
        {{-- Table --}}
        <div style="overflow-x: auto;">
            <table id="{{ $blockId }}-table" style="width: 100%; border-collapse: collapse; min-width: 500px;">
                @if(count($headers) > 0)
                <thead>
                    <tr style="background: {{ $accentColor }};">
                        @foreach($headers as $hi => $header)
                        <th onclick="sortTable{{ $blockId }}({{ $hi }})" style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fff; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; white-space: nowrap; user-select: none;">
                            {{ $header }}
                            <i class="fas fa-sort" style="margin-left: 6px; opacity: 0.5; font-size: 10px;"></i>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                @endif
                <tbody id="{{ $blockId }}-body">
                    @foreach($rows as $ri => $row)
                    <tr class="table-row" data-row="{{ $ri }}" style="background: {{ $ri % 2 === 0 ? '#fff' : '#f9fafb' }}; border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                        @foreach($row as $ci => $cell)
                        <td style="padding: 12px 16px; font-size: 14px; color: {{ $ci === 0 ? '#1f2937' : '#6b7280' }}; font-weight: {{ $ci === 0 ? '500' : '400' }};">
                            @if(preg_match('/\.(pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar)$/i', $cell))
                                <a href="{{ $cell }}" target="_blank" download style="display: inline-flex; align-items: center; gap: 6px; color: {{ $accentColor }}; text-decoration: none; font-weight: 500;">
                                    <i class="fas fa-download" style="font-size: 12px;"></i>
                                    Download
                                </a>
                            @elseif(preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $cell))
                                <a href="{{ $cell }}" target="_blank">
                                    <img src="{{ $cell }}" style="max-width: 60px; max-height: 40px; border-radius: 4px; object-fit: cover;">
                                </a>
                            @elseif(filter_var($cell, FILTER_VALIDATE_URL))
                                <a href="{{ $cell }}" target="_blank" style="color: {{ $accentColor }}; text-decoration: none;">
                                    <i class="fas fa-external-link-alt" style="font-size: 11px; margin-right: 4px;"></i>Link
                                </a>
                            @else
                                {{ $cell }}
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($perPage > 0 && $totalRows > $perPage)
        <div id="{{ $blockId }}-pagination" style="padding: 16px 20px; border-top: 1px solid #e5e7eb; display: flex; justify-content: center; gap: 4px; background: #f9fafb;">
        </div>
        @endif
    </div>
</div>

<script>
(function(){
    const id = '{{ $blockId }}';
    const perPage = {{ $perPage }};
    const totalRows = {{ $totalRows }};
    let currentPage = 1;
    let sortCol = -1;
    let sortAsc = true;
    let filteredRows = [];
    
    // Init
    const allRows = document.querySelectorAll('#' + id + '-body .table-row');
    filteredRows = Array.from(allRows);
    if (perPage > 0) renderPagination();
    showPage(1);
    
    // Filter
    window['filterTable' + id] = function(query) {
        query = query.toLowerCase();
        filteredRows = [];
        allRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(query)) {
                filteredRows.push(row);
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        currentPage = 1;
        if (perPage > 0) renderPagination();
        showPage(1);
        document.getElementById(id + '-info').textContent = filteredRows.length + ' dari ' + totalRows + ' data';
    };
    
    // Sort
    window['sortTable' + id] = function(col) {
        if (sortCol === col) {
            sortAsc = !sortAsc;
        } else {
            sortCol = col;
            sortAsc = true;
        }
        
        filteredRows.sort((a, b) => {
            const aVal = a.children[col]?.textContent.trim() || '';
            const bVal = b.children[col]?.textContent.trim() || '';
            const aNum = parseFloat(aVal.replace(/[^0-9.-]/g, ''));
            const bNum = parseFloat(bVal.replace(/[^0-9.-]/g, ''));
            
            if (!isNaN(aNum) && !isNaN(bNum)) {
                return sortAsc ? aNum - bNum : bNum - aNum;
            }
            return sortAsc ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
        });
        
        const tbody = document.getElementById(id + '-body');
        filteredRows.forEach(row => tbody.appendChild(row));
        showPage(currentPage);
    };
    
    // Pagination
    function showPage(page) {
        currentPage = page;
        if (perPage === 0) {
            filteredRows.forEach(r => r.style.display = '');
            return;
        }
        
        const start = (page - 1) * perPage;
        const end = start + perPage;
        
        filteredRows.forEach((row, i) => {
            row.style.display = (i >= start && i < end) ? '' : 'none';
        });
        
        // Update active button
        document.querySelectorAll('#' + id + '-pagination button').forEach(btn => {
            btn.style.background = btn.dataset.page == page ? '{{ $accentColor }}' : '#fff';
            btn.style.color = btn.dataset.page == page ? '#fff' : '#6b7280';
        });
    }
    
    function renderPagination() {
        const container = document.getElementById(id + '-pagination');
        if (!container) return;
        
        const totalPages = Math.ceil(filteredRows.length / perPage);
        if (totalPages <= 1) {
            container.innerHTML = '';
            return;
        }
        
        let html = '';
        for (let i = 1; i <= totalPages; i++) {
            html += `<button data-page="${i}" onclick="(function(){document.querySelectorAll('#${id}-body .table-row').forEach((r,idx)=>{const vis=Array.from(document.querySelectorAll('#${id}-body .table-row')).filter(x=>x.style.display!=='none');const start=(${i}-1)*${perPage};const end=start+${perPage};vis.forEach((row,j)=>row.style.display=(j>=start&&j<end)?'':'none');});document.querySelectorAll('#${id}-pagination button').forEach(b=>{b.style.background=b.dataset.page==${i}?'{{ $accentColor }}':'#fff';b.style.color=b.dataset.page==${i}?'#fff':'#6b7280';});})()" style="width: 32px; height: 32px; border: 1px solid #e5e7eb; border-radius: 6px; background: ${i===1?'{{ $accentColor }}':'#fff'}; color: ${i===1?'#fff':'#6b7280'}; font-size: 13px; font-weight: 500; cursor: pointer;">${i}</button>`;
        }
        container.innerHTML = html;
    }
})();
</script>

<style>
#{{ $blockId }} tbody tr:hover {
    background: #f0f9ff !important;
}
</style>
@endif
