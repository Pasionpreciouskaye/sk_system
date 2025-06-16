<!-- Inventory Create Modal -->
<div
    x-show="showModal"
    @click.away="showModal = false"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30"
>
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Add Inventory</h2>

        <form method="POST" action="{{ route('inventory.store') }}">
            @csrf

            <!-- Category -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium mb-1">Category</label>
                <select name="category_id" id="category_id" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring focus:ring-pink-500" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Select Category --</option>
                    @foreach($inventoryCategories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 px-3 py-2 rounded focus:ring focus:ring-pink-500"
                    required
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium mb-1">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    value="{{ old('quantity') }}"
                    min="1"
                    class="w-full border border-gray-300 px-3 py-2 rounded focus:ring focus:ring-pink-500"
                    required
                >
                @error('quantity')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cost -->
            <div class="mb-6">
                <label for="cost" class="block text-gray-700 font-medium mb-1">Cost (₱)</label>
                <input
                    type="number"
                    step="0.01"
                    name="cost"
                    id="cost"
                    value="{{ old('cost') }}"
                    class="w-full border border-gray-300 px-3 py-2 rounded focus:ring focus:ring-pink-500"
                    required
                >
                @error('cost')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
                <button
                    type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                >
                    <i class="fas fa-save mr-1"></i> Save
                </button>
                <button
                    type="button"
                    @click="showModal = false"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
