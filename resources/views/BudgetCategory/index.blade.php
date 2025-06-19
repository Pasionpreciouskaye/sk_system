@extends('layouts.dashboard')

@section('content')
<div x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        editData: {},
        deleteId: null
    }"
    class="p-6 bg-white shadow rounded">

    <h1 class="text-2xl font-bold text-pink-600 mb-4">Budget Category Records</h1>

    <!-- Search Left, New Category Right -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-3">
        <form method="GET" class="w-full md:w-1/3 order-2 md:order-1">
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-pink-500"
                placeholder="Search by category name">
        </form>

        <button @click="showCreateModal = true"
            class="order-1 md:order-2 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition">
            + New Category
        </button>
    </div>

    <!-- Table -->
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
                        <button @click="showEditModal = true; editData = {{ json_encode(['id' => $item->id, 'name' => $item->name, 'remarks' => $item->remarks]) }}"
                            class="inline-block px-2 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200">
                            <i class="fas fa-pen-to-square"></i>
                        </button>
                        <button @click="showDeleteModal = true; deleteId = {{ $item->id }}"
                            class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                        No budget categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $data->links('vendor.pagination.custom-tailwind') }}
    </div>

    <!-- CREATE MODAL -->
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showCreateModal = false"></div>
        <div class="bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-2xl relative">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-xl font-bold text-pink-600">Add Budget Category</h2>
                <button @click="showCreateModal = false" class="text-gray-400 hover:text-pink-600 text-2xl leading-none">&times;</button>
            </div>
            <form action="{{ route($resource . '.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Remarks</label>
                        <input type="text" name="remarks"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" @click="showCreateModal = false"
                        class="mr-2 px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-pink-50">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showEditModal = false"></div>
        <div class="bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-2xl relative">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-xl font-bold text-pink-600">Edit Category</h2>
                <button @click="showEditModal = false" class="text-gray-400 hover:text-pink-600 text-2xl leading-none">&times;</button>
            </div>
            <form :action="`/{{ $resource }}/${editData.id}`" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="edit_name" x-model="editData.name" required
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="edit_remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                        <input type="text" name="remarks" id="edit_remarks" x-model="editData.remarks"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" @click="showEditModal = false"
                        class="mr-2 px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-pink-50">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showDeleteModal = false"></div>
        <div class="bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-md">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this category?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showDeleteModal = false"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">Cancel</button>
                <form :action="`/{{ $resource }}/${deleteId}`" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
