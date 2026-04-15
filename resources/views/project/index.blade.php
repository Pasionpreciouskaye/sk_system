@extends('layouts.dashboard')

@section('content')
    <div x-data="{ showModal: false, showEditModal: false, showDeleteModal: false, editProjectId: null, deleteProjectId: null }">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold" style="color:var(--color-text-primary);">{{ $page_title }} Records</h1>
            <div x-data="{ showModal: false }">
                <button @click="showModal = true"
                    class="btn-action-primary px-5 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
                </button>
                @include('project.create')
            </div>
        </div>

        @include('components.alert')

        <!-- Search -->
        <div class="sk-search-wrap">
            <input type="text" id="search" name="search" placeholder="Search by project title..."
                value="{{ request('search') }}" class="sk-search-input">
            <button id="mic-btn" type="button" title="Search by voice" class="sk-mic-btn">
                <i id="mic-icon" class="fas fa-microphone"></i>
            </button>
        </div>

        <!-- Project Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($data as $project)
                <div class="rounded-xl shadow-lg overflow-hidden hover:-translate-y-1 transition duration-300 flex flex-col"
                    style="background:var(--color-card);border:1px solid var(--color-border);">

                    {{-- Image --}}
                    <div class="h-48 overflow-hidden flex-shrink-0">
                        <img src="{{ asset($project->file_path) }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover object-center">
                    </div>

                    {{-- Title bar --}}
                    <div class="px-4 py-3 text-white" style="background:#E11D48;">
                        <h2 class="text-base font-bold truncate">{{ $project->title }}</h2>
                    </div>

                    {{-- Announcement preview --}}
                    <div class="px-4 py-3 text-sm leading-relaxed flex-1 min-h-[80px]"
                        style="color:var(--color-text-secondary);">
                        {!! \Illuminate\Support\Str::limit(strip_tags($project->announcement), 160, '...') !!}
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex justify-center gap-2 px-3 py-3" style="border-top:1px solid var(--color-border);">
                        <button @click="editProjectId = {{ $project->id }}; showEditModal = true"
                            class="btn-edit flex items-center gap-1 px-3 py-1.5 rounded text-sm transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <a href="{{ route($resource . '.show', $project->id) }}">
                            <button class="flex items-center gap-1 px-3 py-1.5 rounded text-sm text-white transition-all duration-200 hover:opacity-90"
                                style="background:#22C55E;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg>
                                View
                            </button>
                        </a>
                        <button @click="deleteProjectId = {{ $project->id }}; showDeleteModal = true"
                            class="btn-delete flex items-center gap-1 px-3 py-1.5 rounded text-sm transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            Delete
                        </button>
                    </div>
                </div>

                @include('project.edit', ['project' => $project])
                @include('project.destroy', ['project' => $project])
            @empty
                <div class="col-span-full text-center text-gray-500 py-10 text-lg">
                    <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
                    No projects found{{ request('search') ? ' for "' . request('search') . '"' : '' }}.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="flex justify-between items-center mt-6 text-sm" style="color:var(--color-text-secondary);">
                <div>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results</div>
                <div style="color:#E11D48;">{{ $data->links('vendor.pagination.custom-tailwind') }}</div>
            </div>
        @endif
    </div>

    @include('components.speech-search')
@endsection
