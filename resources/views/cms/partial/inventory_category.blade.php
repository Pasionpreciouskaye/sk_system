<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $record->name ?? '') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>

    <div>
        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
        <input type="text" name="remarks" id="remarks" value="{{ old('remarks', $record->remarks ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
</div>
