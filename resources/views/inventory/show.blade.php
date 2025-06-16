@extends('layouts.welcome')
@section('content')

@php
    $totalQuantity = $data->sum('quantity');
    $totalCost = $data->sum(fn($item) => $item->cost * $item->quantity);
    $columns = ['ID', 'Category', 'Item', 'Quantity', 'Cost', 'Total'];
@endphp

<div class="p-16">
    <h1 class="text-3xl font-bold text-center text-gray-800 w-full">{{ $page_title }} Records</h1>

    @if ($resource === 'inventory')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 mt-6">
        <!-- Total Quantity -->
        <div class="bg-indigo-100 border border-indigo-300 text-indigo-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="mb-2">
                <i class="fas fa-boxes fa-2x text-indigo-600"></i>
            </div>
            <h3 class="text-sm font-medium mb-1 uppercase">Total Quantity</h3>
            <p class="text-2xl font-bold">{{ $totalQuantity }}</p>
        </div>

        <!-- Total Cost -->
        <div class="bg-purple-100 border border-purple-300 text-purple-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="mb-2">
                <i class="fas fa-coins fa-2x text-purple-600"></i>
            </div>
            <h3 class="text-sm font-medium mb-1 uppercase">Total Cost</h3>
            <p class="text-2xl font-bold">₱{{ number_format($totalCost, 2) }}</p>
        </div>
    </div>
    @endif

    <!-- Inventory Table -->
    <div class="w-full flex justify-center">
        <div class="w-full max-w-6xl">
            <table class="min-w-full border border-gray-200 shadow-lg rounded-lg" id="{{ $resource }}-table">
                <thead class="bg-pink-600">
                    <tr class="text-white uppercase text-md leading-normal">
                        @foreach ($columns as $column)
                        <th class="py-3 px-4 text-left cursor-pointer">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-normal">
                    @foreach ($data as $record)
                    <tr class="border border-gray-200 hover:bg-pink-50 transition-colors">
                        <td class="py-2 px-4 text-left">{{ $record->id }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->category->name ?? '' }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->name }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->quantity }}</td>
                        <td class="py-2 px-4 text-left">₱{{ number_format($record->cost, 2) }}</td>
                        <td class="py-2 px-4 text-left">₱{{ number_format($record->quantity * $record->cost, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTable Script -->
<script>
    $(document).ready(function () {
        $('#{{ $resource }}-table').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 10,
            order: [[0, 'desc']],
            dom: '<"flex justify-between items-center mb-2"lf>rt<"flex justify-between items-center mt-4"ip>',
            initComplete: function () {
                const $searchInput = $('div.dataTables_filter input');
                $searchInput.addClass('ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50');
                const $lengthSelect = $('div.dataTables_length select');
                $lengthSelect.addClass('px-4 py-1 my-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50');
            },
            drawCallback: function () {
                const $paginateButtons = $('div.dataTables_paginate .paginate_button');
                $paginateButtons.addClass('px-4 py-2 text-black rounded-lg hover:bg-pink-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors');
                const $currentPage = $('div.dataTables_paginate .paginate_button.current');
                $currentPage.removeClass('bg-gray-700 text-white');
                $currentPage.addClass('bg-pink-600 text-white px-4 m-2 py-2 rounded-lg transition-colors hover:bg-pink-700');
            }
        });
    });
</script>

@endsection
