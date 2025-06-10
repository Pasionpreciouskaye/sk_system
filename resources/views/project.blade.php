@extends('layouts.welcome')
@section('content')
<div class="p-16 bg-gray-50 min-h-screen">
    <div x-data="{ showModal: false, activeProject: {} }">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-center text-gray-800 w-full">{{ $page_title }} Records</h1>
        </div>

        <div class="mb-6">
            <input type="text" id="search" name="search" placeholder="Search by project title..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-pink-500 focus:border-pink-500 shadow-sm">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($data as $project)
            <div @click="activeProject = {{ json_encode($project) }}, showModal = true"
                class="cursor-pointer bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition duration-300">
                <img src="{{ asset($project->file_path) }}" alt="{{ $project->title }}"
                    class="w-full h-48 object-cover object-center">
                <div class="px-6 py-4 bg-pink-600 text-white">
                    <h2 class="text-lg font-bold truncate">{{ $project->title }}</h2>
                </div>
                <div class="px-6 py-4 text-gray-700">
                    <p class="text-sm leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($project->content), 200) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-10 text-lg">
                <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
                No projects found{{ request('search') ? ' for "' . request('search') . '"' : '' }}.
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->links() : '' }}
        </div>
<!-- Modal -->
<div x-show="showModal" x-cloak
  class="fixed inset-0 bg-black/80 bg-opacity-50 z-[999] flex items-start justify-center pt-10">
  <div @click.away="showModal = false" x-transition
    class="bg-white rounded-2xl max-w-4xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-hidden">

    <div class="grid md:grid-cols-2 gap-0 h-[90vh]"> <!-- full modal height -->
      <div class="h-full">
        <img :src="'/' + activeProject.file_path" alt="Project image"
          class="w-full h-full object-cover object-center rounded-l-xl">
      </div>
      <div class="p-6 flex flex-col justify-between overflow-y-auto"> <!-- scrollable area -->
        <div>
          <div class="bg-pink-100 p-8 flex flex-col">
            <button @click="showModal = false"
              class="self-end text-gray-500 hover:text-gray-800 mb-4 font-bold"
              aria-label="Close modal">×</button>
            <h2 class="text-2xl font-bold text-pink-600 mb-3" x-text="activeProject.title"></h2>
            <div class="text-gray-700 text-sm leading-relaxed" x-html="activeProject.content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
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
