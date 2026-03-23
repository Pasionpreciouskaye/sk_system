<script>
    (function() {
        const searchInput = document.getElementById('search');
        const micBtn = document.getElementById('mic-btn');
        const micIcon = document.getElementById('mic-icon');

        if (!searchInput || !micBtn) return;

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

        if (!SpeechRecognition) {
            micBtn.title = 'Speech recognition not supported. Use Chrome or Edge.';
            micBtn.disabled = true;
            micIcon.classList.add('opacity-30');
            return;
        }

        const recognition = new SpeechRecognition();
        recognition.lang = 'en-US';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;
        recognition.continuous = false;

        let listening = false;

        micBtn.addEventListener('click', function() {
            if (listening) {
                recognition.stop();
                return;
            }
            try {
                recognition.start();
            } catch (e) {
                console.warn('Speech recognition error:', e);
            }
        });

        recognition.addEventListener('start', function() {
            listening = true;
            micIcon.className = 'fas fa-circle-stop text-red-500 text-lg';
            micBtn.classList.add('animate-pulse');
            micBtn.title = 'Listening... click to stop';
        });

        recognition.addEventListener('result', function(e) {
            const transcript = e.results[0][0].transcript;
            searchInput.value = transcript;
            // trigger search
            const url = new URL(window.location.href);
            url.searchParams.set('search', transcript);
            window.location.href = url.toString();
        });

        recognition.addEventListener('end', function() {
            listening = false;
            micIcon.className = 'fas fa-microphone text-pink-500 text-lg';
            micBtn.classList.remove('animate-pulse');
            micBtn.title = 'Search by voice';
        });

        recognition.addEventListener('error', function(e) {
            listening = false;
            micIcon.className = 'fas fa-microphone text-pink-500 text-lg';
            micBtn.classList.remove('animate-pulse');

            const messages = {
                'not-allowed': 'Microphone access denied. Please allow mic permission in your browser.',
                'no-speech': 'No speech detected. Try again.',
                'network': 'Network error. Speech recognition requires internet.',
                'aborted': '',
            };
            const msg = messages[e.error] || ('Speech error: ' + e.error);
            if (msg) alert(msg);
        });

        // keyboard search debounce
        let timeout = null;
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                const url = new URL(window.location.href);
                url.searchParams.set('search', searchInput.value);
                window.location.href = url.toString();
            }, 500);
        });
    })();
</script>
