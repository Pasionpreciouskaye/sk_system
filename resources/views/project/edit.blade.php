{{-- Edit Modal per project --}}
<div x-show="showEditModal && editProjectId === {{ $project->id }}" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showEditModal = false"></div>
    <div class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-4xl">
        <form action="{{ route($resource . '.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500">
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" id="content" rows="6" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Enter HTML content...">{{ old('content', $project->content) }}</textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <label for="file_name" class="block text-sm font-medium text-gray-700">Upload Image</label>
                    <div x-data="{ fileName: '{{ $project->file_name }}' }"
                        class="w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md p-4 bg-gray-50">

                        <div @click="$refs.fileInput.click()"
                            class="cursor-pointer text-center text-gray-500 hover:text-pink-600 transition">
                            <div class="mb-2">
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <span x-text="fileName || 'Click or drag image here'"></span>
                        </div>

                        <input type="file" name="file_name" accept="image/*" x-ref="fileInput" class="hidden"
                            @change="fileName = $event.target.files[0].name">
                    </div>
                    <p class="text-xs text-gray-500 text-center">Current file: {{ $project->file_name }}</p>
                </div>
            </div>
            <div class="flex justify-start mt-6">
                <button type="button" @click="showEditModal = false"
                    class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>