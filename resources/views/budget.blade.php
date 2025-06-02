@extends('layouts.welcome')
@section('content')
<div class="p-16">
    <h1 class="text-3xl font-bold text-center text-gray-800 w-full">{{ $page_title }} Records</h1>
    @if ($resource === 'budget')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-6">
        <div
            class="bg-pink-100 border border-pink-300 text-pink-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="mb-2">
                <i class="fas fa-wallet fa-2x text-pink-600"></i>
            </div>
            <h3 class="text-sm font-medium mb-1 uppercase">Total Allocated</h3>
            <p class="text-2xl font-bold">₱{{ number_format($data->sum('allocated'), 2) }}</p>
        </div>

        <div
            class="bg-green-100 border border-green-300 text-green-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="mb-2">
                <i class="fas fa-receipt fa-2x text-green-600"></i>
            </div>
            <h3 class="text-sm font-medium mb-1 uppercase">Total Spent</h3>
            <p class="text-2xl font-bold">₱{{ number_format($data->sum('spent'), 2) }}</p>
        </div>

        @php
            $totalAllocated = $data->sum('allocated');
            $totalSpent = $data->sum('spent');
            $totalRemaining = $totalAllocated - $totalSpent;

            $bgColor = 'bg-white border-gray-300 text-gray-800';
            $iconColor = 'text-gray-400';

            if ($totalRemaining > 0) {
                $bgColor = 'bg-green-100 border-green-300 text-green-800';
                $iconColor = 'text-green-600';
            } elseif ($totalRemaining < 0) { 
                $bgColor='bg-red-100 border-red-300 text-red-800' ; $iconColor='text-red-600' ;
            } 
        @endphp 
        <div
            class="{{ $bgColor }} rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="mb-2">
                <i class="fas fa-coins fa-2x {{ $iconColor }}"></i>
            </div>
            <h3 class="text-sm font-medium mb-1 uppercase">Total Remaining</h3>
            <p class="text-2xl font-bold">
                ₱{{ number_format($totalRemaining, 2) }}
            </p>
        </div>
    </div>
    @endif
    <div class="w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200 overflow-auto">
        <div class="flex justify-between items-center mb-5 overflow-auto">
            <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">{{ $page_title }} records</h1>
        </div>
        <table class="min-w-full border border-gray-200 shadow-lg rounded-lg" id="{{ $resource }}-table">
            <thead class="bg-pink-600">
                <tr class="text-white uppercase text-md leading-normal">
                    @foreach ($columns as $column)
                    <th class="py-3 px-4 cursor-pointer">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-normal text-center">
                @foreach ($data as $record)
                <tr class="border border-gray-200 hover:bg-pink-50 transition-colors">
                    <td class="py-2 px-4">{{ $record->id ?? '' }}</td>
                    <td class="py-2 px-4">{{ $record->category->name ?? '' }}</td>
                    <td class="py-2 px-4">{{ $record->allocated ?? '' }} - Dated: {{ $record->date_allocated ?? '' }}</td>
                    <td class="py-2 px-4">{{ $record->spent ?? '' }} - Dated: {{ $record->date_spent ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#{{ $resource }}-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        order: [
            [0, 'desc']
        ],

        dom: '<"flex justify-between items-center mb-2"lf>rt<"flex justify-between items-center mt-4"ip>',

        initComplete: function() {
            const table = this.api();
            const $searchInput = $('div.dataTables_filter input');
            $searchInput.addClass(
                'ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );
            const $lengthSelect = $('div.dataTables_length select');
            $lengthSelect.addClass(
                'px-4 py-1 my-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );
        },

        drawCallback: function() {
            const $paginateButtons = $('div.dataTables_paginate .paginate_button');
            $paginateButtons.addClass(
                'px-4 py-2 text-black rounded-lg hover:bg-pink-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors'
            );

            const $currentPage = $('div.dataTables_paginate .paginate_button.current');
            $currentPage.removeClass('bg-gray-700 text-white');
            $currentPage.addClass(
                'bg-pink-600 text-white px-4 m-2 py-2 rounded-lg transition-colors hover:bg-pink-700'
            );
        }
    });
});
</script>
@endsection