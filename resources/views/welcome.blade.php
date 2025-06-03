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
    ]) }})" x-init="init()" class="relative w-full lg:h-150 sm:h-full overflow-hidden bg-gray-100">

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
$members = [
    [
        'name' => 'June Lyn Tabanao',
        'age' => 22,
        'education' => 'Bachelor of Science in Public Administration',
        'roles' => ['Barangay Youth Coordinator', 'Women’s Month Event Organizer'],
        'bio' => 'June Lyn Tabanao is a passionate youth leader known for her unwavering dedication to inclusive governance and community service. As a Barangay Youth Coordinator, she has spearheaded initiatives that uplift marginalized groups, especially women and young girls. Her academic background in public administration enables her to craft and support youth policies that promote active civic participation. She was instrumental in organizing successful Women’s Month campaigns that brought awareness and empowerment to the local community. Her commitment to grassroots advocacy marks her as a transformative leader for the youth of her barangay.'
    ],
    [
        'name' => 'Mark Anthony C.',
        'age' => 24,
        'education' => 'Bachelor of Science in Civil Engineering, Major in Structural Engineering',
        'roles' => ['BANAIYEC Co-Founder', 'College Student Director', 'PICE-TCUSC President'],
        'bio' => 'Mark Anthony, widely known as SKK MAC, blends technical excellence with visionary youth leadership. As a co-founder of BANAIYEC and former student leader, he has elevated youth voices in engineering and governance circles. His involvement in infrastructure-oriented projects has fostered safer, more resilient community spaces. Mark has also mentored aspiring student engineers, creating a pipeline of young leaders passionate about civic duty and nation-building. His dynamic leadership inspires innovation and civic responsibility among the youth of Taguig.'
    ],
    [
        'name' => 'Antonio “Tonton” S.',
        'age' => 21,
        'education' => 'Bachelor of Science in Information Technology',
        'roles' => ['SK Secretary', 'Youth Tech Camp Trainer'],
        'bio' => 'Tonton is a tech-savvy youth leader focused on digital empowerment and innovation. As the SK Secretary, he ensures organized documentation and tech-integrated processes in youth governance. Tonton\'s role as a Youth Tech Camp Trainer has introduced digital skills to dozens of young residents, helping bridge the digital divide. With a deep belief in the power of technology, he continuously advocates for modern solutions to youth challenges, ensuring future-forward progress for his barangay.'
    ],
    [
        'name' => 'Chester R.',
        'age' => 23,
        'education' => 'Bachelor of Science in Criminology',
        'roles' => ['Security Coordinator', 'Community Safety Liaison'],
        'bio' => 'Chester R. brings a solid foundation in public safety and crime prevention to his role as an SK leader. As a Community Safety Liaison, Chester has launched barangay-wide safety seminars, emergency preparedness drills, and security assessments for youth events. His criminology training has been pivotal in implementing discipline-centered programs and fostering a culture of responsibility among youth. Chester stands as a key figure in creating secure, youth-friendly spaces throughout Lower Bicutan.'
    ],
    [
        'name' => 'Jamila “Jam” K.',
        'age' => 20,
        'education' => 'Bachelor of Science in Psychology',
        'roles' => ['Mental Health Advocate', 'SK Wellness Leader'],
        'bio' => 'Jamila “Jam” is a strong mental health advocate dedicated to building emotionally resilient communities. Through her leadership as SK Wellness Leader, she has introduced counseling access, youth peer support groups, and awareness drives on mental health. Her psychology background fuels her commitment to nurturing the emotional well-being of her peers. Jam is deeply admired for her empathy-driven leadership and has transformed the youth support system within her barangay.'
    ],
    [
        'name' => 'Iris M.',
        'age' => 22,
        'education' => 'Bachelor of Science in Education',
        'roles' => ['Youth Literacy Advocate', 'Barangay Tutoring Organizer'],
        'bio' => 'Iris is a passionate educator and literacy advocate who believes in the transformative power of learning. She has organized after-school tutoring programs and weekend reading clinics for underprivileged youth in her community. Iris works closely with parents, volunteers, and schools to address education gaps. Her work has not only improved academic performance but also strengthened the community’s commitment to continuous learning.'
    ],
    [
        'name' => 'Noime C.',
        'age' => 21,
        'education' => 'Bachelor of Science in Nursing',
        'roles' => ['Health Awareness Facilitator', 'First Aid Trainer'],
        'bio' => 'Noime brings her healthcare expertise to the frontline of youth advocacy. She has led health missions, nutrition drives, and first aid training programs aimed at educating and protecting her peers. As a nursing student, she understands the importance of preventive care and has introduced regular wellness monitoring and hygiene initiatives. Noime is a nurturing force in her barangay, committed to creating a healthier, more informed youth population.'
    ],
    [
        'name' => 'Summer L.',
        'age' => 20,
        'education' => 'Bachelor of Arts in Communication Arts',
        'roles' => ['Youth Spokesperson', 'SK Newsletter Editor'],
        'bio' => 'Summer is a dynamic communicator whose creative energy fuels youth engagement in Barangay Lower Bicutan. As both a spokesperson and editor, she has crafted newsletters and digital campaigns that highlight community achievements and amplify young voices. Her expertise in media and storytelling plays a crucial role in connecting the SK council with its constituents. Summer is a vocal advocate for transparent governance and creative expression among the youth.'
    ],
    [
        'name' => 'Andrew “AJ” D.',
        'age' => 22,
        'education' => 'Bachelor of Science in Business Administration',
        'roles' => ['Youth Entrepreneurship Coach', 'SK Budget Committee Member'],
        'bio' => 'AJ is an entrepreneurial-minded youth leader focused on economic empowerment and financial literacy. As a budget committee member, he has helped streamline youth fund allocation and ensure transparency in projects. His coaching sessions on entrepreneurship have empowered local youth to pursue sustainable livelihood ventures. AJ is a trailblazer for youth economic inclusion, helping shape a financially smart and proactive generation in Barangay Lower Bicutan.'
    ],
    [
        'name' => 'Karen S.',
        'age' => 23,
        'education' => 'Bachelor of Science in Environmental Science',
        'roles' => ['Eco-Youth Leader', 'Clean-Up Drive Organizer'],
        'bio' => 'Karen is an environmental steward whose leadership has revitalized eco-awareness in her barangay. As an Eco-Youth Leader, she has led multiple clean-up drives, tree planting events, and sustainability workshops. Her advocacy extends to plastic reduction campaigns and environmental education for school children. Karen’s vision of a green future fuels her proactive role in shaping environmentally conscious youth behavior.'
    ]
];
@endphp


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />

