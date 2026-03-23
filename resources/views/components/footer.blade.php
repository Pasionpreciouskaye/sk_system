<footer class="sk-footer pt-12 pb-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="w-24" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Sangguniang Kabataan</h3>
            <p class="text-sm" style="color:#9CA3AF">Empowering the youth to lead, serve, and build a more inclusive and
                progressive barangay.</p>
        </div>
        <div>
            <h4 class="text-lg font-semibold text-white mb-3">Quick Links</h4>
            <ul class="space-y-2 text-sm" style="color:#D1D5DB">
                <li><a href="{{ route('home') }}" class="hover:text-pink-400 transition">Home</a></li>
                <li><a href="{{ route('project') }}" class="hover:text-pink-400 transition">Projects</a></li>
                <li><a href="{{ route('event') }}" class="hover:text-pink-400 transition">Events</a></li>
                <li><a href="{{ route('budget') }}" class="hover:text-pink-400 transition">Budget</a></li>
                <li><a href="{{ route('inventory') }}" class="hover:text-pink-400 transition">Inventory</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-pink-400 transition">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-lg font-semibold text-white mb-3">Follow Us</h4>
            <div class="flex space-x-4" style="color:#9CA3AF">
                <a href="https://www.facebook.com/share/1CCZCxp7Mu/?mibextid=wwXIfr"
                    class="hover:text-pink-400 transition" target="_blank" rel="noopener noreferrer"><i
                        class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="hover:text-pink-400 transition"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="hover:text-pink-400 transition"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="hover:text-pink-400 transition"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
        </div>
    </div>
    <div class="sk-footer-divider mt-10 pt-6 text-center text-sm border-t" style="color:#6B7280">
        &copy; {{ date('Y') }} Sangguniang Kabataan. All rights reserved.
    </div>
</footer>
