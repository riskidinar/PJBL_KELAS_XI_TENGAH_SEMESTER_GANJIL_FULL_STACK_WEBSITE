<div>
    <p class="text-xs font-semibold text-slate-500 mb-2 tracking-wide">{{ __('PAYMENT METHOD') }}</p>
    <div class="grid grid-cols-2 gap-3">
        <label class="flex items-center justify-center gap-2 border-2 border-emerald-600 text-emerald-700 bg-emerald-50 rounded-xl py-2.5 text-sm font-medium cursor-pointer">
            <input type="radio" name="payment_method" value="cash" class="hidden" checked>
            <span aria-hidden="true"><img src="{{ asset('icons/cash_admin.png') }}" class="w-4 h-4 object-contain"></span>
            Cash
        </label>
        <label class="flex items-center justify-center gap-2 border border-slate-200 text-slate-600 rounded-xl py-2.5 text-sm font-medium cursor-pointer hover:bg-slate-50">
            <input type="radio" name="payment_method" value="qris" class="hidden">
            <span aria-hidden="true"><img src="{{ asset('icons/qris_admin.png') }}" class="w-4 h-4 object-contain"></span>
            E-Wallet / QRIS
        </label>
    </div>
</div>
