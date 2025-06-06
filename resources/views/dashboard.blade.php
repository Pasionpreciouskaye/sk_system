@extends('layouts.dashboard')

@section('content')
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
    const countsLabels = ['Projects', 'Events'];
    const countsData   = [
        {{ $totalProjects }},
        {{ $totalEvents }}
    ];

    const countsCtx = document
        .getElementById('countsChart')
        .getContext('2d');

    new Chart(countsCtx, {
        type: 'bar',
        data: {
            labels: countsLabels,
            datasets: [{
                label: 'Total Count',
                data: countsData,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Count' }
                },
                x: {
                    title: { display: true, text: 'Type' }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    const inventoryLabels     = {!! json_encode($inventoryLabels) !!};
    const inventoryQuantities = {!! json_encode($inventoryQuantities) !!};

    const inventoryCtx = document
        .getElementById('inventoryChart')
        .getContext('2d');

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
                }
            }
        }
    });

    const budgetLabels = {!! json_encode($budgetLabelsPretty) !!};
    const budgetData   = {!! json_encode($budgetTotals) !!};

    const budgetCtx = document
        .getElementById('budgetChart')
        .getContext('2d');

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
