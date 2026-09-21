@php
    $cart = $cart ?? [
        'subtotal' => 115000,
        'tax_label' => 'Rp 0 (No tax per rule)',
        'total' => 115000,
        'amount_received' => 150000,
    ];
@endphp

<div class="space-y-4 pt-4">

    <div class="space-y-1 text-sm">
        <div class="flex justify-between text-slate-500">
            <span>{{ __('Subtotal (:count items)', ['count' => $itemCount ?? 3]) }}</span>
            <span class="text-slate-700 font-medium">Rp {{ number_format($cart['subtotal'], 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-slate-500">
        <span>{{ __('Tax / Discount') }}</span>
            <span>{{ $cart['tax_label'] }}</span>
        </div>
    </div>

    <div class="flex items-center justify-between border-t border-slate-100 pt-3">
        <span class="font-semibold text-slate-800">{{ __('Total Amount') }}</span>
        <span class="text-2xl font-bold text-emerald-700">Rp {{ number_format($cart['total'], 0, ',', '.') }}</span>
    </div>

    @include('kasir.transaction.components.payment-method')

    <div>
        <label for="amount_received" class="block text-xs font-semibold text-slate-500 mb-2 tracking-wide">
            AMOUNT RECEIVED (RP)
        </label>
        <input
            type="number"
            id="amount_received"
            name="amount_received"
            value="{{ $cart['amount_received'] }}"
            class="w-full text-right text-lg font-semibold px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
        >
    </div>

    <button
        type="submit"
        form="transaction-form"
        class="w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3.5 rounded-xl transition"
    >
        <span aria-hidden="true">🖨️</span>
        COMPLETE & PRINT RECEIPT
    </button>

</div>
