{{--
    Chart digambar pakai Chart.js (npm install chart.js) supaya kurva
    smooth seperti desain. Data dilempar dari controller sebagai JSON
    ke atribut data-* lalu dibaca oleh resources/js/charts/hourly-income.js
--}}
@php
    $hourlyLabels = $hourlyLabels ?? ['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00'];
    $hourlyValues = $hourlyValues ?? [120000,260000,410000,560000,640000,700000,980000,720000,540000,300000,180000,520000,610000];
    $peak = $peak ?? ['time' => '14:00', 'value' => 980000];

    $cashTender = $cashTender ?? ['amount' => 2_950_000, 'percent' => 60.8, 'bills' => 38];
    $ewallet    = $ewallet ?? ['amount' => 1_900_000, 'percent' => 39.2, 'scans' => 26];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-5">

    <div class="flex items-start justify-between mb-1">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="font-semibold text-slate-800 text-lg">{{ __('Hourly Income Amount') }}</h2>
                <span class="text-xs text-emerald-600 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Synced
                </span>
            </div>
            <p class="text-sm text-slate-400 mt-1 max-w-sm">
                Intraday trend from 08:00 to 20:00 across all active POS terminals
            </p>
        </div>
        <span class="text-xs font-semibold bg-emerald-800 text-white px-3 py-1.5 rounded-lg whitespace-nowrap">
            Revenue (Rp)
        </span>
    </div>

    <div class="mt-4">
        <canvas
            id="hourly-income-chart"
            height="220"
            data-labels='@json($hourlyLabels)'
            data-values='@json($hourlyValues)'
            data-peak='@json($peak)'
        ></canvas>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-5">
        <div class="flex items-center gap-3 bg-slate-50 rounded-xl p-3">
            <span class="w-9 h-9 flex items-center justify-center bg-white rounded-lg text-lg">💵</span>
            <div class="flex-1">
                <p class="text-xs text-slate-400">{{ __('Cash Tender') }}</p>
                <p class="font-semibold text-slate-800">Rp {{ number_format($cashTender['amount'], 0, ',', '.') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-slate-700">{{ $cashTender['percent'] }}%</p>
                <p class="text-xs text-slate-400">{{ $cashTender['bills'] }} Bills</p>
            </div>
        </div>

        <div class="flex items-center gap-3 bg-slate-50 rounded-xl p-3">
            <span class="w-9 h-9 flex items-center justify-center bg-white rounded-lg text-lg">📱</span>
            <div class="flex-1">
                <p class="text-xs text-slate-400">{{ __('E-Wallet & QRIS') }}</p>
                <p class="font-semibold text-slate-800">Rp {{ number_format($ewallet['amount'], 0, ',', '.') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-slate-700">{{ $ewallet['percent'] }}%</p>
                <p class="text-xs text-slate-400">{{ $ewallet['scans'] }} Scans</p>
            </div>
        </div>
    </div>

</div>

@once
    @push('scripts')
        <script type="module">
            import Chart from 'chart.js/auto';

            const el = document.getElementById('hourly-income-chart');
            if (el) {
                new Chart(el, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(el.dataset.labels),
                        datasets: [{
                            data: JSON.parse(el.dataset.values),
                            borderColor: '#059669',
                            backgroundColor: 'rgba(16,185,129,0.12)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { display: false }, x: { grid: { display: false } } },
                    }
                });
            }
        </script>
    @endpush
@endonce
