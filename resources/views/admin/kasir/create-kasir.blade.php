{{--
    Halaman "Add New Cashier" — didesain menyerupai modal overlay,
    tapi tetap 1 halaman penuh (bukan modal JS) supaya bisa punya URL
    sendiri: route('admin.kasir.create').
    Sidebar & topbar tetap ikut dari layouts/admin.blade.php di belakang overlay.
--}}
@extends('layouts.admin')

@section('title', __('Add New Cashier').' - Admin Matrif')

@section('content')

    {{-- Backdrop gelap transparan, meniru tampilan modal overlay --}}
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] z-40" aria-hidden="true"></div>

    <div class="relative z-50 min-h-full flex items-start justify-center py-10 px-4">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="flex items-start justify-between px-6 py-5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="w-11 h-11 shrink-0 flex items-center justify-center rounded-xl bg-emerald-600 text-white text-lg">
                        👤➕
                    </span>
                    <div>
                        <h1 class="text-lg font-bold text-slate-800">{{ __('Add New Cashier') }}</h1>
                        <p class="text-sm text-slate-400">{{ __('Create terminal credentials and assign store shift access.') }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.kasir.index') }}" class="text-slate-400 hover:text-slate-600 text-xl leading-none" title="Tutup">
                    ✕
                </a>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.kasir.store') }}" class="px-6 py-5 space-y-5">
                @csrf

                {{-- Full Name --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="full_name" class="text-sm font-semibold text-slate-700">{{ __('Full Name') }}</label>
                        <span class="text-xs font-semibold text-red-500">*{{ __('Required') }}</span>
                    </div>
                    <input
                        type="text" id="full_name" name="full_name" required
                        value="{{ old('full_name') }}"
                        placeholder="Siti Nurhaliza"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                    >
                    @error('full_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="email" class="text-sm font-semibold text-slate-700">{{ __('Email Address (Login Username)') }}</label>
                        <span class="text-xs font-semibold text-red-500">*{{ __('Required') }}</span>
                    </div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">✉️</span>
                        <input
                            type="email" id="email" name="email" required
                            value="{{ old('email') }}"
                            placeholder="siti.n@matrif.test"
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                        >
                    </div>
                    @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="text-sm font-semibold text-slate-700">{{ __('Initial Access Password') }}</label>
                        <button type="button" id="generate-password-btn" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                            <span class="leading-none">🔄</span> {{ __('Generate Secure Key') }}
                        </button>
                    </div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">🔒</span>
                        <input
                            type="password" id="password" name="password" required minlength="8"
                            placeholder="Matrif!2024Pass"
                            class="w-full pl-11 pr-11 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                        >
                        <button type="button" id="toggle-password-btn" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" title="{{ __('Show password') }}">
                            👁️
                        </button>
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5">
                        {{ __('Min. 8 characters. Cashier will be prompted to set personal PIN on first register sign-in.') }}
                    </p>
                    @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Assigned User Role (read-only info) --}}
                <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5">
                    <span class="w-9 h-9 shrink-0 flex items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">🛡️</span>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-slate-800">{{ __('Assigned User Role') }}</p>
                        <p class="text-xs text-slate-400">{{ __('Role is automatically set to cashier according to system security policy') }}</p>
                    </div>
                    <span class="text-xs font-bold bg-emerald-600 text-white px-3 py-1.5 rounded-full whitespace-nowrap">CASHIER</span>
                    <input type="hidden" name="role" value="cashier">
                </div>
               
                {{-- Default Shift Assignment --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('Default Shift Assignment') }}</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        <label class="flex items-start gap-3 border border-slate-200 rounded-xl px-4 py-3.5 cursor-pointer">
                            <input type="radio" name="default_shift" value="shift_1" class="mt-1 text-emerald-600 focus:ring-emerald-500" checked>
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">{{ __('Shift 1: Morning') }}</span>
                                <span class="block text-xs text-slate-400 mt-0.5">{{ __('07:00 - 15:00 (Open store rush)') }}</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3 border border-slate-200 rounded-xl px-4 py-3.5 cursor-pointer">
                            <input type="radio" name="default_shift" value="shift_2" class="mt-1 text-emerald-600 focus:ring-emerald-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">{{ __('Shift 2: Afternoon') }}</span>
                                <span class="block text-xs text-slate-400 mt-0.5">{{ __('14:30 - 22:00 (Closing reconciliation)') }}</span>
                            </span>
                        </label>

                    </div>
                </div>

                {{-- Phone Contact --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5">{{ __('Phone Contact (Optional)') }}</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">📞</span>
                        <input
                            type="text" id="phone" name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+62 812 8890 1445"
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
                        >
                    </div>
                </div>

                {{-- Footer aksi --}}
                <div class="flex items-center justify-end gap-4 pt-2 border-t border-slate-100 mt-6">
                    <a href="{{ route('admin.kasir.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700">
                        {{ __('Cancel') }}
                    </a>
                    <button
                        type="submit"
                        class="flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-5 py-3 rounded-xl transition"
                    >
                        <span class="leading-none">👤✓</span> {{ __('Create Cashier Account') }}
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection

@once
    @push('scripts')
        <script>
            // Tampil/sembunyikan password
            document.getElementById('toggle-password-btn')?.addEventListener('click', function () {
                const input = document.getElementById('password');
                input.type = input.type === 'password' ? 'text' : 'password';
            });

            // Generate password acak sederhana (ganti dengan logic sesuai kebijakan keamanan kamu)
            document.getElementById('generate-password-btn')?.addEventListener('click', function () {
                const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$';
                let pass = '';
                for (let i = 0; i < 12; i++) {
                    pass += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                const input = document.getElementById('password');
                input.value = pass;
                input.type = 'text';
            });
        </script>
    @endpush
@endonce
