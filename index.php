<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Start Page — Minimal</title>
    <link rel="icon" type="image/png/ico" href="https://jkp.my.id/assets//img//icons/favico.ico">
    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            transition: background-image .35s ease, background-color .35s ease, color .2s ease;
            background-size: cover;
            background-repeat: no-repeat;
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

        /* responsive: hide custom input on mobile */
        @media (max-width: 640px) {
            #customEngineInput {
                display: none !important;
            }
        }

        /* hide theme toggle (disable switching to light) */
        #toggleTheme {
            display: none !important;
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

        /* mascot image sizing to match the header avatar */
        .mascot img {
            width: 56px;
            height: 56px;
            border-radius: 9999px;
            object-fit: cover;
            display: block;
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

        /* custom dropdown styling */
        .custom-dropdown-container {
            position: relative;
        }

        .custom-dropdown-trigger {
            width: 68px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: .5rem;
            border-radius: 9999px;
            background-color: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.25);
            cursor: pointer;
        }

        .custom-dropdown-trigger:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }

        .custom-dropdown-trigger img {
            width: 25px;
            height: 25px;
        }

        .custom-dropdown-menu {
            position: absolute;
            text-align: left;
            left: 0;
            top: 100%;
            margin-top: 8px;
            width: 12rem;
            padding: 8px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
            z-index: 50;
        }

        .custom-dropdown-menu li {
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .custom-dropdown-menu li:hover {
            background-color: rgba(255, 255, 255, 0.1);
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
        .custom-dropdown-trigger,
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

<body class="min-h-screen flex flex-col items-center justify-start pt-20" data-theme="dark">
    <main class="w-full max-w-2xl p-6 text-center">
        <div id="logo" class="mb-8">
            <div class="logo-row flex items-end justify-center gap-3 mb-1">
                <!-- mascot image provided by user -->
                <div class="mascot rounded-full p-1 flex items-center justify-center">
                    <img src="./icon/maskot.webp" alt="Maskot" width="56" height="56" />
                </div>
                <h1 class="text-3xl font-semibold mb-0">Halo, Kakak ✨</h1>
            </div>
            <p class="text-sm pt-2 opacity-80">tekan <kbd class="px-2 py-0.5 rounded glass">Enter</kbd> untuk mencari</p>
        </div>

        <form id="searchForm" class="flex gap-3 items-center justify-center mb-6">
            <!-- Container untuk dropdown kustom -->
            <div class="custom-dropdown-container relative">
                <div id="engineDropdownTrigger" class="custom-dropdown-trigger" title="Pilih mesin pencari">
                    <img id="selectedEngineIcon" src="./icon/google.svg" alt="Google">
                </div>
                <ul id="engineDropdownMenu" class="custom-dropdown-menu hidden">
                    <li data-value="https://www.google.com/search?q=" data-icon="./icon/google.svg">
                        <img src="./icon/google.svg" alt="Google" class="inline-block w-6 h-6 mr-2" /> Google
                    </li>
                    <li data-value="https://duckduckgo.com/?q=" data-icon="./icon/duckduckgo.svg">
                        <img src="./icon/duckduckgo.svg" alt="DuckDuckGo" class="inline-block w-6 h-6 mr-2" /> DuckDuckGo
                    </li>
                    <li data-value="https://www.bing.com/search?q=" data-icon="./icon/bing.svg">
                        <img src="./icon/bing.svg" alt="Bing" class="inline-block w-6 h-6 mr-2" /> Bing
                    </li>
                    <li data-value="https://search.brave.com/search?q=" data-icon="./icon/brave.svg">
                        <img src="./icon/brave.svg" alt="Brave" class="inline-block w-6 h-6 mr-2" /> Brave
                    </li>
                </ul>
            </div>

            <!-- <select> asli disembunyikan untuk fungsionalitas formulir -->
            <select id="engineSelect" style="display:none;">
                <option value="https://www.google.com/search?q=">Google</option>
                <option value="https://duckduckgo.com/?q=">DuckDuckGo</option>
                <option value="https://www.bing.com/search?q=">Bing</option>
                <option value="https://search.brave.com/search?q=">Brave</option>
            </select>

            <input id="customEngineInput" class="p-3 flex-1 glass text-sm" placeholder="Custom engine base URL" style="display:none;" />

            <div class="input-group relative flex-1">
                <input id="queryInput" type="search" name="q" autocomplete="off" class="p-3 w-full text-lg font-medium glass placeholder:text-white/50 overflow-hidden text-ellipsis" placeholder="Cari sesuatu..." />
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
                <label class="flex-1 text-sm hidden">Tema</label>
                <div class="flex gap-2 items-center">
                    <button id="toggleTheme" class="px-3 py-1 rounded glass">Toggle</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-sm">Wallpaper</label>
                <div class="flex gap-2 mt-2">
                    <button data-preset="none" class="presetBtn p-2 rounded-full glass text-sm">Default</button>
                    <button data-preset="./bg/bg01.webp" class="presetBtn p-2 rounded-full glass text-sm">Preset 1</button>
                    <button data-preset="./bg/bg02.webp" class="presetBtn p-2 rounded-full glass text-sm">Preset 2</button>
                    <button data-preset="./bg/bg04.webp" class="presetBtn p-2 rounded-full glass text-sm">Preset 3</button>
                    <button data-preset="https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded-full glass text-sm">Preset 4</button>
                </div>
                <div class="mt-3 flex gap-2 items-center">
                    <input id="uploadBg" type="file" accept="image/*" class="text-sm" />
                    <label for="uploadBg" class="file-label glass text-sm p-2 rounded-full">📁 Pilih gambar...</label>
                    <button id="removeBg" class="p-2 rounded-full glass text-sm">Remove</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-sm">Default Search Engine</label>
                <div class="mt-2 text-sm custom-dropdown-container">
                    <!-- Dropdown kustom baru untuk pengaturan -->
                    <div id="defaultEngineTrigger" class="custom-dropdown-trigger p-2 w-full flex items-center justify-between text-base" style="width: 100%; height: auto; border-radius: 9999px;">
                        <span id="defaultEngineText">Google</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-70">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </div>
                    <ul id="defaultEngineMenu" class="custom-dropdown-menu hidden" style="width: 100%;">
                        <li data-value="https://www.google.com/search?q=">Google</li>
                        <li data-value="https://duckduckgo.com/?q=">DuckDuckGo</li>
                        <li data-value="https://www.bing.com/search?q=">Bing</li>
                        <li data-value="custom">Custom...</li>
                    </ul>
                    <!-- <select> asli disembunyikan untuk fungsionalitas -->
                    <select id="defaultEngine" class="hidden">
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

        <footer class="mt-8 text-xs ">JKP • <span id="year"></span> • local settings</footer>
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
        const clearBtn = document.getElementById('clearInput');

        const engineDropdownTrigger = document.getElementById('engineDropdownTrigger');
        const engineDropdownMenu = document.getElementById('engineDropdownMenu');
        const selectedEngineIcon = document.getElementById('selectedEngineIcon');
        const engineMenuItems = engineDropdownMenu.querySelectorAll('li');

        // New elements for the settings dropdown
        const defaultEngineTrigger = document.getElementById('defaultEngineTrigger');
        const defaultEngineMenu = document.getElementById('defaultEngineMenu');
        const defaultEngineText = document.getElementById('defaultEngineText');
        const defaultEngineMenuItems = defaultEngineMenu.querySelectorAll('li');

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

            // Update settings dropdown based on saved engine
            const defaultMatched = ['https://www.google.com/search?q=', 'https://duckduckgo.com/?q=', 'https://www.bing.com/search?q='].includes(s.engine) ? s.engine : 'custom';
            defaultEngineSelect.value = defaultMatched;
            const selectedText = defaultEngineMenu.querySelector(`[data-value="${defaultMatched}"]`)?.textContent.trim() || "Custom...";
            defaultEngineText.textContent = selectedText;
            if (defaultMatched === 'custom') {
                defaultEngineCustom.style.display = 'block';
                defaultEngineCustom.value = s.engine
            } else defaultEngineCustom.style.display = 'none';

            // Also update the main dropdown's icon
            const mainEngineItem = engineDropdownMenu.querySelector(`[data-value="${s.engine}"]`);
            if (mainEngineItem) {
                selectedEngineIcon.src = mainEngineItem.getAttribute('data-icon');
            } else {
                // If it's a custom URL, default to Google icon
                selectedEngineIcon.src = "./icon/google.svg";
            }
        }

        applySettings(settings);

        settingsBtn.addEventListener('click', () => {
            settingsPanel.style.display = settingsPanel.style.display === 'none' ? 'block' : 'none'
        });
        cancelSettingsBtn.addEventListener('click', () => {
            settingsPanel.style.display = 'none'
        });
        resetBtn.addEventListener('click', () => {
            // Use a custom modal instead of alert/confirm
            const result = confirm('Reset semua pengaturan ke default?');
            if (result) {
                settings = {
                    ...defaultSettings
                };
                saveSettings(settings);
                applySettings(settings);
                alert('Reset selesai.');
            }
        });
        toggleThemeBtn.addEventListener('click', () => {
            settings.theme = settings.theme === 'dark' ? 'light' : 'dark';
            applyTheme(settings.theme);
            // persist theme change immediately
            saveSettings(settings);
        });

        // Event listener untuk dropdown kustom utama
        engineDropdownTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            engineDropdownMenu.classList.toggle('hidden');
            defaultEngineMenu.classList.add('hidden'); // Close other dropdown
        });

        // Event listener untuk item di dropdown kustom utama
        engineMenuItems.forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const icon = item.getAttribute('data-icon');
                selectedEngineIcon.src = icon;
                engineDropdownMenu.classList.add('hidden');
                engineSelect.value = value;
            });
        });

        // Event listener untuk dropdown kustom pengaturan
        defaultEngineTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            defaultEngineMenu.classList.toggle('hidden');
            engineDropdownMenu.classList.add('hidden'); // Close other dropdown
        });

        // Event listener untuk item di dropdown pengaturan
        defaultEngineMenuItems.forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const text = item.textContent.trim();
                defaultEngineText.textContent = text;
                defaultEngineSelect.value = value;
                defaultEngineMenu.classList.add('hidden');
                defaultEngineCustom.style.display = value === 'custom' ? 'block' : 'none';
            });
        });

        // Close all dropdowns when clicking outside
        document.addEventListener('click', (event) => {
            if (!engineDropdownTrigger.contains(event.target) && !engineDropdownMenu.contains(event.target)) {
                engineDropdownMenu.classList.add('hidden');
            }
            if (!defaultEngineTrigger.contains(event.target) && !defaultEngineMenu.contains(event.target)) {
                defaultEngineMenu.classList.add('hidden');
            }
        });

        presetBtns.forEach(b => {
            b.addEventListener('click', () => {
                const url = b.getAttribute('data-preset');
                settings.wallpaper = url === 'none' ? null : url;
                applyWallpaper(settings.wallpaper)
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
            let chosen = engineSelect.value;
            let defaultChosen = defaultEngineSelect.value === 'custom' ? (defaultEngineCustom.value || chosen) : defaultEngineSelect.value;
            settings.engine = defaultChosen;
            saveSettings(settings);
            applySettings(settings);
            settingsPanel.style.display = 'none';
            alert('Pengaturan tersimpan.')
        });
        searchForm.addEventListener('submit', e => {
            e.preventDefault();
            const q = queryInput.value.trim();
            if (!q) return;
            const base = engineSelect.value; // Now using the hidden select's value
            const url = base + encodeURIComponent(q);
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
            const base = engineSelect.value;
            const url = base + encodeURIComponent(q);
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

        // populate dynamic year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>
