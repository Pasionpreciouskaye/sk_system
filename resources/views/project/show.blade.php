@extends('layouts.dashboard')

@section('content')
<section class="py-16 bg-gradient-to-r from-pink-50 to-white rounded-2xl shadow-xl">
    <h2 class="text-3xl font-extrabold text-pink-600 mb-8 text-center">
        {{ $project->title }}
    </h2>

    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <!-- Image Section -->
            <div class="relative w-full h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset($project->file_path) }}" alt="{{ $project->file_name }}"
                    class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            </div>

           <!-- Announcement Section -->
            <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                {!! $project->announcement !!}
            </div>

    </div>

    <!-- Optional Data Table if Resource is "event" -->
    @if ($resource === 'event' && isset($columns, $data))
    <div class="mt-12 max-w-7xl mx-auto px-4 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-auto" id="{{ $resource }}-table">
                <thead class="bg-pink-600 text-white uppercase text-sm">
                    <tr>
                        @foreach ($columns as $column)
                            <th class="py-3 px-4 text-left">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($data as $record)
                        <tr class="border-b border-gray-200 hover:bg-pink-50 transition-colors">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#{{ $resource }}-table').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 5,
            order: [[0, 'desc']],
            dom: '<"flex justify-between items-center mb-2"lf>rt<"flex justify-between items-center mt-4"ip>',
            initComplete: function () {
                $('div.dataTables_filter input').addClass('ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50');
                $('div.dataTables_length select').addClass('px-4 py-1 my-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50');
            },
            drawCallback: function () {
                $('div.dataTables_paginate .paginate_button').addClass('px-4 py-2 text-black rounded-lg hover:bg-pink-100 transition-colors');
                $('div.dataTables_paginate .paginate_button.current').removeClass('bg-gray-700 text-white').addClass('bg-pink-600 text-white px-4 m-2 py-2 rounded-lg hover:bg-pink-700');
            }
        });
    });
</script>
@endpush
