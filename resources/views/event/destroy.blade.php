<div x-show="showDeleteModal && deleteEventId === {{ $event->id }}" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
        <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this event?</p>
        <form method="POST" action="{{ route('event.destroy', $event->id) }}">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Yes, Delete
                </button>
                <button type="button" @click="showDeleteModal = false"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-100">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
