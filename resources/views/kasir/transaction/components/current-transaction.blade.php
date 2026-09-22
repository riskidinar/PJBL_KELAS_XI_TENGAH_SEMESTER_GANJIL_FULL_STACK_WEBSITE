@php
    // Dummy cart items — nanti diisi dari session/cart service kamu
    $items = $items ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-5">

    <div class="flex items-center justify-between mb-1">
        <h2 class="font-semibold text-slate-800 text-lg">{{ __('Current Transaction') }}</h2>
        <span class="text-xs font-semibold bg-emerald-600 text-white px-2.5 py-1 rounded-md">
            TRX-{{ now()->format('Ymd') }}-001
        </span>
    </div>

    <div class="flex justify-between text-xs text-slate-400 mb-4">
        <span>{{ __('Current Register') }}: #01</span>
        <span>{{ __('Current Cashier') }}: {{ auth()->user()->name ?? 'Rizki' }}</span>
    </div>

    <form id="transaction-form" method="POST" action="{{ route('kasir.transaction.store') }}">
        @csrf

        <div class="relative mb-4">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"><img src="{{ asset('icons/customer_kasir.png') }}" class="w-3 h-3 object-contain"></span>
            <input
                type="text"
                name="customer_name"
                placeholder="{{ __('Enter the name') }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
            >
        </div>

        <div class="space-y-4" data-cart-items>
            @forelse ($items as $item)
                @include('kasir.transaction.components.transaction-item', ['item' => $item])
            @empty
                <p class="text-sm text-slate-400 text-center py-6">{{ __('Belum ada item di keranjang.') }}</p>
            @endforelse
        </div>

        <input type="hidden" name="cart_items" id="cart-items-input" value="[]">

        @include('kasir.transaction.components.payment-section', ['itemCount' => count($items)])
    </form>

</div>
