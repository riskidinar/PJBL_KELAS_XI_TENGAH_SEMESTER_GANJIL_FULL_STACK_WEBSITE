@php
    // Ganti dengan $sessionId, $autoReconciliation, $transactions dari controller
    $sessionId = $sessionId ?? '#20260913-S1';
    $autoReconciliation = $autoReconciliation ?? true;

    $transactions = $transactions ?? [
        [
            'id' => 'TRX-20260913-072', 'timestamp' => '10:42:15 WIB',
            'register' => 'Reg #01', 'cashier_name' => 'Rizki Ramadhan', 'cashier_initials' => 'RR', 'cashier_note' => 'Scale SC-II',
            'customer_name' => 'Budi Santoso', 'customer_code' => 'MB-982', 'customer_note' => '(+115 Pts)',
            'items' => [['name' => 'Cavendish', 'weight' => '2.5kg'], ['name' => 'Sunkist', 'weight' => '1.25kg']],
            'extra_note' => '+1 pack',
            'net_weight' => '3.750 kg', 'item_count' => 3,
            'tender_method' => 'Cash', 'tender_lines' => [],
            'total' => 115000, 'total_note' => null,
            'status' => 'Settled', 'highlight' => true,
        ],
        [
            'id' => 'TRX-20260913-072', 'timestamp' => '10:42:15 WIB',
            'register' => 'Reg #01', 'cashier_name' => 'Rizki Ramadhan', 'cashier_initials' => 'RR', 'cashier_note' => 'Scale SC-II',
            'customer_name' => 'Walk-in Customer', 'customer_code' => null, 'customer_note' => 'Guest Terminal',
            'items' => [['name' => 'Fuji Apple', 'weight' => '1.800kg'], ['name' => 'Honey Mango', 'weight' => '1.100kg']],
            'extra_note' => null,
            'net_weight' => '2.900 kg', 'item_count' => 2,
            'tender_method' => 'QRIS BCA', 'tender_lines' => ['Ref: 99823412'],
            'total' => 89500, 'total_note' => 'Tax Exempt (0%)',
            'status' => 'Settled',
        ],
        [
            'id' => 'TRX-20260913-072', 'timestamp' => '10:42:15 WIB',
            'register' => 'Reg #01', 'cashier_name' => 'Rizki Ramadhan', 'cashier_initials' => 'RR', 'cashier_note' => 'Scale SC-II',
            'customer_name' => 'Walk-in Customer', 'customer_code' => null, 'customer_note' => 'Guest Terminal',
            'items' => [['name' => 'Fuji Apple', 'weight' => '1.800kg'], ['name' => 'Honey Mango', 'weight' => '1.100kg']],
            'extra_note' => null,
            'net_weight' => '2.900 kg', 'item_count' => 2,
            'tender_method' => 'QRIS BCA', 'tender_lines' => ['Ref: 99823412'],
            'total' => 89500, 'total_note' => 'Tax Exempt (0%)',
            'status' => 'Settled',
        ],
        [
            'id' => 'TRX-20260913-072', 'timestamp' => '10:42:15 WIB',
            'register' => 'Reg #01', 'cashier_name' => 'Rizki Ramadhan', 'cashier_initials' => 'RR', 'cashier_note' => '(Wholesale Bulk)',
            'customer_name' => 'Restoran Nusantara', 'customer_code' => 'MB-044', 'customer_note' => null,
            'items' => [['name' => 'Lime Nipis', 'weight' => '12.0kg'], ['name' => 'Watermelon', 'weight' => '18.5kg']],
            'extra_note' => null,
            'net_weight' => '30.500 kg', 'item_count' => 2,
            'tender_method' => 'Cash', 'tender_lines' => ['Tender: 600k |', 'Chg: 22k'],
            'total' => 578000, 'total_note' => 'Bulk Zero Discount',
            'status' => 'Settled',
        ],
        [
            'id' => 'TRX-20260913-072', 'timestamp' => '10:42:15 WIB',
            'register' => 'Reg #01', 'cashier_name' => 'Rizki Ramadhan', 'cashier_initials' => 'RR', 'cashier_note' => '(Wholesale Bulk)',
            'customer_name' => 'Restoran Nusantara', 'customer_code' => 'MB-044', 'customer_note' => null,
            'items' => [['name' => 'Lime Nipis', 'weight' => '12.0kg'], ['name' => 'Watermelon', 'weight' => '18.5kg']],
            'extra_note' => null,
            'net_weight' => '30.500 kg', 'item_count' => 2,
            'tender_method' => 'Cash', 'tender_lines' => ['Tender: 600k |', 'Chg: 22k'],
            'total' => 578000, 'total_note' => 'Bulk Zero Discount',
            'status' => 'Settled',
        ],
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    {{-- Journal header bar --}}
    <div class="flex items-center justify-between px-5 py-3 bg-slate-50 border-b border-slate-200">
        <div class="flex items-center gap-2">
            <span class="leading-none text-slate-500"><img src="{{ asset('icons/jam_topbar_kasir.png') }}" class="w-3 h-3 object-contain"></span></span>
            <span class="text-sm font-semibold text-slate-700">Immutable POS Journal</span>
            <span class="text-xs text-slate-400 bg-white border border-slate-200 rounded-md px-2 py-1 ml-2">
                Session {{ $sessionId }}
            </span>
        </div>

        @if ($autoReconciliation)
            <span class="text-xs font-medium text-slate-500 flex items-center gap-1.5">
                Auto-reconciliation active
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </span>
        @endif
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs font-semibold text-slate-400 tracking-wide border-b border-slate-100">
                    <th class="py-3 pl-5 pr-4">{{ __('TRX ID / TIMESTAMP') }}</th>
                    <th class="py-3 pr-4">{{ __('REGISTER') }} &<br>{{ __('CASHIER') }}</th>
                    <th class="py-3 pr-4">{{ __('CUSTOMER') }}</th>
                    <th class="py-3 pr-4">{{ __('PRODUCE') }}<br>{{ __('BASKET (AUDIT') }}<br>{{ __('SUMMARY)') }}</th>
                    <th class="py-3 pr-4 text-right">{{ __('NET') }}<br>{{ __('WEIGHT') }}<br>/ {{ __('QTY') }}</th>
                    <th class="py-3 pr-4">{{ __('TENDER') }}<br>{{ __('METHOD') }}</th>
                    <th class="py-3 pr-4 text-right">{{ __('TOTAL (RP)') }}</th>
                    <th class="py-3 pr-4">{{ __('AUDIT') }}<br>{{ __('STATUS') }}</th>
                    <th class="py-3 pr-5">{{ __('ACTIONS') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $trx)
                    @include('kasir.history.components.transaction-row', ['trx' => $trx])
                @empty
                    <tr>
                        <td colspan="9" class="py-10 text-center text-slate-400">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
