@extends('layouts.dashboard')
@section('content')
<section class="py-16 bg-gradient-to-r from-pink-50 to-white rounded-2xl shadow-xl">
    <h2 class="text-3xl font-extrabold text-pink-600 mb-8 text-center">
        {{ $$resource->title }}
    </h2>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 ">
            <div class="relative w-full h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset($$resource->file_path) }}" alt="{{ $$resource->file_name }}"
                    class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            </div>
            <div class="prose lg:prose-lg text-gray-700">
                {!! $$resource->content !!}
            </div>
        </div>
    </div>

    @if ($resource === 'event')
    <div class="mt-12 max-w-7xl mx-auto px-4 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-auto" id="{{ $resource }}-table">
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
                        <td class="py-2 px-4">{{ $record->full_name ?? '' }}</td>
                        <td class="py-2 px-4">{{ $record->email ?? '' }}</td>
                        <td class="py-2 px-4">{{ $record->contact_number ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
<script>
$(document).ready(function() {
    $('#{{ $resource }}-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 5,
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