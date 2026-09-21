@php
    // Dummy cart items — nanti diisi dari session/cart service kamu
    $items = $items ?? [
        ['id' => 1, 'name' => 'Cavendish Banana', 'price_per_unit' => 18000, 'unit' => 'kg', 'qty' => 2.5, 'subtotal' => 45000],
        ['id' => 2, 'name' => 'Sunkist Navel Orange', 'price_per_unit' => 32000, 'unit' => 'kg', 'qty' => 1.25, 'subtotal' => 40000],
        ['id' => 3, 'name' => 'Sweet Strawberries', 'price_per_unit' => 15000, 'unit' => 'pack', 'qty' => 2, 'subtotal' => 30000],
    ];
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

    <div class="relative mb-4">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true">👤</span>
        <input
            type="text"
            name="customer_name"
            placeholder="{{ __('Enter the name') }}"
            class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
        >
    </div>

    <form id="transaction-form" method="POST" action="{{ route('kasir.transaction.store') }}">
        @csrf

        <div class="space-y-4">
            @forelse ($items as $item)
                @include('kasir.transaction.components.transaction-item', ['item' => $item])
            @empty
                <p class="text-sm text-slate-400 text-center py-6">{{ __('Belum ada item di keranjang.') }}</p>
            @endforelse
        </div>

        @include('kasir.transaction.components.payment-section', ['itemCount' => count($items)])
    </form>

</div>
