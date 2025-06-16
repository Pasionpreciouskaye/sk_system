<!-- Delete Inventory Modal -->
<div
    x-show="showDeleteModal"
    @click.away="showDeleteModal = false"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30"
>
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h2 class="text-lg font-semibold text-red-600 mb-4">
            <i class="fas fa-exclamation-triangle mr-2"></i> Confirm Delete
        </h2>

        <p class="text-gray-700 mb-6">Are you sure you want to delete the inventory record <strong>{{ $item->name }}</strong>?</p>

        <form method="POST" action="{{ route('inventory.destroy', $item->id) }}">
            @csrf
            @method('DELETE')

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    <i class="fas fa-trash mr-1"></i> Delete
                </button>
                <button type="button" @click="showDeleteModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
