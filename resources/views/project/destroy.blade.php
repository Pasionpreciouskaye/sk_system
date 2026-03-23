{{-- Delete Modal per project --}}
<div x-show="showDeleteModal && deleteProjectId === {{ $project->id }}" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-60" @click="showDeleteModal = false"></div>
    <div class="action-modal bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">
        <form action="{{ route($resource . '.destroy', $project->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <h2 class="text-xl font-bold text-pink-600">Delete {{ $project->title }}?</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to delete this project?</p>
            <div class="flex justify-end mt-6 gap-2">
                <button type="button" @click="showDeleteModal = false"
                    class="btn-action-secondary px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition-all duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="btn-action-primary px-4 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>
