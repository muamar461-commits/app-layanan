<div class="flex flex-col w-full pb-16">
    <!-- Top Utility Context / Breadcrumb Ribbon -->
    <section class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium overflow-x-auto whitespace-nowrap">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    <span>Beranda</span>
                </a>
                <span class="text-outline-variant">/</span>
                <a href="{{ route('layanan.index') }}" class="hover:text-primary transition-colors">Layanan</a>
                <span class="text-outline-variant">/</span>
                <span class="font-semibold text-primary truncate max-w-xs">{{ $page->title }}</span>
            </nav>
        </div>
    </section>

    <!-- Service Detail Main Wrapper -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <!-- Title Section & Badges -->
        <header class="mb-8">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-semibold">
                    <span class="material-symbols-outlined text-[15px]">verified</span>
                    Resmi & Gratis (Rp 0)
                </span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-medium">
                    <span class="material-symbols-outlined text-[15px]">update</span>
                    Diperbarui: {{ $page->published_at ? $page->published_at->translatedFormat('d F Y') : 'September 2026' }}
                </span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant text-xs font-medium">
                    <span class="material-symbols-outlined text-[15px]">fingerprint</span>
                    TTE Tersertifikasi BSrE
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-on-surface tracking-tight max-w-4xl">
                {{ $page->title }}
            </h1>
            <p class="mt-3 text-sm sm:text-base text-on-surface-variant max-w-4xl leading-relaxed">
                {{ $page->description }}
            </p>
        </header>

        <!-- 2-Column Responsive Layout: Left 8 cols, Right 4 cols -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Main Content -->
            <div class="lg:col-span-8 flex flex-col gap-8 min-w-0">
                <!-- In-Page Jump Anchors Bar -->
                <nav class="sticky top-20 z-30 bg-surface-container-lowest/90 backdrop-blur-md rounded-xl p-1.5 shadow-sm border border-outline-variant/40 flex items-center gap-1 overflow-x-auto whitespace-nowrap text-xs font-medium">
                    <a href="#deskripsi" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">Deskripsi</a>
                    <a href="#persyaratan" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">Persyaratan</a>
                    <a href="#alur" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">Alur Layanan</a>
                    <a href="#unduhan" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">Dokumen Unduhan</a>
                    <a href="#lokasi" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">Lokasi & Jam</a>
                    <a href="#faq" class="px-3 py-1.5 rounded-lg text-on-surface hover:bg-surface-container-high transition-colors">FAQ</a>
                </nav>

                <!-- 1. Deskripsi & Manfaat Layanan -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="deskripsi">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">assignment_turned_in</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-primary font-bold">Informasi Utama</span>
                            <h2 class="text-lg font-bold text-on-surface">Deskripsi & Manfaat Pelayanan</h2>
                        </div>
                    </div>
                    <div class="text-sm text-on-surface-variant leading-relaxed space-y-3">
                        <p>
                            Layanan ini diselenggarakan secara terpadu oleh Dinas Sosial Kabupaten Blitar untuk memberikan kepastian hukum dan kemudahan akses bagi masyarakat yang memerlukan dokumen sosial resmi. Dokumen ditandatangani secara elektronik (TTE) dan dilengkapi kode verifikasi QR untuk pembuktian keaslian secara instan tanpa perlu legalisir basah.
                        </p>
                    </div>

                    <!-- Highlight Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-surface-container-low flex flex-col gap-1.5">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-tertiary flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined text-[18px]">verified</span>
                            </div>
                            <h4 class="font-bold text-xs text-on-surface mt-1">Keaslian Terjamin</h4>
                            <p class="text-[11px] text-on-surface-variant leading-relaxed">
                                Dilengkapi barcode verifikasi mandiri yang dapat divalidasi langsung oleh instansi sekolah/kampus/faskes.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low flex flex-col gap-1.5">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined text-[18px]">timer</span>
                            </div>
                            <h4 class="font-bold text-xs text-on-surface mt-1">Proses Cepat</h4>
                            <p class="text-[11px] text-on-surface-variant leading-relaxed">
                                Estimasi verifikasi dan penerbitan 1-2 hari kerja sejak dokumen dinyatakan lengkap oleh verifikator.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low flex flex-col gap-1.5">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-900 flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined text-[18px]">currency_ruble</span>
                            </div>
                            <h4 class="font-bold text-xs text-on-surface mt-1">Tanpa Pungutan</h4>
                            <p class="text-[11px] text-on-surface-variant leading-relaxed">
                                Sepenuhnya dibiayai oleh APBD Kabupaten Blitar. Waspadai calo atau pihak tak bertanggung jawab.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- 2. Persyaratan Berkas -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="persyaratan">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">fact_check</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-secondary font-bold">Dokumen Wajib</span>
                            <h2 class="text-lg font-bold text-on-surface">Persyaratan Pengajuan Berkas</h2>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-on-surface-variant">
                        Siapkan foto atau scan dokumen asli dengan pencahayaan terang dan tulisan terbaca jelas (format JPG, PNG, atau PDF maks. 2 MB per berkas):
                    </p>

                    <div class="space-y-3 pt-2">
                        @if(!empty(trim($page->requirements)))
                            <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 text-sm text-on-surface-variant space-y-2">
                                {!! nl2br(e($page->requirements)) !!}
                            </div>
                        @else
                            <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                                <div>
                                    <h4 class="font-semibold text-sm text-on-surface">1. Kartu Tanda Penduduk (e-KTP) Pemohon</h4>
                                    <p class="text-xs text-on-surface-variant">e-KTP asli pemohon atau orang tua/wali murid warga Kabupaten Blitar yang masih berlaku.</p>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                                <div>
                                    <h4 class="font-semibold text-sm text-on-surface">2. Kartu Keluarga (KK) Terbaru</h4>
                                    <p class="text-xs text-on-surface-variant">Kartu Keluarga yang mencantumkan nama pemohon dan nama orang yang diterangkan.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- 3. Alur Pelayanan Vertikal -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="alur">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-tertiary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">timeline</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-tertiary font-bold">Prosedur Layanan</span>
                            <h2 class="text-lg font-bold text-on-surface">Tahapan & Alur Penyelesaian</h2>
                        </div>
                    </div>

                    <div class="relative pl-6 space-y-6 pt-2 border-l-2 border-primary-container/20 ml-3">
                        @if(!empty(trim($page->procedure)))
                            <div class="text-sm text-on-surface-variant leading-relaxed">
                                {!! nl2br(e($page->procedure)) !!}
                            </div>
                        @else
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-xs font-bold">1</div>
                                <h4 class="font-bold text-sm text-on-surface">Pilih Tujuan & Lengkapi Data</h4>
                                <p class="text-xs text-on-surface-variant mt-0.5">Warga memilih tujuan penggunaan surat, mengisi data identitas NIK dan anggota keluarga yang diterangkan.</p>
                            </div>
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-xs font-bold">2</div>
                                <h4 class="font-bold text-sm text-on-surface">Unggah Berkas Persyaratan</h4>
                                <p class="text-xs text-on-surface-variant mt-0.5">Unggah foto KTP dan Kartu Keluarga yang jelas. Sistem akan menerbitkan nomor registrasi tiket unik.</p>
                            </div>
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-xs font-bold">3</div>
                                <h4 class="font-bold text-sm text-on-surface">Pemeriksaan & Verifikasi Data SIKS-NG</h4>
                                <p class="text-xs text-on-surface-variant mt-0.5">Petugas Dinsos memeriksa kelengkapan berkas serta mencocokkan status desil pada server SIKS-NG Kemensos.</p>
                            </div>
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-xs font-bold">4</div>
                                <h4 class="font-bold text-sm text-on-surface">Pengesahan Surat & TTE Digital</h4>
                                <p class="text-xs text-on-surface-variant mt-0.5">Kepala Bidang memeriksa draf dan Kepala Dinas menandatangani surat secara digital.</p>
                            </div>
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-emerald-700 text-on-primary flex items-center justify-center text-xs font-bold">5</div>
                                <h4 class="font-bold text-sm text-on-surface">Surat Terbit & Siap Diunduh</h4>
                                <p class="text-xs text-on-surface-variant mt-0.5">Pemohon dapat mengunduh dokumen resmi PDF ber-QR Code dari halaman Cek Status atau mengambil cetakan fisik di kantor Dinsos.</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- 4. Dokumen Unduhan -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="unduhan">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">download</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-primary font-bold">Formulir Resmi</span>
                            <h2 class="text-lg font-bold text-on-surface">Unduh Format Surat & Panduan</h2>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        @forelse($page->downloadableForms as $form)
                            <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/40 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[22px]">description</span>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-semibold text-sm text-on-surface">{{ $form->title }}</h4>
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                                Versi {{ $form->version ?? 'Terbaru' }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-0.5">{{ $form->description ?? 'Format cetak resmi untuk keperluan pengajuan mandiri.' }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($form->file_path) }}" target="_blank" class="px-3.5 py-2 rounded-lg bg-surface-container-lowest text-primary font-semibold text-xs border border-outline-variant/60 hover:bg-primary hover:text-white transition shadow-sm shrink-0 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    <span>Unduh</span>
                                </a>
                            </div>
                        @empty
                            <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/40 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[22px]">picture_as_pdf</span>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-semibold text-sm text-on-surface">Petunjuk Pengisian Permohonan Layanan</h4>
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Versi Terbaru</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Panduan tata cara pengisian identitas NIK dan pengecekan nomor tiket online.</p>
                                    </div>
                                </div>
                                <a href="#" class="px-3.5 py-2 rounded-lg bg-surface-container-lowest text-primary font-semibold text-xs border border-outline-variant/60 hover:bg-primary hover:text-white transition shadow-sm shrink-0 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    <span>Unduh</span>
                                </a>
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- 5. Lokasi & Jam Operasional -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="lokasi">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface shrink-0">
                            <span class="material-symbols-outlined text-[24px]">location_on</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-on-surface-variant font-bold">Lokasi Pelayanan</span>
                            <h2 class="text-lg font-bold text-on-surface">Lokasi Loket & Jam Operasional</h2>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs sm:text-sm text-on-surface-variant pt-2">
                        <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 space-y-1">
                            <span class="font-bold text-on-surface flex items-center gap-1.5 text-sm">
                                <span class="material-symbols-outlined text-primary text-[18px]">domain</span>
                                Alamat Kantor Dinsos
                            </span>
                            <p class="pt-1">{{ $page->location ?? 'Loket Pelayanan Terpadu Dinas Sosial Kab. Blitar, Jl. Kusuma Bangsa No. 15, Kanigoro' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 space-y-1">
                            <span class="font-bold text-on-surface flex items-center gap-1.5 text-sm">
                                <span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
                                Jam Pelayanan
                            </span>
                            <p class="pt-1">{{ $page->service_hours ?? 'Senin – Kamis: 07.30 – 15.30 WIB | Jumat: 07.30 – 14.30 WIB' }}</p>
                        </div>
                    </div>
                </section>

                <!-- 6. FAQ Terkait -->
                <section class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 flex flex-col gap-4 scroll-mt-36" id="faq">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[24px]">help</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-wider text-secondary font-bold">Tanya Jawab</span>
                            <h2 class="text-lg font-bold text-on-surface">Pertanyaan Seputar Layanan Ini</h2>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        @forelse($page->faqs as $faq)
                            <details class="group bg-surface-container-low rounded-xl p-4 transition-all">
                                <summary class="flex items-center justify-between cursor-pointer font-semibold text-xs sm:text-sm text-on-surface select-none list-none">
                                    <span>{{ $faq->question }}</span>
                                    <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                                </summary>
                                <p class="mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/30">
                                    {{ $faq->answer }}
                                </p>
                            </details>
                        @empty
                            <details class="group bg-surface-container-low rounded-xl p-4 transition-all" open>
                                <summary class="flex items-center justify-between cursor-pointer font-semibold text-xs sm:text-sm text-on-surface select-none list-none">
                                    <span>Berapa batas desil maksimal untuk dapat diterbitkan surat DTSEN?</span>
                                    <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                                </summary>
                                <p class="mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/30">
                                    Batas desil ditentukan berdasarkan tujuan penggunaan. Untuk jalur afirmasi SPMB / KIP Kuliah biasanya mensyaratkan desil 1 sampai desil 5. Apabila desil di luar ketentuan, verifikator akan memberikan catatan penolakan resmi.
                                </p>
                            </details>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Right Column: Sticky Action Card -->
            <aside class="lg:col-span-4 sticky top-24 space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-md border border-outline-variant/60 flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-primary uppercase tracking-wider">Aksi Pengajuan</span>
                        <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-bold">Online 24 Jam</span>
                    </div>

                    <h3 class="font-extrabold text-base text-on-surface">Ajukan Permohonan Sekarang</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Layanan dapat diajukan langsung secara mandiri melalui form online tanpa perlu datang dan antre di kantor dinas.
                    </p>

                    @php
                        $applyParam = match($page->serviceType?->handler?->value ?? $page->serviceType?->handler) {
                            'dtsen' => 'dtsen',
                            'pbi' => 'pbi',
                            default => 'lainnya',
                        };
                    @endphp

                    <div class="space-y-2 pt-2">
                        <a href="{{ route('pengajuan', ['service' => $applyParam]) }}" class="w-full py-3.5 px-4 rounded-xl bg-primary-container text-on-primary font-bold text-sm hover:bg-primary transition-all shadow-md flex items-center justify-center gap-2">
                            <span>Mulai Pengajuan Online</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        <a href="{{ route('cek-status') }}" class="w-full py-2.5 px-4 rounded-xl bg-surface-container text-on-surface font-semibold text-xs hover:bg-surface-container-high transition-all flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">search</span>
                            <span>Sudah Punya Tiket? Cek Status</span>
                        </a>
                    </div>

                    <div class="pt-4 border-t border-outline-variant/30 space-y-2.5 text-xs text-on-surface-variant">
                        <div class="flex items-center justify-between">
                            <span>Estimasi Waktu</span>
                            <span class="font-bold text-on-surface">1 – 2 Hari Kerja</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Biaya Retribusi</span>
                            <span class="font-bold text-emerald-700">Rp 0 (Gratis)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Metode Pengambilan</span>
                            <span class="font-bold text-on-surface">Unduh PDF / Loket</span>
                        </div>
                    </div>
                </div>

                <!-- Assistance Card -->
                <div class="bg-surface-container-low rounded-2xl p-5 border border-outline-variant/40 flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary text-[24px]">support</span>
                    <div class="flex flex-col gap-1">
                        <h4 class="font-bold text-xs text-on-surface">Butuh Konsultasi?</h4>
                        <p class="text-[11px] text-on-surface-variant leading-relaxed">
                            Hubungi layanan informasi via WhatsApp resmi Dinsos Kab. Blitar: <strong>0812-3456-7890</strong>
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
