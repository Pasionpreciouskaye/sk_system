@extends('layouts.dashboard')

@section('content')
    <style>
        .dark .feedback-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .feedback-wrapper h1 {
            color: #F9FAFB !important;
        }

        .dark .feedback-wrapper label,
        .dark .feedback-wrapper span {
            color: #D1D5DB !important;
        }

        .dark .feedback-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .feedback-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .feedback-wrapper input,
        .dark .feedback-wrapper select {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .feedback-wrapper input:focus,
        .dark .feedback-wrapper select:focus {
            border-color: #E91E63 !important;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.25) !important;
        }

        .dark .feedback-wrapper .pagination-info {
            color: #D1D5DB !important;
        }
    </style>

    <div class="feedback-wrapper p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-pink-600">{{ $page_title }}</h1>

        @include('components.alert')

        <!-- Filter + Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
            <form method="GET" class="flex items-center space-x-2">
                <label for="per_page" class="text-sm text-gray-700">Show</label>
                <select name="per_page" id="per_page" onchange="this.form.submit()"
                    class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-[#E91E63] transition-all duration-200">
                    @foreach ([10, 25, 50, 100] as $limit)
                        <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>
                            {{ $limit }}</option>
                    @endforeach
                </select>
                <span class="text-sm text-gray-700">entries</span>
            </form>

            <form method="GET" class="w-full md:w-1/3">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] text-sm transition-all duration-200">
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
                        <tr
                            class="border-b border-gray-200 text-sm text-gray-700 hover:bg-pink-50 transition-colors duration-200">
                            <td class="px-4 py-3">{{ $data->firstItem() + $index }}</td>
                            <td class="px-4 py-3">{{ $feedback->name }}</td>
                            <td class="px-4 py-3">
                                <a href="mailto:{{ $feedback->email }}"
                                    class="text-action text-[#F472B6] hover:text-[#E91E63] transition-colors duration-200">
                                    {{ $feedback->email }}
                                </a>
                            </td>
                            <td class="px-4 py-3">{{ $feedback->subject }}</td>
                            <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($feedback->message, 80, '...') }}</td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn-delete bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="display:inline"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg> Delete
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

        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="flex flex-col md:flex-row justify-between items-center mt-4 text-sm text-gray-600 gap-2">
                <div class="pagination-info">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                </div>
                <div class="text-pink-600">
                    {{ $data->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
                </div>
            </div>
        @endif
    </div>
@endsection
