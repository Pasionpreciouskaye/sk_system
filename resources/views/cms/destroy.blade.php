<div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-60" @click="showDeleteModal = false"></div>
    <div x-show="showDeleteModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="cms-modal bg-white dark:bg-[#1B2A41] rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">
        <div class="flex justify-between items-center mb-4 border-b border-gray-200 dark:border-[#2A3B55] pb-2">
            <h2 class="text-xl font-bold text-pink-600">Delete {{ $resource }}</h2>
            <button @click="showDeleteModal = false"
                class="text-gray-400 hover:text-pink-500 dark:hover:text-pink-400 text-2xl leading-none transition-colors">&times;</button>
        </div>
        <div class="mt-5 mb-3 text-gray-700 dark:text-gray-200 text-md">
            <p>Are you sure you want to delete this record?</p>
            <p class="mt-2"><span class="font-semibold">{{ $page_title }}:</span>
                @if ($record->first_name)
                    {{ trim(($record->first_name ?? '') . ' ' . ($record->middle_name ?? '') . ' ' . ($record->last_name ?? '')) }}
                @else
                    {{ $record->name }}
                @endif
            </p>
        </div>
        <div class="flex justify-end gap-2">
            <button type="button" @click="showDeleteModal = false"
                class="cms-btn-secondary px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">Cancel</button>
            <form action="{{ route($resource . '.destroy', $record->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit"
                    class="cms-btn-primary px-4 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] shadow-sm hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
