@extends('layouts.dashboard')

@section('content')
    <div x-data="{ showModal: false, showEditModal: false, showDeleteModal: false, editEventId: null, deleteEventId: null }">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
            <div x-data="{ showModal: false }">
                <button @click="showModal = true"
                    class="btn-action-primary px-5 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
                </button>
                @include('event.create')
            </div>
        </div>

        @include('components.alert')

        <!-- Search -->
        <div class="sk-search-wrap">
            <input type="text" id="search" name="search" placeholder="Search by event title..."
                value="{{ request('search') }}" class="sk-search-input">
            <button id="mic-btn" type="button" title="Search by voice" class="sk-mic-btn">
                <i id="mic-icon" class="fas fa-microphone"></i>
            </button>
        </div>

        <!-- Event Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($data as $event)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:-translate-y-1 transition duration-300">
                    <!-- Image -->
                    <img src="{{ asset($event->file_path) }}" alt="{{ $event->title }}"
                        class="w-full h-48 object-cover object-center">

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
                            class="btn-edit p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-800 rounded transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="display:inline"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit
                        </button>
                        <a href="{{ route($resource . '.show', $event->id) }}">
                            <button class="p-2 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-800 rounded transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="display:inline"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg> View
                            </button>
                        </a>
                        <button @click="deleteEventId = {{ $event->id }}; showDeleteModal = true"
                            class="btn-delete p-2 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 rounded transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="display:inline"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg> Delete
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

    @include('components.speech-search')
@endsection
