<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showModal = false"></div>
    <div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-pink-600">Add new {{ $page_title }}</h2>
            <button @click="showModal = false"
                class="text-gray-400 hover:text-pink-600 text-2xl leading-none">&times;</button>
        </div>
        <form action="{{ route($resource . '.store') }}" method="POST">
            @csrf
            @if ($resource === 'budget_category' || $resource === 'inventory_category')
            @include('cms.partial.budget_category')
            @else
            @include('cms.partial.' . $resource)
            @endif
            <div class="flex justify-end mt-6">
                <button type="button" @click="showModal = false"
                    class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 transition">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
