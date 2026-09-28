<div class="flex flex-col w-full pb-16">
    <!-- Top Utility Context / Header Sub-Band -->
    <section class="w-full bg-surface-container-lowest border-b border-outline-variant/30 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-4">
            <!-- Breadcrumb & Portal Badge -->
            <div class="flex flex-wrap items-center justify-between gap-3">
                <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium">
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">home</span>
                        Beranda
                    </a>
                    <span class="text-outline-variant">/</span>
                    <span class="text-primary font-semibold">Layanan</span>
                </nav>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container text-xs text-on-surface-variant">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>Portal Resmi Pelayanan Dinas Sosial Kabupaten Blitar</span>
                </div>
            </div>

            <!-- Main Headline & Subtitle -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pt-2">
                <div class="max-w-3xl flex flex-col gap-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-on-surface">
                        Katalog & Informasi Layanan Sosial
                    </h1>
                    <p class="text-sm sm:text-base text-on-surface-variant leading-relaxed">
                        Temukan informasi lengkap, syarat pengajuan, alur prosedur, dan estimasi waktu penyelesaian layanan sosial masyarakat Kabupaten Blitar secara transparan dan mudah diakses.
                    </p>
                </div>

                <!-- Active Status Indicator Card -->
                <div class="flex-shrink-0 bg-surface-container-low px-4 py-3 rounded-xl flex items-center gap-3 border border-outline-variant/40 shadow-sm">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm">
                        <span class="material-symbols-outlined text-[24px]">verified</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-sm text-on-surface">{{ $totalServicesCount }} Layanan Aktif</span>
                        <span class="text-xs text-on-surface-variant">Terintegrasi Blitar Satu Pintu</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Search & Filter Controls -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full">
        <!-- Search Input Container -->
        <div class="w-full bg-surface-container-lowest p-3 rounded-xl shadow-sm border border-outline-variant/60 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <div class="relative flex-1 flex items-center">
                <span class="material-symbols-outlined absolute left-3.5 text-on-surface-variant text-[22px] pointer-events-none">search</span>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Cari layanan, persyaratan, atau kata kunci (mis. DTSEN, KIS, Disabilitas, Bansos)..." 
                    class="w-full h-11 pl-11 pr-4 rounded-lg bg-surface-container-low text-on-surface text-sm placeholder:text-on-surface-variant/60 border border-outline-variant/40 focus:outline-none focus:border-primary-container focus:bg-white transition"
                />
            </div>
            <button 
                type="button" 
                class="h-11 px-6 bg-primary-container text-on-primary rounded-lg font-semibold text-sm hover:bg-primary transition-all flex items-center justify-center gap-2 shadow-sm shrink-0"
            >
                <span>Filter Layanan</span>
                <span class="material-symbols-outlined text-[18px]">tune</span>
            </button>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 pt-4">
            <button 
                wire:click="setCategory('all')" 
                type="button" 
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2 transition-all shadow-sm {{ $selectedCategory === 'all' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
            >
                <span>Semua</span>
                <span class="px-1.5 py-0.5 rounded-full {{ $selectedCategory === 'all' ? 'bg-white/20 text-on-primary' : 'bg-surface-container-high text-on-surface-variant' }} text-[11px] font-bold">
                    {{ $totalServicesCount }}
                </span>
            </button>
            <button 
                wire:click="setCategory('bansos')" 
                type="button" 
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2 transition-all shadow-sm {{ $selectedCategory === 'bansos' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
            >
                <span>Bantuan & Jaminan Sosial</span>
            </button>
            <button 
                wire:click="setCategory('kesehatan')" 
                type="button" 
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2 transition-all shadow-sm {{ $selectedCategory === 'kesehatan' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
            >
                <span>Layanan Kesehatan</span>
            </button>
            <button 
                wire:click="setCategory('rehabilitasi')" 
                type="button" 
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2 transition-all shadow-sm {{ $selectedCategory === 'rehabilitasi' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
            >
                <span>Rehabilitasi Sosial</span>
            </button>
            <button 
                wire:click="setCategory('pengaduan')" 
                type="button" 
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2 transition-all shadow-sm {{ $selectedCategory === 'pengaduan' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
            >
                <span>Pengaduan & Advokasi</span>
            </button>
        </div>

        <!-- Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-6">
            @forelse($serviceTypes as $service)
                @php
                    $detailSlug = match($service->handler?->value ?? $service->handler) {
                        'dtsen' => 'surat-keterangan-dtsen',
                        'pbi' => 'reaktivasi-kis',
                        default => $infoPages[$service->id]?->slug ?? 'surat-keterangan-dtsen',
                    };
                    $applyParam = match($service->handler?->value ?? $service->handler) {
                        'dtsen' => 'dtsen',
                        'pbi' => 'pbi',
                        default => 'lainnya',
                    };
                    $iconName = match($service->handler?->value ?? $service->handler) {
                        'dtsen' => 'description',
                        'pbi' => 'health_and_safety',
                        default => $service->needs_assessment ? 'diversity_1' : 'assignment',
                    };
                    $iconColor = match($service->handler?->value ?? $service->handler) {
                        'dtsen' => 'text-primary bg-red-50',
                        'pbi' => 'text-secondary bg-amber-50',
                        default => 'text-tertiary bg-blue-50',
                    };
                @endphp
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-primary-container/40 transition flex flex-col justify-between group">
                    <div>
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl {{ $iconColor }} flex items-center justify-center group-hover:scale-110 transition">
                                <span class="material-symbols-outlined text-2xl">{{ $iconName }}</span>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-surface-container text-xs font-medium text-on-surface-variant">
                                SLA: {{ $service->sla_days ?? 1 }} Hari
                            </span>
                        </div>

                        <span class="text-xs font-semibold text-primary uppercase tracking-wider block mb-1">
                            {{ $service->category }}
                        </span>
                        <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">
                            {{ $service->name }}
                        </h3>
                        <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-6 line-clamp-3">
                            {{ $service->description }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between gap-2">
                        <a href="{{ route('layanan.detail', ['slug' => $detailSlug]) }}" class="text-xs font-semibold text-on-surface hover:text-primary transition-colors flex items-center gap-1">
                            <span>Lihat Detail</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                        <a href="{{ route('pengajuan', ['service' => $applyParam]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary-container text-on-primary text-xs font-semibold hover:bg-primary transition shadow-sm">
                            <span>Ajukan</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-surface-container-lowest rounded-2xl p-12 text-center border border-outline-variant/60">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-2">search_off</span>
                    <h3 class="font-bold text-lg text-on-surface">Layanan Tidak Ditemukan</h3>
                    <p class="text-sm text-on-surface-variant mt-1 max-w-md mx-auto">
                        Tidak ada layanan yang sesuai dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain atau hubungi petugas kami.
                    </p>
                    <button wire:click="$set('search', '')" class="mt-4 px-4 py-2 rounded-lg bg-surface-container text-xs font-semibold text-on-surface hover:bg-surface-container-high transition">
                        Reset Pencarian
                    </button>
                </div>
            @endforelse
        </div>
    </section>
</div>
