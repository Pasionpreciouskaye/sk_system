@extends('layouts.dashboard')
@section('content')
@if ($resource === 'budget')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
    } elseif ($totalRemaining < 0) { $bgColor='bg-red-100 border-red-300 text-red-800' ; $iconColor='text-red-600' ; }
        @endphp <div
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
@if ($resource === 'inventory')
@php
$totalItems = $data->sum('quantity');
$totalCosting = $data->sum(function ($item) {
return $item->cost * $item->quantity;
});
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div
        class="bg-indigo-100 border border-indigo-300 text-indigo-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="mb-2">
            <i class="fas fa-boxes fa-2x text-indigo-600"></i>
        </div>
        <h3 class="text-sm font-medium mb-1 uppercase">Total Items</h3>
        <p class="text-2xl font-bold">{{ $totalItems }}</p>
    </div>

    <div
        class="bg-purple-100 border border-purple-300 text-purple-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="mb-2">
            <i class="fas fa-calculator fa-2x text-purple-600"></i>
        </div>
        <h3 class="text-sm font-medium mb-1 uppercase">Total Costing</h3>
        <p class="text-2xl font-bold">₱{{ number_format($totalCosting, 2) }}</p>
    </div>
</div>
@endif
<div class="w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200 overflow-auto max-h-[85vh] min-h-[85vh]">
    <div class="flex justify-between items-center mb-5 overflow-auto">
        <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">{{ $page_title }} records</h1>
        @unless ($resource === 'feedback')
        <div x-data="{ showModal: false }">
            <button @click="showModal = true"
                class="px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 hover:text-white border border-pink-700 transition-colors">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
            @include('cms.create')
        </div>
        @endunless
    </div>

    @include('components.alert')
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
                @if ($resource === 'user')
                <td class="py-2 px-4">{{ $record->first_name ?? '' }} {{ $record->middle_name ?: '' }}
                    {{ $record->last_name ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->email ?? '' }}</td>
                @elseif ($resource === 'budget')
                <td class="py-2 px-4">{{ $record->category->name ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->allocated ?? '' }} - Dated: {{ $record->date_allocated ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->spent ?? '' }} - Dated: {{ $record->date_spent ?? '' }}</td>
                @elseif ($resource === 'inventory')
                <td class="py-2 px-4">{{ $record->category->name ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->name ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->quantity ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->cost ?? '' }}</td>
                @elseif ($resource === 'feedback')
                <td class="py-2 px-4">{{ $record->subject ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->message ?? '' }}</td>
                @else
                <td class="py-2 px-4">{{ $record->name ?? '' }}</td>
                <td class="py-2 px-4">{{ $record->remarks ?? '' }}</td>
                @endif

                @unless ($resource === 'feedback')
                <td class="py-2 px-4">
                    <div class="inline-flex items-center space-x-2">
                        <div x-data="{ showEditModal: false }">
                            <button @click="showEditModal = true"
                                class="inline-block p-2 bg-blue-100 text-blue-500 hover:bg-blue-200 hover:text-blue-700 rounded transition-colors"
                                title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            @include('cms.edit')
                        </div>
                        <div x-data="{ showDeleteModal: false }">
                            <button @click="showDeleteModal = true"
                                class="inline-block p-2 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 rounded transition-colors"
                                title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @include('cms.destroy')
                        </div>
                    </div>
                </td>
                @endunless
            </tr>
            @endforeach
        </tbody>
    </table>
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