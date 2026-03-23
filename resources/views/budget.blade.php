@extends('layouts.welcome')
@section('content')
    <style>
        .dark .budget-stat-pink {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .budget-stat-pink i {
            color: #F472B6 !important;
        }

        .dark .budget-stat-green {
            background-color: #1B2A41 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .budget-stat-green i {
            color: #34D399 !important;
        }

        .dark .budget-stat-remaining {
            background-color: #2A1A2F !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .budget-stat-remaining i {
            color: #F87171 !important;
        }

        .dark .budget-table-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .budget-table-wrapper thead {
            background-color: #E91E63 !important;
        }

        .dark .budget-table-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .budget-table-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .budget-page-title {
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
        <h1 class="text-3xl font-bold text-center budget-page-title w-full mb-2">{{ $page_title }} Records</h1>

        @if ($resource === 'budget')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div
                    class="budget-stat-pink bg-pink-100 border border-pink-300 text-pink-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-2"><i class="fas fa-wallet fa-2x text-pink-600"></i></div>
                    <h3 class="text-sm font-medium mb-1 uppercase">Total Allocated</h3>
                    <p class="text-2xl font-bold">₱{{ number_format($data->sum('allocated'), 2) }}</p>
                </div>
                <div
                    class="budget-stat-green bg-green-100 border border-green-300 text-green-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-2"><i class="fas fa-receipt fa-2x text-green-600"></i></div>
                    <h3 class="text-sm font-medium mb-1 uppercase">Total Spent</h3>
                    <p class="text-2xl font-bold">₱{{ number_format($data->sum('spent'), 2) }}</p>
                </div>
                @php
                    $totalAllocated = $data->sum('allocated');
                    $totalSpent = $data->sum('spent');
                    $totalRemaining = $totalAllocated - $totalSpent;
                @endphp
                <div
                    class="budget-stat-remaining bg-red-100 border border-red-300 text-red-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-2"><i class="fas fa-coins fa-2x text-red-600"></i></div>
                    <h3 class="text-sm font-medium mb-1 uppercase">Total Remaining</h3>
                    <p class="text-2xl font-bold">₱{{ number_format($totalRemaining, 2) }}</p>
                </div>
            </div>
        @endif

        <div class="w-full flex justify-center">
            <div class="budget-table-wrapper w-full max-w-6xl rounded-lg border border-gray-200">
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
                                <td class="py-2 px-4 text-left">{{ $record->id ?? '' }}</td>
                                <td class="py-2 px-4 text-left">{{ $record->category->name ?? '' }}</td>
                                <td class="py-2 px-4 text-left">₱{{ number_format($record->allocated, 2) }}</td>
                                <td class="py-2 px-4 text-left">₱{{ number_format($record->spent, 2) }}</td>
                                <td class="py-2 px-4 text-left">
                                    @if ($record->file)
                                        <a href="{{ asset('storage/' . $record->file) }}" target="_blank"
                                            class="text-pink-500 underline hover:text-pink-400">Download PDF</a>
                                    @else
                                        <span style="color:var(--color-text-muted)">No File</span>
                                    @endif
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
                    $fi.addClass(
                        'ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50 pr-8'
                    );
                    $fi.attr('id', 'search').wrap(
                        '<div style="position:relative;display:inline-flex;align-items:center;"></div>'
                    );
                    $fi.after(
                        '<button id="mic-btn" title="Search by voice" style="position:absolute;right:0.4rem;background:none;border:none;cursor:pointer;padding:0;line-height:1;"><i id="mic-icon" class="fas fa-microphone" style="color:#E91E63;font-size:0.95rem;"></i></button>'
                    );
                    $('div.dataTables_length select').addClass(
                        'px-4 py-1 my-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
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
