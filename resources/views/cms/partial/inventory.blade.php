<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $record->name ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Inventory
            Category</label>
        <select name="category_id" id="category_id" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
            <option value="" disabled
                {{ old('category_id', $record->category_id ?? '') == '' ? 'selected' : '' }}>
                Select a category</option>
            @foreach ($inventoryCategories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $record->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $record->quantity ?? '') }}"
            required min="0"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div>
        <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit Cost</label>
        <input type="number" name="cost" id="cost" step="0.01"
            value="{{ old('cost', $record->cost ?? '') }}" required min="0"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>
</div>
