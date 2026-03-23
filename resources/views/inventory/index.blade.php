@extends($resource === 'inventory-show' ? 'layouts.welcome' : 'layouts.dashboard')
@section('content')
    <style>
        /* Inventory dark mode layered colors */
        .dark .inv-stat-pink {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-stat-pink i {
            color: #F472B6 !important;
        }

        .dark .inv-stat-green {
            background-color: #1B2A41 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-stat-green i {
            color: #34D399 !important;
        }

        .dark .inv-stat-red {
            background-color: #2A1A2F !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-stat-red i {
            color: #F87171 !important;
        }

        .dark .inv-table-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .inv-table-wrapper h1 {
            color: #F9FAFB !important;
        }

        .dark .inv-table-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .inv-table-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .inv-table-wrapper .btn-edit {
            background-color: #162338 !important;
            color: #60A5FA !important;
            border: 1px solid #2A3B55;
        }

        .dark .inv-table-wrapper .btn-edit:hover {
            background-color: #24344D !important;
            color: #93C5FD !important;
        }
    </style>

    @if ($resource === 'inventory')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @php
                $totalItems = $data->count();
                $totalQuantity = $data->sum('quantity');
                $totalCost = $data->sum(function ($item) {
                    return $item->quantity * $item->cost;
                });
            @endphp

            <div
                class="inv-stat-pink bg-pink-100 border border-pink-300 text-pink-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="mb-2"><i class="fas fa-box fa-2x text-pink-600"></i></div>
                <h3 class="text-sm font-medium mb-1 uppercase">Total Items</h3>
                <p class="text-2xl font-bold">{{ $totalItems }}</p>
            </div>

            <div
                class="inv-stat-green bg-green-100 border border-green-300 text-green-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="mb-2"><i class="fas fa-cubes fa-2x text-green-600"></i></div>
                <h3 class="text-sm font-medium mb-1 uppercase">Total Quantity</h3>
                <p class="text-2xl font-bold">{{ $totalQuantity }}</p>
            </div>

            <div
                class="inv-stat-red bg-red-100 border border-red-300 text-red-800 rounded-lg p-6 shadow text-center transform transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="mb-2"><i class="fas fa-money-bill-wave fa-2x text-red-600"></i></div>
                <h3 class="text-sm font-medium mb-1 uppercase">Total Cost</h3>
                <p class="text-2xl font-bold">₱{{ number_format($totalCost, 2) }}</p>
            </div>
        </div>
    @endif

    <div
        class="inv-table-wrapper w-full {{ $resource === 'inventory-show' ? 'p-6' : 'bg-white p-8' }} rounded-lg shadow-lg border border-gray-200 overflow-auto max-h-[85vh] min-h-[85vh]">
        <!-- Header and Add Button -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>

            @if ($resource === 'inventory')
                <div x-data="{ showModal: false }">
                    <button @click="showModal = true"
                        class="btn-action-primary px-5 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                        <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
                    </button>
                    @include('cms.create')
                </div>
            @endif
        </div>

        @include('components.alert')

        <table class="min-w-full border border-gray-200 shadow-lg rounded-lg" id="{{ $resource }}-table">
            <thead class="bg-pink-600">
                <tr class="text-white uppercase text-md leading-normal">
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Item</th>
                    <th class="py-3 px-4 text-left">Category</th>
                    <th class="py-3 px-4 text-left">Quantity</th>
                    <th class="py-3 px-4 text-left">Cost</th>
                    @if ($resource === 'inventory')
                        <th class="py-3 px-4 text-left">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach ($data as $record)
                    <tr class="border border-gray-200 hover:bg-pink-50 transition">
                        <td class="py-2 px-4 text-left">{{ $record->id }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->name }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->category->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 text-left">{{ $record->quantity }}</td>
                        <td class="py-2 px-4 text-left">₱{{ number_format($record->cost, 2) }}</td>

                        @if ($resource === 'inventory')
                            <td class="py-2 px-4 text-left">
                                <div class="inline-flex space-x-2">
                                    <div x-data="{ showEditModal: false }">
                                        <button @click="showEditModal = true"
                                            class="btn-edit p-2 bg-blue-100 text-blue-500 hover:bg-blue-200 rounded transition-all duration-200">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        @include('cms.edit')
                                    </div>
                                    <div x-data="{ showDeleteModal: false }">
                                        <button @click="showDeleteModal = true"
                                            class="btn-delete p-2 bg-red-100 text-red-500 hover:bg-red-200 rounded transition-all duration-200">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @include('cms.destroy')
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-600">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
                </div>
                <div>
                    {{ $data->links('vendor.pagination.custom-tailwind') }}
                </div>
            </div>
        @endif
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
                    $('div.dataTables_filter input').addClass(
                        'ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500'
                    );
                    $('div.dataTables_length select').addClass(
                        'px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500'
                    );
                },
                drawCallback: function() {
                    $('div.dataTables_paginate .paginate_button').addClass(
                        'px-4 py-2 text-black rounded-lg hover:bg-pink-100');
                    $('div.dataTables_paginate .paginate_button.current').removeClass('bg-gray-700')
                        .addClass('bg-pink-600 text-white px-4 py-2 rounded-lg');
                }
            });
        });
    </script>
@endsection
