<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'SAPA SOSIAL' }} — Dinas Sosial Kabupaten Blitar</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#93000b",
                        "primary-container": "#b91c1c",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#ffcdc7",
                        "primary-fixed": "#ffdad6",
                        "primary-fixed-dim": "#ffb4ab",
                        "on-primary-fixed": "#410002",
                        "on-primary-fixed-variant": "#93000b",
                        "secondary": "#855300",
                        "secondary-container": "#fea619",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#684000",
                        "secondary-fixed": "#ffddb8",
                        "secondary-fixed-dim": "#ffb95f",
                        "on-secondary-fixed": "#2a1700",
                        "on-secondary-fixed-variant": "#653e00",
                        "tertiary": "#003ea8",
                        "tertiary-container": "#0053db",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#cdd7ff",
                        "tertiary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#b4c5ff",
                        "on-tertiary-fixed": "#00174b",
                        "on-tertiary-fixed-variant": "#003ea8",
                        "background": "#f9f9f9",
                        "surface": "#f9f9f9",
                        "surface-dim": "#dadada",
                        "surface-bright": "#f9f9f9",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f3f3",
                        "surface-container": "#eeeeee",
                        "surface-container-high": "#e8e8e8",
                        "surface-container-highest": "#e2e2e2",
                        "on-surface": "#1a1c1c",
                        "on-surface-variant": "#5b403d",
                        "inverse-surface": "#2f3131",
                        "inverse-on-surface": "#f0f1f1",
                        "outline": "#8f6f6c",
                        "outline-variant": "#e4beb9",
                        "surface-tint": "#b91c1c",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "space-md": "1rem",
                        "space-lg": "1.5rem",
                        "space-xl": "2rem",
                        "space-2xl": "3rem",
                        "margin": "1rem",
                        "margin-tablet": "1.5rem",
                        "margin-desktop": "2.5rem"
                    },
                    fontFamily: {
                        "sans": ["Inter", "sans-serif"],
                        "inter": ["Inter", "sans-serif"]
                    }
                }
            }
        };
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
        }
        .material-symbols-outlined.fill-1 {
            font-variation-settings: 'FILL' 1;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-background text-on-surface antialiased flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false }">
    <!-- Top Crimson Accent Bar -->
    <div class="fixed top-0 left-0 right-0 h-1 bg-primary-container z-50"></div>

    <!-- Navigation Header -->
    <header class="fixed top-1 left-0 right-0 z-40 bg-surface-container-lowest/95 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)] border-b border-outline-variant/30">
        <div class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 60" width="165" height="42" fill="none">
                    <rect x="4" y="8" width="44" height="44" rx="12" fill="#B91C1C"/>
                    <path d="M26 19 C22 15 16 18 16 23 C16 28 26 35 26 35 C26 35 36 28 36 23 C36 18 30 15 26 19 Z" fill="#F59E0B" />
                    <path d="M19 32 C17 34 16 37 18 39 C20 41 24 40 26 38 C28 40 32 41 34 39 C36 37 35 34 33 32" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    <text x="56" y="29" font-family="'Inter', system-ui, sans-serif" font-size="20" font-weight="800" fill="#B91C1C" letter-spacing="-0.5">SAPA SOSIAL</text>
                    <text x="56" y="44" font-family="'Inter', system-ui, sans-serif" font-size="10.5" font-weight="600" fill="#6B7280" letter-spacing="0.2">KABUPATEN BLITAR</text>
                </svg>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Beranda
                </a>
                <a href="{{ route('layanan.index') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('layanan.*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Layanan
                </a>
                <a href="{{ route('pengaduan') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('pengaduan') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Pengaduan
                </a>
                <a href="{{ route('cek-status') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('cek-status') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Cek Status
                </a>
                <a href="{{ route('verifikasi') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('verifikasi') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Verifikasi SK
                </a>
                <a href="{{ route('informasi') }}" 
                   class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('informasi') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">
                    Informasi & FAQ
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('akun-saya') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-on-surface bg-surface-container hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-primary">account_circle</span>
                        <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-3.5 py-2 rounded-lg text-sm font-medium text-on-surface bg-surface-container hover:bg-surface-container-high transition-colors">
                        Masuk
                    </a>
                @endauth

                <a href="{{ route('pengajuan') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold bg-primary-container text-on-primary hover:bg-primary transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">add_circle</span>
                    <span class="hidden sm:inline">Ajukan Layanan</span>
                </a>

                <a href="/admin" title="Masuk Portal Petugas / Admin" class="hidden md:inline-flex items-center justify-center w-9 h-9 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                </a>

                <!-- Mobile menu toggle -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg text-on-surface-variant hover:bg-surface-container">
                    <span class="material-symbols-outlined text-[24px]" x-show="!mobileMenuOpen">menu</span>
                    <span class="material-symbols-outlined text-[24px]" x-show="mobileMenuOpen" style="display:none;">close</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="lg:hidden border-t border-outline-variant/30 bg-surface-container-lowest px-4 py-3 space-y-1 shadow-lg" x-show="mobileMenuOpen" style="display:none;">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Beranda
            </a>
            <a href="{{ route('layanan.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('layanan.*') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Katalog Layanan
            </a>
            <a href="{{ route('pengaduan') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('pengaduan') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Pengaduan Sosial
            </a>
            <a href="{{ route('cek-status') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('cek-status') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Cek Status Tiket
            </a>
            <a href="{{ route('verifikasi') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('verifikasi') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Verifikasi SK DTSEN
            </a>
            <a href="{{ route('informasi') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('informasi') ? 'bg-primary-container text-on-primary' : 'text-on-surface hover:bg-surface-container' }}">
                Informasi & FAQ
            </a>
            <div class="pt-2 border-t border-outline-variant/30 flex items-center justify-between">
                <a href="/admin" class="text-xs text-on-surface-variant hover:text-primary flex items-center gap-1 py-1">
                    <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span>
                    Portal Petugas
                </a>
                <a href="{{ route('akun-saya') }}" class="text-xs text-primary font-semibold flex items-center gap-1 py-1">
                    <span class="material-symbols-outlined text-[16px]">person</span>
                    Akun Saya
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Stage -->
    <main class="w-full pt-20 bg-background flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="w-full bg-surface-container-lowest border-t border-outline-variant/40 mt-16 shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-4 flex flex-col gap-4">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 60" width="150" height="38" fill="none">
                            <rect x="4" y="8" width="44" height="44" rx="12" fill="#B91C1C"/>
                            <path d="M26 19 C22 15 16 18 16 23 C16 28 26 35 26 35 C26 35 36 28 36 23 C36 18 30 15 26 19 Z" fill="#F59E0B" />
                            <path d="M19 32 C17 34 16 37 18 39 C20 41 24 40 26 38 C28 40 32 41 34 39 C36 37 35 34 33 32" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <text x="56" y="29" font-family="'Inter', system-ui, sans-serif" font-size="20" font-weight="800" fill="#B91C1C" letter-spacing="-0.5">SAPA SOSIAL</text>
                            <text x="56" y="44" font-family="'Inter', system-ui, sans-serif" font-size="10.5" font-weight="600" fill="#6B7280" letter-spacing="0.2">KABUPATEN BLITAR</text>
                        </svg>
                    </div>
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        Satu Pintu Layanan Sosial Dinas Sosial Kabupaten Blitar. Mewujudkan pelayanan sosial yang inklusif, cepat, transparan, dan terpercaya bagi seluruh warga Kabupaten Blitar.
                    </p>
                    <div class="flex items-center gap-2 text-xs text-on-surface-variant">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                            Server SIKS-NG Online
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-medium">
                            Terkoneksi Pusdatin Kemensos
                        </span>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div class="lg:col-span-2 flex flex-col gap-3">
                    <h3 class="font-semibold text-sm text-on-surface uppercase tracking-wider">Layanan Utama</h3>
                    <ul class="flex flex-col gap-2 text-sm text-on-surface-variant">
                        <li><a href="{{ route('pengajuan', ['service' => 'dtsen']) }}" class="hover:text-primary transition-colors">Surat DTSEN</a></li>
                        <li><a href="{{ route('pengajuan', ['service' => 'pbi']) }}" class="hover:text-primary transition-colors">Reaktivasi KIS</a></li>
                        <li><a href="{{ route('pengajuan', ['service' => 'rehab']) }}" class="hover:text-primary transition-colors">Rehabilitasi Sosial</a></li>
                        <li><a href="{{ route('pengaduan') }}" class="hover:text-primary transition-colors">Pengaduan Sosial</a></li>
                        <li><a href="{{ route('verifikasi') }}" class="hover:text-primary transition-colors">Verifikasi Keaslian SK</a></li>
                    </ul>
                </div>

                <!-- Col 3: Assistance -->
                <div class="lg:col-span-3 flex flex-col gap-3">
                    <h3 class="font-semibold text-sm text-on-surface uppercase tracking-wider">Bantuan & Regulasi</h3>
                    <ul class="flex flex-col gap-2 text-sm text-on-surface-variant">
                        <li><a href="{{ route('cek-status') }}" class="hover:text-primary transition-colors">Cek Status Tiket</a></li>
                        <li><a href="{{ route('informasi') }}" class="hover:text-primary transition-colors">FAQ & Pusat Informasi</a></li>
                        <li><a href="{{ route('layanan.index') }}" class="hover:text-primary transition-colors">Katalog Persyaratan</a></li>
                        <li><a href="/admin" class="hover:text-primary transition-colors">Portal Staf / Petugas</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div class="lg:col-span-3 flex flex-col gap-3">
                    <h3 class="font-semibold text-sm text-on-surface uppercase tracking-wider">Kontak & Kantor</h3>
                    <div class="flex flex-col gap-1 text-sm text-on-surface-variant">
                        <p class="font-semibold text-on-surface">Dinas Sosial Kabupaten Blitar</p>
                        <p>Jl. Kusuma Bangsa No. 15, Kanigoro</p>
                        <p>Kabupaten Blitar, Jawa Timur 66171</p>
                        <p class="pt-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">phone</span>
                            (0342) 801-445
                        </p>
                        <p class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">mail</span>
                            dinsos@blitarkab.go.id
                        </p>
                        <p class="text-xs text-on-surface-variant/80 pt-1">
                            Jam Operasional: Senin–Jumat 07.30–16.00 WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-8 pt-6 border-t border-outline-variant/30 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant">
                <p>Hak Cipta &copy; {{ date('Y') }} Pemerintah Kabupaten Blitar — Dinas Sosial. All rights reserved.</p>
                <p class="text-on-surface-variant/70">SAPA SOSIAL — Satu Pintu Layanan Sosial Terpadu</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
