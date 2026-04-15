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
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="display:inline;margin-right:4px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg> Delete
                </button>
                <button type="button" @click="showDeleteModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
