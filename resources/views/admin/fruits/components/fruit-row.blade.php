{{--
    Satu baris produk buah. Dipanggil dari fruit-table.blade.php dengan
    @include(..., ['fruit' => $fruit]).
    $fruit: id, code, image, name, category, unit, unit_price,
    current_stock_label, deficit_label (null kalau tidak ada),
    stock_percent (0-100, dipakai lebar progress bar),
    status ('available'|'low'|'out'), status_label, updated_label, faded (bool)
--}}
@php
    $statusStyles = [
        'available' => ['badge' => 'bg-emerald-100 text-emerald-700', 'bar' => 'bg-emerald-500', 'value' => 'text-slate-800'],
        'low'       => ['badge' => 'bg-orange-100 text-orange-600', 'bar' => 'bg-orange-500', 'value' => 'text-orange-600'],
        'out'       => ['badge' => 'bg-red-500 text-white', 'bar' => 'bg-red-400', 'value' => 'text-red-500'],
    ];
    $style = $statusStyles[$fruit['status']] ?? $statusStyles['available'];
    $faded = $fruit['faded'] ?? ($fruit['status'] === 'out');
@endphp

<tr class="border-b border-slate-100 hover:bg-slate-50/60 {{ $faded ? 'opacity-70' : '' }}">

    <td class="py-4 pl-5 pr-3">
        <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" value="{{ $fruit['id'] }}">
    </td>

    <td class="py-4 pr-4 whitespace-nowrap">
        <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md">{{ $fruit['code'] }}</span>
    </td>

    <td class="py-4 pr-4">
        <div class="flex items-center gap-3">
            <img src="{{ $fruit['image'] }}" alt="{{ $fruit['name'] }}" class="w-11 h-11 rounded-lg object-cover shrink-0">
            <div>
                <p class="font-semibold {{ $faded ? 'text-slate-400' : 'text-slate-800' }} leading-tight">{{ $fruit['name'] }}</p>
                <p class="text-xs text-slate-400">{{ $fruit['category'] }}</p>
            </div>
        </div>
    </td>

    <td class="py-4 pr-4 text-sm text-slate-600">{{ $fruit['unit'] }}</td>

    <td class="py-4 pr-4 whitespace-nowrap">
        <p class="font-semibold text-slate-800">Rp {{ number_format($fruit['unit_price'], 0, ',', '.') }}</p>
        <p class="text-xs text-slate-400">/ {{ $fruit['unit'] }}</p>
    </td>

    <td class="py-4 pr-4">
        <div class="flex items-center gap-2 mb-1.5">
            <span class="font-semibold {{ $style['value'] }}">{{ $fruit['current_stock_label'] }}</span>
            @if(!empty($fruit['deficit_label']))
                <span class="text-xs font-medium text-orange-500">{{ $fruit['deficit_label'] }}</span>
            @endif
        </div>
        <div class="h-1.5 rounded-full bg-slate-100">
            <div class="h-1.5 rounded-full {{ $style['bar'] }}" style="width: {{ $fruit['stock_percent'] }}%"></div>
        </div>
    </td>

    <td class="py-4 pr-4 whitespace-nowrap">
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full {{ $style['badge'] }}">
            {{ $fruit['status_label'] }}
        </span>
    </td>

    <td class="py-4 pr-4 text-sm text-slate-500 whitespace-nowrap">{{ $fruit['updated_label'] }}</td>

    <td class="py-4 pr-5 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.fruits.edit', $fruit['id']) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100" title="Edit">
                <img src="{{ asset('icons/edit_buah.png') }}" class="w-4 h-4 object-contain">
            </a>
            <form method="POST" action="{{ route('admin.fruits.destroy', $fruit['id']) }}" onsubmit="return confirm('Hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50" title="Hapus">
                    <img src="{{ asset('icons/delete.png') }}" class="w-4 h-4 object-contain">
                </button>
            </form>
        </div>
    </td>

</tr>