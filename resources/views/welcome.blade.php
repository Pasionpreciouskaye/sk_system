@extends('layouts.welcome')
@section('content')
@include('components.alert')
<div id="main-carousel" class="relative w-full bg-black" style="aspect-ratio:16/9;">
    @php
    $carouselSlides = [
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
    ];
    @endphp

    @foreach($carouselSlides as $i => $slide)
        <img src="{{ $slide }}"
            class="carousel-slide absolute inset-0 w-full h-full"
            style="object-fit:contain; display:{{ $i === 0 ? 'block' : 'none' }};"
            alt="Slide {{ $i + 1 }}">
    @endforeach
</div>

<script>
(function() {
    var slides = document.querySelectorAll('#main-carousel .carousel-slide');
    var current = 0;
    setInterval(function() {
        slides[current].style.display = 'none';
        current = (current + 1) % slides.length;
        slides[current].style.display = 'block';
    }, 5000);
})();
</script>

<section class="sk-section-base py-16" style="background-color:#F9FAFB;">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold" style="color:#E11D48;">Our Core Initiatives</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center">
            {{-- PPA --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden w-full hover:shadow-xl transition hover:-translate-y-1 duration-300 border border-gray-100 dark:border-[#2A3B55]">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/projects.webp') }}" alt="Projects"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-bold mb-2" style="color:#E11D48;">Program, Projects and Activities</h3>
                    <p class="text-sm text-gray-500 mb-4">Explore our community-driven projects and developments.</p>
                    <a href="{{ route('project') }}"
                        class="inline-block px-5 py-2 text-sm font-semibold text-white rounded-lg transition-all duration-200 hover:opacity-90 hover:shadow-md"
                        style="background:#E11D48;">
                        See more details
                    </a>
                </div>
            </div>

            {{-- Budget --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden w-full hover:shadow-xl transition hover:-translate-y-1 duration-300 border border-gray-100 dark:border-[#2A3B55]">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/budget.webp') }}" alt="Budget"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-bold mb-2" style="color:#F59E0B;">Budget Transparency</h3>
                    <p class="text-sm text-gray-500 mb-4">Access financial records and transparency reports.</p>
                    <a href="{{ route('budget') }}"
                        class="inline-block px-5 py-2 text-sm font-semibold text-white rounded-lg transition-all duration-200 hover:opacity-90 hover:shadow-md"
                        style="background:#F59E0B;">
                        See more details
                    </a>
                </div>
            </div>

            {{-- Inventory --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden w-full hover:shadow-xl transition hover:-translate-y-1 duration-300 border border-gray-100 dark:border-[#2A3B55]">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/inv.png') }}" alt="Inventory"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-bold mb-2" style="color:#22C55E;">Inventory</h3>
                    <p class="text-sm text-gray-500 mb-4">Track and manage SK equipment and resources.</p>
                    <a href="{{ route('inventory') }}"
                        class="inline-block px-5 py-2 text-sm font-semibold text-white rounded-lg transition-all duration-200 hover:opacity-90 hover:shadow-md"
                        style="background:#22C55E;">
                        See more details
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sk-section-alt py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-6" style="color:#E11D48;">More About Our Youth Activities</h2>
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
            " x-init="init()" class="relative w-full rounded-lg overflow-hidden shadow-lg" style="aspect-ratio:16/9;">

            <div class="flex h-full transition-transform duration-700 ease-in-out"
                :style="`transform: translateX(-${currentIndex * 100}%);`">

                <template x-for="slide in slides" :key="slide">
                    <div class="w-full h-full flex-shrink-0">
                        <img :src="slide" class="w-full h-full object-contain" alt="Slide Image">
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>
<section class="sk-section-alt py-16" style="background-color:#F3F4F6;">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-stretch">
            <div class="flex flex-col h-full">
                <h2 class="text-3xl font-bold text-center mb-4" style="color:#E11D48;">Vision</h2>
                <div class="sk-card-inner rounded-xl shadow-md p-6 text-center flex-grow flex items-center justify-center hover:shadow-lg transition hover:-translate-y-1">
                    <p>
                        To be an inclusive and proactive youth organization that inspires leadership, promotes
                        positive change, and empowers every young individual to participate in building a
                        progressive, transparent, and united community. We aim to foster a sense of responsibility,
                        encourage civic engagement, and develop future leaders who are committed to creating
                        sustainable solutions for the challenges faced by our community.
                    </p>
                </div>
            </div>
            <div class="flex flex-col h-full">
                <h2 class="text-3xl font-bold text-center mb-4" style="color:#E11D48;">Mission</h2>
                <div class="sk-card-inner rounded-xl shadow-md p-6 text-center flex-grow flex items-center justify-center hover:shadow-lg transition hover:-translate-y-1">
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
<section class="sk-section-base py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-12" style="color:#E11D48;">Our Core Commitments</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="sk-card-inner p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                <h3 class="text-xl font-semibold mb-2" style="color:#E11D48;">Empower the Youth</h3>
                <p class="text-sm" style="color:#6B7280;">
                    Equip young individuals with leadership skills, values, and opportunities to become proactive
                    contributors to their community.
                </p>
            </div>
            <div class="sk-card-inner p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                <h3 class="text-xl font-semibold mb-2" style="color:#F59E0B;">Promote Transparency and Accountability</h3>
                <p class="text-sm" style="color:#6B7280;">
                    Ensure that all projects and activities are carried out with integrity, transparency, and
                    openness to public scrutiny.
                </p>
            </div>
            <div class="sk-card-inner p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                <h3 class="text-xl font-semibold mb-2" style="color:#E11D48;">Foster Community Engagement</h3>
                <p class="text-sm" style="color:#6B7280;">
                    Create programs that encourage youth participation in cultural, educational, environmental, and
                    sports initiatives that benefit the whole barangay.
                </p>
            </div>
            <div class="sk-card-inner p-6 rounded-lg shadow hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                <h3 class="text-xl font-semibold mb-2" style="color:#22C55E;">Support Holistic Development</h3>
                <p class="text-sm" style="color:#6B7280;">
                    Address the physical, mental, emotional, and social needs of the youth through comprehensive and
                    inclusive programs.
                </p>
            </div>
        </div>
    </div>
</section>
@php
$members = [
    [
        'display_name' => 'June Lyn Tabanao',
        'title' => 'SK CHAIRWOMAN',
        'full_name' => 'JUNE LYN ALUMBRE TABANAO',
        'age' => 24,
        'birthday' => 'JUNE 12, 2000',
        'education' => 'COLLEGE GRADUATE COURSE:BACHELOR OF SCIENCE IN SOCIAL WORK CUM LAUDE'
    ],
    [
        'display_name' => 'SKK Mac',
        'title' => 'ADMIN',
        'full_name' => 'Mark Anthony Cañete Capulong',
        'age' => 24,
        'birthday' => 'August 08, 2025',
        'education' => 'Bachelor of Science in Civil Engineering - Major in Structural Engineering'
    ],
    [
        'display_name' => 'SKK Tonton',
        'title' => 'ADMIN',
        'full_name' => 'Antonio “Tonton” S.',
        'age' => 21,
        'birthday' => 'N/A',
        'education' => 'Bachelor of Science in Information Technology',
    ],
    [
        'display_name' => 'SKK Chester',
        'title' => 'Secretary',
        'full_name' => 'Arturo Irojo Vista',
        'age' => 21,
        'birthday' => 'October 3, 2003',
        'education' => '2nd Year Criminology Student',
    ],
    [
        'display_name' => 'SKK Jam',
        'title' => 'ADMIN',
        'full_name' => 'JAMILA JOSEFA ESTRELLADO GALLANO',
        'age' => 24,
        'birthday' => 'JULY 9, 2000',
        'education' => 'Bachelor of Science in Industrial Engineering',
    ],
    [
        'display_name' => 'SKK AJ',
        'title' => 'ADMIN',
        'full_name' => 'April Joy Altea Reyes',
        'age' => 24,
        'birthday' => 'April 18 2002',
        'education' => 'College Graduate - Bachelor of Science in Business Administration Major in Marketing Management',
    ],
    [
        'display_name' => 'SKK Noime',
        'title' => 'ADMIN',
        'full_name' => 'Noime Tolosa Llagas ',
        'age' => 24,
        'birthday' => 'June 16, 2000',
        'education' => 'College Graduate - Bachelor of Secondary Education Major In English',
    ],
    [
        'display_name' => 'SKK Summer',
        'title' => 'ADMIN',
        'full_name' => 'Summer L.',
        'age' => 20,
        'birthday' => 'N/A',
        'education' => 'Bachelor of Arts in Communication Arts',
    ],
    [
        'display_name' => 'SKK Iris',
        'title' => 'ADMIN',
        'full_name' => 'Iris Dela Cruz Palamos',
        'age' => 24,
        'birthday' => 'Sept. 27, 2000',
        'education' => 'Bachelor of Science in Public Administration',
    ],
    [
        'display_name' => 'SKK Karen',
        'title' => 'Treasurer',
        'full_name' => 'Karen Rose Decon Coñado',
        'age' => 25,
        'birthday' => 'April 27, 2000',
        'education' => 'College Graduate - Bachelor of Public Administration  (TCU)',
    ]
];
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />

<section class="sk-section-alt py-16" style="background-color:#F3F4F6;">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12" style="color:#E11D48;">Sangguniang Kabataan - Lower Bicutan 2022-2025</h2>

        <div id="sk-carousel" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($members as $index => $member)
                        <li class="splide__slide">
                            <div id="member-trigger-{{ $index }}"
                                class="bg-white rounded-lg shadow p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-transform cursor-pointer">
                                <img src="{{ asset("images/members/admin" . ($index + 1) . ".webp") }}"
                                    alt="{{ $member['display_name'] ?? 'Member Image' }}" class="w-full h-48 object-cover object-top rounded mb-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-1 uppercase">{{ $member['display_name'] ?? 'No Name' }}</h3>
                                <p class="text-sm text-pink-600 font-medium">{{ $member['title'] ?? '' }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
@foreach ($members as $index => $member)
<div id="member-modal-{{ $index }}" class="bg-black/50 fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-pink-200 rounded-lg shadow-lg max-w-2xl lg:h-[32rem] p-6 relative mx-7">
        <button data-close="member-modal-{{ $index }}"
            class="absolute top-3 right-3 text-pink-600 hover:bg-pink-100 rounded-full w-8 h-8 flex items-center justify-center font-bold text-xl leading-none">
            &times;
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="space-y-4">
                <img src="{{ asset("images/members/admin" . ($index + 1) . ".webp") }}"
                    alt="{{ $member['display_name'] ?? 'Member Image' }}"
                    class="rounded shadow max-w-full w-60 object-cover h-78" />
            </div>
            <div class="md:col-span-2">
                <p class="mb-1"><strong>Complete Full Name:</strong> {{ $member['full_name'] ?? $member['display_name'] ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Age:</strong> {{ $member['age'] ?? 'N/A' }} yrs old</p>
                <p class="mb-1"><strong>Birthday:</strong> {{ $member['birthday'] ?? 'N/A' }}</p>
                <p class="mb-4"><strong>Educational Attainment:</strong> {{ $member['education'] ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Splide('#sk-carousel', {
        perPage: 5,
        perMove: 1,
        gap: '1rem',
        pagination: false,
        breakpoints: {
            1024: { perPage: 3 },
            640: { perPage: 2 },
            480: { perPage: 1 },
        }
    }).mount();

    const totalMembers = {{ count($members) }};
    for (let i = 0; i < totalMembers; i++) {
        const trigger = document.getElementById(`member-trigger-${i}`);
        const modal = document.getElementById(`member-modal-${i}`);
        const closeBtn = modal.querySelector('[data-close]');

        if (trigger && modal && closeBtn) {
            trigger.addEventListener('click', () => modal.classList.remove('hidden'));
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        }
    }
});

function carousel(slideData) {
    return {
        slides: slideData,
        currentIndex: 0,
        timer: null,
        init() {
            this.timer = setInterval(() => {
                this.next();
            }, 5000);
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
