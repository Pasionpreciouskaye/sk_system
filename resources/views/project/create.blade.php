<!-- Modal for Create -->
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-60" @click="showModal = false"></div>

    <div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="action-modal bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-4xl">

        <div class="flex justify-between items-center mb-4 modal-border border-b pb-2">
            <h2 class="text-xl font-bold text-pink-600">Add New {{ $page_title }}</h2>
            <button @click="showModal = false"
                class="text-gray-400 hover:text-pink-500 text-2xl leading-none transition-colors">&times;</button>
        </div>

        <form action="{{ route($resource . '.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" name="title" id="title" required value="{{ old('title') }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500">
                    </div>
                    <div>
                        <label for="announcement" class="block text-sm font-medium text-gray-700">Announcement (Use
                            Format)</label>
                        <textarea name="announcement" id="announcement" rows="6" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500"
                            placeholder="WHAT:
                            WHERE:
                            WHEN:
                            WHO:
                            WHY:
                            HOW:">{{ old('announcement') }}
                        </textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <label for="file_name" class="block text-sm font-medium text-gray-700">Optional File (Image or
                        PDF)</label>
                    <div x-data="{ fileName: '' }"
                        class="upload-zone w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md p-4 bg-gray-50">
                        <label for="file_name"
                            class="cursor-pointer text-center text-gray-500 hover:text-pink-600 transition">
                            <div class="mb-2"><i class="fas fa-upload fa-2x"></i></div>
                            <span x-text="fileName || 'Click or drag image or PDF here'"></span>
                        </label>
                        <input type="file" name="file_name" id="file_name" accept="image/*,.pdf" class="hidden"
                            @change="fileName = $event.target.files[0].name">
                    </div>
                </div>
            </div>
            <div class="flex justify-start mt-10 gap-2">
                <button type="button" @click="showModal = false"
                    class="btn-action-secondary px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition-all duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="btn-action-primary px-4 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
