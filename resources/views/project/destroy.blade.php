{{-- Delete Modal per project --}}
<div x-show="showDeleteModal && deleteProjectId === {{ $project->id }}" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showDeleteModal = false"></div>
    <div class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">
        <form action="{{ route($resource . '.destroy', $project->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <h2 class="text-xl font-bold text-pink-600">Delete {{ $project->title }}?</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to delete this project?</p>
            <div class="flex justify-end mt-6">
                <button type="button" @click="showDeleteModal = false"
                    class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 transition">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>