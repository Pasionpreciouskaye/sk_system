@extends('layouts.welcome')
@section('content')
@include('components.alert')
<div x-data="carousel({{ json_encode([
        asset('images/carousel/banner.webp'),
        asset('images/carousel/pic3 (4).webp'),
        asset('images/carousel/pic3 (5).webp'),
        asset('images/carousel/pic6 (6).webp'),
        asset('images/carousel/pic7 (13).webp'),
        asset('images/carousel/pic8 (3).webp'),
        asset('images/carousel/pic8 (11).webp'),
        asset('images/carousel/project1.webp'),
        asset('images/carousel/project5.webp'),
        asset('images/carousel/recentproj7.webp'),
        asset('images/carousel/recentproj11.webp'),
    ]) }})" x-init="init()" class="relative w-full lg:h-180 sm:h-full overflow-hidden bg-gray-100">

    <div class="flex transition-transform duration-700 ease-in-out"
        :style="`transform: translateX(-${currentIndex * 100}%);`" style="width: 1100%;">

        <template x-for="slide in slides" :key="slide">
            <div class="w-full h-full flex-shrink-0">
                <img :src="slide" class="w-full object-cover object-center" alt="Slide Image">
            </div>
        </template>
    </div>
</div>

<section class="py-16 bg-gray-100">
    <div class="max-w-full mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-pink-600 ">Our Core Initiatives</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-1 justify-items-center">
            <div
                class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm text-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="p-6">
                    <img src="{{ asset('images/projects.webp') }}" alt="Projects Icon"
                        class="mx-auto h-50 rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">Projects</h3>
                    <p class="text-gray-600 mb-4">Explore our community-driven projects and developments.</p>
                    <a href="{{ route('project') }}"
                        class="inline-block px-4 py-2 text-sm text-white bg-blue-700 rounded hover:bg-blue-800 transition">
                        See more details
                    </a>
                </div>
            </div>

            <div
                class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm text-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="p-6">
                    <img src="{{ asset('images/events.webp') }}" alt="Events Icon" class="mx-auto h-50 rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-pink-600 mb-2">Events</h3>
                    <p class="text-gray-600 mb-4">Join and view upcoming SK events and activities.</p>
                    <a href="{{ route('event') }}"
                        class="inline-block px-4 py-2 text-sm text-white bg-pink-600 rounded hover:bg-pink-700 transition">
                        See more details
                    </a>
                </div>
            </div>

            <div
                class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm text-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="p-6">
                    <img src="{{ asset('images/budget.webp') }}" alt="Budget Icon" class="mx-auto h-50 rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Budget Transparency</h3>
                    <p class="text-gray-600 mb-4">Access financial records and transparency reports.</p>
                    <a href="{{ route('budget') }}"
                        class="inline-block px-4 py-2 text-sm text-white bg-green-700 rounded hover:bg-green-800 transition">
                        See more details
                    </a>
                </div>
            </div>

            <div
                class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm text-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <div class="p-6">
                    <img src="{{ asset('images/budget.webp') }}" alt="Budget Icon" class="mx-auto h-50 rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Inventory</h3>
                    <p class="text-gray-600 mb-4">Access financial records and transparency reports.</p>
                    <a href="{{ route('inventory') }}"
                        class="inline-block px-4 py-2 text-sm text-white bg-green-700 rounded hover:bg-green-800 transition">
                        See more details
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-pink-600 mb-6">More About Our Youth Activities</h2>
            <p class="text-gray-700 mb-4">
                Task Force Youth Council of Barangay Lower Bicutan, Taguig was created/formed by Kagawad Camille Joy
                Adriano to empower the potentials of the youth and also to give different projects to the youths of
                barangay. It was March 2014, TFYC was created. Various projects and seminars conducted by the team,
                including
                the annual Summer League for Basketball and Volleyball.
            </p>
            <p class="text-gray-700 mb-4">
                2017, the TFYC was handled by Kagawad Ricardo "Goma" Cruz IV which is also the head of the Youth
                Development of the Barangay.
            </p>
            <p class="text-gray-700">
                2018, the Sangguniang Kabataan Lower Bicutan is under the supervision of SK Chairman Denn Michael
                “Dingdong” Bahan together with 7 SK Councilors, 1 SK Secretary, and 1 SK Treasurer. In the current
                year 2023, the Sangguniang Kabataan Lower Bicutan is now under the supervision of SK
                Chairwoman June Lyn A. Tabanao together with the team LYNkod Kabataan consisting of 7 SK Councilors,
                1 SK Secretary, and 1 SK Treasurer for the year 2023–2025.
            </p>
        </div>
        <div x-data="
            carousel({{ json_encode([
                asset('images/carousel/grouppic1.webp'),
                asset('images/carousel/grouppic2.webp'),
                asset('images/carousel/grouppic3.webp'),
                asset('images/carousel/grouppic4.webp'),
            ]) }})
            " x-init="init()" class="relative w-full h-[500px] rounded-lg overflow-hidden shadow-lg">

            <div class="flex transition-transform duration-700 ease-in-out"
                :style="`transform: translateX(-${currentIndex * 100}%);`">

                <template x-for="slide in slides" :key="slide">
                    <div class="w-full h-full flex-shrink-0">
                        <img :src="slide" class="w-full object-cover object-center" alt="Slide Image">
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-stretch">
            <div
                class="flex flex-col h-full">
                <h2 class="text-3xl font-bold text-pink-600 text-center mb-4">Vision</h2>
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-gray-700 text-center flex-grow flex items-center justify-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                    <p>
                        To be an inclusive and proactive youth organization that inspires leadership, promotes
                        positive change, and empowers every young individual to participate in building a
                        progressive, transparent, and united community. We aim to foster a sense of responsibility,
                        encourage civic engagement, and develop future leaders who are committed to creating
                        sustainable solutions for the challenges faced by our community.
                    </p>
                </div>
            </div>

            <div
                class="flex flex-col h-full">
                <h2 class="text-3xl font-bold text-pink-600 text-center mb-4">Mission</h2>
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-gray-700 text-center flex-grow flex items-center justify-center hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                    <p>
                        To provide meaningful opportunities for the youth to engage in nation-building by initiating
                        programs that enhance skills, leadership, and social responsibility. We are committed to
                        fostering transparency, accountability, and active participation to create sustainable and
                        impactful community initiatives. Our mission is to create a platform for young individuals
                        to collaborate, learn, and take proactive roles in shaping a better future, promoting social
                        justice, and driving positive change within their communities.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-pink-600 mb-12">Our Core Commitments</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div
                class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Empower the Youth</h3>
                <p class="text-gray-600 text-sm">
                    Equip young individuals with leadership skills, values, and opportunities to become proactive
                    contributors to their community.
                </p>
            </div>

            <div
                class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <h3 class="text-xl font-semibold text-green-700 mb-2">Promote Transparency and Accountability</h3>
                <p class="text-gray-600 text-sm">
                    Ensure that all projects and activities are carried out with integrity, transparency, and
                    openness to public scrutiny.
                </p>
            </div>

            <div
                class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <h3 class="text-xl font-semibold text-pink-600 mb-2">Foster Community Engagement</h3>
                <p class="text-gray-600 text-sm">
                    Create programs that encourage youth participation in cultural, educational, environmental, and
                    sports initiatives that benefit the whole barangay.
                </p>
            </div>

            <div
                class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 transition-transform block">
                <h3 class="text-xl font-semibold text-purple-700 mb-2">Support Holistic Development</h3>
                <p class="text-gray-600 text-sm">
                    Address the physical, mental, emotional, and social needs of the youth through comprehensive and
                    inclusive programs.
                </p>
            </div>
        </div>
    </div>
