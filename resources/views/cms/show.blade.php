<div x-show="showShowModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div x-show="showShowModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90" class="z-10 p-6 w-full max-w-xl">
        <div x-show="showShowModal" x-cloak x-transition
            class="relative bg-white rounded-2xl shadow-2xl overflow-hidden w-full max-w-lg">
            <div class="flex items-center justify-between bg-pink-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Feedback Details</h2>
                <button @click="showShowModal = false"
                    class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <dt class="text-sm font-semibold text-gray-500">Subject</dt>
                    <dd class="mt-1 text-lg font-medium text-gray-800">
                        {{ $record->subject }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-gray-500">Message</dt>
                    <dd class="mt-2 text-gray-700 prose prose-sm max-w-none max-h-64 overflow-y-auto break-words">
                        {{ $record->message }}
                    </dd>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 text-right">
                <button @click="showShowModal = false"
                    class="inline-flex items-center px-5 py-2 bg-pink-600 text-white font-semibold rounded-lg shadow hover:bg-pink-700 transition">
                    <i class="fa-solid fa-check mr-2"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
