@php
    $trxId = $trxId ?? 'TRX-20260913-001';
@endphp

<div class="flex items-center gap-3 bg-indigo-50/60 border border-indigo-100 rounded-2xl px-5 py-4 mb-6">
    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-emerald-500 text-white text-lg"><img src="{{ asset('icons/check_struk.png') }}" class="w-5 h-5 object-contain"></span>
    <p class="font-semibold text-slate-800">Transaction Completed</p>
    <span class="font-mono text-xs font-semibold text-slate-500 bg-white border border-slate-200 rounded-md px-2.5 py-1">
        {{ $trxId }}
    </span>
</div>