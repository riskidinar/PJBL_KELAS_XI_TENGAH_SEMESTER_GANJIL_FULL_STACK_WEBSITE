@php
    // Ganti dengan $receipt dari controller (struktur data mengikuti struk asli)
    $receipt = $receipt ?? [
        'store_name' => 'MATRIF',
        'store_tagline' => 'FRUIT CASHIER SYSTEM',
        'store_branch' => 'Grand Central Store',
        'store_address' => 'Jl. Ahmad Yani No. 88, Jakarta',
        'store_phone' => '(021) 555-0199',
        'trx_id' => 'TRX-20260913-001',
        'date' => '13/09/2026 10:42:15',
        'cashier' => 'Rizki',
        'customer' => 'Budi',
        'terminal' => 'Reg-01 / Scale-SCII',
        'items' => [
            ['name' => 'Cavendish Banana', 'qty_note' => '2.5 kg x Rp 18,000', 'subtotal' => 45000],
            ['name' => 'Sunkist Navel Orange', 'qty_note' => '1.25 kg x Rp 32,000', 'subtotal' => 40000],
            ['name' => 'Sweet Strawberries', 'qty_note' => '2 pack x Rp 15,000', 'subtotal' => 30000],
        ],
        'total_qty_note' => '3 Items (3.75 kg + 2 pk)',
        'subtotal' => 115000,
        'discount_tax' => 0,
        'grand_total' => 115000,
        'payment_method' => 'Cash',
        'payment_amount' => 150000,
        'change' => 35000,
        'footer_note' => 'FRESH FRUITS EVERY DAY',
        'footer_note_2' => 'Please keep this receipt as proof of fresh purchase.',
    ];
@endphp

<div class="flex justify-center py-4">
    <div id="receipt-paper" class="bg-[#fdfaf3] w-full max-w-sm px-6 py-8 font-mono text-[13px] leading-relaxed text-slate-800 shadow-sm"
         style="clip-path: polygon(0% 0%, 100% 0%, 100% 98%, 96% 100%, 92% 98%, 88% 100%, 84% 98%, 80% 100%, 76% 98%, 72% 100%, 68% 98%, 64% 100%, 60% 98%, 56% 100%, 52% 98%, 48% 100%, 44% 98%, 40% 100%, 36% 98%, 32% 100%, 28% 98%, 24% 100%, 20% 98%, 16% 100%, 12% 98%, 8% 100%, 4% 98%, 0% 100%);">

        <div class="text-center mb-3">
            <p class="text-lg font-bold tracking-wide">{{ $receipt['store_name'] }}</p>
            <p class="text-xs font-bold">{{ $receipt['store_tagline'] }}</p>
            <p class="text-xs mt-1">{{ $receipt['store_branch'] }}</p>
            <p class="text-xs">{{ $receipt['store_address'] }}</p>
            <p class="text-xs">{{ __('Tel') }}: {{ $receipt['store_phone'] }}</p>
        </div>

        <p class="my-2">{{ str_repeat('=', 42) }}</p>

        <div class="space-y-0.5 text-xs">
            <div class="flex justify-between"><span>{{ __('Transaction') }}</span><span>: {{ $receipt['trx_id'] }}</span></div>
            <div class="flex justify-between"><span>{{ __('Date') }}</span><span>: {{ $receipt['date'] }}</span></div>
            <div class="flex justify-between"><span>{{ __('Receipt Cashier') }}</span><span>: {{ $receipt['cashier'] }}</span></div>
            <div class="flex justify-between"><span>{{ __('Receipt Customer') }}</span><span>: {{ $receipt['customer'] }}</span></div>
            <div class="flex justify-between"><span>{{ __('Terminal') }}</span><span>: {{ $receipt['terminal'] }}</span></div>
        </div>

        <p class="my-2">{{ str_repeat('-', 42) }}</p>

        <div class="flex justify-between text-xs font-bold">
            <span>{{ __('ITEM') }}</span>
            <span class="flex gap-4"><span>{{ __('Receipt QTY') }}</span><span>{{ __('Receipt Price') }}</span><span>{{ __('SUBTOTAL') }}</span></span>
        </div>

        <p class="my-2">{{ str_repeat('-', 42) }}</p>

        <div class="space-y-3">
            @foreach ($receipt['items'] as $item)
                <div>
                    <p class="font-bold text-xs">{{ $item['name'] }}</p>
                    <div class="flex justify-between text-xs">
                        <span>{{ $item['qty_note'] }}</span>
                        <span class="font-bold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="my-2">{{ str_repeat('-', 42) }}</p>

        <div class="text-xs space-y-1">
            <div class="flex justify-between"><span>{{ __('TOTAL QTY') }}</span><span>{{ $receipt['total_qty_note'] }}</span></div>
            <div class="flex justify-between"><span>{{ __('SUBTOTAL') }}</span><span class="font-bold">Rp {{ number_format($receipt['subtotal'], 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>{{ __('DISCOUNT / TAX') }}</span><span>Rp {{ number_format($receipt['discount_tax'], 0, ',', '.') }}</span></div>
        </div>

        <p class="my-2">{{ str_repeat('-', 42) }}</p>

        <div class="flex justify-between text-sm font-bold">
            <span>{{ __('GRAND TOTAL') }}</span><span>Rp {{ number_format($receipt['grand_total'], 0, ',', '.') }}</span>
        </div>

        <p class="my-2">{{ str_repeat('-', 42) }}</p>

        <div class="text-xs space-y-1 font-bold">
            <div class="flex justify-between"><span>{{ __('PAYMENT') }} ({{ $receipt['payment_method'] }})</span><span>Rp {{ number_format($receipt['payment_amount'], 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>{{ __('CHANGE RETURNED') }}</span><span>Rp {{ number_format($receipt['change'], 0, ',', '.') }}</span></div>
        </div>

        <p class="my-2">{{ str_repeat('=', 42) }}</p>

        <div class="text-center my-4">
            <p class="text-xs font-bold tracking-widest mb-2">{{ __('BARCODE / QR CODE') }}</p>
            {{-- Ganti dengan barcode/QR asli, mis. pakai package milon/barcode atau simplesoftwareio/simple-qrcode --}}
            <img src="{{ route('kasir.struct.barcode', $receipt['trx_id']) }}" alt="Barcode" class="mx-auto h-14">
            <p class="text-xs mt-1">{{ $receipt['trx_id'] }}</p>
        </div>

        <p class="my-2">{{ str_repeat('=', 42) }}</p>

        <div class="text-center text-xs">
            <p class="font-bold">{{ __('THANK YOU!') }}</p>
            <p class="font-bold">{{ $receipt['footer_note'] }}</p>
            <p class="mt-1">{{ $receipt['footer_note_2'] }}</p>
        </div>

        <p class="my-2">{{ str_repeat('=', 42) }}</p>

    </div>
</div>

@once
    @push('styles')
        <style>
            /* Supaya saat dicetak, cuma struknya yang keluar (bukan sidebar/topbar) */
            @media print {
                body * { visibility: hidden; }
                #receipt-paper, #receipt-paper * { visibility: visible; }
                #receipt-paper { position: absolute; top: 0; left: 0; width: 80mm; box-shadow: none; }
            }
        </style>
    @endpush
@endonce
