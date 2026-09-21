@php
    // Ganti dengan $transaction dari controller
    $transaction = $transaction ?? [
        'grand_total' => 115000,
        'tendered' => 150000,
        'ref' => 'TRX-20260913-001',
        'datetime' => '13/09/2026, 10:42:15 WIB',
        'cashier' => 'Rizki Ramadhan (#01)',
        'customer' => 'Budi Santoso (Member)',
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-6">

    <div class="flex items-center gap-3 mb-5">
        <span class="w-11 h-11 flex items-center justify-center rounded-xl bg-emerald-500 text-white text-xl">⚙️</span>
        <div>
            <p class="text-xs font-bold text-emerald-600 tracking-wide">{{ __('ORDER SETTLED') }}</p>
            <p class="text-xl font-bold text-slate-800">{{ __('Payment Successful') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 bg-slate-50 rounded-xl p-4 mb-5">
        <div>
            <p class="text-xs text-slate-400 mb-1">{{ __('Summary Grand Total') }}</p>
            <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($transaction['grand_total'], 0, ',', '.') }}</p>
        </div>
        <div>
            <p class="text-xs text-slate-400 mb-1">{{ __('Tendered') }}</p>
            <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($transaction['tendered'], 0, ',', '.') }}</p>
        </div>
    </div>

    <dl class="space-y-3 mb-6">
        <div class="flex items-center justify-between text-sm">
            <dt class="text-slate-400">{{ __('Transaction Ref') }}</dt>
            <dd class="font-mono font-semibold text-slate-800">{{ $transaction['ref'] }}</dd>
        </div>
        <div class="flex items-center justify-between text-sm">
            <dt class="text-slate-400">{{ __('Date & Timestamp') }}</dt>
            <dd class="font-semibold text-slate-800">{{ $transaction['datetime'] }}</dd>
        </div>
        <div class="flex items-center justify-between text-sm">
            <dt class="text-slate-400">{{ __('Active Cashier') }}</dt>
            <dd class="font-semibold text-slate-800">{{ $transaction['cashier'] }}</dd>
        </div>
        <div class="flex items-center justify-between text-sm">
            <dt class="text-slate-400">{{ __('Customer Profile') }}</dt>
            <dd class="font-semibold text-emerald-600">{{ $transaction['customer'] }}</dd>
        </div>
    </dl>

    <button
        type="button"
        onclick="window.print()"
        class="w-full flex items-center justify-between gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-3.5 rounded-xl transition mb-3"
    >
        <span class="flex items-center gap-2">
            <span class="leading-none">🖨️</span> Print Thermal Receipt
        </span>
        <span class="text-xs font-mono bg-white/20 px-2 py-1 rounded-md">[ENTER] / [Ctrl+P]</span>
    </button>

    <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('kasir.transaction.index') }}"
           class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl transition">
            <span class="leading-none">🧾</span> New Sale [Space]
        </a>
        <a href="{{ route('kasir.history.index') }}"
           class="flex items-center justify-center gap-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold py-2.5 rounded-xl transition">
            <span class="leading-none">📄</span> View All Logs
        </a>
    </div>

</div>
