@extends('layouts.welcome')
@section('content')

@include('components.alert')
<section>
    <div class="w-full h-full flex-shrink-0">
        <img src="{{ asset('images/banner2.jpg') }}" class="w-full h-full object-cover object-center" alt="Slide Image">
    </div>
</section>
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-pink-600">
                Got a question? We'd love to hear from you. Send us a message and we’ll respond as soon as possible.
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <a href="tel:+639190793112"
                class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="text-pink-600 mb-3">
                    <i class="fas fa-phone fa-2x"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Call Us</h3>
                <p class="text-gray-600 text-sm">0919 079 3112</p>
            </a>
            <a href="mailto:sk.taguig@gmail.com"
                class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="text-pink-600 mb-3">
                    <i class="fas fa-envelope fa-2x"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Email Us</h3>
                <p class="text-gray-600 text-sm">sk.taguig@gmail.com</p>
            </a>
            <a href="https://www.google.com/maps?q=Lower+Bicutan+Taguig" target="_blank"
                class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="text-pink-600 mb-3">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Visit Us</h3>
                <p class="text-gray-600 text-sm">Lower Bicutan, Taguig City</p>
            </a>
        </div>

        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Send Us Your Feedback</h3>
            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="subject" class="block text-gray-700 font-medium mb-1">
                        Subject<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="subject" name="subject" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" />
                </div>

                <div x-data="{ message: '' }">
                    <label for="message" class="block text-gray-700 font-medium mb-1">
                        Message<span class="text-red-500">*</span>
                    </label>
                    <textarea id="message" name="message" x-model="message" maxlength="1000"
                        @input="if (message.length > 1000) message = message.slice(0, 1000)" rows="5" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    <p class="mt-1 text-right text-sm text-gray-500">
                        <span x-text="message.length"></span>/1000 characters
                    </p>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-pink-600 text-white font-semibold px-6 py-3 rounded-md shadow hover:bg-pink-700 transition">
                        Submit Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-pink-600 text-center mb-8">Visit us in Lower Bicutan, Taguig</h2>
        <div class="w-full h-[500px] rounded-lg overflow-hidden shadow-lg">
            <iframe class="w-full h-full border-0"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7725.331995619784!2d121.05900409426638!3d14.503853430830043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cf45a8993d73%3A0x1cc0eab73f1c507e!2sNew%20Lower%20Bicutan%2C%20Taguig%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1746634838998!5m2!1sen!2sph"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
<section class="py-16 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-pink-600 mb-8">Emergency Hotlines</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-center">
            <a href="tel:+63287893200"
                class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">TAGUIG COMMAND CENTER</h3>
                <p class="text-gray-600 text-sm">(02) 8789 3200</p>
            </a>
            <a href="tel:+639160793112"
                class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">TAGUIG RESCUE</h3>
                <p class="text-gray-600 text-sm">0916 079 3112</p>
            </a>
            <a href="tel:+639688507912"
                class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">TAGUIG PNP</h3>
                <p class="text-gray-600 text-sm">0968 850 7912</p>
            </a>
            <a href="tel:+639190793112"
                class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">DOCTOR-ON-CALL</h3>
                <p class="text-gray-600 text-sm">0919 079 3112</p>
            </a>
            <a href="tel:+639168517712"
                class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">R.E.A.C.T.</h3>
                <p class="text-gray-600 text-sm">0916 851 7712</p>
            </a>
        </div>
    </div>
</section>
@endsection
