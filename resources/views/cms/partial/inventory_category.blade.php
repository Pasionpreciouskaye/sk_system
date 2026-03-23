<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $record->name ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>

    <div>
        <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
        <input type="text" name="remarks" id="remarks" value="{{ old('remarks', $record->remarks ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
    </div>
</div>
