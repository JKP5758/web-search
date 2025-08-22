<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>JKP Search Page</title>
    <meta name="description" content="Kunjugi halaman search yang lebih meanarik" />
    <link rel="icon" type="image/png/ico" href="https://jkp.my.id/assets//img//icons/favico.ico">
    <!-- Tailwind output (biarkan kalau kamu pake Tailwind build) -->
    <link href="./style.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col items-center justify-start pt-20 transition-all duration-300" data-theme="dark">
    <main class="w-full max-w-2xl p-6 text-center">
        <div id="logo" class="mb-8">
                <div class="logo-row flex items-end justify-center gap-3 mb-1">
                <!-- mascot image provided by user (wrapped so it can be hidden) -->
                <div id="mascotWrap" class="mascot relative rounded-full h-14 w-14 flex items-center justify-center overflow-hidden">
                    <img id="mascotImg" src="./icon/maskot.webp" alt="Maskot" class="w-full h-full object-cover" />
                </div>
                <h1 id="headerTitle" class="text-3xl font-semibold mb-0">Halo, Kakak ✨</h1>
            </div>
            <p id="headerSubtext" class="text-sm pt-2 opacity-80">tekan <kbd class="px-2 py-0.5 rounded-md
              bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
              shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)]">Enter</kbd> untuk mencari</p>
        </div>

        <form id="searchForm" class="flex gap-3 items-center justify-center mb-6">
            <!-- Container untuk dropdown kustom -->
            <div class="relative hidden sm:block">
                <div id="engineDropdownTrigger"
                    class="w-12 h-12 flex items-center justify-center p-2 rounded-full cursor-pointer hover:bg-white/10 transition-colors
                 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                 shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)]"
                    title="Pilih mesin pencari">
                    <img id="selectedEngineIcon" src="./icon/google.svg" alt="Google" class="w-6 h-6">
                </div>
                <ul id="engineDropdownMenu"
                    class="hidden absolute left-0 top-full mt-2 w-48 p-2 rounded-xl z-50 text-left
                 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                 shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)]">
                    <li data-value="https://www.google.com/search?q=" data-icon="./icon/google.svg"
                        class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10 flex items-center gap-2">
                        <img src="./icon/google.svg" alt="Google" class="w-6 h-6" /> Google
                    </li>
                    <li data-value="https://duckduckgo.com/?q=" data-icon="./icon/duckduckgo.svg"
                        class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10 flex items-center gap-2">
                        <img src="./icon/duckduckgo.svg" alt="DuckDuckGo" class="w-6 h-6" /> DuckDuckGo
                    </li>
                    <li data-value="https://www.bing.com/search?q=" data-icon="./icon/bing.svg"
                        class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10 flex items-center gap-2">
                        <img src="./icon/bing.svg" alt="Bing" class="w-6 h-6" /> Bing
                    </li>
                    <li data-value="https://search.brave.com/search?q=" data-icon="./icon/brave.svg"
                        class="p-2 rounded-md cursor-pointer transition-colors hover:bg-white/10 flex items-center gap-2">
                        <img src="./icon/brave.svg" alt="Brave" class="w-6 h-6" /> Brave
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

            <input id="customEngineInput"
                class="hidden p-3 flex-1 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
               shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm rounded-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all"
                placeholder="Custom engine base URL" />

            <div class="relative flex-1">
                <input id="queryInput" type="search" name="q" autocomplete="off"
                    class="py-3 px-5 w-full text-lg font-medium bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px]
                 border border-[rgba(255,255,255,0.06)] shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)]
                 placeholder:text-white/50 overflow-hidden text-ellipsis rounded-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all"
                    placeholder="Cari sesuatu..." />
                <div id="suggestions"
                    class="hidden suggestions absolute inset-x-0 top-full mt-2 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px]
                 rounded-xl shadow-xl overflow-hidden z-40 max-h-72 overflow-y-auto"></div>

                <button type="button" id="clearInput" aria-label="Clear"
                    class="hidden absolute right-14 top-1/2 -translate-y-1/2 border-0 bg-transparent text-white/70 w-7 h-7 flex items-center justify-center rounded-full cursor-pointer hover:bg-white/5 transition-colors"
                    title="Clear">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>

                <button type="submit" aria-label="Search"
                    class="w-11 h-11 flex items-center justify-center border-0 rounded-full bg-white/10 text-cyan-400 cursor-pointer hover:bg-white/20 transition-all absolute right-2 top-1/2 -translate-y-1/2"
                    title="Search">
                    <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.65" y1="16.65" x2="21" y2="21"></line>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Settings panel as a fixed overlay to prevent CLS -->
        <aside id="settingsPanel"
            class="fixed inset-0 bg-black/50 backdrop-blur-md flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200">
            <div
                class="settings-content w-full max-w-2xl p-6 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
               shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] rounded-xl text-left">
                <h2 class="font-semibold mb-3">Pengaturan</h2>
                <div class="flex items-center gap-3 mb-3">
                    <label class="flex-1 text-sm hidden">Tema</label>
                    <div class="flex gap-2 items-center">
                        <button id="toggleTheme" class="px-3 py-1 rounded-md hidden">Toggle</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Wallpaper</label>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <button data-preset="none"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Default</button>
                        <button data-preset="./bg/bg01.webp"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Wallpaper 1</button>
                        <button data-preset="./bg/bg02.webp"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Wallpaper 2</button>
                        <button data-preset="./bg/bg04.webp"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Wallpaper 3</button>
                        <button data-preset="https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?q=80&w=1400&auto=format&fit=crop&s=1"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Wallpaper 4</button>
                    </div>
                    <div class="mt-3 flex gap-2 items-center">
                        <input id="uploadBg" type="file" accept="image/*" class="text-sm hidden" />
                        <label for="uploadBg"
                            class="inline-flex items-center gap-2 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm p-2 rounded-full cursor-pointer hover:bg-white/10">📁 Pilih gambar...</label>
                        <button id="removeBg"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Remove</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Mascot</label>
                    <div class="flex flex-wrap gap-2 mt-2 items-center">
                        <button data-mascot="./icon/maskot.webp" class="mascot-preset p-0 rounded-full bg-[rgba(255,255,255,0.02)]" title="Default">
                            <img src="./icon/maskot.webp" class="w-12 h-12 rounded-full object-cover" alt="Default">
                        </button>
                        <button data-mascot="./icon/maskot2.webp" class="mascot-preset p-0 rounded-full bg-[rgba(255,255,255,0.02)]" title="Variant 1">
                            <img src="./icon/maskot2.webp" class="w-12 h-12 rounded-full object-cover" alt="Variant 1">
                        </button>
                        <button data-mascot="./icon/maskot3.webp" class="mascot-preset p-0 rounded-full bg-[rgba(255,255,255,0.02)]" title="Variant 2">
                            <img src="./icon/maskot3.webp" class="w-12 h-12 rounded-full object-cover" alt="Variant 2">
                        </button>
                        <button data-mascot="./icon/maskot4.webp" class="mascot-preset p-0 rounded-full bg-[rgba(255,255,255,0.02)]" title="Variant 2">
                            <img src="./icon/maskot4.webp" class="w-12 h-12 rounded-full object-cover" alt="Variant 2">
                        </button>
                    </div>
                    <div class="mt-3 flex gap-2 items-center">
                        <input id="uploadMascot" type="file" accept="image/*" class="text-sm hidden" />
                        <label for="uploadMascot" id="uploadMascotLabel"
                            class="inline-flex items-center gap-2 bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm p-2 rounded-full cursor-pointer hover:bg-white/10">📁 Upload mascots</label>
                        <button id="removeMascot"
                            class="p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                     shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] text-sm transition-transform hover:bg-white/10">Remove</button>
                        <div id="mascotPreviewSmall" class="ml-2 w-10 h-10 rounded-full overflow-hidden border border-[rgba(255,255,255,0.06)]"></div>
                    </div>
                    <div class="mt-2 flex items-center gap-2">
                        <input id="showMascotToggle" type="checkbox" class="hidden" />
                        <label for="showMascotToggle" class="inline-flex items-center gap-2 cursor-pointer select-none">
                            <input id="showMascotCheckboxVisual" type="checkbox" />
                            <span class="text-sm">Tampilkan maskot</span>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Header</label>
                    <div class="mt-2 flex flex-col gap-2">
                        <input id="headerTitleInput" type="text" class="p-2 rounded-full bg-[rgba(255,255,255,0.04)] text-sm" placeholder="Judul (H1)" />
                        <label class="inline-flex items-center gap-2">
                            <input id="showHeaderTitleToggle" type="checkbox" />
                            <span class="text-sm">Tampilkan judul</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input id="showHeaderSubtextToggle" type="checkbox" />
                            <span class="text-sm">Tampilkan subteks</span>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-sm">Default Search Engine</label>
                    <div id="defaultEngineButtons" class="flex flex-wrap gap-2 mt-2">
                        <button class="engineBtn relative w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full
                           bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                           shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-md"
                            data-value="https://www.google.com/search?q=">
                            <img src="./icon/google.svg" class="engine-icon w-5 h-5" alt="Google">
                        </button>
                        <button class="engineBtn relative w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full
                           bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                           shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-md"
                            data-value="https://duckduckgo.com/?q=">
                            <img src="./icon/duckduckgo.svg" class="engine-icon w-5 h-5" alt="DuckDuckGo">
                        </button>
                        <button class="engineBtn relative w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full
                           bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                           shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-md"
                            data-value="https://www.bing.com/search?q=">
                            <img src="./icon/bing.svg" class="engine-icon w-5 h-5" alt="Bing">
                        </button>
                        <button class="engineBtn relative w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full
                           bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                           shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-md"
                            data-value="https://search.brave.com/search?q=">
                            <img src="./icon/brave.svg" class="engine-icon w-5 h-5" alt="Brave">
                        </button>
                        <button class="engineBtn relative w-11 h-11 flex flex-col items-center justify-center p-1 rounded-full
                           bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                           shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] cursor-pointer transition-transform hover:-translate-y-1 hover:shadow-md"
                            data-value="custom">
                            <svg class="engine-icon w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20v-8m0 0V4m0 8h8m-8 0H4" />
                            </svg>
                        </button>
                    </div>
                    <input id="defaultEngineCustom" placeholder="Custom engine base URL"
                        class="hidden mt-2 p-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                   shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] w-full focus:outline-none focus:shadow-xl focus:border-blue-500 transition-all" />
                </div>

                <div class="flex justify-between mt-4">
                    <button id="resetBtn"
                        class="px-4 py-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                   shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] transition-transform hover:bg-white/10 text-red-500/80">Reset</button>
                    <button id="cancelSettings"
                        class="px-4 py-2 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
                   shadow-[inset_0_1px_6px_rgba(0,0,0,0.25)] transition-transform hover:bg-white/10">Close</button>
                </div>
            </div>
        </aside>
    </main>

    <!-- Floating settings button -->
    <button id="settingsBtn"
        class="fixed bottom-4 right-4 items-center flex justify-center p-3 size-10 rounded-full bg-[rgba(255,255,255,0.06)] backdrop-blur-[12px] border border-[rgba(255,255,255,0.06)]
           shadow-lg">⚙️</button>

    <footer class="mt-8 text-xs opacity-70 text-center w-full pb-4">
        © <a href="http://jkp.my.id" target="_blank" rel="noopener noreferrer">JKP</a> • <span id="year"></span> • local settings
    </footer>


    <script>
        const STORAGE_KEY = 'startpage-settings-v1';
        const defaultSettings = {
            theme: 'dark',
            engine: 'https://www.google.com/search?q=',
            wallpaper: null,
            mascot: null,
            mascotSource: 'preset',
            showMascot: true,
            headerTitle: 'Halo, Kakak ✨',
            showHeaderTitle: true,
            showHeaderSubtext: true
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

        // make saveSettings failures visible in console to diagnose issues (e.g., quota)
        const _saveSettings = saveSettings;
        saveSettings = function(obj) {
            try {
                _saveSettings(obj);
            } catch (e) {
                console.warn('[settings] saveSettings failed', e);
            }
            // also log a compact preview for debugging
            try {
                console.debug('[settings] saved preview ->', { mascot: (obj && obj.mascot) ? (typeof obj.mascot === 'string' ? (obj.mascot.slice(0, 64) + (obj.mascot.length > 64 ? '...':'') ) : obj.mascot) : null });
            } catch (e) {}
        };

    // separate mascot key (more robust small-key save)
    const MASCOT_KEY = 'startpage-mascot-v1';

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
                // fallback: try reading mascot only and merge
                try {
                    const mRaw = supportsLocalStorage() ? localStorage.getItem(MASCOT_KEY) : null;
                    const mObj = mRaw ? JSON.parse(mRaw) : null;
                    const base = { ...defaultSettings };
                    if (mObj && mObj.src) base.mascot = mObj.src;
                    return base;
                } catch (e2) {
                    return { ...defaultSettings };
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
        const presetBtns = document.querySelectorAll('[data-preset]');
        const uploadBg = document.getElementById('uploadBg');
        const removeBg = document.getElementById('removeBg');
        const queryInput = document.getElementById('queryInput');
        const searchForm = document.getElementById('searchForm');
        const clearBtn = document.getElementById('clearInput');

        const engineDropdownTrigger = document.getElementById('engineDropdownTrigger');
        const engineDropdownMenu = document.getElementById('engineDropdownMenu');
        const selectedEngineIcon = document.getElementById('selectedEngineIcon');
    const mascotImg = document.getElementById('mascotImg');
    const mascotBadge = document.getElementById('mascotBadge');
    const mascotPreviewSmall = document.getElementById('mascotPreviewSmall');
    const uploadMascot = document.getElementById('uploadMascot');
    const removeMascot = document.getElementById('removeMascot');
        const mascotWrap = document.getElementById('mascotWrap');
        const showMascotToggle = document.getElementById('showMascotToggle');
        const showMascotCheckboxVisual = document.getElementById('showMascotCheckboxVisual');
    const headerTitleEl = document.getElementById('headerTitle');
    const headerSubtextEl = document.getElementById('headerSubtext');
    const headerTitleInput = document.getElementById('headerTitleInput');
    const showHeaderTitleToggle = document.getElementById('showHeaderTitleToggle');
    const showHeaderSubtextToggle = document.getElementById('showHeaderSubtextToggle');

        // New elements for the settings radio buttons
        const defaultEngineButtons = document.getElementById('defaultEngineButtons').querySelectorAll('.engineBtn');

        let settings = loadSettings();
    console.debug('[settings] loaded ->', { mascot: settings && settings.mascot ? (typeof settings.mascot === 'string' ? (settings.mascot.slice(0,64) + (settings.mascot.length>64?'...':'')) : settings.mascot) : null });
        // if mascot missing, try to restore from MASCOT_KEY
        if (!settings.mascot) {
            try {
                const mRaw = supportsLocalStorage() ? localStorage.getItem(MASCOT_KEY) : null;
                if (mRaw) {
                    const mObj = JSON.parse(mRaw);
                    if (mObj && mObj.src) {
                        console.debug('[mascot] restoring from', MASCOT_KEY, mObj.src && (typeof mObj.src === 'string' ? mObj.src.slice(0,64) + (mObj.src.length>64?'...':'') : mObj.src));
                        settings.mascot = mObj.src;
                        settings.mascotSource = mObj.source || 'preset';
                        // do not save yet; applySettings will save when applyMascot is called
                    }
                }
            } catch (e) {
                console.warn('[mascot] restore from MASCOT_KEY failed', e);
            }
        }

        // suggestions filtering: terms to block from appearing in Google Suggest
        const SUGGEST_BANNED = [
            'gacor', 'slot', 'bet', 'jackpot', 'casino', 'judi', 'togel', 'rtp', 'judi',
            'qq', 'judol', '88', '77', '99', '11', 'zeus', 'gates', 'hoki', 'win', 'toto'
        ];

        // Suggestion history (local only)
        const HISTORY_KEY = 'startpage-suggest-history-v1';
        const HISTORY_LIMIT = 40;

        function loadHistory() {
            try {
                if (supportsLocalStorage()) {
                    const raw = localStorage.getItem(HISTORY_KEY);
                    const parsed = raw ? JSON.parse(raw) : [];
                    console.debug('[history] loadHistory ->', parsed && parsed.length ? parsed.slice(0, 10) : parsed);
                    return parsed;
                } else {
                    const match = document.cookie.match(new RegExp('(^| )' + HISTORY_KEY + '=([^;]+)'));
                    const parsed = match ? JSON.parse(decodeURIComponent(match[2])) : [];
                    console.debug('[history] loadHistory (cookie) ->', parsed && parsed.length ? parsed.slice(0, 10) : parsed);
                    return parsed;
                }
            } catch (e) {
                console.warn('[history] loadHistory failed', e);
                return [];
            }
        }

        function saveHistory(arr) {
            try {
                const dump = JSON.stringify(arr);
                if (supportsLocalStorage()) localStorage.setItem(HISTORY_KEY, dump);
                else document.cookie = HISTORY_KEY + '=' + encodeURIComponent(dump) + ';path=/;max-age=' + (60 * 60 * 24 * 365);
                console.debug('[history] saveHistory -> length:', (arr || []).length, 'preview:', (arr || []).slice(0, 8));
            } catch (e) {}
        }

        let suggestHistory = loadHistory();

        function addToHistory(q) {
            try {
                q = (q || '').trim();
                if (!q) return;
                // remove duplicates (case-insensitive)
                const lower = q.toLowerCase();
                suggestHistory = suggestHistory.filter(item => item.toLowerCase() !== lower);
                suggestHistory.unshift(q);
                if (suggestHistory.length > HISTORY_LIMIT) suggestHistory.length = HISTORY_LIMIT;
                saveHistory(suggestHistory);
                console.debug('[history] addToHistory ->', q);
            } catch (e) {}
        }

        function removeHistoryItem(idx) {
            try {
                if (typeof idx === 'number') {
                    console.debug('[history] removeHistoryItem by index ->', idx, suggestHistory[idx]);
                    suggestHistory.splice(idx, 1);
                } else {
                    const val = (idx || '').toString().trim();
                    console.debug('[history] removeHistoryItem by value ->', val);
                    // remove case-insensitive and trimmed
                    suggestHistory = suggestHistory.filter(item => item.toString().trim().toLowerCase() !== val.toLowerCase());
                }
                saveHistory(suggestHistory);
            } catch (e) {
                console.warn('[history] removeHistoryItem failed', e);
            }
        }

        function clearHistory() {
            suggestHistory = [];
            saveHistory(suggestHistory);
            console.debug('[history] clearHistory -> cleared');
            hideSuggestions();
        }

        function applyTheme(theme) {
            body.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                body.classList.remove('light-theme');
                body.style.color = 'white';
                body.style.backgroundColor = '#0b1020'
            } else {
                body.classList.add('light-theme');
                body.style.color = '#0b1020';
                body.style.backgroundColor = '#f3f4f6'
            }
        }

        function applyWallpaper(wallpaper) {
            if (wallpaper) {
                body.style.backgroundImage = `url('${wallpaper}')`;
                // make sure the background image covers the viewport and is centered
                body.style.backgroundSize = 'cover';
                body.style.backgroundPosition = 'center center';
                body.style.backgroundRepeat = 'no-repeat';
                // keep background fixed so it doesn't scroll with content
                body.style.backgroundAttachment = 'fixed';
            } else {
                body.style.backgroundImage = '';
                body.style.backgroundSize = '';
                body.style.backgroundPosition = '';
                body.style.backgroundRepeat = '';
                body.style.backgroundAttachment = '';
            }
        }

        // helper to visually mark an engine button active (adds small check element + shadow)
        function setEngineBtnActive(btn, isActive) {
            if (isActive) {
                btn.classList.add('shadow-[0_10px_28px_rgba(59,130,246,0.16)]', 'border-[rgba(59,130,246,0.7)]', 'scale-105', '-translate-y-1.5');
                if (!btn.querySelector('.engine-check')) {
                    const span = document.createElement('span');
                    span.className = 'engine-check absolute top-1 right-1 bg-[rgba(59,130,246,0.95)] text-white w-4 h-4 rounded-full flex items-center justify-center text-[11px]';
                    span.textContent = '✓';
                    btn.appendChild(span);
                }
            } else {
                btn.classList.remove('shadow-[0_10px_28px_rgba(59,130,246,0.16)]', 'border-[rgba(59,130,246,0.7)]', 'scale-105', '-translate-y-1.5');
                const c = btn.querySelector('.engine-check');
                if (c) c.remove();
            }
        }

        function applySettings(s) {
            applyTheme(s.theme);
            applyWallpaper(s.wallpaper);
            // apply header text & visibility
            applyHeaderSettings(s);
            // show/hide mascot
            applyShowMascot(s.showMascot === undefined ? true : s.showMascot);
            // apply mascot if present
            if (s.mascot) applyMascot(s.mascot, s.mascotSource || 'preset');
            // when using dropdown, set selected value and custom input
            const known = ['https://www.google.com/search?q=', 'https://duckduckgo.com/?q=', 'https://www.bing.com/search?q=', 'https://search.brave.com/search?q='];
            const matched = known.includes(s.engine) ? s.engine : 'custom';
            engineSelect.value = matched === 'custom' ? 'custom' : matched;
            if (matched === 'custom') {
                customEngineInput.classList.remove('hidden');
                customEngineInput.value = s.engine
            } else customEngineInput.classList.add('hidden');

            // Update settings radio buttons (visual active)
            defaultEngineButtons.forEach(btn => {
                setEngineBtnActive(btn, false);
                if (btn.dataset.value === s.engine || (btn.dataset.value === 'custom' && !known.includes(s.engine))) {
                    setEngineBtnActive(btn, true);
                    if (btn.dataset.value === 'custom') {
                        defaultEngineCustom.classList.remove('hidden');
                        defaultEngineCustom.value = s.engine;
                    } else {
                        defaultEngineCustom.classList.add('hidden');
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

        function applyMascot(src, source) {
            try {
                if (mascotImg) mascotImg.src = src || './icon/maskot.webp';
                // small preview (if present)
                if (typeof mascotPreviewSmall !== 'undefined' && mascotPreviewSmall && mascotPreviewSmall.nodeType === 1) {
                    try {
                        mascotPreviewSmall.innerHTML = '';
                        const im = document.createElement('img');
                        im.src = src || './icon/maskot.webp';
                        im.className = 'w-full h-full object-cover';
                        mascotPreviewSmall.appendChild(im);
                    } catch (e) {
                        console.warn('[mascot] preview update failed', e);
                    }
                }
                // badge (preset or custom) if available
                if (typeof mascotBadge !== 'undefined' && mascotBadge && mascotBadge.nodeType === 1) {
                    mascotBadge.textContent = source === 'custom' ? 'custom' : 'preset';
                }
                settings.mascot = src;
                settings.mascotSource = source;
                try { saveSettings(settings); console.debug('[mascot] saved to settings'); } catch (e) { console.warn('[mascot] save to settings failed', e); }
                // also save a small copy under a dedicated key to make persistence more robust
                try {
                    if (supportsLocalStorage()) localStorage.setItem(MASCOT_KEY, JSON.stringify({ src: src, source: source }));
                    console.debug('[mascot] saved to', MASCOT_KEY);
                } catch (e) { console.warn('[mascot] failed saving to MASCOT_KEY', e); }
                // update preset active state
                markActivePreset(src, source);
            } catch (e) {
                console.warn('applyMascot failed', e);
            }
        }

            function applyShowMascot(show) {
                try {
                    const shouldShow = !!show;
                    if (mascotWrap) mascotWrap.style.display = shouldShow ? '' : 'none';
                    // keep the visual checkbox in sync
                    if (typeof showMascotCheckboxVisual !== 'undefined' && showMascotCheckboxVisual) showMascotCheckboxVisual.checked = shouldShow;
                    settings.showMascot = shouldShow;
                    saveSettings(settings);
                    console.debug('[settings] applyShowMascot ->', shouldShow);
                } catch (e) {
                    console.warn('applyShowMascot failed', e);
                }
            }

        function markActivePreset(src, source) {
            const presets = document.querySelectorAll('.mascot-preset');
            presets.forEach(p => {
                const psrc = p.getAttribute('data-mascot');
                if (source === 'custom') {
                    p.style.outline = '';
                } else {
                    if (psrc === src) {
                        p.style.outline = '3px solid rgba(34,211,238,0.36)';
                        p.style.outlineOffset = '3px';
                    } else {
                        p.style.outline = '';
                    }
                }
            });
        }

        function applyHeaderSettings(s) {
            try {
                // prefer explicit headerTitle value (even empty string). Only use default when undefined.
                const title = (s && Object.prototype.hasOwnProperty.call(s, 'headerTitle')) ? s.headerTitle : defaultSettings.headerTitle;
                let showTitle = typeof s.showHeaderTitle === 'undefined' ? true : !!s.showHeaderTitle;
                // if the title is intentionally empty, hide the header automatically
                if (!title || !String(title).trim()) {
                    showTitle = false;
                }
                const showSub = typeof s.showHeaderSubtext === 'undefined' ? true : !!s.showHeaderSubtext;

                if (headerTitleEl) {
                    headerTitleEl.textContent = title;
                    headerTitleEl.style.display = showTitle ? '' : 'none';
                }
                if (headerSubtextEl) headerSubtextEl.style.display = showSub ? '' : 'none';

                // keep controls in settings panel in sync
                if (headerTitleInput) headerTitleInput.value = title;
                if (showHeaderTitleToggle) showHeaderTitleToggle.checked = showTitle;
                if (showHeaderSubtextToggle) showHeaderSubtextToggle.checked = showSub;

                // persist into settings object if provided
                settings.headerTitle = title;
                settings.showHeaderTitle = showTitle;
                settings.showHeaderSubtext = showSub;
                saveSettings(settings);
                console.debug('[settings] applyHeaderSettings ->', { title, showTitle, showSub });
            } catch (e) {
                console.warn('applyHeaderSettings failed', e);
            }
        }

        // Settings panel toggle (use Tailwind classes for visibility)
        settingsBtn.addEventListener('click', () => {
            const isOpen = settingsPanel.classList.contains('opacity-100');
            if (isOpen) {
                settingsPanel.classList.remove('opacity-100', 'pointer-events-auto');
                settingsPanel.classList.add('opacity-0', 'pointer-events-none');
            } else {
                settingsPanel.classList.add('opacity-100', 'pointer-events-auto');
                settingsPanel.classList.remove('opacity-0', 'pointer-events-none');
            }
        });
        cancelSettingsBtn.addEventListener('click', () => {
            settingsPanel.classList.remove('opacity-100', 'pointer-events-auto');
            settingsPanel.classList.add('opacity-0', 'pointer-events-none');
        });
        resetBtn.addEventListener('click', () => {
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
            saveSettings(settings);
        });

        // Event listener for main dropdown
        engineDropdownTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            engineDropdownMenu.classList.toggle('hidden');
        });

        engineDropdownMenu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const icon = item.getAttribute('data-icon');
                selectedEngineIcon.src = icon;
                engineDropdownMenu.classList.add('hidden');
                engineSelect.value = value;
                settings.engine = value;
                saveSettings(settings);
            });
        });

        // Event listener for settings radio buttons (autosave immediately)
        defaultEngineButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                defaultEngineButtons.forEach(b => setEngineBtnActive(b, false));
                setEngineBtnActive(btn, true);
                const value = btn.dataset.value;
                if (value === 'custom') {
                    defaultEngineCustom.classList.remove('hidden');
                    settings.engine = defaultEngineCustom.value || '';
                } else {
                    defaultEngineCustom.classList.add('hidden');
                    settings.engine = value;
                }
                // autosave and apply immediately
                saveSettings(settings);
                applySettings(settings);
            });
        });

        // autosave when user edits custom engine input
        if (defaultEngineCustom) {
            defaultEngineCustom.addEventListener('input', () => {
                const activeBtn = document.querySelector('#defaultEngineButtons .engineBtn');
                // find the active one by checking for engine-check badge
                const active = Array.from(defaultEngineButtons).find(b => b.querySelector('.engine-check'));
                if (active && active.dataset.value === 'custom') {
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

        // mascot presets wiring
        const mascotPresets = document.querySelectorAll('.mascot-preset');
        if (mascotPresets && mascotPresets.length) {
            mascotPresets.forEach(b => {
                b.addEventListener('click', () => {
                    const src = b.getAttribute('data-mascot');
                    applyMascot(src, 'preset');
                });
            });
        }

        if (typeof uploadMascot !== 'undefined' && uploadMascot && uploadMascot.addEventListener) {
            uploadMascot.addEventListener('change', e => {
                const f = e.target.files && e.target.files[0];
                if (!f) return;
                if (f.size > 2_000_000) {
                    if (!confirm('Gambar maskot >2MB, lanjut?')) return;
                }
                const reader = new FileReader();
                reader.onload = () => {
                    applyMascot(reader.result, 'custom');
                };
                reader.readAsDataURL(f);
            });
        }

        if (typeof removeMascot !== 'undefined' && removeMascot && removeMascot.addEventListener) {
            removeMascot.addEventListener('click', () => {
                if (!confirm('Remove custom mascot and revert to default?')) return;
                settings.mascot = null;
                settings.mascotSource = 'preset';
                applyMascot('./icon/maskot.webp', 'preset');
                saveSettings(settings);
            });
        }

        // show/hide mascot toggle (visual checkbox)
        if (typeof showMascotCheckboxVisual !== 'undefined' && showMascotCheckboxVisual) {
            // initialize visual checkbox state
            showMascotCheckboxVisual.checked = settings.showMascot === undefined ? true : !!settings.showMascot;
            showMascotCheckboxVisual.addEventListener('change', (e) => {
                applyShowMascot(!!e.target.checked);
            });
        }

        // Header controls wiring
        if (headerTitleInput) {
            headerTitleInput.value = (typeof settings.headerTitle === 'undefined' || settings.headerTitle === null) ? defaultSettings.headerTitle : settings.headerTitle;
            headerTitleInput.addEventListener('input', (e) => {
                const v = e.target.value;
                settings.headerTitle = v;
                // if user cleared the input, auto-uncheck the show title toggle
                if (!v || !v.trim()) {
                    settings.showHeaderTitle = false;
                }
                applyHeaderSettings(settings);
            });
        }
        if (showHeaderTitleToggle) {
            showHeaderTitleToggle.checked = settings.showHeaderTitle === undefined ? true : !!settings.showHeaderTitle;
            showHeaderTitleToggle.addEventListener('change', (e) => {
                const checked = !!e.target.checked;
                // if re-checking while title is empty, restore default title
                if (checked && (!settings.headerTitle || !String(settings.headerTitle).trim())) {
                    settings.headerTitle = defaultSettings.headerTitle;
                }
                settings.showHeaderTitle = checked;
                applyHeaderSettings(settings);
            });
        }
        if (showHeaderSubtextToggle) {
            showHeaderSubtextToggle.checked = settings.showHeaderSubtext === undefined ? true : !!settings.showHeaderSubtext;
            showHeaderSubtextToggle.addEventListener('change', (e) => {
                settings.showHeaderSubtext = !!e.target.checked;
                applyHeaderSettings(settings);
            });
        }

        // Save button removed: settings are saved automatically when changed
        // Use submitSearch so queries are saved to history first
        searchForm.addEventListener('submit', e => {
            e.preventDefault();
            submitSearch();
        });

        // clear button behaviour
        queryInput.addEventListener('input', () => {
            if (queryInput.value) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
            scheduleSuggest(queryInput.value);
        });
        clearBtn.addEventListener('click', () => {
            queryInput.value = '';
            clearBtn.classList.add('hidden');
            queryInput.focus();
            hideSuggestions();
        });

        // Suggestions: JSONP to Google suggest
        const suggestionsEl = document.getElementById('suggestions');
        let suggestTimer = null;
        let currentScript = null;
        let activeIndex = -1;
        // when true, mouse hover handlers should ignore visual hover so keyboard nav wins
        let suppressMouseHover = false;
        let suppressMouseHoverTimer = null;

        function removeAllHighlights() {
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            items.forEach(it => {
                // remove visual highlighting (clear inline styles and classes)
                it.style.background = '';
                it.style.boxShadow = '';
                it.style.transform = '';
                it.style.color = '';
                it.style.transition = '';
                it.removeAttribute('aria-selected');
            });
        }

        function highlightOnly(i, opts) {
            opts = opts || {};
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            if (!items || !items.length) return;
            removeAllHighlights();
            const chosen = items[i];
            if (!chosen) return;
            // apply a non-shifting left accent and subtle background using inline styles
            chosen.style.transition = 'background 160ms ease, box-shadow 160ms ease, color 160ms ease';
            chosen.style.background = 'linear-gradient(90deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01))';
            chosen.style.boxShadow = 'inset 4px 0 0 0 rgba(34,211,238,0.14)';
            chosen.style.color = '#9ef0ff';
            chosen.setAttribute('aria-selected', 'true');
            activeIndex = i;
            if (opts.focus) {
                try {
                    queryInput.focus();
                    const len = queryInput.value.length;
                    queryInput.setSelectionRange(len, len);
                } catch (e) {}
            }
        }

        function scheduleSuggest(q) {
            if (suggestTimer) clearTimeout(suggestTimer);
            console.debug('[suggest] scheduleSuggest ->', q);
            if (!q) {
                // if empty, show local history (if any) instead of hiding
                if (suggestHistory && suggestHistory.length) {
                    // render history-only suggestions
                    suggestTimer = setTimeout(() => renderSuggestions([]), 80);
                    return;
                }
                hideSuggestions();
                return;
            }
            suggestTimer = setTimeout(() => fetchSuggest(q), 160);
        }

        function fetchSuggest(q) {
            // cleanup previous
            if (currentScript) {
                try {
                    document.head.removeChild(currentScript);
                } catch (e) {}
                currentScript = null;
            }
            const cbName = 'gSuggestCB_' + Date.now();
            console.debug('[suggest] fetchSuggest ->', q, 'callback:', cbName);
            window[cbName] = function(data) {
                try {
                    console.debug('[suggest] JSONP cb', cbName, 'raw:', data && data[1] ? data[1].slice(0, 8) : data);
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
            console.debug('[suggest] renderSuggestions remoteCount=', Array.isArray(list) ? list.length : 0, 'historyCount=', suggestHistory.length);
            suggestionsEl.innerHTML = '';
            activeIndex = -1;


            // Build a unified list: local history first (if any), then remote suggestions
            const items = [];
            const q = (queryInput && queryInput.value) ? queryInput.value.trim().toLowerCase() : '';
            if (suggestHistory && suggestHistory.length) {
                suggestHistory.forEach(h => {
                    // only include history items that match the current query (substring),
                    // unless the query is empty (show all history)
                    if (!q || h.toLowerCase().includes(q)) items.push({
                        type: 'history',
                        text: h
                    });
                });
            }

            if (Array.isArray(list) && list.length) {
                list.forEach(s => {
                    // remote suggestions are generally already relevant; optionally filter by q too
                    if (!q || s.toLowerCase().includes(q)) items.push({
                        type: 'remote',
                        text: s
                    });
                });
            }

            // filter and dedupe while preserving order; also skip banned terms
            const seen = new Set();
            const final = [];
            items.forEach(it => {
                const s = (it.text || '').trim();
                if (!s) return;
                const lower = s.toLowerCase();
                if (SUGGEST_BANNED.some(term => lower.includes(term))) return;
                if (seen.has(lower)) return;
                seen.add(lower);
                final.push(it);
            });

            if (!final.length) {
                hideSuggestions();
                return;
            }

            final.forEach((entry, i) => {
                const row = document.createElement('div');
                row.setAttribute('role', 'option');
                row.dataset.index = i;
                // remove CSS :hover reliance and manage highlight exclusively via JS
                row.className = 'suggestion-item flex items-center justify-between p-2 px-3 cursor-pointer text-white text-left';

                const left = document.createElement('div');
                left.className = 'flex-1 text-left';
                left.textContent = entry.text;
                left.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    selectSuggestion(i);
                    // add to history before navigating
                    addToHistory(entry.text);
                    submitSearch();
                });

                // keep hover/active visual exclusive: when mouse moves over an item set highlight
                row.addEventListener('mouseenter', (ev) => {
                    // if keyboard nav recently used, ignore mouse hover so keyboard selection stays visible
                    if (suppressMouseHover) return;
                    highlightOnly(i, {
                        focus: false
                    });
                });
                row.addEventListener('mouseleave', (ev) => {
                    // only clear if this row is not the active keyboard-selected one
                    if (activeIndex === i) return;
                    // clear inline styles used by highlightOnly
                    row.style.background = '';
                    row.style.boxShadow = '';
                    row.style.color = '';
                    row.style.transition = '';
                    row.removeAttribute('aria-selected');
                });

                const right = document.createElement('div');
                right.className = 'flex items-center gap-2';

                if (entry.type === 'history') {
                    // delete button for history item
                    const del = document.createElement('button');
                    del.type = 'button';
                    del.className = 'text-xs text-red-300 px-2 py-1 rounded hover:bg-white/5';
                    del.textContent = 'hapus';
                    del.addEventListener('mousedown', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        console.debug('[ui] delete history mousedown ->', entry.text);
                        // remove by value
                        removeHistoryItem(entry.text);
                        // re-render using same remote list
                        renderSuggestions(list);
                    });
                    right.appendChild(del);
                }

                row.appendChild(left);
                row.appendChild(right);
                suggestionsEl.appendChild(row);
            });

            // add clear history control if we have history
            if (suggestHistory && suggestHistory.length) {
                const clearRow = document.createElement('div');
                clearRow.className = 'p-2 px-3 text-xs text-center text-white/70 hover:bg-white/5 cursor-pointer';
                clearRow.textContent = 'Clear suggestion history';
                clearRow.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    console.debug('[ui] clear history mousedown');
                    if (confirm('Clear all suggestion history?')) {
                        clearHistory();
                        renderSuggestions(list);
                    }
                });
                suggestionsEl.appendChild(clearRow);
            }

            suggestionsEl.classList.remove('hidden');
        }

        function hideSuggestions() {
            suggestionsEl.classList.add('hidden');
            suggestionsEl.innerHTML = '';
            activeIndex = -1;
        }

        function selectSuggestion(i) {
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            if (!items.length) return;
            // remove highlight from all
            items.forEach(it => {
                it.classList.remove('bg-white/10', 'text-cyan-200', 'scale-105');
                it.removeAttribute('aria-selected');
            });
            const chosen = items[i];
            if (!chosen) return;
            // add highlight classes (Tailwind utilities)
            chosen.classList.add('bg-white/10', 'text-cyan-200', 'scale-105');
            chosen.setAttribute('aria-selected', 'true');
            activeIndex = i;
            // chosen may contain child nodes (delete button). Use left text node
            const left = chosen.querySelector('div') || chosen;
            queryInput.value = left.textContent.trim();
            // keep caret visible and focused in the input when navigating via keyboard
            try {
                queryInput.focus();
                const len = queryInput.value.length;
                // place caret at end
                queryInput.setSelectionRange(len, len);
            } catch (e) {
                // ignore if not supported
            }
        }

        function submitSearch() {
            const q = queryInput.value.trim();
            if (!q) return;
            // save to local suggest history first
            addToHistory(q);
            console.debug('[search] submitSearch ->', q);
            const url = settings.engine + encodeURIComponent(q);
            window.location.href = url;
        }

        // keyboard navigation
        queryInput.addEventListener('keydown', (e) => {
            const items = suggestionsEl.querySelectorAll('.suggestion-item');
            // Ensure the input keeps focus while using keyboard arrows even if the mouse is over
            // the suggestion panel (prevents the caret from disappearing)
            try {
                queryInput.focus();
            } catch (e) {}

            if (!suggestionsEl.classList.contains('hidden') && items.length) {
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    // keyboard nav: highlight via JS and suppress mouse hover briefly
                    const next = (activeIndex + 1) % items.length;
                    highlightOnly(next, { focus: true });
                    suppressMouseHover = true;
                    if (suppressMouseHoverTimer) clearTimeout(suppressMouseHoverTimer);
                    suppressMouseHoverTimer = setTimeout(() => { suppressMouseHover = false; }, 300);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    const prev = (activeIndex - 1 + items.length) % items.length;
                    highlightOnly(prev, { focus: true });
                    suppressMouseHover = true;
                    if (suppressMouseHoverTimer) clearTimeout(suppressMouseHoverTimer);
                    suppressMouseHoverTimer = setTimeout(() => { suppressMouseHover = false; }, 300);
                } else if (e.key === 'Enter') {
                    if (activeIndex >= 0) {
                        e.preventDefault();
                        // if enter pressed after keyboard nav, ensure the selected item is used
                        // update queryInput from active item (already done by highlightOnly via focus)
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
        // Show history on focus when input is empty
        queryInput.addEventListener('focus', () => {
            console.debug('[input] focus, value=', queryInput.value);
            if (!queryInput.value.trim() && suggestHistory && suggestHistory.length) {
                renderSuggestions([]);
            }
        });
        window.addEventListener('load', () => {
            queryInput.focus()
        });

        // Ensure we persist the latest settings before the page unloads — helps when localStorage is quota-sensitive
        window.addEventListener('beforeunload', () => {
            try {
                saveSettings(settings);
                console.debug('[settings] beforeunload saved settings');
            } catch (e) {
                console.warn('[settings] beforeunload save failed', e);
            }
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
                    const isOpen = settingsPanel.classList.contains('opacity-100');
                    if (isOpen) {
                        settingsPanel.classList.remove('opacity-100', 'pointer-events-auto');
                        settingsPanel.classList.add('opacity-0', 'pointer-events-none');
                    } else {
                        settingsPanel.classList.add('opacity-100', 'pointer-events-auto');
                        settingsPanel.classList.remove('opacity-0', 'pointer-events-none');
                    }
                } else if (e.key.toLowerCase() === 's') {
                    e.preventDefault();
                    const isOpen = settingsPanel.classList.contains('opacity-100');
                    if (isOpen) {
                        settingsPanel.classList.remove('opacity-100', 'pointer-events-auto');
                        settingsPanel.classList.add('opacity-0', 'pointer-events-none');
                    } else {
                        settingsPanel.classList.add('opacity-100', 'pointer-events-auto');
                        settingsPanel.classList.remove('opacity-0', 'pointer-events-none');
                    }
                }
            }

            // close settings with Escape
            if (e.key === 'Escape') {
                if (settingsPanel.classList.contains('opacity-100')) settingsPanel.classList.remove('opacity-100', 'pointer-events-auto');
            }
        });

        // populate dynamic year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    // debug panel removed
    </script>
</body>

</html>