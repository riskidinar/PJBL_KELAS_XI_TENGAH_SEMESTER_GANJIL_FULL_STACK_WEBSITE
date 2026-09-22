{{--
    Satu baris produk. Dipanggil dari scale-table.blade.php dengan
    @include(..., ['product' => $product])
    $product: image, name, plu, unit_note, category, category_sub,
    volume, volume_unit, revenue, days_remaining, turnover_status
    (turnover_status: 'fast' | 'optimal' | 'stable' | 'critical'), turnover_percent
--}}
@php
    $statusStyles = [
        'fast'     => ['label' => 'Fast',     'text' => 'text-emerald-600', 'bar' => 'bg-emerald-500'],
        'optimal'  => ['label' => 'Optimal',  'text' => 'text-emerald-600', 'bar' => 'bg-emerald-500'],
        'stable'   => ['label' => 'Stable',   'text' => 'text-sky-600',     'bar' => 'bg-sky-500'],
        'critical' => ['label' => 'Critical', 'text' => 'text-orange-600', 'bar' => 'bg-orange-500'],
    ];
    $style = $statusStyles[$product['turnover_status']] ?? $statusStyles['stable'];
@endphp

<tr class="border-b border-slate-100 last:border-0">

    <td class="py-4 pl-8 pr-6">
        <div class="flex items-center gap-3">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                class="w-14 h-14 rounded-lg object-contain bg-slate-50 p-1 shrink-0"
                loading="lazy"
                onerror="this.onerror=null; this.src='{{ asset('img/login.png') }}';">
            <div>
                <p class="font-semibold text-slate-800 leading-tight">{{ $product['name'] }}</p>
                <p class="text-xs text-slate-400">PLU {{ $product['plu'] }} &bull; {{ $product['unit_note'] }}</p>
            </div>
        </div>
    </td>

    <td class="py-4 px-6 text-sm text-slate-600">
        {{ $product['category'] }}
        @if (! empty($product['category_sub']))
            <br class="hidden md:block"> {{ $product['category_sub'] }}
        @endif
    </td>

    <td class="py-4 px-6 text-right font-semibold text-slate-800 whitespace-nowrap">
        {{ $product['volume'] }} {{ $product['volume_unit'] }}
    </td>

    <td class="py-4 px-6 text-right font-semibold text-slate-800 whitespace-nowrap">
        Rp {{ number_format($product['revenue'], 0, ',', '.') }}
    </td>

    <td class="py-4 pl-6 pr-8 min-w-40">
        <div class="flex items-center justify-between mb-1.5">
            <span class="text-xs text-slate-500">{{ $product['days_remaining'] }} Days Remaining</span>
            <span class="text-xs font-semibold {{ $style['text'] }}">{{ $style['label'] }}</span>
        </div>
        <div class="h-1.5 rounded-full bg-slate-100">
            <div class="h-1.5 rounded-full {{ $style['bar'] }}" style="width: {{ $product['turnover_percent'] }}%"></div>
        </div>
    </td>

</tr>
