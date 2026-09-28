<div class="flex flex-col w-full pb-16">
    <!-- Breadcrumb & Top Badges Row -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Verifikasi Keaslian Surat</span>
            </nav>
            <div class="flex flex-wrap items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-surface-container rounded-full text-on-surface">
                    <span class="material-symbols-outlined text-[16px] text-tertiary">lock</span>
                    Keamanan BSrE BSSN
                </span>
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-surface-container rounded-full text-on-surface">
                    <span class="material-symbols-outlined text-[16px] text-primary">database</span>
                    Database Resmi Dinsos
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Wrapper -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <!-- Page Header -->
        <div class="relative bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 mb-8 overflow-hidden">
            <div class="max-w-3xl flex flex-col gap-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-xs font-semibold w-fit">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    Portal Validasi Dokumen & Sertifikat Digital TTE Resmi
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">
                    Verifikasi Keaslian Surat & Dokumen Resmi
                </h1>
                <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                    Sistem verifikasi tanda tangan elektronik (TTE) dan keabsahan dokumen digital yang diterbitkan oleh Dinas Sosial Pemerintah Kabupaten Blitar secara real-time, transparan, dan terbuka untuk publik.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Main Area (8 Cols) -->
            <div class="lg:col-span-8 flex flex-col gap-6">

                <!-- Search Input Form -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60">
                    <h3 class="font-bold text-sm text-on-surface mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">qr_code_scanner</span>
                        Periksa Kode Verifikasi / Nomor Surat
                    </h3>
                    <p class="text-xs text-on-surface-variant mb-4">
                        Masukkan kode alfanumerik yang tertera di bawah QR Code atau ketikkan nomor resmi surat keterangan.
                    </p>

                    <form wire:submit="verify" class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                wire:model="code" 
                                placeholder="Contoh: VRF-202610-001 atau 400.9/123/409.105/2026" 
                                required
                                class="w-full h-11 px-3.5 pl-10 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs sm:text-sm text-on-surface font-mono placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary-container focus:bg-white transition"
                            />
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">search</span>
                        </div>
                        <button type="submit" class="h-11 px-6 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm flex items-center justify-center gap-1.5 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">verified</span>
                            <span>Periksa Keaslian</span>
                        </button>
                    </form>
                    @error('code') <span class="text-error text-xs block mt-2">{{ $message }}</span> @enderror
                </div>

                <!-- Hasil Verifikasi -->
                @if($hasSearched)
                    @if($certificate && !$isExpired)
                        <!-- ================= FRAME A: SURAT VALID ================= -->
                        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-emerald-300 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-6 text-white flex flex-col sm:flex-row items-center sm:items-start gap-4">
                                <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[32px] text-white">verified_user</span>
                                </div>
                                <div class="text-center sm:text-left space-y-1">
                                    <span class="text-[11px] uppercase tracking-wider text-emerald-100 font-bold block">
                                        Hasil Pengecekan Sistem Dinsos Kab. Blitar
                                    </span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-white">
                                        DOKUMEN RESMI TERVERIFIKASI & SAH
                                    </h2>
                                    <p class="text-xs text-emerald-100 max-w-xl leading-relaxed">
                                        Tanda Tangan Elektronik (TTE) tersertifikasi secara hukum oleh Balai Sertifikasi Elektronik (BSrE) - BSSN sesuai ketentuan yang berlaku.
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 space-y-6">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 bg-surface-container-low/60 p-4 rounded-xl gap-3">
                                    <div>
                                        <span class="text-xs text-on-surface-variant block">Nomor Registrasi Surat</span>
                                        <span class="font-bold text-sm text-primary font-mono">{{ $certificate->certificate_number ?? '400.9/123/409.105/2026' }}</span>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold inline-flex items-center gap-1 self-start sm:self-auto">
                                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                                        Status: BERLAKU / AKTIF
                                    </span>
                                </div>

                                @php
                                    $subjName = $certificate->subject_name ?: ($certificate->serviceRequest?->applicant_name ?? 'Warga');
                                    $nameMasked = substr($subjName, 0, 1) . '*** ' . substr($subjName, -3);
                                    $rawNik = $certificate->subject_nik ?: ($certificate->serviceRequest?->applicant_nik ?? '3505000000000000');
                                    $nikMasked = substr($rawNik, 0, 4) . ' ******* ' . substr($rawNik, -4);
                                @endphp

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/30">
                                        <span class="text-on-surface-variant block mb-1">Nama Yang Diterangkan:</span>
                                        <span class="font-bold text-sm text-on-surface">{{ $nameMasked }}</span>
                                        <span class="text-[11px] text-on-surface-variant block mt-0.5 font-mono">NIK: {{ $nikMasked }}</span>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/30">
                                        <span class="text-on-surface-variant block mb-1">Tujuan Penggunaan:</span>
                                        <span class="font-bold text-sm text-on-surface">{{ $certificate->purpose?->name ?? 'SPMB / Beasiswa Pendidikan' }}</span>
                                        <span class="text-[11px] text-on-surface-variant block mt-0.5">{{ $certificate->purpose_description ?: 'Keperluan resmi' }}</span>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/30">
                                        <span class="text-on-surface-variant block mb-1">Tanggal Penerbitan:</span>
                                        <span class="font-bold text-on-surface">{{ $certificate->issued_at ? $certificate->issued_at->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}</span>
                                        <span class="text-[11px] text-on-surface-variant block mt-0.5">Masa Berlaku: {{ $certificate->valid_until ? $certificate->valid_until->translatedFormat('d F Y') : '6 Bulan sejak terbit' }}</span>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/30">
                                        <span class="text-on-surface-variant block mb-1">Pejabat Penandatangan:</span>
                                        <span class="font-bold text-on-surface">Kepala Dinas Sosial Kabupaten Blitar</span>
                                        <span class="text-[11px] text-emerald-800 font-semibold block mt-0.5 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">verified</span>
                                            TTE Tersertifikasi Sah
                                        </span>
                                    </div>
                                </div>

                                <div class="p-3 rounded-lg bg-surface-container text-xs text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-emerald-700 text-[20px]">info</span>
                                    <span>Informasi di atas ditarik langsung secara real-time dari pangkalan data Dinas Sosial Kabupaten Blitar. Dokumen ini sah dan tidak memerlukan legalisir cap basah tambahan.</span>
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- ================= FRAME B: INVALID / KEDALUWARSA ================= -->
                        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-red-300 overflow-hidden">
                            <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-white flex flex-col sm:flex-row items-center sm:items-start gap-4">
                                <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[32px] text-white">gpp_bad</span>
                                </div>
                                <div class="text-center sm:text-left space-y-1">
                                    <span class="text-[11px] uppercase tracking-wider text-red-100 font-bold block">
                                        Peringatan Keabsahan Dokumen
                                    </span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-white">
                                        {{ $isExpired ? 'DOKUMEN KEDALUWARSA / HABIS MASA BERLAKU' : 'DOKUMEN TIDAK DAPAT DIVERIFIKASI' }}
                                    </h2>
                                    <p class="text-xs text-red-100 max-w-xl leading-relaxed">
                                        {{ $isExpired ? 'Surat keterangan ini telah melewati masa berlaku yang ditetapkan dan tidak dapat dipergunakan kembali.' : 'Kode verifikasi atau nomor surat tidak tercatat dalam basis data resmi Dinas Sosial Kabupaten Blitar.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 space-y-4 text-xs text-on-surface-variant">
                                <h4 class="font-bold text-sm text-on-surface">Kemungkinan Penyebab:</h4>
                                <ul class="list-disc pl-5 space-y-1.5 leading-relaxed">
                                    <li>Salah ketik saat memasukkan kode verifikasi atau nomor surat.</li>
                                    <li>Masa berlaku surat telah habis sehingga memerlukan pengajuan permohonan baru.</li>
                                    <li>Dokumen bukan diterbitkan secara resmi melalui sistem SAPA SOSIAL Blitar.</li>
                                </ul>

                                <div class="pt-4 border-t border-outline-variant/30 flex flex-wrap items-center gap-3">
                                    <a href="{{ route('pengajuan', ['service' => 'dtsen']) }}" class="px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm">
                                        Ajukan Surat DTSEN Baru
                                    </a>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="px-4 py-2.5 rounded-lg border border-outline-variant/60 text-on-surface font-semibold text-xs hover:bg-surface-container transition">
                                        Hubungi Petugas Verifikator
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Right Sidebar: Guidance -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-4">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Petunjuk Cek</span>
                    <h3 class="font-bold text-base text-on-surface">Di Mana Menemukan Kode Verifikasi?</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Pada setiap lembar fisik Surat Keterangan DTSEN resmi yang diterbitkan, kode verifikasi berada di bagian sudut kanan bawah tepat di bawah kotak barcode / QR Code.
                    </p>
                    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/40 text-center font-mono text-xs text-primary font-bold">
                        Contoh: VRF-202610-001
                    </div>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-3">
                    <span class="material-symbols-outlined text-secondary text-3xl">verified</span>
                    <h4 class="font-bold text-sm text-on-surface">Legalitas Tanda Tangan Elektronik</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Berdasarkan UU ITE dan regulasi BSSN, tanda tangan elektronik tersertifikasi memiliki kekuatan hukum sah yang setara dengan tanda tangan basah dan cap stempel basah instansi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
