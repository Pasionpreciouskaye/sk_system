<div x-show="showDeleteModal && deleteEventId === {{ $event->id }}"
    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <div class="action-modal bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
        <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this event?</p>
        <form method="POST" action="{{ route('event.destroy', $event->id) }}">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2">
                <button type="button" @click="showDeleteModal = false"
                    class="btn-action-secondary px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="btn-action-primary px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>
