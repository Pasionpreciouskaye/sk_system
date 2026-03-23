<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="allocated" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Allocated Amount</label>
        <input type="number" step="0.01" name="allocated" id="allocated"
            value="{{ old('allocated', $record->allocated ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] dark:focus:shadow-[0_0_0_3px_rgba(233,30,99,0.25)] transition-all duration-200">
    </div>

    <div>
        <label for="date_allocated" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date
            Allocated</label>
        <input type="date" name="date_allocated" id="date_allocated"
            value="{{ old('date_allocated', $record->date_allocated ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div>
        <label for="spent" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount Spent</label>
        <input type="number" step="0.01" name="spent" id="spent"
            value="{{ old('spent', $record->spent ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div>
        <label for="date_spent" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date Spent</label>
        <input type="date" name="date_spent" id="date_spent"
            value="{{ old('date_spent', $record->date_spent ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div class="md:col-span-2">
        <label for="budget_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Budget
            Category</label>
        <select name="budget_id" id="budget_id" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
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

    <div class="md:col-span-2">
        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Budget File
            (PDF)</label>
        <input type="file" name="file" id="file" accept="application/pdf"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] transition-all duration-200">
    </div>
</div>
