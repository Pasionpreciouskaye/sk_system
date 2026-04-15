@extends('layouts.dashboard')

@section('content')
    @php
        $budgetTotal = collect($budgetTotals)->sum();
        $monthlyAvg = round($budgetTotal / max(count($budgetTotals), 1), 2);
        $latestMonth = end($budgetLabelsPretty);
        $latestAmount = end($budgetTotals);
    @endphp

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 rounded-xl shadow text-center" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h4 class="text-sm font-medium mb-1" style="color:var(--color-text-secondary);">Total Budget Spent</h4>
            <p class="text-2xl font-bold" style="color:#E11D48;">₱{{ number_format($budgetTotal, 2) }}</p>
        </div>
        <div class="p-4 rounded-xl shadow text-center" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h4 class="text-sm font-medium mb-1" style="color:var(--color-text-secondary);">Average Monthly Spending</h4>
            <p class="text-2xl font-bold" style="color:#22C55E;">₱{{ number_format($monthlyAvg, 2) }}</p>
        </div>
        <div class="p-4 rounded-xl shadow text-center" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h4 class="text-sm font-medium mb-1" style="color:var(--color-text-secondary);">Latest Month ({{ $latestMonth }})</h4>
            <p class="text-2xl font-bold" style="color:#F59E0B;">₱{{ number_format($latestAmount, 2) }}</p>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="p-6 rounded-xl shadow min-h-[300px] flex flex-col" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h3 class="font-semibold mb-4" style="color:var(--color-text-primary);">Projects</h3>
            <div class="flex-1 flex items-center justify-center">
                <canvas id="countsChart"></canvas>
            </div>
        </div>
        <div class="p-6 rounded-xl shadow min-h-[300px] flex flex-col" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h3 class="font-semibold mb-4" style="color:var(--color-text-primary);">Inventory by Category</h3>
            <div class="flex-1 flex items-center justify-center">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>
        <div class="p-6 rounded-xl shadow min-h-[300px] flex flex-col" style="background:var(--color-card);border:1px solid var(--color-border);">
            <h3 class="font-semibold mb-4" style="color:var(--color-text-primary);">Total Spent per Month</h3>
            <div class="flex-1 flex items-center justify-center">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const isDark = document.documentElement.classList.contains('dark');
        const chartTextColor  = isDark ? '#94A3B8' : '#374151';
        const chartGridColor  = isDark ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.08)';

        // Projects bar chart
        new Chart(document.getElementById('countsChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Projects'],
                datasets: [{
                    label: 'Total Count',
                    data: [{{ $totalProjects }}],
                    backgroundColor: ['rgba(225,29,72,0.7)'],
                    borderColor: ['rgba(225,29,72,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { color: chartTextColor }, grid: { color: chartGridColor }, title: { display: true, text: 'Count', color: chartTextColor } },
                    x: { ticks: { color: chartTextColor }, grid: { color: chartGridColor }, title: { display: true, text: 'Type', color: chartTextColor } }
                }
            }
        });

        // Inventory pie chart
        new Chart(document.getElementById('inventoryChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($inventoryLabels) !!},
                datasets: [{
                    data: {!! json_encode($inventoryQuantities) !!},
                    backgroundColor: ['rgba(255,99,132,0.7)','rgba(54,162,235,0.7)','rgba(255,206,86,0.7)','rgba(75,192,192,0.7)','rgba(153,102,255,0.7)','rgba(255,159,64,0.7)','rgba(34,197,94,0.7)','rgba(244,63,94,0.7)','rgba(245,158,11,0.7)','rgba(99,102,241,0.7)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right', labels: { boxWidth: 12, color: chartTextColor } },
                    tooltip: { callbacks: { label: ctx => { const t = ctx.dataset.data.reduce((a,b)=>a+b,0); return `${ctx.label}: ${ctx.parsed} (${((ctx.parsed/t)*100).toFixed(1)}%)`; } } }
                }
            }
        });

        // Budget line chart
        new Chart(document.getElementById('budgetChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($budgetLabelsPretty) !!},
                datasets: [{
                    label: 'Total Spent (₱)',
                    data: {!! json_encode($budgetTotals) !!},
                    fill: false, tension: 0.3,
                    borderColor: '#22C55E',
                    pointBackgroundColor: '#22C55E',
                    pointBorderColor: '#fff',
                    pointRadius: 5, borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { labels: { color: chartTextColor } } },
                scales: {
                    x: { ticks: { color: chartTextColor }, grid: { color: chartGridColor }, title: { display: true, text: 'Month', color: chartTextColor } },
                    y: { beginAtZero: true, ticks: { color: chartTextColor }, grid: { color: chartGridColor }, title: { display: true, text: 'Total Spent (₱)', color: chartTextColor } }
                }
            }
        });
    </script>
@endsection
