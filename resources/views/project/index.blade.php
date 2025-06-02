@extends('layouts.dashboard')
@section('content')
<div x-data="{ showEditModal: false, showDeleteModal: false, editProjectId: null, deleteProjectId: null }">
    <div class="flex justify-between mb-5">
        <h1 class="text-3xl font-bold text-center text-gray-800">{{ $page_title }} Records</h1>
        <div x-data="{ showModal: false }">
            <button @click="showModal = true"
                class="px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 hover:text-white border border-pink-700 transition-colors">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
            @include('project.create')
        </div>
    </div>

    @include('components.alert')

    <div class="mb-3">
        <input type="text" id="search" name="search" placeholder="Search by project title..."
            value="{{ request('search') }}"
            class="border border-gray-300 rounded p-2 w-full focus:ring focus:ring-[#1A4798] focus:border-[#1A4798]">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($data as $project)
        <div
            class="bg-white rounded-lg shadow-lg overflow-hidden hover:-translate-y-1 transition transform duration-300">
            <div class="px-8 py-6 bg-pink-600 text-white border-b border-pink-700">
                <h2 class="text-xl font-bold">{{ $project->title }}</h2>
            </div>
            <div class="px-8 py-6 text-gray-800">
                <p class="text-sm">{{ \Illuminate\Support\Str::limit(strip_tags($project->content), 300) }}</p>
            </div>
            <div class="flex justify-center space-x-2 border-t border-gray-200 px-3 py-4">
                <button @click="editProjectId = {{ $project->id }}; showEditModal = true"
                    class="p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-800 rounded transition"
                    title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </button>
                <a href="{{ route($resource . '.show', $project->id) }}">
                    <button
                        class="p-2 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-800 rounded transition"
                        title="View">
                        <i class="fa-solid fa-expand"></i> View
                    </button>
                </a>
                <button @click="deleteProjectId = {{ $project->id }}; showDeleteModal = true"
                    class="p-2 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 rounded transition"
                    title="Delete">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </div>
        </div>
        @include('project.edit')
        @include('project.destroy')
        @empty
        <div class="col-span-full text-center text-gray-500 py-10 text-lg">
            <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
            No projects found{{ request('search') ? ' for \"' . request('search') . '\"' : '' }}.
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->links() : '' }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search');
    let timeout = null;
    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            const query = searchInput.value;
            const url = new URL(window.location.href);
            url.searchParams.set('search', query);
            window.location.href = url.toString();
        }, 500);
    });
});
</script>
@endsection