</section>
@php
$memberNames = [
'June Lyn Tabanao', 'SKK MAC', 'SKS Tonton', 'SKK Chester', 'SKK Jam',
'SKK AJ', 'SKK Noime', 'SKK Summer', 'SKK Iris', 'SKK Karen'
];
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />

<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-pink-600 text-center mb-12">Our Featured SK</h2>

        <div id="sk-carousel" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @for ($i = 1; $i <= count($memberNames); $i++) <li class="splide__slide">
                        <div
                            class="bg-white rounded-lg shadow p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-transform">
                            <img src="{{ asset("images/members/admin$i.webp") }}" alt="{{ $memberNames[$i - 1] }}"
                                class="w-full h-48 object-cover object-top rounded mb-4">
                            <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $memberNames[$i - 1] }}</h3>
                        </div>
                        </li>
                        @endfor
                </ul>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Splide('#sk-carousel', {
        perPage: 5,
        perMove: 1,
        gap: '1rem',
        pagination: false,
        breakpoints: {
            1024: {
                perPage: 3
            },
            640: {
                perPage: 2
            },
            480: {
                perPage: 1
            },
        }
    }).mount();
});

function carousel(slideData) {
    return {
        slides: slideData,
        currentIndex: 0,
        timer: null,
        init() {
            this.timer = setInterval(() => {
                this.next();
            }, 3000);
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        },
        goTo(index) {
            this.currentIndex = index;
        }
    }
}
</script>
@endsection