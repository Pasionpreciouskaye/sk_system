@extends('layouts.dashboard')

@section('content')
    <style>
        .dark .cat-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .cat-wrapper h1 {
            color: #F9FAFB !important;
        }

        .dark .cat-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .cat-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .cat-wrapper .divide-y {
            border-color: #1F2A44 !important;
        }

        .dark .cat-wrapper .btn-edit {
            background-color: #162338 !important;
            color: #60A5FA !important;
            border: 1px solid #2A3B55;
        }

        .dark .cat-wrapper .btn-edit:hover {
            background-color: #24344D !important;
            color: #93C5FD !important;
        }
    </style>

    <div x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        editData: {},
        deleteId: null
    }" class="cat-wrapper p-6 bg-white shadow rounded">

        <h1 class="text-2xl font-bold text-pink-600 mb-4">Budget Category Records</h1>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-3">
            <form method="GET" class="w-full md:w-1/3 order-2 md:order-1">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full border border-gray-300 dark:border-[#2A3B55] dark:bg-[#162338] dark:text-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E91E63] transition-all duration-200"
                    placeholder="Search by category name">
            </form>

            <button @click="showCreateModal = true"
                class="btn-action-primary order-1 md:order-2 px-4 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                + New Category
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-pink-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Remarks</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    @forelse ($data as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="px-4 py-2">{{ $item->name }}</td>
                            <td class="px-4 py-2">{{ $item->remarks }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <button
                                    @click="showEditModal = true; editData = {{ json_encode(['id' => $item->id, 'name' => $item->name, 'remarks' => $item->remarks]) }}"
                                    class="btn-edit inline-block px-2 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition-all duration-200">
                                    <i class="fas fa-pen-to-square"></i>
                                </button>
                                <button @click="showDeleteModal = true; deleteId = {{ $item->id }}"
                                    class="btn-delete px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition-all duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No budget categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $data->links('vendor.pagination.custom-tailwind') }}
        </div>

        <!-- CREATE MODAL -->
        <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showCreateModal = false"></div>
            <div class="action-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-2xl relative">
                <div class="flex justify-between items-center modal-border border-b pb-3 mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Add Budget Category</h2>
                    <button @click="showCreateModal = false"
                        class="text-gray-400 hover:text-pink-500 text-2xl leading-none transition-colors">&times;</button>
                </div>
                <form action="{{ route($resource . '.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" required
                                class="w-full border border-gray-300 dark:border-[#2A3B55] dark:bg-[#162338] dark:text-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
                            <input type="text" name="remarks"
                                class="w-full border border-gray-300 dark:border-[#2A3B55] dark:bg-[#162338] dark:text-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 gap-2">
                        <button type="button" @click="showCreateModal = false"
                            class="btn-action-secondary px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="btn-action-primary px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showEditModal = false"></div>
            <div class="action-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-2xl relative">
                <div class="flex justify-between items-center modal-border border-b pb-3 mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Edit Category</h2>
                    <button @click="showEditModal = false"
                        class="text-gray-400 hover:text-pink-500 text-2xl leading-none transition-colors">&times;</button>
                </div>
                <form :action="`/{{ $resource }}/${editData.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="edit_name" x-model="editData.name" required
                                class="w-full border border-gray-300 dark:border-[#2A3B55] dark:bg-[#162338] dark:text-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                        </div>
                        <div>
                            <label for="edit_remarks"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
                            <input type="text" name="remarks" id="edit_remarks" x-model="editData.remarks"
                                class="w-full border border-gray-300 dark:border-[#2A3B55] dark:bg-[#162338] dark:text-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 gap-2">
                        <button type="button" @click="showEditModal = false"
                            class="btn-action-secondary px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="btn-action-primary px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showDeleteModal = false"></div>
            <div class="action-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Confirm Deletion</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this category?</p>
                <div class="flex justify-end gap-2">
                    <button @click="showDeleteModal = false"
                        class="btn-action-secondary px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                        Cancel
                    </button>
                    <form :action="`/{{ $resource }}/${deleteId}`" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn-action-primary px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
