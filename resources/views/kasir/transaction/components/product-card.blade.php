{{--
    Dipanggil dari product-grid.blade.php dengan @include(..., ['product' => $product])
    $product diharapkan berbentuk array/objek dengan: code, stock_label, image,
    category, name, price, unit, in_stock (bool)
--}}
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden {{ !($product['in_stock'] ?? true) ? 'opacity-60' : '' }}">

    <div class="relative h-32">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">

        <span class="absolute top-2 left-2 text-[10px] font-semibold bg-white/90 text-slate-600 px-2 py-0.5 rounded-md">
            {{ $product['code'] }}
        </span>

        @if($product['in_stock'] ?? true)
            <span class="absolute top-2 right-2 text-[10px] font-semibold bg-emerald-600 text-white px-2 py-0.5 rounded-md flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                {{ $product['stock_label'] }}
            </span>
        @else
            <span class="absolute top-2 right-2 text-[10px] font-semibold bg-red-500 text-white px-2 py-0.5 rounded-md">
                {{ $product['stock_label'] ?? 'Slot Habis' }}
            </span>
        @endif
    </div>

    <div class="p-3">
        <p class="text-xs font-medium text-emerald-700">{{ $product['category'] }}</p>
        <p class="font-semibold text-slate-800 mb-2">{{ $product['name'] }}</p>

        <div class="flex items-center justify-between">
            <p class="text-emerald-700 font-bold">
                Rp {{ number_format($product['price'], 0, ',', '.') }}<span class="text-slate-400 font-normal">/{{ $product['unit'] }}</span>
            </p>

            <button
                type="button"
                class="w-9 h-9 rounded-lg flex items-center justify-center transition
                       {{ ($product['in_stock'] ?? true) ? 'bg-emerald-600 hover:bg-emerald-700 text-white' : 'bg-slate-100 text-slate-400 cursor-not-allowed' }}"
                @if(!($product['in_stock'] ?? true)) disabled @endif
                data-add-to-cart="{{ $product['id'] ?? '' }}"
            >
                <span aria-hidden="true">🛒</span>
            </button>
        </div>
    </div>
</div>
