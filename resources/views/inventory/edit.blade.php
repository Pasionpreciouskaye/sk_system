<!-- Edit Inventory Modal -->
<div
    x-show="showEditModal"
    @click.away="showEditModal = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30"
    x-cloak
>
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 overflow-y-auto max-h-[90vh]">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Inventory</h2>

        <form method="POST" action="{{ route('inventory.update', $record->id) }}">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div class="mb-4">
                <label for="category_id_{{ $record->id }}" class="block text-gray-700 font-medium mb-1">Category</label>
                <select name="category_id" id="category_id_{{ $record->id }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-pink-500 focus:border-pink-500" required>
                    @foreach($inventoryCategories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == $record->category_id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name_{{ $record->id }}" class="block text-gray-700 font-medium mb-1">Item Name</label>
                <input type="text" name="name" id="name_{{ $record->id }}" value="{{ $record->name }}"
                       class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity_{{ $record->id }}" class="block text-gray-700 font-medium mb-1">Quantity</label>
                <input type="number" name="quantity" id="quantity_{{ $record->id }}" value="{{ $record->quantity }}"
                       class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <!-- Cost -->
            <div class="mb-6">
                <label for="cost_{{ $record->id }}" class="block text-gray-700 font-medium mb-1">Cost (₱)</label>
                <input type="number" step="0.01" name="cost" id="cost_{{ $record->id }}" value="{{ $record->cost }}"
                       class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
