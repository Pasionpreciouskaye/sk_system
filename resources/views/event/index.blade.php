@extends('layouts.dashboard')

@section('content')
<div x-data="{ showModal: false, showEditModal: false, showDeleteModal: false, editEventId: null, deleteEventId: null }">
    <!-- Header & Add Button -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
        <div x-data="{ showModal: false }">
            <button @click="showModal = true"
                class="px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 border border-pink-700 transition-colors">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
            @include('event.create')
        </div>
    </div>

    @include('components.alert')

    <!-- Search -->
    <div class="mb-6">
        <input type="text" id="search" name="search" placeholder="Search by event title..."
            value="{{ request('search') }}"
            class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-pink-500 focus:border-pink-500 shadow-sm">
    </div>

    <!-- Event Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($data as $event)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:-translate-y-1 transition duration-300">
            <!-- Title -->
            <div class="px-6 py-4 bg-pink-600 text-white border-b border-pink-700">
                <h2 class="text-lg font-bold truncate">{{ $event->title }}</h2>
            </div>

            <!-- Announcement Preview -->
            <div class="px-6 py-4">
                <p class="text-sm text-black leading-relaxed">
                    {{ \Illuminate\Support\Str::limit(strip_tags($event->content), 180, '...') }}
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center space-x-2 border-t border-gray-200 px-3 py-4">
                <button @click="editEventId = {{ $event->id }}; showEditModal = true"
                    class="p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-800 rounded transition">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </button>
                <a href="{{ route($resource . '.show', $event->id) }}">
                    <button
                        class="p-2 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-800 rounded transition">
                        <i class="fa-solid fa-expand"></i> View
                    </button>
                </a>
                <button @click="deleteEventId = {{ $event->id }}; showDeleteModal = true"
                    class="p-2 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 rounded transition">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </div>
        </div>

        @include('event.edit', ['event' => $event])
        @include('event.destroy', ['event' => $event])
        @empty
        <div class="col-span-full text-center text-gray-500 py-10 text-lg">
            <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
            No events found{{ request('search') ? ' for "' . request('search') . '"' : '' }}.
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
        <div>
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
        </div>
        <div class="text-pink-600">
            {{ $data->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('search');
    let timeout = null;
    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            const query = searchInput.value;
            const url = new URL(window.location.href);
            url.searchParams.set('search', query);
            window.location.href = url.toString();
        }, 500);
    });
});
</script>
@endsection
