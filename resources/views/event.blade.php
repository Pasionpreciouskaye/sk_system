@extends('layouts.welcome')

@section('content')
<div class="p-16 bg-gray-50 min-h-screen">
    @include('components.alert')

    <div x-data="{ showModal: false, activeEvent: {} }">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-center text-gray-800 w-full">{{ $page_title }} Records</h1>
        </div>

        <div class="mb-6">
            <input type="text" id="search" name="search" placeholder="Search by event title..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-pink-500 focus:border-pink-500 shadow-sm">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($data as $event)
            <div @click="activeEvent = {{ json_encode($event) }}, showModal = true"
                class="cursor-pointer bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition duration-300">
                <img src="{{ asset($event->file_path) }}" alt="{{ $event->title }}"
                    class="w-full h-48 object-cover object-center">
                <div class="px-6 py-4 bg-pink-600 text-white">
                    <h2 class="text-lg font-bold truncate">{{ $event->title }}</h2>
                </div>
                <div class="px-6 py-4 text-gray-700">
                    <p class="text-sm leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($event->content), 200) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-10 text-lg">
                <i class="fa-solid fa-circle-exclamation text-2xl text-pink-500 mb-2 block"></i>
                No Events found{{ request('search') ? ' for "' . request('search') . '"' : '' }}.
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->links() : '' }}
        </div>

        <!-- Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div @click.away="showModal = false" x-transition
                class="relative bg-white rounded-3xl max-w-3xl w-full shadow-3xl max-h-[90vh] overflow-hidden grid grid-cols-1 md:grid-cols-3">
                <div class="md:col-span-2 flex flex-col">
                    <div class="relative h-48 md:h-64 overflow-hidden">
                        <img :src="'/' + activeEvent.file_path" alt="Event image" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <h2 class="absolute bottom-4 left-4 text-2xl md:text-3xl font-bold text-white"
                            x-text="activeEvent.title"></h2>
                    </div>
                    <div
                        class="p-6 overflow-auto prose prose-p:text-gray-700 prose-a:text-pink-600 max-h-[calc(90vh-16rem)]">
                        <div x-html="activeEvent.content"></div>
                    </div>
                </div>

                <div class="bg-pink-50 p-8 flex flex-col">
                    <button @click="showModal = false" class="self-end text-gray-500 hover:text-gray-800 mb-4"
                        aria-label="Close modal">×</button>

                    <h3 class="text-xl font-semibold text-pink-600 mb-1">Register for this event</h3>
                    <p class="text-sm text-gray-600 mb-6">Fill out the form below and we’ll save your spot.</p>

                    <form :action="'{{ url('/event-registration') }}/' + activeEvent.id" method="POST"
                        class="flex-1 flex flex-col space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="full_name" placeholder="John Doe"
                                class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Email</label>
                            <input type="text" name="email"
                                placeholder="email@example.com"
                                class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Contact Number</label>
                            <input type="tel" name="contact_number"
                                placeholder="09999999999"
                                class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required />
                        </div>
                        <button type="submit"
                            class="mt-auto bg-gradient-to-r from-pink-500 to-pink-700 text-white font-semibold py-3 rounded-lg shadow-md hover:from-pink-600 hover:to-pink-800 transition">
                            Register now!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
