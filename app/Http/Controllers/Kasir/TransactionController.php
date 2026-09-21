<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('kasir.transaction.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount_received' => ['required', 'numeric', 'min:0'],
            'customer_name' => ['nullable', 'string', 'max:100'],
            'payment_method' => ['required', 'in:cash,qris'],
        ]);

        $transactionId = 'TRX-'.now()->format('YmdHis');
        $grandTotal = 115000;
        $paymentAmount = (int) $validated['amount_received'];

        session()->put('receipt', [
            'store_name' => 'MATRIF',
            'store_tagline' => 'FRUIT CASHIER SYSTEM',
            'store_branch' => 'Grand Central Store',
            'store_address' => 'Jl. Ahmad Yani No. 88, Jakarta',
            'store_phone' => '(021) 555-0199',
            'trx_id' => $transactionId,
            'date' => now()->format('d/m/Y H:i:s'),
            'cashier' => auth()->user()->name ?? 'Rizki',
            'customer' => $validated['customer_name'] ?? 'Guest Customer',
            'terminal' => 'Reg-01 / Scale-SCII',
            'items' => [
                ['name' => 'Cavendish Banana', 'qty_note' => '2.5 kg x Rp 18,000', 'subtotal' => 45000],
                ['name' => 'Sunkist Navel Orange', 'qty_note' => '1.25 kg x Rp 32,000', 'subtotal' => 40000],
                ['name' => 'Sweet Strawberries', 'qty_note' => '2 pack x Rp 15,000', 'subtotal' => 30000],
            ],
            'total_qty_note' => '3 Items (3.75 kg + 2 pk)',
            'subtotal' => $grandTotal,
            'discount_tax' => 0,
            'grand_total' => $grandTotal,
            'payment_method' => strtoupper($validated['payment_method']),
            'payment_amount' => $paymentAmount,
            'change' => max(0, $paymentAmount - $grandTotal),
            'footer_note' => 'FRESH FRUITS EVERY DAY',
            'footer_note_2' => 'Please keep this receipt as proof of fresh purchase.',
        ]);

        return redirect()->route('kasir.struct.index', [
            'trxId' => $transactionId,
        ]);
    }
}
