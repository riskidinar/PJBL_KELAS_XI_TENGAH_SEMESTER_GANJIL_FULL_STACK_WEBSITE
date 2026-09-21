<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FruitController extends Controller
{
    public function index(): View
    {
        $fruits = [];

        if (Schema::hasTable('fruits')) {
            $fruits = Fruit::query()
                ->latest()
                ->get()
                ->map(fn (Fruit $fruit): array => $this->presentFruit($fruit))
                ->all();
        }

        return view('admin.fruits.index', ['fruits' => $fruits]);
    }

    public function create(): View
    {
        return view('admin.fruits.create-fruit');
    }

    public function edit(int $id): View
    {
        $fruit = Fruit::query()->findOrFail($id);

        return view('admin.fruits.edit-fruit', [
            'fruit' => $fruit,
            'fruitId' => $fruit->id,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fruit_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'between:0,4'],
            'unit' => ['required', 'in:kg,g'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'initial_stock' => ['required', 'numeric', 'min:0'],
            'min_stock_alert' => ['required', 'numeric', 'min:0'],
            'fruit_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = $request->hasFile('fruit_image')
            ? $request->file('fruit_image')->store('fruits', 'public')
            : null;

        Fruit::create([
            'code' => $this->nextFruitCode(),
            'name' => $validated['fruit_name'],
            'category' => $this->categoryName((int) $validated['category_id']),
            'price' => $validated['unit_price'],
            'stock' => $validated['initial_stock'],
            'unit' => $validated['unit'],
            'minimum_stock' => $validated['min_stock_alert'],
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.fruits.index')
            ->with('status', 'Data buah berhasil ditambahkan.');
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
            'image' => $fruit->image ? asset('storage/'.$fruit->image) : asset('img/login.png'),
            'name' => $fruit->name,
            'category' => $fruit->category ?? __('Uncategorized'),
            'unit' => $fruit->unit,
            'unit_price' => $fruit->price,
            'current_stock_label' => $fruit->stock.' '.$fruit->unit,
            'deficit_label' => $status === 'low' ? '-'.($minimumStock - $stock).' '.$fruit->unit : null,
            'stock_percent' => $status === 'out' ? 0 : ($status === 'low' ? 50 : 100),
            'status' => $status,
            'status_label' => match ($status) {
                'out' => __('Out of Stock'),
                'low' => __('Low Stock'),
                default => __('Stock Available'),
            },
            'updated_label' => $fruit->updated_at?->format('d M Y, H:i'),
        ];
    }

    private function categoryName(int $categoryId): string
    {
        return [
            0 => 'Exotic',
            1 => 'Bananas & Tropical',
            2 => 'Citrus & Oranges',
            3 => 'Apples & Pears',
            4 => 'Berries & Melons',
        ][$categoryId];
    }

    private function nextFruitCode(): string
    {
        $nextNumber = 1;

        do {
            $code = 'FRUIT'.str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
            $nextNumber++;
        } while (Fruit::query()->where('code', $code)->exists());

        return $code;
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $fruit = Fruit::query()->findOrFail($id);
        $validated = $request->validate([
            'fruit_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'between:0,4'],
            'unit' => ['required', 'in:kg,g'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'initial_stock' => ['required', 'numeric', 'min:0'],
            'min_stock_alert' => ['required', 'numeric', 'min:0'],
            'fruit_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['fruit_name'],
            'category' => $this->categoryName((int) $validated['category_id']),
            'price' => $validated['unit_price'],
            'stock' => $validated['initial_stock'],
            'unit' => $validated['unit'],
            'minimum_stock' => $validated['min_stock_alert'],
        ];

        if ($request->hasFile('fruit_image')) {
            if ($fruit->image) {
                Storage::disk('public')->delete($fruit->image);
            }

            $data['image'] = $request->file('fruit_image')->store('fruits', 'public');
        }

        $fruit->update($data);

        return redirect()
            ->route('admin.fruits.index')
            ->with('status', 'Data buah berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $fruit = Fruit::query()->findOrFail($id);

        if ($fruit->image) {
            Storage::disk('public')->delete($fruit->image);
        }

        $fruit->delete();

        return redirect()
            ->route('admin.fruits.index')
            ->with('status', 'Data buah berhasil dihapus.');
    }
}
