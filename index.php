<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>JKP Search Page</title>
    <meta name="description" content="Kunjugi halaman search yang lebih meanarik" />
    <link rel="icon" type="image/png/ico" href="https://jkp.my.id/assets//img//icons/favico.ico">
    <!-- Tailwind Play CLI -->
    <link href="./style.css" rel="stylesheet">
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
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.25);
        }

        [data-theme="light"] .glass {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: inset 0 1px 6px rgba(255, 255, 255, 0.6);
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

        /* CLS FIX: Settings panel as a fixed overlay */
        #settingsPanel.is-visible {
            opacity: 1;
            pointer-events: auto;
        }

        /* Engine button styles and active state */
        .engineBtn {
            /* ensure buttons are positioned for badge */
            position: relative;
            transition: transform .12s ease, box-shadow .12s ease, border-color .12s ease;
        }

        .engineBtn:hover {
            transform: translateY(-3px);
        }

        .engineBtn.active {
            box-shadow: 0 10px 28px rgba(59, 130, 246, 0.16);
            border-color: rgba(59, 130, 246, 0.7);
            transform: translateY(-4px) scale(1.06);
        }

        /* small check badge when active */
        .engineBtn.active::after {
            content: "\2713";
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(59,130,246,0.95);
            color: #fff;
            width: 18px;
            height: 18px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(2,6,23,0.2);
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
            <p class="text-sm pt-2 opacity-80">tekan <kbd class="px-2 py-0.5 rounded-md glass">Enter</kbd> untuk mencari</p>
        </div>

        <form id="searchForm" class="flex gap-3 items-center justify-center mb-6">
            <!-- Container untuk dropdown kustom -->
            <div class="relative hidden sm:block">
                <div id="engineDropdownTrigger" class="glass w-12 h-12 flex items-center justify-center p-2 rounded-full cursor-pointer hover:bg-white/10 transition-colors" title="Pilih mesin pencari">
                    <img id="selectedEngineIcon" src="./icon/google.svg" alt="Google" class="w-6 h-6">
                </div>
                <ul id="engineDropdownMenu" class="glass hidden absolute left-0 top-full mt-2 w-48 p-2 rounded-xl z-50 text-left">
                    <li data-value="https://www.google.com/search?q=" data-icon="./icon/google.svg" class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10">
                        <img src="./icon/google.svg" alt="Google" class="inline-block w-6 h-6 mr-2" /> Google
                    </li>
                    <li data-value="https://duckduckgo.com/?q=" data-icon="./icon/duckduckgo.svg" class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10">
                        <img src="./icon/duckduckgo.svg" alt="DuckDuckGo" class="inline-block w-6 h-6 mr-2" /> DuckDuckGo
                    </li>
                    <li data-value="https://www.bing.com/search?q=" data-icon="./icon/bing.svg" class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10">
                        <img src="./icon/bing.svg" alt="Bing" class="inline-block w-6 h-6 mr-2" /> Bing
                    </li>
                    <li data-value="https://search.brave.com/search?q=" data-icon="./icon/brave.svg" class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10">
                        <img src="./icon/brave.svg" alt="Brave" class="inline-block w-6 h-6 mr-2" /> Brave
                    </li>
                </ul>
            </div>

            <!-- <select> asli disembunyikan untuk fungsionalitas formulir -->
            <select id="engineSelect" class="hidden">
                <option value="https://www.google.com/search?q=">Google</option>
                <option value="https://duckduckgo.com/?q=">DuckDuckGo</option>
                <option value="https://www.bing.com/search?q=">Bing</option>
                <option value="https://search.brave.com/search?q=">Brave</option>
            </select>

            <input id="customEngineInput" class="p-3 flex-1 glass text-sm rounded-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all" placeholder="Custom engine base URL" style="display:none;" />

            <div class="relative flex-1">
                <input id="queryInput" type="search" name="q" autocomplete="off" class="py-3 px-5 w-full text-lg font-medium glass placeholder:text-white/50 overflow-hidden text-ellipsis rounded-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all" placeholder="Cari sesuatu..." />
                <div id="suggestions" class="suggestions absolute inset-x-0 top-full mt-2 glass rounded-xl shadow-xl overflow-hidden z-40 max-h-72 overflow-y-auto" style="display:none;"></div>
                <button type="button" id="clearInput" aria-label="Clear" class="absolute right-14 top-1/2 -translate-y-1/2 border-0 bg-transparent text-white/70 w-7 h-7 flex items-center justify-center rounded-full cursor-pointer hover:bg-white/5 transition-colors" title="Clear" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
                <button type="submit" aria-label="Search" class="w-11 h-11 flex items-center justify-center border-0 rounded-full bg-white/10 text-cyan-400 cursor-pointer hover:bg-white/20  transition-all absolute right-2 top-1/2 -translate-y-1/2" title="Search">
                    <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.65" y1="16.65" x2="21" y2="21"></line>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Settings panel as a fixed overlay to prevent CLS -->
        <aside id="settingsPanel" class="fixed inset-0 bg-black/50 backdrop-blur-md flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity">
            <div class="settings-content w-full max-w-md p-6 glass rounded-xl text-left">
                <h2 class="font-semibold mb-3">Pengaturan</h2>
                <div class="flex items-center gap-3 mb-3">
                    <label class="flex-1 text-sm hidden">Tema</label>
                    <div class="flex gap-2 items-center">
                        <button id="toggleTheme" class="px-3 py-1 rounded-md glass hidden">Toggle</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Wallpaper</label>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <button data-preset="none" class="presetBtn p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Default</button>
                        <button data-preset="./bg/bg01.webp" class="presetBtn p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Preset 1</button>
                        <button data-preset="./bg/bg02.webp" class="presetBtn p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Preset 2</button>
                        <button data-preset="./bg/bg04.webp" class="presetBtn p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Preset 3</button>
                        <button data-preset="https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Preset 4</button>
                    </div>
                    <div class="mt-3 flex gap-2 items-center">
                        <input id="uploadBg" type="file" accept="image/*" class="text-sm" />
                        <label for="uploadBg" class="file-label glass text-sm p-2 rounded-full transition-transform hover:bg-white/10">📁 Pilih gambar...</label>
                        <button id="removeBg" class="p-2 rounded-full glass text-sm transition-transform hover:bg-white/10">Remove</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Default Search Engine</label>
                    <div id="defaultEngineButtons" class="flex flex-wrap gap-2 mt-2">
                        <button class="engineBtn w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full glass cursor-pointer transition-transform hover:bg-white/10" data-value="https://www.google.com/search?q=">
                            <img src="./icon/google.svg" class="engine-icon w-5 h-5" alt="Google">
                        </button>
                        <button class="engineBtn w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full glass cursor-pointer transition-transform hover:bg-white/10" data-value="https://duckduckgo.com/?q=">
                            <img src="./icon/duckduckgo.svg" class="engine-icon w-5 h-5" alt="DuckDuckGo">
                        </button>
                        <button class="engineBtn w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full glass cursor-pointer transition-transform hover:bg-white/10" data-value="https://www.bing.com/search?q=">
                            <img src="./icon/bing.svg" class="engine-icon w-5 h-5" alt="Bing">
                        </button>
                        <button class="engineBtn w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full glass cursor-pointer transition-transform hover:bg-white/10" data-value="https://search.brave.com/search?q=">
                            <img src="./icon/brave.svg" class="engine-icon w-5 h-5" alt="Brave">
                        </button>
                        <button class="engineBtn w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full glass cursor-pointer transition-transform hover:bg-white/10" data-value="custom">
                            <svg class="engine-icon w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20v-8m0 0V4m0 8h8m-8 0H4" />
                            </svg>
                        </button>
                    </div>
                    <input id="defaultEngineCustom" placeholder="Custom engine base URL" class="mt-2 p-2 rounded-full glass w-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all" style="display:none;" />
                </div>

                <div class="flex justify-between mt-4">
                    <button id="resetBtn" class="px-4 py-2 rounded-full glass transition-transform hover:bg-white/10 text-red-500/80">Reset</button>
                        <button id="cancelSettings" class="px-4 py-2 rounded-full glass transition-transform hover:bg-white/10">Close</button>
                </div>
            </div>
        </aside>
    </main>

    <!-- Floating settings button -->
    <button id="settingsBtn" class="fixed bottom-4 right-4 p-3 glass rounded-full shadow-lg">⚙️</button>

    <footer class="mt-8 text-xs opacity-70 text-center w-full pb-4">
        © <a href="http://jkp.my.id" target="_blank" rel="noopener noreferrer">JKP</a> • <span id="year"></span> • local settings
    </footer>

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
        const cancelSettingsBtn = document.getElementById('cancelSettings');
        const resetBtn = document.getElementById('resetBtn');
        const toggleThemeBtn = document.getElementById('toggleTheme');
        const engineSelect = document.getElementById('engineSelect');
        const customEngineInput = document.getElementById('customEngineInput');
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

        // New elements for the settings radio buttons
        const defaultEngineButtons = document.getElementById('defaultEngineButtons').querySelectorAll('.engineBtn');

        let settings = loadSettings();

        // suggestions filtering: terms to block from appearing in Google Suggest
        const SUGGEST_BANNED = [
            'gacor',
            'slot',
            'bet',
            'jackpot',
            'casino',
            'judi',
            'togel',
            'rtp',
            'judi',
            'qq',
            'judol',
            '88',
            '77',
            '99',
            '11',
            'zeus',
            'gates',
            'hoki',
            'win',
            'toto'

            // add more terms here as needed
        ];

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

            // Update settings radio buttons
            defaultEngineButtons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.value === s.engine || (btn.dataset.value === 'custom' && !known.includes(s.engine))) {
                    btn.classList.add('active');
                    defaultEngineCustom.style.display = (btn.dataset.value === 'custom') ? 'block' : 'none';
                    if (btn.dataset.value === 'custom') {
                        defaultEngineCustom.value = s.engine;
                    }
                }
            });

            // Also update the main dropdown's icon
            const mainEngineItem = engineDropdownMenu.querySelector(`[data-value="${s.engine}"]`);
            if (mainEngineItem) {
                selectedEngineIcon.src = mainEngineItem.getAttribute('data-icon');
            } else {
                // If it's a custom URL, default to Brave icon (or a better icon)
                selectedEngineIcon.src = "./icon/brave.svg";
            }
        }

        applySettings(settings);

        settingsBtn.addEventListener('click', () => {
            settingsPanel.classList.toggle('is-visible');
        });
        cancelSettingsBtn.addEventListener('click', () => {
            settingsPanel.classList.remove('is-visible');
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

        // Event listener for main dropdown
        engineDropdownTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            engineDropdownMenu.classList.toggle('hidden');
        });

        engineMenuItems.forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const icon = item.getAttribute('data-icon');
                selectedEngineIcon.src = icon;
                engineDropdownMenu.classList.add('hidden');
                engineSelect.value = value;
            });
        });

        // Event listener for settings radio buttons (autosave immediately)
        defaultEngineButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                defaultEngineButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const value = btn.dataset.value;
                defaultEngineCustom.style.display = (value === 'custom') ? 'block' : 'none';
                settings.engine = (value === 'custom') ? defaultEngineCustom.value : value;
                // autosave and apply immediately
                saveSettings(settings);
                applySettings(settings);
            });
        });

        // autosave when user edits custom engine input
        if (defaultEngineCustom) {
            defaultEngineCustom.addEventListener('input', () => {
                const activeBtn = document.querySelector('#defaultEngineButtons .engineBtn.active');
                if (activeBtn && activeBtn.dataset.value === 'custom') {
                    settings.engine = defaultEngineCustom.value;
                    saveSettings(settings);
                }
            });
        }

        // Close all dropdowns when clicking outside
        document.addEventListener('click', (event) => {
            if (!engineDropdownTrigger.contains(event.target) && !engineDropdownMenu.contains(event.target)) {
                engineDropdownMenu.classList.add('hidden');
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
    // Save button removed: settings are saved automatically when changed
        searchForm.addEventListener('submit', e => {
            e.preventDefault();
            const q = queryInput.value.trim();
            if (!q) return;
            // The search engine URL is now stored in settings.engine
            const url = settings.engine + encodeURIComponent(q);
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
            // filter out banned terms (case-insensitive substring match)
            const filtered = list.filter(s => {
                if (!s) return false;
                const lower = s.toLowerCase();
                return !SUGGEST_BANNED.some(term => lower.includes(term));
            });
            if (!filtered.length) {
                hideSuggestions();
                return;
            }
            filtered.forEach((s, i) => {
                const it = document.createElement('div');
                it.className = 'suggestion-item p-2 px-3 cursor-pointer text-white text-left hover:bg-white/10';
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
            const url = settings.engine + encodeURIComponent(q);
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
                    settingsPanel.classList.toggle('is-visible');
                } else if (e.key.toLowerCase() === 's') {
                    e.preventDefault();
                    settingsPanel.classList.toggle('is-visible');
                }
            }

            // close settings with Escape
            if (e.key === 'Escape') {
                if (settingsPanel.classList.contains('is-visible')) settingsPanel.classList.remove('is-visible');
            }
        });

        // populate dynamic year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>