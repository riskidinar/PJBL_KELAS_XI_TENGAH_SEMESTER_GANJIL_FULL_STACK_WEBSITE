@php
    // Ganti dengan $cashiers dari controller
    $cashiers = $cashiers ?? [
        ['name' => 'Rizki Ramadhan', 'status' => 'Active Now', 'shift' => 'Shift 1 • Register #01 • Started 08.00 AM', 'amount' => 2420000, 'trx' => 32],
        ['name' => 'Siti Aisyah',    'status' => 'Active Now', 'shift' => 'Shift 1 • Register #02 • Started 08.00 AM', 'amount' => 1780000, 'trx' => 24],
        ['name' => 'Dian Kusuma',    'status' => 'On Break',   'shift' => 'Shift 2 • Register #03 • Resumes 11:30 AM', 'amount' => 650000, 'trx' => 8],
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-5">

    <div class="flex items-center justify-between mb-1">
        <h2 class="font-semibold text-slate-800 text-lg">{{ __('Cashier Performance & Terminals') }}</h2>
        <a href="{{ route('admin.kasir.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-800">
            Shift Logs →
        </a>
    </div>
    <p class="text-sm text-slate-400 mb-4">{{ __('Live metrics per register workstation') }}</p>

    <div class="space-y-3">
        @foreach ($cashiers as $cashier)
            @php $active = $cashier['status'] === 'Active Now'; @endphp
            <div class="flex items-center gap-3 border border-slate-100 rounded-xl p-3">

                <div class="relative shrink-0">
                    <img
                        src="{{ $cashier['avatar_url'] ?? asset('images/default-avatar.png') }}"
                        alt="{{ $cashier['name'] }}"
                        class="w-10 h-10 rounded-full object-cover"
                    >
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white {{ $active ? 'bg-emerald-500' : 'bg-orange-400' }}"></span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="font-semibold text-slate-800 text-sm">{{ $cashier['name'] }}</p>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $active ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-600' }}">
                            {{ $cashier['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $cashier['shift'] }}</p>
                </div>

                <div class="text-right shrink-0">
                    <p class="font-bold text-slate-800">Rp {{ number_format($cashier['amount'], 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400">{{ $cashier['trx'] }} Transactions</p>
                </div>
            </div>
        @endforeach
    </div>

</div>
