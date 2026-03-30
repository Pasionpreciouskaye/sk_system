<script>
    (function() {
        var inputId = '{{ $inputId ?? "search" }}';

        // SVG mic icon — no FA dependency
        var MIC_SVG = '<svg id="mic-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="pointer-events:none"><path d="M12 1a4 4 0 0 1 4 4v6a4 4 0 0 1-8 0V5a4 4 0 0 1 4-4zm-1 17.93V21H9v2h6v-2h-2v-2.07A8.001 8.001 0 0 0 20 11h-2a6 6 0 0 1-12 0H4a8.001 8.001 0 0 0 7 7.93z"/></svg>';
        var STOP_SVG = '<svg id="mic-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="#ef4444" style="pointer-events:none"><rect x="6" y="6" width="12" height="12" rx="2"/></svg>';

        function init() {
            var searchInput = document.getElementById(inputId);
            var micBtn = document.getElementById('mic-btn');

            if (!searchInput || !micBtn) return;

            // Ensure SVG icon is rendered (replaces any empty <i> tag)
            if (!micBtn.querySelector('svg')) {
                micBtn.innerHTML = MIC_SVG;
            }

            var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                micBtn.title = 'Speech recognition not supported. Use Chrome or Edge.';
                micBtn.disabled = true;
                micBtn.style.opacity = '0.4';
                return;
            }

            var recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
            recognition.continuous = false;

            var listening = false;

            micBtn.addEventListener('click', function() {
                if (listening) { recognition.stop(); return; }
                try { recognition.start(); } catch (e) { console.warn('Speech error:', e); }
            });

            recognition.addEventListener('start', function() {
                listening = true;
                micBtn.innerHTML = STOP_SVG;
                micBtn.classList.add('listening');
                micBtn.title = 'Listening... click to stop';
            });

            recognition.addEventListener('result', function(e) {
                var transcript = e.results[0][0].transcript;
                searchInput.value = transcript;
                // DataTable: filter directly
                if (window.$ && window.$.fn && window.$.fn.dataTable) {
                    try {
                        var dt = window.$('table.dataTable').DataTable();
                        if (dt) { dt.search(transcript).draw(); return; }
                    } catch(err) {}
                }
                // URL-based search
                var url = new URL(window.location.href);
                url.searchParams.set('search', transcript);
                window.location.href = url.toString();
            });

            recognition.addEventListener('end', function() {
                listening = false;
                micBtn.innerHTML = MIC_SVG;
                micBtn.classList.remove('listening');
                micBtn.title = 'Search by voice';
            });

            recognition.addEventListener('error', function(e) {
                listening = false;
                micBtn.innerHTML = MIC_SVG;
                micBtn.classList.remove('listening');
                var messages = {
                    'not-allowed': 'Microphone access denied. Please allow mic permission.',
                    'no-speech': 'No speech detected. Try again.',
                    'network': 'Network error. Speech recognition requires internet.',
                    'aborted': '',
                };
                var msg = messages[e.error] || ('Speech error: ' + e.error);
                if (msg) alert(msg);
            });

            // Keyboard debounce for URL-based pages
            if (inputId === 'search') {
                var timeout = null;
                searchInput.addEventListener('keyup', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        var url = new URL(window.location.href);
                        url.searchParams.set('search', searchInput.value);
                        window.location.href = url.toString();
                    }, 500);
                });
            }
        }

        // Wait for DataTable to inject its input
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() { setTimeout(init, 400); });
        } else {
            setTimeout(init, 400);
        }
    })();
</script>
