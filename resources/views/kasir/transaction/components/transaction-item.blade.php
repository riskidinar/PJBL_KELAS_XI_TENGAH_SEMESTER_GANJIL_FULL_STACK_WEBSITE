{{--
    Satu baris item di keranjang transaksi berjalan.
    Dipanggil dari current-transaction.blade.php.
--}}
<div class="border-b border-slate-100 pb-4">
    <div class="flex items-start justify-between mb-2">
        <div>
            <p class="font-semibold text-slate-800 text-sm">{{ $item['name'] }}</p>
            <p class="text-xs text-slate-400">Rp {{ number_format($item['price_per_unit'], 0, ',', '.') }} / {{ $item['unit'] }}</p>
        </div>
        <p class="font-semibold text-emerald-700 text-sm">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
    </div>

    <div class="flex items-center gap-3">
        <button type="button" class="w-7 h-7 rounded-md border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50"
                data-qty-decrease="{{ $item['id'] }}">−</button>

        <span class="text-sm w-14 text-center" data-qty-value="{{ $item['id'] }}">{{ $item['qty'] }} {{ $item['unit'] }}</span>

        <button type="button" class="w-7 h-7 rounded-md border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50"
                data-qty-increase="{{ $item['id'] }}">+</button>

        <button type="button" class="ml-auto text-red-500 hover:text-red-600" data-remove-item="{{ $item['id'] }}">
            <span aria-hidden="true"><img src="{{ asset('icons/delete_transaction.png') }}" class="w-4 h-4 object-contain"></span>
        </button>
    </div>
</div>
