@extends('layouts.dashboard')

@section('content')

@php
    $budgetTotal = collect($budgetTotals)->sum();
    $monthlyAvg = round($budgetTotal / max(count($budgetTotals), 1), 2);
    $latestMonth = end($budgetLabelsPretty);
    $latestAmount = end($budgetTotals);
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-xl shadow text-center">
        <h4 class="text-sm font-medium text-gray-600 mb-1">Total Budget Spent</h4>
        <p class="text-2xl font-bold text-pink-600">₱{{ number_format($budgetTotal, 2) }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <h4 class="text-sm font-medium text-gray-600 mb-1">Average Monthly Spending</h4>
        <p class="text-2xl font-bold text-green-600">₱{{ number_format($monthlyAvg, 2) }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <h4 class="text-sm font-medium text-gray-600 mb-1">Latest Month ({{ $latestMonth }})</h4>
        <p class="text-2xl font-bold text-blue-600">₱{{ number_format($latestAmount, 2) }}</p>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="bg-white p-6 rounded-xl shadow min-h-[300px] flex flex-col">
        <h3 class="font-semibold mb-4">Projects vs Events</h3>
        <div class="h-100 flex-1 flex items-center justify-center">
            <canvas id="countsChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow min-h-[300px] flex flex-col">
        <h3 class="font-semibold mb-4">Inventory by Category</h3>
        <div class="h-100 flex-1 flex items-center justify-center">
            <canvas id="inventoryChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow min-h-[300px] flex flex-col">
        <h3 class="font-semibold mb-4">Total Spent per Month</h3>
        <div class="h-100 flex-1 flex items-center justify-center">
            <canvas id="budgetChart"></canvas>
        </div>
    </div>
</div>

<script>
    // ---------- Projects vs Events ----------
    const countsLabels = ['Projects', 'Events'];
    const countsData = [{{ $totalProjects }}, {{ $totalEvents }}];
    const countsCtx = document.getElementById('countsChart').getContext('2d');

    new Chart(countsCtx, {
        type: 'bar',
        data: {
            labels: countsLabels,
            datasets: [{
                label: 'Total Count',
                data: countsData,
                backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = countsData.reduce((a, b) => a + b, 0);
                            const value = context.parsed.y;
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ${value} (${percent}%)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Count' }
                },
                x: {
                    title: { display: true, text: 'Type' }
                }
            }
        }
    });

    // ---------- Inventory Pie Chart ----------
    const inventoryLabels     = {!! json_encode($inventoryLabels) !!};
    const inventoryQuantities = {!! json_encode($inventoryQuantities) !!};
    const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');

    new Chart(inventoryCtx, {
        type: 'pie',
        data: {
            labels: inventoryLabels,
            datasets: [{
                label: 'Quantity',
                data: inventoryQuantities,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: { boxWidth: 12, boxHeight: 12 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.parsed;
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ${value} (${percent}%)`;
                        }
                    }
                }
            }
        }
    });

    // ---------- Budget Line Chart ----------
    const budgetLabels = {!! json_encode($budgetLabelsPretty) !!};
    const budgetData   = {!! json_encode($budgetTotals) !!};
    const budgetCtx = document.getElementById('budgetChart').getContext('2d');

    new Chart(budgetCtx, {
        type: 'line',
        data: {
            labels: budgetLabels,
            datasets: [{
                label: 'Total Spent (₱)',
                data: budgetData,
                fill: false,
                tension: 0.3,
                borderColor: 'rgba(75, 192, 192, 1)',
                pointBackgroundColor: 'rgba(75, 192, 192, 0.7)',
                pointBorderColor: '#fff',
                pointRadius: 5,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const current = context.parsed.y;
                            const index = context.dataIndex;
                            const prev = index > 0 ? context.dataset.data[index - 1] : 0;
                            const change = prev > 0 ? (((current - prev) / prev) * 100).toFixed(1) : '0';
                            return `₱${current.toLocaleString()} (${change}% vs last)`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Month' }
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Total Spent (₱)' }
                }
            }
        }
    });
</script>
@endsection
