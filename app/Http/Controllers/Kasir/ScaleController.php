<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ScaleController extends Controller
{
    public function index(): View
    {
        $products = Fruit::query()
            ->orderBy('name')
            ->get()
            ->map(fn (Fruit $fruit): array => $this->presentFruit($fruit))
            ->all();

        return view('kasir.scale.index', ['products' => $products]);
    }

    /**
     * @return array<string, mixed>
     */
    private function presentFruit(Fruit $fruit): array
    {
        $stock = (float) $fruit->stock;
        $minimumStock = (float) $fruit->minimum_stock;
        $isOutOfStock = $stock <= 0;
        $isLowStock = ! $isOutOfStock && $stock <= $minimumStock;
        $status = $isOutOfStock ? 'critical' : ($isLowStock ? 'critical' : 'stable');
        $stockPercent = $isOutOfStock
            ? 0
            : min(100, (int) round($minimumStock > 0 ? ($stock / $minimumStock) * 50 : 100));

        return [
            'image' => $fruit->image
                ? Storage::disk('public')->url($fruit->image)
                : asset('img/login.png'),
            'name' => $fruit->name,
            'plu' => $fruit->code,
            'unit_note' => 'Per '.strtoupper($fruit->unit),
            'category' => $fruit->category ?? __('Uncategorized'),
            'category_sub' => null,
            'volume' => number_format($stock, 2, ',', '.'),
            'volume_unit' => $fruit->unit,
            'revenue' => (float) $fruit->price * $stock,
            'days_remaining' => $isOutOfStock ? 0 : round($stock, 1),
            'turnover_status' => $status,
            'turnover_percent' => $stockPercent,
        ];
    }
}
