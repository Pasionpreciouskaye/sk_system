<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="allocated" class="block text-sm font-medium text-gray-700">Allocated Amount</label>
        <input type="number" step="0.01" name="allocated" id="allocated"
            value="{{ old('allocated', $record->allocated ?? '') }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>

    <div>
        <label for="date_allocated" class="block text-sm font-medium text-gray-700">Date Allocated</label>
        <input type="date" name="date_allocated" id="date_allocated"
            value="{{ old('date_allocated', $record->date_allocated ?? '') }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>

    <div>
        <label for="spent" class="block text-sm font-medium text-gray-700">Amount Spent</label>
        <input type="number" step="0.01" name="spent" id="spent"
            value="{{ old('spent', $record->spent ?? '') }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>

    <div>
        <label for="date_spent" class="block text-sm font-medium text-gray-700">Date Spent</label>
        <input type="date" name="date_spent" id="date_spent"
            value="{{ old('date_spent', $record->date_spent ?? '') }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>

    <div class="md:col-span-2">
        <label for="budget_id" class="block text-sm font-medium text-gray-700">Budget Category</label>
        <select name="budget_id" id="budget_id" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
            <option value="" disabled {{ old('budget_id', $record->budget_id ?? '') === '' ? 'selected' : '' }}>
                Select a category
            </option>
            @foreach ($budgetCategories as $category)
                <option value="{{ $category->id }}"
                    {{ old('budget_id', $record->budget_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
