<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Start Page — Minimal</title>
    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html,
        body {
            height: 100%
        }

        body {
            transition: background-image .35s ease, background-color .35s ease, color .2s ease;
            background-size: cover;
            background-position: center;
        }

        .glass {
            background-color: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            /* thin border + subtle inset shadow for 3D glass look */
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.25);
        }

        [data-theme="light"] .glass {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: inset 0 1px 6px rgba(255, 255, 255, 0.6);
        }

        /* base element styling */
        select,
        input,
        button,
        textarea {
            border-radius: 0.75rem;
            border: 1px solid transparent;
            transition: box-shadow .18s ease, border-color .15s ease, background-color .15s ease;
        }

        /* remove default focus outline and provide a minimal, clean focus */
        input:focus,
        select:focus,
        textarea:focus,
        button:focus {
            outline: none;
            box-shadow: 0 6px 18px rgba(2, 6, 23, 0.12);
            border-color: rgba(59, 130, 246, 0.6);
            /* subtle blue accent */
        }

        /* make .glass children slightly inset for 3d feel */
        .glass>* {
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        }

        /* style the small select (engine icon) to avoid white default backgrounds */
        select.glass {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem;
        }

        /* hide IE/Edge expand arrow */
        select.glass::-ms-expand {
            display: none;
        }

        /* file input: hide native control and use themed label */
        input[type="file"] {
            display: none;
        }

        .file-label {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem .75rem;
            cursor: pointer;
        }

        /* subtle preset button hover */
        .presetBtn {
            border: 1px solid rgba(255, 255, 255, 0.04);
            box-shadow: inset 0 -8px 12px rgba(0, 0, 0, 0.18);
        }

        /* engine icon buttons */
        .engineBtn {
            width: 44px;
            height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .25rem;
            border-radius: 10rem;
            /* fully rounded */
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(255, 255, 255, 0.02);
            cursor: pointer;
        }

        .engineBtn:hover {
            transform: translateY(-2px);
        }

        .engineBtn.active {
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.18);
            border-color: rgba(59, 130, 246, 0.6);
            color: rgba(59, 130, 246, 1);
        }

        .engine-icon {
            width: 20px;
            height: 20px;
            filter: var(--icon-filter, none);
        }

        /* search button */
        .btn-search {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.04);
            color: #38bdf8;
            /* cyan-ish */
            cursor: pointer;
        }

        .btn-search:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateY(-1px);
        }

        .btn-search svg {
            width: 20px;
            height: 20px;
        }

        /* dropdown engine select styling */
        .engine-select {
            width: 68px;
            height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .5rem;
            border-radius: 9999px;
            text-indent: -9999px;
            /* hide text visually so we can show icon */
            overflow: hidden;
            position: relative;
        }

        .engine-select option {
            text-indent: 0;
        }

        /* input group: clear + search inside the right side */
        .input-group {
            position: relative;
        }

        .input-group .btn-clear {
            position: absolute;
            right: 48px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            cursor: pointer;
        }

        .input-group .btn-clear:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .input-group .btn-search {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* make primary fields and controls pill-shaped */
        input.p-3,
        .engine-select,
        .btn-search,
        .file-label,
        .presetBtn,
        .engineBtn,
        #saveSettings,
        #cancelSettings,
        #resetBtn,
        select.p-2 {
            border-radius: 9999px;
        }

        /* ensure the settings panel buttons visually match when small */
        #saveSettings,
        #cancelSettings,
        #resetBtn {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* suggestions dropdown */
        .suggestions {
            position: absolute;
            left: 0;
            right: 0;
            top: calc(100% + 8px);
            background: rgba(2, 6, 23, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
            overflow: hidden;
            z-index: 40;
            max-height: 280px;
            overflow-y: auto;
        }

        .suggestion-item {
            padding: .6rem .75rem;
            cursor: pointer;
            color: #fff;
            text-align: left;
        }

        .suggestion-item:hover,
        .suggestion-item.active {
            background: rgba(255, 255, 255, 0.04);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-start pt-24" data-theme="dark">
    <main class="w-full max-w-2xl p-6 text-center">
        <div id="logo" class="mb-8">
            <h1 class="text-3xl font-semibold mb-1">Halo, Kakak ✨</h1>
            <p class="text-sm opacity-80">Start page minimal — tekan <kbd class="px-2 py-0.5 rounded glass">Enter</kbd> untuk mencari</p>
        </div>

        <form id="searchForm" class="flex gap-3 items-center justify-center mb-6">
            <!-- engine picker as dropdown with icon background set by JS -->
            <select id="engineSelect" class="glass engine-select p-3 rounded-full" title="Pilih mesin pencari">
                <option value="https://www.google.com/search?q=">Google</option>
                <option value="https://duckduckgo.com/?q=">DuckDuckGo</option>
                <option value="https://www.bing.com/search?q=">Bing</option>
                <option value="https://search.brave.com/search?q=">Brave</option>
            </select>

            <input id="customEngineInput" class="p-3 flex-1 glass text-sm" placeholder="Custom engine base URL" style="display:none;" />

            <div class="input-group relative flex-1">
                <input id="queryInput" type="search" name="q" autocomplete="off" class="p-3 w-full text-lg font-medium glass placeholder:text-white/50" placeholder="Cari sesuatu..." />
                <div id="suggestions" class="suggestions" style="display:none;"></div>
                <button type="button" id="clearInput" aria-label="Clear" class="btn-clear" title="Clear" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
                <button type="submit" aria-label="Search" class="btn-search glass" title="Search">
                    <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.65" y1="16.65" x2="21" y2="21"></line>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Settings panel -->
        <aside id="settingsPanel" class="mt-6 p-4 rounded-xl glass shadow-lg" style="display:none; text-align:left;">
            <h2 class="font-semibold mb-3">Pengaturan</h2>
            <div class="flex items-center gap-3 mb-3">
                <label class="flex-1 text-sm">Tema</label>
                <div class="flex gap-2 items-center">
                    <button id="toggleTheme" class="px-3 py-1 rounded glass">Toggle</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-sm">Wallpaper</label>
                <div class="flex gap-2 mt-2">
                    <button data-preset="none" class="presetBtn p-2 rounded-full glass text-sm">Default</button>
                    <button data-preset="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded-full glass text-sm">Preset 1</button>
                    <button data-preset="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded-full glass text-sm">Preset 2</button>
                </div>
                <div class="mt-3 flex gap-2 items-center">
                    <input id="uploadBg" type="file" accept="image/*" class="text-sm" />
                    <label for="uploadBg" class="file-label glass text-sm p-2 rounded-full">📁 Pilih gambar...</label>
                    <button id="removeBg" class="p-2 rounded-full glass text-sm">Remove</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-sm">Default Search Engine</label>
                <div class="mt-2 text-sm">
                    <select id="defaultEngine" class="p-2 rounded-full glass w-full">
                        <option value="https://www.google.com/search?q=">Google</option>
                        <option value="https://duckduckgo.com/?q=">DuckDuckGo</option>
                        <option value="https://www.bing.com/search?q=">Bing</option>
                        <option value="custom">Custom...</option>
                    </select>
                    <input id="defaultEngineCustom" placeholder="Custom engine base URL" class="mt-2 p-2 rounded-full glass w-full" style="display:none;" />
                </div>
            </div>

            <div class="flex gap-2 mt-4">
                <button id="saveSettings" class="px-4 py-2 rounded-full glass">Save</button>
                <button id="cancelSettings" class="px-4 py-2 rounded-full glass">Close</button>
                <button id="resetBtn" class="px-4 py-2 rounded-full glass text-red-500">Reset</button>
            </div>
        </aside>

        <footer class="mt-8 text-xs opacity-70">Minimal Start Page • local settings</footer>
    </main>

    <!-- Floating settings button -->
    <button id="settingsBtn" class="fixed bottom-4 right-4 p-3 glass shadow-lg">⚙️</button>

    <script>
        const STORAGE_KEY = 'startpage-settings-v1';
        const defaultSettings = {
            theme: 'dark',
            engine: 'https://www.google.com/search?q=',
            wallpaper: null
        };

        function supportsLocalStorage() {
            try {
                return 'localStorage' in window && window.localStorage != null
            } catch (e) {
                return false
            }
        }

        function saveSettings(obj) {
            try {
                if (supportsLocalStorage()) localStorage.setItem(STORAGE_KEY, JSON.stringify(obj));
                else document.cookie = STORAGE_KEY + '=' + encodeURIComponent(JSON.stringify(obj)) + ';path=/;max-age=' + (60 * 60 * 24 * 365);
            } catch (e) {}
        }

        function loadSettings() {
            try {
                if (supportsLocalStorage()) {
                    const raw = localStorage.getItem(STORAGE_KEY);
                    return raw ? JSON.parse(raw) : {
                        ...defaultSettings
                    }
                } else {
                    const match = document.cookie.match(new RegExp('(^| )' + STORAGE_KEY + '=([^;]+)'));
                    return match ? JSON.parse(decodeURIComponent(match[2])) : {
                        ...defaultSettings
                    }
                }
            } catch (e) {
                return {
                    ...defaultSettings
                }
            }
        }

        const body = document.body;
        const settingsBtn = document.getElementById('settingsBtn');
        const settingsPanel = document.getElementById('settingsPanel');
        const saveSettingsBtn = document.getElementById('saveSettings');
        const cancelSettingsBtn = document.getElementById('cancelSettings');
        const resetBtn = document.getElementById('resetBtn');
        const toggleThemeBtn = document.getElementById('toggleTheme');
        const engineSelect = document.getElementById('engineSelect');
        const customEngineInput = document.getElementById('customEngineInput');
        const defaultEngineSelect = document.getElementById('defaultEngine');
        const defaultEngineCustom = document.getElementById('defaultEngineCustom');
        const presetBtns = document.querySelectorAll('.presetBtn');
        const uploadBg = document.getElementById('uploadBg');
        const removeBg = document.getElementById('removeBg');
        const queryInput = document.getElementById('queryInput');
        const searchForm = document.getElementById('searchForm');
        const engineButtons = document.querySelectorAll('.engineBtn');
        const clearBtn = document.getElementById('clearInput');

        let settings = loadSettings();

        function applyTheme(theme) {
            body.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                body.style.color = 'white';
                body.style.backgroundColor = '#0b1020'
            } else {
                body.style.color = '#0b1020';
                body.style.backgroundColor = '#f3f4f6'
            }
        }

        function applyWallpaper(wallpaper) {
            body.style.backgroundImage = wallpaper ? `url('${wallpaper}')` : ''
        }

        function applySettings(s) {
            applyTheme(s.theme);
            applyWallpaper(s.wallpaper);
            // when using dropdown, set selected value and custom input
            const known = ['https://www.google.com/search?q=', 'https://duckduckgo.com/?q=', 'https://www.bing.com/search?q=', 'https://search.brave.com/search?q='];
            const matched = known.includes(s.engine) ? s.engine : 'custom';
            engineSelect.value = matched === 'custom' ? 'custom' : matched;
            if (matched === 'custom') {
                customEngineInput.style.display = 'block';
                customEngineInput.value = s.engine
            } else customEngineInput.style.display = 'none';
            defaultEngineSelect.value = ['https://www.google.com/search?q=', 'https://duckduckgo.com/?q=', 'https://www.bing.com/search?q='].includes(s.engine) ? s.engine : 'custom';
            if (defaultEngineSelect.value === 'custom') {
                defaultEngineCustom.style.display = 'block';
                defaultEngineCustom.value = s.engine
            } else defaultEngineCustom.style.display = 'none';
        }
        applySettings(settings);

        settingsBtn.addEventListener('click', () => {
            settingsPanel.style.display = settingsPanel.style.display === 'none' ? 'block' : 'none'
        });
        cancelSettingsBtn.addEventListener('click', () => {
            settingsPanel.style.display = 'none'
        });
        resetBtn.addEventListener('click', () => {
            if (confirm('Reset semua pengaturan ke default?')) {
                settings = {
                    ...defaultSettings
                };
                saveSettings(settings);
                applySettings(settings);
                alert('Reset selesai');
            }
        });
        toggleThemeBtn.addEventListener('click', () => {
            settings.theme = settings.theme === 'dark' ? 'light' : 'dark';
            applyTheme(settings.theme);
            // persist theme change immediately
            saveSettings(settings);
        });
        engineSelect.addEventListener('change', e => {
            const v = e.target.value;
            customEngineInput.style.display = v === 'custom' ? 'block' : 'none';
            // update visual icon background
            fixSelectTheme();
        });
        // remove old engine button handlers (not used when dropdown present)
        defaultEngineSelect.addEventListener('change', e => {
            defaultEngineCustom.style.display = e.target.value === 'custom' ? 'block' : 'none'
        });
        presetBtns.forEach(b => {
            b.addEventListener('click', () => {
                const url = b.getAttribute('data-preset');
                settings.wallpaper = url === 'none' ? null : url;
                applyWallpaper(settings.wallpaper)
                // persist wallpaper choice immediately (user expects preview -> saved)
                saveSettings(settings);
            })
        });
        uploadBg.addEventListener('change', e => {
            const f = e.target.files && e.target.files[0];
            if (!f) return;
            if (f.size > 2_000_000) {
                if (!confirm('Gambar >2MB, lanjut?')) return;
            }
            const reader = new FileReader();
            reader.onload = () => {
                settings.wallpaper = reader.result;
                applyWallpaper(settings.wallpaper)
                // save uploaded wallpaper
                saveSettings(settings);
            };
            reader.readAsDataURL(f)
        });
        removeBg.addEventListener('click', () => {
            settings.wallpaper = null;
            applyWallpaper(null)
            saveSettings(settings);
        });
        saveSettingsBtn.addEventListener('click', () => {
            let chosen = engineSelect.value === 'custom' ? (customEngineInput.value || defaultSettings.engine) : engineSelect.value;
            let defaultChosen = defaultEngineSelect.value === 'custom' ? (defaultEngineCustom.value || chosen) : defaultEngineSelect.value;
            settings.engine = defaultChosen || chosen;
            // persist and apply immediately so UI reflects choice without reload
            saveSettings(settings);
            applySettings(settings);
            settingsPanel.style.display = 'none';
            alert('Pengaturan tersimpan.')
        });
        searchForm.addEventListener('submit', e => {
            e.preventDefault();
            const q = queryInput.value.trim();
            if (!q) return;
            const base = engineSelect.value === 'custom' ? (customEngineInput.value || settings.engine) : engineSelect.value;
            const url = (base || settings.engine) + encodeURIComponent(q);
            window.location.href = url
        });
        // clear button behaviour
        queryInput.addEventListener('input', () => {
            clearBtn.style.display = queryInput.value ? 'inline-flex' : 'none';
            scheduleSuggest(queryInput.value);
        });
        clearBtn.addEventListener('click', () => {
            queryInput.value = '';
            clearBtn.style.display = 'none';
            queryInput.focus();
            hideSuggestions();
        });

        // Suggestions: JSONP to Google suggest
        const suggestionsEl = document.getElementById('suggestions');
        let suggestTimer = null;
        let currentScript = null;
        let activeIndex = -1;

        function scheduleSuggest(q) {
            if (suggestTimer) clearTimeout(suggestTimer);
            if (!q) {
                hideSuggestions();
                return;
            }
            suggestTimer = setTimeout(() => fetchSuggest(q), 160);
        }

        function fetchSuggest(q) {
            // cleanup previous
            if (currentScript) {
                document.head.removeChild(currentScript);
                currentScript = null;
            }
            const cbName = 'gSuggestCB_' + Date.now();
            window[cbName] = function(data) {
                try {
                    renderSuggestions(data && data[1] ? data[1] : []);
                } finally {
                    delete window[cbName];
                }
            };
            const url = 'https://suggestqueries.google.com/complete/search?client=firefox&q=' + encodeURIComponent(q) + '&callback=' + cbName;
            currentScript = document.createElement('script');
            currentScript.src = url;
            currentScript.onerror = () => {
                delete window[cbName];
                if (currentScript) {
                    try {
                        document.head.removeChild(currentScript);
                    } catch (e) {}
                    currentScript = null;
                }
            };
            document.head.appendChild(currentScript);
        }

        function renderSuggestions(list) {
            suggestionsEl.innerHTML = '';
            activeIndex = -1;
            if (!list || !list.length) {
                hideSuggestions();
                return;
            }
            list.forEach((s, i) => {
                const it = document.createElement('div');
                it.className = 'suggestion-item';
                it.textContent = s;
                it.addEventListener('mousedown', (e) => { // use mousedown to avoid blur before click
                    e.preventDefault();
                    selectSuggestion(i);
                    submitSearch();
                });
                suggestionsEl.appendChild(it);
            });
            suggestionsEl.style.display = 'block';
        }

        function hideSuggestions() {
            suggestionsEl.style.display = 'none';
            suggestionsEl.innerHTML = '';
            activeIndex = -1;
        }

        function selectSuggestion(i) {
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            if (!items.length) return;
            items.forEach(it => it.classList.remove('active'));
            const chosen = items[i];
            if (!chosen) return;
            chosen.classList.add('active');
            activeIndex = i;
            queryInput.value = chosen.textContent;
        }

        function submitSearch() {
            const q = queryInput.value.trim();
            if (!q) return;
            const base = engineSelect.value === 'custom' ? (customEngineInput.value || settings.engine) : engineSelect.value;
            const url = (base || settings.engine) + encodeURIComponent(q);
            window.location.href = url;
        }

        // keyboard navigation
        queryInput.addEventListener('keydown', (e) => {
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            if (suggestionsEl.style.display === 'block' && items.length) {
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectSuggestion((activeIndex + 1) % items.length);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectSuggestion((activeIndex - 1 + items.length) % items.length);
                } else if (e.key === 'Enter') {
                    if (activeIndex >= 0) {
                        e.preventDefault();
                        submitSearch();
                    }
                } else if (e.key === 'Escape') {
                    hideSuggestions();
                }
            }
        });

        // hide suggestions on blur
        queryInput.addEventListener('blur', () => {
            setTimeout(hideSuggestions, 150);
        });
        window.addEventListener('load', () => {
            queryInput.focus()
        });
        window.addEventListener('keydown', e => {
            // focus search with Ctrl/Cmd+K
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                queryInput.focus()
            }

            // toggle settings with Ctrl+, or 's' key (when not typing)
            const activeTag = document.activeElement && document.activeElement.tagName;
            if (!['INPUT', 'TEXTAREA', 'SELECT'].includes(activeTag)) {
                if ((e.ctrlKey || e.metaKey) && e.key === ',') {
                    e.preventDefault();
                    settingsPanel.style.display = settingsPanel.style.display === 'none' ? 'block' : 'none';
                } else if (e.key.toLowerCase() === 's') {
                    e.preventDefault();
                    settingsPanel.style.display = settingsPanel.style.display === 'none' ? 'block' : 'none';
                }
            }

            // close settings with Escape
            if (e.key === 'Escape') {
                if (settingsPanel.style.display !== 'none') settingsPanel.style.display = 'none';
            }
        });

        // ensure select icon backgrounds don't show white in dark theme
        function fixSelectTheme() {
            const s = document.getElementById('engineSelect');
            if (!s) return;
            // set a background-image using the currently selected engine's icon
            const val = s.value;
            let bg = '';
            if (val === 'https://www.google.com/search?q=') bg = "url('icon/google.svg')";
            else if (val === 'https://duckduckgo.com/?q=') bg = "url('icon/duckduckgo.svg')";
            else if (val === 'https://www.bing.com/search?q=') bg = "url('icon/bing.svg')";
            else if (val === 'https://search.brave.com/search?q=') bg = "url('icon/brave.svg')";
            else bg = '';
            s.style.backgroundImage = bg;
            s.style.backgroundRepeat = 'no-repeat';
            s.style.backgroundPosition = 'center';
            s.style.backgroundSize = '25px 25px';
        }
        // run on load and whenever theme changes via toggle
        fixSelectTheme();
        // also update icon when engine select changed
        document.getElementById('engineSelect').addEventListener('change', fixSelectTheme);
    </script>
</body>

</html>