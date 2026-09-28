<div class="flex flex-col w-full pb-16">
    <!-- Top Utility Context / Breadcrumb -->
    <section class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    <span>Beranda</span>
                </a>
                <span class="text-outline-variant">/</span>
                <span class="font-semibold text-primary">Pusat Informasi & FAQ</span>
            </nav>
        </div>
    </section>

    <!-- Hero Header & Interactive Search -->
    <section class="w-full bg-gradient-to-b from-surface-container-lowest via-surface-container-low to-background py-12 lg:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <!-- Civic Trust Badge -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-xs font-semibold mb-4 shadow-sm">
                <span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
                <span>Pusat Bantuan & Edukasi Terpadu Blitar</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-on-surface tracking-tight mb-3">
                Pusat Informasi & Tanya Jawab (FAQ)
            </h1>
            <p class="text-sm sm:text-base text-on-surface-variant max-w-2xl mb-8 leading-relaxed">
                Temukan panduan persyaratan administrasi, jadwal pelayanan, alur bantuan sosial, dan jawaban resmi dari Dinas Sosial Kabupaten Blitar secara instan dan transparan.
            </p>

            <!-- Main Search Console -->
            <div class="w-full bg-surface-container-lowest p-2.5 rounded-2xl shadow-lg border border-outline-variant/60 flex flex-col sm:flex-row items-stretch gap-2 relative">
                <div class="relative flex-1 flex items-center">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-3.5 pointer-events-none text-[22px]">search</span>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari kata kunci, topik, atau syarat... (contoh: DTSEN, reaktivasi KIS, beasiswa, lansia)" 
                        class="w-full pl-11 pr-4 py-3 h-12 rounded-xl bg-surface-container-low text-on-surface placeholder:text-on-surface-variant/50 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-container/20 transition"
                    />
                </div>
                @if($search)
                    <button 
                        type="button" 
                        wire:click="$set('search', '')" 
                        class="h-12 px-4 rounded-xl text-xs font-semibold text-on-surface-variant hover:bg-surface-container transition"
                    >
                        Hapus
                    </button>
                @endif
            </div>

            <!-- Popular Search Chips -->
            <div class="mt-4 flex flex-wrap items-center justify-center gap-1.5 text-xs">
                <span class="text-on-surface-variant flex items-center gap-1 mr-1">
                    <span class="material-symbols-outlined text-[15px] text-secondary">trending_up</span>
                    Populer:
                </span>
                <button type="button" wire:click="setKeyword('DTSEN')" class="px-3 py-1 bg-surface-container-lowest text-primary rounded-full text-xs font-medium shadow-sm hover:bg-primary-fixed border border-outline-variant/40 transition">
                    Syarat Surat DTSEN
                </button>
                <button type="button" wire:click="setKeyword('KIS')" class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant rounded-full text-xs font-medium shadow-sm hover:bg-primary-fixed hover:text-primary border border-outline-variant/40 transition">
                    Reaktivasi KIS / PBI
                </button>
                <button type="button" wire:click="setKeyword('Lansia')" class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant rounded-full text-xs font-medium shadow-sm hover:bg-primary-fixed hover:text-primary border border-outline-variant/40 transition">
                    Lansia Terlantar
                </button>
                <button type="button" wire:click="setKeyword('Jam')" class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant rounded-full text-xs font-medium shadow-sm hover:bg-primary-fixed hover:text-primary border border-outline-variant/40 transition">
                    Jam Pelayanan Loket
                </button>
            </div>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full space-y-12">
        <!-- Live Search Results Section (if search filled) -->
        @if(!empty(trim($search)))
            <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 space-y-4">
                <div class="flex items-center justify-between border-b border-outline-variant/30 pb-3">
                    <h2 class="font-bold text-base text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">manage_search</span>
                        Hasil Pencarian untuk "{{ $search }}"
                    </h2>
                    <span class="text-xs text-on-surface-variant">{{ $articles->count() }} Informasi Ditemukan</span>
                </div>

                <div class="space-y-3">
                    @forelse($articles as $article)
                        <div class="p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition border border-outline-variant/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="space-y-1">
                                <span class="px-2 py-0.5 rounded bg-primary-fixed text-primary text-[10px] font-bold uppercase">
                                    {{ $article->category }}
                                </span>
                                <h3 class="font-bold text-sm text-on-surface">
                                    <a href="{{ route('layanan.detail', ['slug' => $article->slug]) }}" class="hover:text-primary transition">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-on-surface-variant line-clamp-2">{{ $article->description }}</p>
                            </div>
                            <a href="{{ route('layanan.detail', ['slug' => $article->slug]) }}" class="px-3 py-1.5 rounded-lg bg-surface-container-lowest text-primary text-xs font-semibold hover:bg-primary hover:text-white transition shadow-sm border border-outline-variant/60 shrink-0 self-start sm:self-center">
                                Baca Detail &rarr;
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-3xl mb-1">search_off</span>
                            <p class="text-xs">Tidak ditemukan informasi yang cocok dengan kata kunci "{{ $search }}".</p>
                        </div>
                    @endforelse
                </div>
            </section>
        @endif

        <!-- Topic Categories Bento Grid -->
        <section>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Kategori Panduan</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1">Kluster Informasi Pelayanan</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div wire:click="setKeyword('Bansos')" class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-primary transition cursor-pointer group">
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
                    </div>
                    <h3 class="font-bold text-base text-on-surface mb-1 group-hover:text-primary transition-colors">Program Bantuan Sosial</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4">
                        Informasi kriteria penerima, pemutakhiran data DTSEN di desa, beasiswa afirmasi, dan PKH/BPNT.
                    </p>
                    <span class="text-xs font-semibold text-primary flex items-center gap-1">
                        <span>Lihat Panduan</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </span>
                </div>

                <!-- Card 2 -->
                <div wire:click="setKeyword('KIS')" class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-amber-500 transition cursor-pointer group">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <span class="material-symbols-outlined text-2xl">health_and_safety</span>
                    </div>
                    <h3 class="font-bold text-base text-on-surface mb-1 group-hover:text-secondary transition-colors">Jaminan Kesehatan (KIS/PBI)</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4">
                        Prosedur reaktivasi kepesertaan BPJS PBI yang nonaktif, syarat pasien darurat, dan koordinasi Jamkesda.
                    </p>
                    <span class="text-xs font-semibold text-secondary flex items-center gap-1">
                        <span>Lihat Panduan</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </span>
                </div>

                <!-- Card 3 -->
                <div wire:click="setKeyword('Rehabilitasi')" class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-blue-500 transition cursor-pointer group">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-tertiary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <span class="material-symbols-outlined text-2xl">diversity_1</span>
                    </div>
                    <h3 class="font-bold text-base text-on-surface mb-1 group-hover:text-tertiary transition-colors">Rehabilitasi & Disabilitas</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4">
                        Penanganan lansia terlantar, bantuan alat mobilitas disabilitas, evakuasi ODGJ terlantar, dan rujukan panti.
                    </p>
                    <span class="text-xs font-semibold text-tertiary flex items-center gap-1">
                        <span>Lihat Panduan</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </span>
                </div>
            </div>
        </section>

        <!-- Grouped FAQ Accordions -->
        <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-10 shadow-sm border border-outline-variant/60 space-y-8">
            <div>
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Tanya Jawab Lengkap</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1">Daftar Pertanyaan yang Sering Diajukan</h2>
                <p class="text-xs sm:text-sm text-on-surface-variant mt-1">
                    Berikut rangkuman pertanyaan resmi seputar pengajuan berkas, pelacakan tiket, dan kebijakan Dinas Sosial Kab. Blitar.
                </p>
            </div>

            <div class="space-y-4">
                @if(isset($faqs) && count($faqs) > 0)
                    @foreach($faqs as $groupCategory => $groupItems)
                        <div class="space-y-3">
                            <h3 class="font-bold text-sm text-primary uppercase tracking-wide border-b border-outline-variant/30 pb-1">
                                {{ ucfirst($groupCategory ?: 'Layanan Umum') }}
                            </h3>
                            @foreach($groupItems as $faq)
                                <details class="group bg-surface-container-low rounded-xl p-4 transition-all border border-outline-variant/30">
                                    <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-on-surface select-none list-none">
                                        <span>{{ $faq->question }}</span>
                                        <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                                    </summary>
                                    <div class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/20">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <details class="group bg-surface-container-low rounded-xl p-4 transition-all border border-outline-variant/30" open>
                        <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-on-surface select-none list-none">
                            <span>Bagaimana cara mengetahui peringkat desil DTSEN saya?</span>
                            <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/20">
                            Peringkat desil ditarik langsung dari aplikasi SIKS-NG Kementerian Sosial oleh petugas Dinas Sosial saat Anda mengajukan Surat Keterangan DTSEN atau dapat ditanyakan ke Operator SIKS-NG di Kantor Desa/Kelurahan domisili Anda.
                        </div>
                    </details>
                    <details class="group bg-surface-container-low rounded-xl p-4 transition-all border border-outline-variant/30">
                        <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-on-surface select-none list-none">
                            <span>Berapa lama proses surat pengantar atau rekomendasi diterbitkan?</span>
                            <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/20">
                            Proses rata-rata 1 sampai 2 hari kerja setelah dokumen dinyatakan lengkap dan lolos verifikasi data desil di sistem.
                        </div>
                    </details>
                @endif
            </div>
        </section>
    </div>
</div>
