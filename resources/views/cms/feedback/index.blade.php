@extends('layouts.dashboard')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-pink-600">{{ $page_title }}</h1>

    @include('components.alert')

    <!-- Filter + Search -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        <!-- Show X Entries -->
        <form method="GET" class="flex items-center space-x-2">
            <label for="per_page" class="text-sm text-gray-700">Show</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-2 py-1 text-sm">
                @foreach ([10, 25, 50, 100] as $limit)
                    <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                @endforeach
            </select>
            <span class="text-sm text-gray-700">entries</span>
        </form>

        <!-- Search Bar -->
        <form method="GET" class="w-full md:w-1/3">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500 text-sm">
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-pink-600 text-white">
                <tr class="text-left text-sm">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Subject</th>
                    <th class="px-4 py-2">Message</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $feedback)
                    <tr class="border-b border-gray-200 text-sm text-gray-700 hover:bg-pink-50">
                        <td class="px-4 py-3">{{ $data->firstItem() + $index }}</td>
                        <td class="px-4 py-3">{{ $feedback->name }}</td>
                        <td class="px-4 py-3">{{ $feedback->email }}</td>
                        <td class="px-4 py-3">{{ $feedback->subject }}</td>
                        <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($feedback->message, 80, '...') }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No feedback found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   <!-- Pagination -->
@if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="flex flex-col md:flex-row justify-between items-center mt-4 text-sm text-gray-600 gap-2">
        <div>
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
        </div>
        <div class="text-pink-600">
            {{ $data->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
@endif
</div>
@endsection
