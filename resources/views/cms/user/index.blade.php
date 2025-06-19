@extends('layouts.dashboard')
@section('content')

<div class="w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200 overflow-auto max-h-[85vh] min-h-[85vh]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
        <a href="{{ route('user.create') }}"
           class="px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 border border-pink-700">
            <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
        </a>
    </div>

    @include('components.alert')

    <table class="min-w-full border border-gray-200 shadow-lg rounded-lg" id="{{ $resource }}-table">
        <thead class="bg-pink-600">
            <tr class="text-white uppercase text-md leading-normal">
                <th class="py-3 px-4 text-left">ID</th>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @foreach ($data as $user)
                <tr class="border border-gray-200 hover:bg-pink-50 transition">
                    <td class="py-2 px-4 text-left">{{ $user->id }}</td>
                    <td class="py-2 px-4 text-left">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="py-2 px-4 text-left">{{ $user->email }}</td>
                    <td class="py-2 px-4 text-left">
                        <div class="inline-flex space-x-2">
                            <a href="{{ route('user.edit', $user->id) }}"
                               class="p-2 bg-blue-100 text-blue-500 hover:bg-blue-200 rounded">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 bg-red-100 text-red-500 hover:bg-red-200 rounded">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#{{ $resource }}-table').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 10,
            order: [[0, 'desc']],
            dom: '<"flex justify-between items-center mb-2"lf>rt<"flex justify-between items-center mt-4"ip>',
            initComplete: function () {
                $('div.dataTables_filter input').addClass('ml-2 px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500');
                $('div.dataTables_length select').addClass('px-4 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500');
            },
            drawCallback: function () {
                $('div.dataTables_paginate .paginate_button').addClass('px-4 py-2 text-black rounded-lg hover:bg-pink-100');
                $('div.dataTables_paginate .paginate_button.current').removeClass('bg-gray-700').addClass('bg-pink-600 text-white px-4 py-2 rounded-lg');
            }
        });
    });
</script>

@endsection
