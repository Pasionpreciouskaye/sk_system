@extends('layouts.welcome')
@section('content')
    @php
        $totalQuantity = $data->sum('quantity');
        $totalCost = $data->sum(fn($item) => $item->cost * $item->quantity);
        $columns = ['ID', 'Category', 'Item', 'Quantity', 'Cost', 'Total'];
    @endphp

    <style>
        .dark .inv-stat-qty {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-stat-qty i {
            color: #818CF8 !important;
        }

        .dark .inv-stat-cost {
            background-color: #1B2A41 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-stat-cost i {
            color: #C084FC !important;
        }

        .dark .inv-table-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .inv-table-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-table-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .inv-page-title {
            color: #F9FAFB !important;
        }

        /* DataTable dark mode */
        .dark .dataTables_wrapper {
            color: #F9FAFB !important;
        }

        .dark .dataTables_filter input,
        .dark .dataTables_length select {
            background-color: #162338 !important;
            color: #F9FAFB !important;
            border-color: #2A3B55 !important;
        }

        .dark .dataTables_paginate .paginate_button {
            color: #F9FAFB !important;
        }

        .dark .dataTables_paginate .paginate_button.current {
            background: #E91E63 !important;
            color: #fff !important;
        }

        .dark .dataTables_info {
            color: #D1D5DB !important;
        }

        /* Search bar */
        .speech-search-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .speech-search-wrap input {
            padding-right: 2.5rem;
        }

        .speech-search-wrap .mic-btn {
            position: absolute;
            right: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
    </style>

    <div class="p-8 md:p-16">
        <h1 class="text-3xl font-bold text-center inv-page-title w-full mb-2">{{ $page_title }} Records</h1>

        @if ($resource === 'inventory')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div
                    class="inv-stat-qty bg-indigo-100 border border-indigo-300 text-indigo-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-2"><i class="fas fa-boxes fa-2x text-indigo-600"></i></div>
                    <h3 class="text-sm font-medium mb-1 uppercase">Total Quantity</h3>
                    <p class="text-2xl font-bold">{{ $totalQuantity }}</p>
                </div>
                <div
                    class="inv-stat-cost bg-purple-100 border border-purple-300 text-purple-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-2"><i class="fas fa-coins fa-2x text-purple-600"></i></div>
                    <h3 class="text-sm font-medium mb-1 uppercase">Total Cost</h3>
                    <p class="text-2xl font-bold">₱{{ number_format($totalCost, 2) }}</p>
                </div>
            </div>
        @endif

        <div class="w-full flex justify-center">
            <div class="inv-table-wrapper w-full max-w-6xl rounded-lg border border-gray-200">
                <table class="min-w-full shadow-lg rounded-lg" id="{{ $resource }}-table">
                    <thead class="bg-pink-600">
                        <tr class="text-white uppercase text-md leading-normal">
                            @foreach ($columns as $column)
                                <th class="py-3 px-4 text-left cursor-pointer">{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-sm font-normal" style="color:var(--color-text-primary)">
                        @foreach ($data as $record)
                            <tr class="border border-gray-200 hover:bg-pink-50 transition-colors">
                                <td class="py-2 px-4 text-left">{{ $record->id }}</td>
                                <td class="py-2 px-4 text-left">{{ $record->category->name ?? '' }}</td>
                                <td class="py-2 px-4 text-left">{{ $record->name }}</td>
                                <td class="py-2 px-4 text-left">{{ $record->quantity }}</td>
                                <td class="py-2 px-4 text-left">₱{{ number_format($record->cost, 2) }}</td>
                                <td class="py-2 px-4 text-left">₱{{ number_format($record->quantity * $record->cost, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                    const $fi = $('div.dataTables_filter input');
                    $fi.addClass('sk-search-input').attr('id', 'search').attr('placeholder', 'Search...');
                    $('div.dataTables_filter').append(
                        '<button id="mic-btn" title="Search by voice" class="dt-mic-btn"></button>'
                    );
                    $('div.dataTables_length select').addClass(
                        'px-3 py-1 my-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500'
                    );
                },
                drawCallback: function() {
                    $('div.dataTables_paginate .paginate_button').addClass(
                        'px-4 py-2 rounded-lg hover:bg-pink-100 disabled:opacity-50 transition-colors'
                    );
                    $('div.dataTables_paginate .paginate_button.current').removeClass(
                        'bg-gray-700 text-white').addClass(
                        'bg-pink-600 text-white px-4 m-2 py-2 rounded-lg transition-colors hover:bg-pink-700'
                    );
                }
            });
        });
    </script>
    @include('components.speech-search')
@endsection
