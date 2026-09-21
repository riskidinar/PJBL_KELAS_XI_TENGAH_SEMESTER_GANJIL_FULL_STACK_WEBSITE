{{--
    Satu baris transaksi versi Admin. Dipanggil dari transaction-table.blade.php
    dengan @include(..., ['trx' => $trx]).
    Beda dari versi kasir: avatar warna beda per cashier, dan badge "LATEST"
    di baris transaksi paling baru.
--}}
@php
    $dotColors = ['bg-orange-400', 'bg-sky-400', 'bg-emerald-400', 'bg-fuchsia-400'];
@endphp

<tr class="border-b border-slate-100 align-top {{ $trx['is_latest'] ?? false ? 'bg-emerald-50/40' : 'hover:bg-slate-50/60' }}">

    {{-- TRX ID / Timestamp --}}
    <td class="py-4 pl-5 pr-4 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <p class="font-mono text-sm font-semibold text-emerald-700">{{ $trx['id'] }}</p>
            @if ($trx['is_latest'] ?? false)
                <span class="text-[10px] font-bold bg-emerald-600 text-white px-2 py-0.5 rounded-md">LATEST</span>
            @endif
        </div>
        <p class="text-xs text-slate-400 mt-0.5">{{ $trx['timestamp'] }}</p>
    </td>

    {{-- Register & Cashier --}}
    <td class="py-4 pr-4 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <span class="w-7 h-7 shrink-0 rounded-full {{ $trx['avatar_color'] ?? 'bg-emerald-600' }} text-white text-[11px] font-bold flex items-center justify-center">
                {{ $trx['cashier_initials'] }}
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-700 leading-tight">{{ $trx['cashier_name'] }}</p>
                <p class="text-xs text-slate-400">{{ $trx['register'] }}</p>
                <p class="text-xs text-slate-400">({{ $trx['cashier_note'] }})</p>
            </div>
        </div>
    </td>

    {{-- Customer --}}
    <td class="py-4 pr-4">
        <p class="text-sm font-semibold text-slate-700">{{ $trx['customer_name'] }}</p>
        @if(!empty($trx['customer_code']))
            <p class="text-xs text-slate-400 font-mono">{{ $trx['customer_code'] }}</p>
        @endif
        @if(!empty($trx['customer_note']))
            <p class="text-xs text-emerald-600 font-medium">{{ $trx['customer_note'] }}</p>
        @endif
    </td>

    {{-- Produce Basket (Audit Summary) --}}
    <td class="py-4 pr-4">
        <div class="flex flex-wrap gap-1.5">
            @foreach ($trx['items'] as $i => $item)
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600 bg-slate-50 border border-slate-100 rounded-md px-2 py-1">
                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColors[$i % count($dotColors)] }}"></span>
                    {{ $item['name'] }} ({{ $item['weight'] }})
                </span>
            @endforeach
            @if(!empty($trx['extra_note']))
                <span class="inline-flex items-center text-xs font-medium text-slate-400 bg-slate-50 border border-dashed border-slate-200 rounded-md px-2 py-1">
                    {{ $trx['extra_note'] }}
                </span>
            @endif
        </div>
    </td>

    {{-- Net Weight / Qty --}}
    <td class="py-4 pr-4 text-right whitespace-nowrap">
        <p class="font-semibold text-slate-800">{{ $trx['net_weight'] }}</p>
        <p class="text-xs text-slate-400">{{ $trx['item_count'] }} items</p>
    </td>

    {{-- Tender Method --}}
    <td class="py-4 pr-4 whitespace-nowrap">
        <p class="text-sm font-semibold text-slate-700 flex items-center gap-1.5">
            <span class="leading-none">💳</span> {{ $trx['tender_method'] }}
        </p>
        @foreach ($trx['tender_lines'] ?? [] as $line)
            <p class="text-xs text-slate-400">{{ $line }}</p>
        @endforeach
    </td>

    {{-- Total --}}
    <td class="py-4 pr-4 text-right whitespace-nowrap">
        <p class="font-bold text-slate-800">Rp {{ number_format($trx['total'], 0, ',', '.') }}</p>
        @if(!empty($trx['total_note']))
            <p class="text-xs text-slate-400">{{ $trx['total_note'] }}</p>
        @endif
    </td>

    {{-- Actions --}}
    <td class="py-4 pr-5 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <button type="button" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100" title="Print Receipt">
                🖨️
            </button>
            <button type="button" class="w-8 h-8 flex items-center justify-center rounded-lg {{ $trx['is_latest'] ?? false ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:bg-slate-100' }}" title="View Detail">
                👁️
            </button>
        </div>
    </td>

</tr>