<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-pink-600 text-center mb-12">Our Featured SK</h2>

        <div id="sk-carousel" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($members as $index => $member)
                        <li class="splide__slide">
                            <div id="member-trigger-{{ $index }}"
                                class="bg-white rounded-lg shadow p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-transform cursor-pointer">
                                <img src="{{ asset("images/members/admin" . ($index + 1) . ".webp") }}"
                                    alt="{{ $member['name'] }}" class="w-full h-48 object-cover object-top rounded mb-4">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $member['name'] }}</h3>
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
<div id="member-modal-{{ $index }}" class="fixed inset-0 bg-gray bg-opacity-50 flex items-center justify-center z-80 hidden">
    <div class="bg-pink-200 rounded-lg shadow-lg max-200 w-250 lg:h-130 p-6 relative mx-7">
        <button data-close="member-modal-{{ $index }}"
            class="absolute top-3 right-3 text-pink-600 hover:bg-pink-100 rounded-full w-8 h-8 flex items-center justify-center font-bold text-xl leading-none">
            &times;
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="space-y-4">
                <img src="{{ asset("images/members/admin" . ($index + 1) . ".webp") }}"
                    alt="{{ $member['name'] }}" class="rounded shadow max-3x1 w-60 object-cover h-78" />
            </div>
            <div class="md:col-span-2">
                <h3 class="text-2xl font-bold mb-4 text-pink-600">{{ $member['name'] }}</h3>
                <p class="mb-2"><strong>Age:</strong> {{ $member['age'] }} years old</p>
                <p class="mb-4"><strong>Educational Attainment:</strong> {{ $member['education'] }}</p>

                <h4 class="text-xl font-semibold mb-2">Leadership Track</h4>
                <ul class="list-disc list-inside space-y-1 text-gray-700">
                    @foreach ($member['roles'] as $role)
                        <li>{{ $role }}</li>
                    @endforeach
                </ul>

                <h4 class="text-xl font-semibold mt-6 mb-2">Additional Information</h4>
                <p class="text-gray-700">{{ $member['bio'] }}</p>
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
