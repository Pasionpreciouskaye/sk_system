<!-- cms/create.blade.php -->
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-60" @click="showModal = false"></div>
    <div x-show="showModal" x-cloak x-transition
        class="cms-modal bg-white dark:bg-[#1B2A41] rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">

        <div class="flex justify-between items-center mb-4 border-b border-gray-200 dark:border-[#2A3B55] pb-2">
            <h2 class="text-xl font-bold text-pink-600">Add new {{ $page_title }}</h2>
            <button @click="showModal = false"
                class="text-gray-400 hover:text-pink-500 dark:hover:text-pink-400 text-2xl transition-colors">&times;</button>
        </div>

        <form action="{{ route($resource . '.store') }}" method="POST"
            @if ($resource === 'budget') enctype="multipart/form-data" @endif>
            @csrf

            @if ($resource === 'budget_category' || $resource === 'inventory_category')
                @include('cms.partial.budget_category')
            @else
                @include('cms.partial.' . $resource)
            @endif

            <div class="flex justify-end mt-6 gap-2">
                <button type="button" @click="showModal = false"
                    class="cms-btn-secondary px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                    Cancel
                </button>
                <button type="submit"
                    class="cms-btn-primary px-4 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] shadow-sm hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
