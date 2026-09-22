<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $fruits = Fruit::query()
            ->orderBy('name')
            ->get()
            ->map(fn (Fruit $fruit): array => $this->presentFruit($fruit))
            ->all();

        $categories = collect($fruits)
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->map(fn (string $category): array => ['label' => $category])
            ->prepend([
                'label' => __('All Fruits'),
                'count' => count($fruits),
                'active' => true,
            ])
            ->all();

        return view('kasir.transaction.index', [
            'products' => $fruits,
            'categories' => $categories,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function presentFruit(Fruit $fruit): array
    {
        $stock = (float) $fruit->stock;
        $minimumStock = (float) $fruit->minimum_stock;
        $status = $stock <= 0 ? 'out' : ($stock <= $minimumStock ? 'low' : 'available');

        return [
            'id' => $fruit->id,
            'code' => $fruit->code,
            'stock_label' => $status === 'out'
                ? __('Out of Stock')
                : number_format($stock, 2, ',', '.').' '.$fruit->unit,
            'image' => $fruit->image ? asset('storage/'.$fruit->image) : asset('img/login.png'),
            'category' => $fruit->category ?? __('Uncategorized'),
            'name' => $fruit->name,
            'price' => $fruit->price,
            'stock' => $stock,
            'unit' => $fruit->unit,
            'in_stock' => $stock > 0,
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount_received' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'json'],
            'customer_name' => ['nullable', 'string', 'max:100'],
            'payment_method' => ['required', 'in:cash,qris'],
        ]);

        $cartItems = json_decode($validated['cart_items'], true);

        Validator::make(['items' => $cartItems], [
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'distinct'],
            'items.*.quantity' => ['required', 'numeric', 'gt:0'],
        ])->validate();

        $fruitIds = collect($cartItems)->pluck('id')->map(fn (mixed $id): int => (int) $id);
        $fruits = Fruit::query()->whereIn('id', $fruitIds)->get()->keyBy('id');

        if ($fruits->count() !== $fruitIds->unique()->count()) {
            throw ValidationException::withMessages([
                'cart_items' => __('One or more selected fruits are no longer available.'),
            ]);
        }

        $items = collect($cartItems)->map(function (array $cartItem) use ($fruits): array {
            $fruit = $fruits->get((int) $cartItem['id']);
            $quantity = round((float) $cartItem['quantity'], 2);

            if ($quantity > (float) $fruit->stock) {
                throw ValidationException::withMessages([
                    'cart_items' => __('Insufficient stock for :fruit.', ['fruit' => $fruit->name]),
                ]);
            }

            $price = (float) $fruit->price;

            return [
                'name' => $fruit->name,
                'qty_note' => $this->formatQuantity($quantity).' '.$fruit->unit.' x Rp '.number_format($price, 0, ',', '.'),
                'subtotal' => round($price * $quantity, 2),
            ];
        });

        $grandTotal = round($items->sum('subtotal'), 2);
        $paymentAmount = round((float) $validated['amount_received'], 2);

        if ($paymentAmount < $grandTotal) {
            throw ValidationException::withMessages([
                'amount_received' => __('The amount received must be at least Rp :amount.', [
                    'amount' => number_format($grandTotal, 0, ',', '.'),
                ]),
            ]);
        }

        $transactionId = 'TRX-'.now()->format('YmdHis');

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
            'items' => $items->all(),
            'total_qty_note' => $items->count().' Items',
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

    private function formatQuantity(float $quantity): string
    {
        return rtrim(rtrim(number_format($quantity, 2, ',', '.'), '0'), ',');
    }
}
