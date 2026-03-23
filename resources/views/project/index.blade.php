@extends('layouts.dashboard')

@section('content')
    <div x-data="{ showModal: false, showEditModal: false, showDeleteModal: false, editProjectId: null, deleteProjectId: null }">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
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
        <div class="mb-6 flex gap-2">
            <input type="text" id="search" name="search" placeholder="Search by project title..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-pink-500 focus:border-pink-500 shadow-sm">
            <button id="mic-btn" type="button" title="Search by voice"
                class="flex items-center justify-center px-4 rounded-lg border border-gray-300 bg-white hover:bg-pink-50 transition shadow-sm"
                style="min-width:48px">
                <i id="mic-icon" class="fas fa-microphone text-pink-500 text-lg"></i>
            </button>
        </div>

        <!-- Project Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($data as $project)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:-translate-y-1 transition duration-300">
                    <!-- Title -->
                    <div class="px-6 py-4 bg-pink-600 text-white border-b border-pink-700">
                        <h2 class="text-lg font-bold truncate">{{ $project->title }}</h2>
                    </div>

                    <!-- Announcement Preview -->
                    <div class="px-4 py-2 text-sm text-black leading-relaxed min-h-[100px] whitespace-pre-line">
                        {!! \Illuminate\Support\Str::limit(strip_tags($project->announcement), 200, '...') !!}
                    </div>


                    <!-- Buttons -->
                    <div class="flex justify-center space-x-2 border-t border-gray-200 px-3 py-4">
                        <button @click="editProjectId = {{ $project->id }}; showEditModal = true"
                            class="btn-edit p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-800 rounded transition-all duration-200">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        <a href="{{ route($resource . '.show', $project->id) }}">
                            <button
                                class="p-2 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-800 rounded transition-all duration-200">
                                <i class="fa-solid fa-expand"></i> View
                            </button>
                        </a>
                        <button @click="deleteProjectId = {{ $project->id }}; showDeleteModal = true"
                            class="btn-delete p-2 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 rounded transition-all duration-200">
                            <i class="fa-solid fa-trash"></i> Delete
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
