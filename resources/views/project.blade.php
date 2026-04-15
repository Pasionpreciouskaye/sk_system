@extends('layouts.welcome')

@section('content')
    <div class="sk-section-base p-16 min-h-screen">
        <div x-data="{ showModal: false, activeProject: {} }">
            <div class="flex justify-between mb-5">
                <h1 class="text-3xl font-bold text-center w-full" style="color:#E11D48;">{{ $page_title }} Records</h1>
            </div>

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
                    <div @click="activeProject = {{ json_encode($project) }}, showModal = true"
                        class="sk-card-inner cursor-pointer rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition duration-300">
                        <img src="{{ asset($project->file_path) }}" alt="{{ $project->title }}"
                            class="w-full h-48 object-cover object-center">
                        <div class="px-6 py-4 text-white" style="background:#E11D48;">
                            <h2 class="text-lg font-bold truncate">{{ $project->title }}</h2>
                        </div>
                        <div class="px-6 py-4">
                            <p class="text-sm leading-relaxed" style="color:#6B7280;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($project->announcement), 200) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-lg" style="color:#6B7280;">
                        <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
                        No projects found{{ request('search') ? ' for "' . request('search') . '"' : '' }}.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="flex justify-between items-center mt-8 text-sm" style="color:#6B7280;">
                    <div>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results</div>
                    <div style="color:#E11D48;">{{ $data->links('vendor.pagination.custom-tailwind') }}</div>
                </div>
            @endif

            <!-- Modal -->
            <div x-show="showModal" x-cloak
                class="fixed inset-0 bg-black/80 z-[999] flex items-start justify-center pt-10">
                <div @click.away="showModal = false" x-transition
                    class="rounded-2xl max-w-4xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-hidden"
                    style="background:#FFFFFF;">
                    <div class="grid md:grid-cols-3 gap-0 h-[90vh]">
                        <div class="md:col-span-2 flex flex-col">
                            <div class="h-48 md:h-64 overflow-hidden flex-shrink-0">
                                <img :src="'/' + activeProject.file_path" alt="Project image"
                                    class="w-full h-full object-cover object-center rounded-tl-xl">
                            </div>
                            <div class="p-6 overflow-y-auto flex-1" style="background:#FCE4EC;">
                                <h2 class="text-2xl font-bold mb-3" style="color:#E11D48;" x-text="activeProject.title"></h2>
                                <div x-html="activeProject.announcement"
                                    class="text-sm leading-relaxed whitespace-pre-line" style="color:#1F2937;"></div>
                            </div>
                        </div>
                        {{-- Registration Form --}}
                        <div class="p-8 flex flex-col overflow-y-auto" style="background:#FFF1F5;">
                            <button @click="showModal = false"
                                class="self-end font-bold text-xl mb-4"
                                style="color:#6B7280;" aria-label="Close modal">×</button>
                            <h3 class="text-xl font-semibold mb-1" style="color:#E11D48;">Register for this project</h3>
                            <p class="text-sm mb-6" style="color:#6B7280;">Fill out the form below to register.</p>
                            <form :action="`/project/${activeProject.id}/register`" method="POST"
                                class="flex-1 flex flex-col space-y-4">
                                @csrf
                                <div>
                                    <label class="block mb-1 text-sm font-medium" style="color:#1F2937;">Full Name</label>
                                    <input type="text" name="full_name" placeholder="Name"
                                        style="background:#FFFFFF;color:#1F2937;border:1px solid #FBCFE8;"
                                        class="w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                        required />
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm font-medium" style="color:#1F2937;">Email</label>
                                    <input type="email" name="email" placeholder="email@example.com"
                                        style="background:#FFFFFF;color:#1F2937;border:1px solid #FBCFE8;"
                                        class="w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                        required />
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm font-medium" style="color:#1F2937;">Contact Number</label>
                                    <input type="tel" name="contact_number" placeholder="09999999999"
                                        style="background:#FFFFFF;color:#1F2937;border:1px solid #FBCFE8;"
                                        class="w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                        required />
                                </div>
                                <button type="submit"
                                    class="mt-auto text-white font-semibold py-3 rounded-lg shadow-md hover:opacity-90 transition"
                                    style="background:#E11D48;">
                                    Register now!
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.speech-search')
@endsection
