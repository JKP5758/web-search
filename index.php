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
            border: 1px solid rgba(255,255,255,0.06);
            box-shadow: inset 0 1px 6px rgba(0,0,0,0.25);
        }

        [data-theme="light"] .glass {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(15,23,42,0.06);
            box-shadow: inset 0 1px 6px rgba(255,255,255,0.6);
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
        input:focus, select:focus, textarea:focus, button:focus {
            outline: none;
            box-shadow: 0 6px 18px rgba(2,6,23,0.12);
            border-color: rgba(59,130,246,0.6); /* subtle blue accent */
        }

        /* make .glass children slightly inset for 3d feel */
        .glass > * {
            box-shadow: inset 0 0 0 rgba(0,0,0,0);
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
            border-radius: 0.75rem;
        }
        /* hide IE/Edge expand arrow */
        select.glass::-ms-expand { display: none; }

        /* file input: hide native control and use themed label */
        input[type="file"] { display: none; }
        .file-label {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem .75rem;
            cursor: pointer;
        }

        /* subtle preset button hover */
        .presetBtn {
            border: 1px solid rgba(255,255,255,0.04);
            box-shadow: inset 0 -8px 12px rgba(0,0,0,0.18);
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
            <select id="engineSelect" class="appearance-none p-3 w-12 h-12 glass flex items-center justify-center text-center">
                <option value="https://www.google.com/search?q=" selected>🌐</option>
                <option value="https://duckduckgo.com/?q=">🦆</option>
                <option value="https://www.bing.com/search?q=">🅱️</option>
                <option value="https://search.brave.com/search?q=">🦁</option>
                <option value="custom">✏️</option>
            </select>

            <input id="customEngineInput" class="p-3 flex-1 glass text-sm" placeholder="Custom engine base URL" style="display:none;" />

            <input id="queryInput" type="search" name="q" autocomplete="off" class="p-3 flex-1 text-lg font-medium glass placeholder:text-white/50" placeholder="Cari sesuatu..." />

            <button type="submit" class="p-3 w-12 h-12 glass">🔎</button>
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
                    <button data-preset="none" class="presetBtn p-2 rounded glass text-sm">Default</button>
                    <button data-preset="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded glass text-sm">Preset 1</button>
                    <button data-preset="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1400&auto=format&fit=crop&s=1" class="presetBtn p-2 rounded glass text-sm">Preset 2</button>
                </div>
                <div class="mt-3 flex gap-2 items-center">
                    <input id="uploadBg" type="file" accept="image/*" class="text-sm" />
                    <label for="uploadBg" class="file-label glass text-sm p-2 rounded">📁 Pilih gambar...</label>
                    <button id="removeBg" class="p-2 rounded glass text-sm">Remove</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-sm">Default Search Engine</label>
                <div class="mt-2 text-sm">
                    <select id="defaultEngine" class="p-2 rounded glass w-full">
                        <option value="https://www.google.com/search?q=">Google</option>
                        <option value="https://duckduckgo.com/?q=">DuckDuckGo</option>
                        <option value="https://www.bing.com/search?q=">Bing</option>
                        <option value="custom">Custom...</option>
                    </select>
                    <input id="defaultEngineCustom" placeholder="Custom engine base URL" class="mt-2 p-2 rounded glass w-full" style="display:none;" />
                </div>
            </div>

            <div class="flex gap-2 mt-4">
                <button id="saveSettings" class="px-4 py-2 rounded glass">Save</button>
                <button id="cancelSettings" class="px-4 py-2 rounded glass">Close</button>
                <button id="resetBtn" class="px-4 py-2 rounded glass text-red-500">Reset</button>
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
            engineSelect.value = ['https://www.google.com/search?q=', 'https://duckduckgo.com/?q=', 'https://www.bing.com/search?q=', 'https://search.brave.com/search?q='].includes(s.engine) ? s.engine : 'custom';
            if (engineSelect.value === 'custom') {
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
            customEngineInput.style.display = e.target.value === 'custom' ? 'block' : 'none'
        });
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
            if (!['INPUT','TEXTAREA','SELECT'].includes(activeTag)) {
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
            if (document.body.getAttribute('data-theme') === 'dark') s.style.backgroundColor = 'transparent';
            else s.style.backgroundColor = 'transparent';
        }
        // run on load and whenever theme changes via toggle
        fixSelectTheme();
    </script>
</body>

</html>