<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KasirController extends Controller
{
    public function index(): View
    {
        $staffList = [];

        if (Schema::hasTable('users')) {
            $staffList = User::query()
                ->where('role', 'cashier')
                ->latest()
                ->get()
                ->map(fn (User $cashier): array => $this->presentCashier($cashier))
                ->all();
        }

        return view('admin.kasir.index', ['staffList' => $staffList]);
    }

    public function create(): View
    {
        return view('admin.kasir.create-kasir');
    }

    public function edit(int $id): View
    {
        $cashier = Schema::hasTable('users')
            ? User::query()->where('role', 'cashier')->findOrFail($id)
            : new User([
                'id' => $id,
                'name' => '',
                'email' => '',
                'shift' => 'shift_1',
            ]);

        return view('admin.kasir.edit-kasir', [
            'cashier' => $cashier,
            'cashierId' => $id,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'default_shift' => ['required', 'in:shift_1,shift_2'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'cashier',
            'phone' => $validated['phone'] ?? null,
            'shift' => $validated['default_shift'],
        ]);

        return redirect()
            ->route('admin.kasir.index')
            ->with('status', 'Data kasir berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $cashier = User::query()->where('role', 'cashier')->findOrFail($id);
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($cashier->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'default_shift' => ['required', 'in:shift_1,shift_2'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $cashier->fill([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'shift' => $validated['default_shift'],
        ]);

        if (! empty($validated['password'])) {
            $cashier->password = $validated['password'];
        }

        $cashier->save();

        return redirect()
            ->route('admin.kasir.index')
            ->with('status', 'Data kasir berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $cashier = User::query()->where('role', 'cashier')->findOrFail($id);
        $cashier->delete();

        return redirect()
            ->route('admin.kasir.index')
            ->with('status', 'Data kasir berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function presentCashier(User $cashier): array
    {
        $shiftLabel = match ($cashier->shift) {
            'shift_2' => __('Shift 2: Afternoon').' (14:30 - 22:00)',
            default => __('Shift 1: Morning').' (07:00 - 15:00)',
        };

        return [
            'id' => $cashier->id,
            'avatar_url' => null,
            'initials' => collect(explode(' ', trim($cashier->name)))
                ->filter()
                ->take(2)
                ->map(fn (string $part): string => strtoupper($part[0]))
                ->implode(''),
            'name' => $cashier->name,
            'code' => 'CSH-'.str_pad((string) $cashier->id, 3, '0', STR_PAD_LEFT),
            'email' => $cashier->email,
            'role' => 'Cashier',
            'register_name' => __('Floating Cashier'),
            'register_note' => null,
            'status' => 'active',
            'status_label' => __('Active Now'),
            'shift_note' => $shiftLabel,
            'sales_amount' => null,
            'sales_note' => '-',
            'scale_accuracy_percent' => null,
            'scale_accuracy_label' => '-',
            'activity_label' => '-',
            'activity_time' => '-',
        ];
    }
}
