{{--
    Halaman "Add New Fruit Product" — bergaya modal overlay, tapi tetap
    1 halaman penuh dengan URL sendiri: route('admin.fruits.create').
    Sidebar & topbar tetap ikut dari layouts/admin.blade.php di belakang overlay.
--}}
@extends('layouts.admin')

@section('title', __('Edit Fruit Product').' - Admin Matrif')

@section('content')

    {{-- Backdrop gelap transparan, meniru tampilan modal overlay --}}
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] z-40" aria-hidden="true"></div>

    <div class="relative z-50 min-h-full flex items-start justify-center py-10 px-4">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="flex items-start justify-between px-6 py-5 bg-slate-50 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="w-11 h-11 shrink-0 flex items-center justify-center rounded-xl bg-emerald-600 text-white text-lg">
                          <img src="{{ asset('icons/add_fruit_form.png') }}" class="w-5 h-5 object-contain">
                    </span>
                    <div>
                        <h1 class="text-lg font-bold text-slate-800">{{ __('Edit Fruit Product') }}</h1>
                        <p class="text-sm text-slate-400">{{ __('Fill in fruit catalog details according to MATRIF inventory standards.') }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.fruits.index') }}" class="text-slate-400 hover:text-slate-600 text-xl leading-none" title="Tutup">
                    ✕
                </a>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.fruits.update', $fruitId) }}" enctype="multipart/form-data" class="px-6 py-5 space-y-5">
                @csrf
                @method('PUT')

                {{-- Fruit Code + Fruit Name --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="fruit_code" class="text-sm font-semibold text-slate-700">{{ __('Fruit Code') }}</label>
                            <span class="text-xs font-semibold text-emerald-600">{{ __('Auto-Gen') }}</span>
                        </div>
                        <div class="relative">
                            <input
                                type="text" id="fruit_code" name="fruit_code"
                                value="{{ $fruit->code }}" readonly
                                class="w-full pl-4 pr-11 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-mono text-slate-600 cursor-not-allowed"
                            >
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">🔒</span>
                        </div>
                    </div>

                    <div>
                        <label for="fruit_name" class="text-sm font-semibold text-slate-700 mb-1.5 block">
                            {{ __('Fruit Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text" id="fruit_name" name="fruit_name" required
                            value="{{ old('fruit_name', $fruit->name) }}"
                            placeholder="Avocado Mentega Super"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                        >
                        @error('fruit_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                {{-- Category --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="category_id" class="text-sm font-semibold text-slate-700">
                            {{ __('Category') }} <span class="text-red-500">*</span>
                        </label>
                        <button type="button" id="add-category-btn" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                            <span class="leading-none">+</span> {{ __('Add Category') }}
                        </button>
                    </div>
                    <select
                        id="category_id" name="category_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                    >
                        <option value="" disabled {{ old('category_id') === null ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach ($categories ?? ['Exotic', 'Bananas & Tropical', 'Citrus & Oranges', 'Apples & Pears', 'Berries & Melons'] as $i => $cat)
                            <option value="{{ is_array($cat) ? $cat['id'] : $i }}" {{ old('category_id', $fruit->category === (is_array($cat) ? $cat['name'] : $cat) ? $i : null) == (is_array($cat) ? $cat['id'] : $i) ? 'selected' : '' }}>
                                {{ is_array($cat) ? $cat['name'] : $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Unit Configuration --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        {{ __('Unit Configuration') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">

                        <label class="flex items-center justify-center gap-2 rounded-xl py-3.5 text-sm font-semibold cursor-pointer border-2 transition
                                      border-slate-200 text-slate-600">
                            <input type="radio" name="unit" value="kg" class="hidden" {{ old('unit', $fruit->unit) === 'kg' ? 'checked' : '' }}>
                            <span class="leading-none">⚖️</span> Kilogram (kg)
                        </label>

                        <label class="flex items-center justify-center gap-2 rounded-xl py-3.5 text-sm font-semibold cursor-pointer border-2 transition
                                      border-slate-200 text-slate-600 bg-slate-50">
                            <input type="radio" name="unit" value="g" class="hidden" {{ old('unit', $fruit->unit) === 'g' ? 'checked' : '' }}>
                            <span class="leading-none">📐</span> Gram (g)
                        </label>

                    </div>
                </div>

                {{-- Unit Price, Initial Stock, Min Stock Alert --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div>
                        <label for="unit_price" class="text-sm font-semibold text-slate-700 mb-1.5 block">
                            {{ __('Unit Price') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">Rp</span>
                            <input
                                type="number" id="unit_price" name="unit_price" required min="0" step="1"
                                value="{{ old('unit_price', $fruit->price) }}"
                                placeholder="35,000"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="initial_stock" class="text-sm font-semibold text-slate-700 mb-1.5 block">
                            {{ __('Initial Stock') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="number" id="initial_stock" name="initial_stock" required min="0" step="0.1"
                                value="{{ old('initial_stock', $fruit->stock) }}"
                                placeholder="25.0"
                                class="w-full pl-4 pr-10 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                            >
                            <span id="initial-stock-unit" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-medium">kg</span>
                        </div>
                    </div>

                    <div>
                        <label for="min_stock_alert" class="text-sm font-semibold text-slate-700 mb-1.5 block">
                            {{ __('Min. Stock Alert') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="number" id="min_stock_alert" name="min_stock_alert" required min="0" step="0.1"
                                value="{{ old('min_stock_alert', $fruit->minimum_stock) }}"
                                placeholder="10.0"
                                class="w-full pl-4 pr-10 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                            >
                            <span id="min-stock-unit" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-medium">kg</span>
                        </div>
                    </div>

                </div>

                <p class="flex items-start gap-1.5 text-xs text-slate-400 -mt-2">
                    <span class="leading-none">ⓘ</span>
                    {{ __('Triggers Low Stock alert when remaining net fruit inventory drops at or below minimum threshold.') }}
                </p>

                {{-- Fruit Image Asset --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('Fruit Image Asset') }}</label>

                    <label for="fruit_image" class="flex items-center gap-4 bg-slate-50 border border-dashed border-slate-300 rounded-xl p-4 cursor-pointer hover:bg-slate-100 transition">
                        <img id="fruit-image-preview" src="{{ $fruit->image ? asset('storage/'.$fruit->image) : '' }}" alt="{{ $fruit->name }}" class="w-16 h-16 rounded-lg object-cover {{ $fruit->image ? '' : 'hidden' }}">
                        <span id="fruit-image-placeholder" class="w-16 h-16 rounded-lg bg-slate-200 flex items-center justify-center text-2xl shrink-0 {{ $fruit->image ? 'hidden' : '' }}">🥑</span>

                        <div>
                            <p class="text-sm font-semibold text-slate-700">{{ __('Click to upload or drag and drop image') }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ __('JPG, PNG, WebP up to 2MB. 1:1 square produce photo recommended for POS terminal tile clarity.') }}</p>
                        </div>

                        <input type="file" id="fruit_image" name="fruit_image" accept="image/jpeg,image/png,image/webp" class="hidden">
                    </label>
                    @error('fruit_image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

            </form>

            {{-- Footer aksi --}}
            <div class="flex items-center justify-between gap-4 px-6 py-4 bg-slate-50 border-t border-slate-100">
                <a href="{{ route('admin.fruits.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700">
                    {{ __('Cancel') }}
                </a>
                <button
                    type="submit"
                    form=""
                    onclick="this.closest('.bg-white').querySelector('form').requestSubmit()"
                    class="flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-5 py-3 rounded-xl transition"
                >
                    <span class="leading-none"><img src="{{ asset('icons/check_struk.png') }}" class="w-3 h-3 object-contain"></span> {{ __('Update Fruit Product') }}
                </button>
            </div>

        </div>
    </div>

@endsection

@once
    @push('scripts')
        <script>
            // Ganti label unit (kg/g) di kolom Initial Stock & Min Stock Alert
            // mengikuti pilihan Unit Configuration.
            document.querySelectorAll('input[name="unit"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const label = this.value; // 'kg' atau 'g'
                    document.getElementById('initial-stock-unit').textContent = label;
                    document.getElementById('min-stock-unit').textContent = label;
                });
            });

            // Preview gambar yang diupload
            document.getElementById('fruit_image')?.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (ev) {
                    const preview = document.getElementById('fruit-image-preview');
                    const placeholder = document.getElementById('fruit-image-placeholder');
                    preview.src = ev.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            });
        </script>
    @endpush
@endonce
