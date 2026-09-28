<div class="flex flex-col w-full pb-16">
    <!-- Sub-header Breadcrumb Bar -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between text-xs text-on-surface-variant font-medium">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Cek Status Tiket</span>
            </nav>
            <div class="hidden sm:flex items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                    Server SIKS-NG Online
                </span>
                <span class="text-outline-variant">|</span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px] text-primary">verified_user</span>
                    Terkoneksi Pusdatin RI
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Stage -->
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        <!-- Title Section -->
        <div class="flex flex-col gap-1 mb-8">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2.5 h-6 bg-primary-container rounded-full"></span>
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Portal Transparansi Layanan Sosial</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">
                Lacak Status Permohonan & Tiket Layanan
            </h1>
            <p class="text-xs sm:text-sm text-on-surface-variant max-w-3xl leading-relaxed">
                Pantau proses verifikasi berkas, perkembangan rekomendasi, hingga penerbitan dokumen resmi secara transparan dan berkala tanpa perlu antre di kantor Dinsos.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Primary Column (8 Cols) -->
            <div class="lg:col-span-8 flex flex-col gap-6">

                <!-- FRAME A: Form Pencarian Cepat Berkas -->
                <section class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container via-amber-500 to-tertiary-container"></div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-4 pt-1">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-50 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[22px]">manage_search</span>
                            </div>
                            <div>
                                <h2 class="font-bold text-sm sm:text-base text-on-surface">Formulir Pencarian Cepat Berkas</h2>
                                <p class="text-xs text-on-surface-variant">Masukkan rincian tiket registrasi yang Anda peroleh saat pendaftaran.</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-medium">
                            <span class="material-symbols-outlined text-[14px]">lock</span>
                            Validasi NIK 4 Digit
                        </span>
                    </div>

                    <form wire:submit="search" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                        <div class="sm:col-span-7 flex flex-col gap-1">
                            <label class="text-xs font-semibold text-on-surface flex items-center justify-between" for="ticket_number">
                                <span>Nomor Registrasi Tiket <span class="text-error">*</span></span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="ticket_number" 
                                    wire:model="ticket_number" 
                                    placeholder="Contoh: DTSEN-202610-00012 atau PBI-202610-00007" 
                                    required 
                                    class="w-full h-11 px-3.5 pl-10 rounded-lg bg-surface-container-low border border-outline-variant/80 text-on-surface text-xs sm:text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary-container focus:bg-white transition"
                                />
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">confirmation_number</span>
                            </div>
                            @error('ticket_number') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-5 flex flex-col gap-1">
                            <label class="text-xs font-semibold text-on-surface" for="security_code">
                                4 Digit Terakhir NIK / No. HP <span class="text-error">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="security_code" 
                                    wire:model="security_code" 
                                    maxlength="4" 
                                    placeholder="Contoh: 1234" 
                                    required 
                                    class="w-full h-11 px-3.5 pl-10 rounded-lg bg-surface-container-low border border-outline-variant/80 text-on-surface text-xs sm:text-sm font-mono tracking-widest text-center sm:text-left focus:outline-none focus:border-primary-container focus:bg-white transition"
                                />
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">security</span>
                            </div>
                            @error('security_code') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-12 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-2 border-t border-outline-variant/30">
                            <div class="flex items-center gap-3 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[16px] text-secondary">info</span>
                                <span>Lapisan keamanan untuk melindungi privasi data warga Kabupaten Blitar.</span>
                            </div>
                            <button 
                                type="submit" 
                                class="h-11 px-6 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-bold text-xs sm:text-sm inline-flex items-center justify-center gap-2 shadow-sm transition"
                            >
                                <span class="material-symbols-outlined text-[18px]">travel_explore</span>
                                <span>Lacak Status Permohonan</span>
                            </button>
                        </div>
                    </form>

                    @if($errorMessage)
                        <div class="mt-4 p-3 rounded-lg bg-red-50 border border-red-200 text-error text-xs flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <span>{{ $errorMessage }}</span>
                        </div>
                    @endif
                </section>

                <!-- ================= HASIL PELACAKAN SERVICE REQUEST ================= -->
                @if($serviceRequest)
                    @php
                        $status = $serviceRequest->status;
                        $statusValue = $status?->value ?? $status;
                        $statusLabel = $status?->label() ?? ucfirst(str_replace('_', ' ', $statusValue));

                        $isRevision = ($statusValue === 'revision_requested');
                        $isFinished = in_array($statusValue, ['issued', 'completed', 'reactivated']);
                        $isRejected = in_array($statusValue, ['rejected', 'ministry_rejected']);

                        $statusBadgeClass = match($statusValue) {
                            'completed', 'issued', 'reactivated' => 'bg-emerald-100 text-emerald-800',
                            'revision_requested' => 'bg-amber-100 text-amber-800 animate-pulse',
                            'rejected', 'ministry_rejected' => 'bg-red-100 text-red-800',
                            default => 'bg-blue-100 text-blue-800',
                        };

                        // Masking
                        $rawNik = $serviceRequest->applicant_nik;
                        $maskedNik = substr($rawNik, 0, 4) . ' ' . substr($rawNik, 4, 2) . '** **** ' . substr($rawNik, -4);
                        $nameParts = explode(' ', $serviceRequest->applicant_name);
                        $maskedName = $nameParts[0] . (count($nameParts) > 1 ? ' ' . substr($nameParts[1], 0, 1) . str_repeat('*', max(1, strlen($nameParts[1]) - 1)) : '');
                    @endphp

                    <!-- FRAME C (CONDITIONAL ALERT): Urgent Action / Correction Notice -->
                    @if($isRevision)
                        <section class="rounded-xl border border-amber-300 bg-amber-50 shadow-sm p-6 relative overflow-hidden">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 flex items-center justify-center shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-[24px]">warning</span>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <span class="text-xs font-bold text-amber-900 uppercase tracking-wide flex items-center gap-1.5">
                                            Perhatian: Berkas Membutuhkan Perbaikan / Klarifikasi
                                        </span>
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-200 text-amber-950 font-bold text-xs">
                                            Batas Waktu: 2x24 Jam
                                        </span>
                                    </div>
                                    <div class="bg-white/90 rounded-lg p-3 border border-amber-200 text-xs text-on-surface">
                                        <div class="flex items-center gap-1 text-[11px] text-amber-800 font-semibold mb-1">
                                            <span class="material-symbols-outlined text-[15px]">rate_review</span>
                                            <span>Catatan Verifikator Dinas Sosial:</span>
                                        </div>
                                        <p class="leading-relaxed">
                                            {{ $serviceRequest->officer_notes ?? 'Foto dokumen Kartu Keluarga / KTP kurang jelas atau buram. Mohon unggah ulang foto asli lembar dokumen yang terbaca tajam agar dapat segera diproses.' }}
                                        </p>
                                    </div>

                                    <!-- Quick Revision Upload Form -->
                                    <div class="space-y-2 pt-1">
                                        <label class="text-xs font-bold text-on-surface block">Unggah Berkas Perbaikan Pengganti</label>
                                        <input type="file" wire:model="file_revision" class="text-xs w-full text-on-surface-variant"/>
                                        @error('file_revision') <span class="text-error text-[11px] block">{{ $message }}</span> @enderror

                                        <input type="text" wire:model="revisionNote" placeholder="Catatan perbaikan (mis. Foto KK halaman depan diperjelas)..." class="w-full h-9 px-3 rounded-lg bg-white border border-amber-300 text-xs text-on-surface focus:outline-none focus:border-amber-600"/>

                                        <button 
                                            type="button" 
                                            wire:click="uploadRevision" 
                                            class="px-5 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-sm transition inline-flex items-center gap-1.5"
                                        >
                                            <span class="material-symbols-outlined text-[16px]">send</span>
                                            <span>Kirim Perbaikan Berkas Sekarang</span>
                                        </button>

                                        @if($revisionUploaded)
                                            <span class="text-xs text-emerald-800 font-bold block pt-1">
                                                ✓ Berkas perbaikan berhasil diunggah! Status permohonan telah diperbarui.
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    <!-- Finished Certificate Download Card -->
                    @if($isFinished && $serviceRequest->dtsenCertificate)
                        <section class="rounded-xl border border-emerald-300 bg-emerald-50 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md">
                                    <span class="material-symbols-outlined text-[28px]">verified</span>
                                </div>
                                <div>
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-200 text-emerald-950 font-bold text-[10px] uppercase">
                                        Dokumen Resmi Sah Terbit
                                    </span>
                                    <h3 class="font-bold text-base text-emerald-950 mt-0.5">Surat Keterangan DTSEN Siap Diunduh!</h3>
                                    <p class="text-xs text-emerald-800 mt-0.5">
                                        Nomor Surat: {{ $serviceRequest->dtsenCertificate->certificate_number ?? '400.9/123/409.105/2026' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0 w-full sm:w-auto">
                                <a 
                                    href="{{ route('verifikasi', ['code' => $serviceRequest->dtsenCertificate->verification_code ?? 'VRF-202610-001']) }}" 
                                    class="px-4 py-2.5 rounded-lg bg-white border border-emerald-300 text-emerald-800 font-bold text-xs hover:bg-emerald-100 transition shadow-sm inline-flex items-center gap-1"
                                >
                                    <span class="material-symbols-outlined text-[16px]">qr_code_scanner</span>
                                    <span>Verifikasi SK</span>
                                </a>
                                <a 
                                    href="#" 
                                    onclick="window.print();"
                                    class="px-5 py-2.5 rounded-lg bg-emerald-700 text-white font-bold text-xs hover:bg-emerald-800 transition shadow-sm inline-flex items-center gap-1.5"
                                >
                                    <span class="material-symbols-outlined text-[18px]">download</span>
                                    <span>Unduh Surat (PDF)</span>
                                </a>
                            </div>
                        </section>
                    @endif

                    <!-- FRAME B: Live Tracking Result -->
                    <section class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 overflow-hidden">
                        <!-- Result Header Card -->
                        <div class="p-6 border-b border-outline-variant/30 bg-surface-container-low/40">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="space-y-2">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="px-3 py-1 rounded-md bg-primary-container text-on-primary font-mono font-bold text-xs sm:text-sm tracking-wide">
                                            {{ $serviceRequest->request_number }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $statusBadgeClass }}">
                                            <span class="w-2 h-2 rounded-full bg-current"></span>
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                    <h3 class="font-bold text-lg text-on-surface">
                                        {{ $serviceRequest->serviceType?->name ?? 'Pengajuan Layanan Sosial' }}
                                    </h3>
                                    <p class="text-xs text-on-surface-variant flex flex-wrap items-center gap-x-4 gap-y-1">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[15px]">event</span>
                                            Diajukan: {{ $serviceRequest->submitted_at ? $serviceRequest->submitted_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[15px]">domain</span>
                                            Dinas Sosial Kabupaten Blitar
                                        </span>
                                    </p>
                                </div>
                                <button type="button" onclick="window.print()" class="px-3.5 py-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold text-xs inline-flex items-center gap-1.5 transition self-start lg:self-auto shrink-0">
                                    <span class="material-symbols-outlined text-[16px]">print</span>
                                    <span>Cetak Lembar Lacak</span>
                                </button>
                            </div>

                            <!-- Masked Profile Banner -->
                            <div class="mt-4 p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/40 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                                <div>
                                    <span class="text-on-surface-variant block text-[11px]">Nama Pemohon:</span>
                                    <span class="font-bold text-on-surface">{{ $maskedName }}</span>
                                </div>
                                <div>
                                    <span class="text-on-surface-variant block text-[11px]">NIK Terproteksi:</span>
                                    <span class="font-mono text-on-surface">{{ $maskedNik }}</span>
                                </div>
                                <div>
                                    <span class="text-on-surface-variant block text-[11px]">Wilayah:</span>
                                    <span class="font-bold text-on-surface truncate block">
                                        {{ $serviceRequest->village?->name }}, {{ $serviceRequest->village?->district?->name }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-on-surface-variant block text-[11px]">Prioritas Layanan:</span>
                                    <span class="font-bold {{ $serviceRequest->is_priority ? 'text-primary' : 'text-on-surface' }}">
                                        {{ $serviceRequest->is_priority ? 'Prioritas Khusus' : 'Reguler' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Vertical Step Timeline -->
                        <div class="p-6">
                            <h4 class="font-bold text-sm text-on-surface mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">timeline</span>
                                Riwayat Perkembangan Berkas
                            </h4>

                            <div class="relative pl-6 space-y-6 before:content-[''] before:absolute before:left-3 before:top-2 before:bottom-3 before:w-0.5 before:bg-outline-variant/40 ml-2">
                                <!-- Step 1: Diajukan -->
                                <div class="relative flex items-start gap-4">
                                    <div class="absolute -left-[27px] w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center ring-4 ring-white shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </div>
                                    <div class="flex-1 bg-surface-container-low/60 rounded-xl p-3 border border-outline-variant/30">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                            <span class="font-bold text-xs text-on-surface">1. Permohonan Diterima Sistem SAPA SOSIAL</span>
                                            <span class="text-[10px] text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded font-semibold">{{ $serviceRequest->submitted_at?->format('d/m/Y H:i') }} WIB</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Berkas registrasi mandiri berhasil diterima secara online dan masuk ke antrean verifikasi.</p>
                                    </div>
                                </div>

                                <!-- Step 2: Pemeriksaan Berkas -->
                                <div class="relative flex items-start gap-4">
                                    <div class="absolute -left-[27px] w-7 h-7 rounded-full {{ in_array($statusValue, ['submitted']) ? 'bg-blue-600 text-white animate-pulse' : 'bg-emerald-600 text-white' }} flex items-center justify-center ring-4 ring-white shadow-sm shrink-0">
                                        @if(in_array($statusValue, ['submitted']))
                                            <span class="material-symbols-outlined text-[16px]">hourglass_top</span>
                                        @else
                                            <span class="material-symbols-outlined text-[16px]">check</span>
                                        @endif
                                    </div>
                                    <div class="flex-1 bg-surface-container-low/60 rounded-xl p-3 border border-outline-variant/30">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                            <span class="font-bold text-xs text-on-surface">2. Pemeriksaan Berkas & Administrasi</span>
                                            <span class="text-[10px] text-on-surface-variant font-semibold">
                                                {{ in_array($statusValue, ['submitted']) ? 'Sedang Berlangsung' : 'Selesai Diperiksa' }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Verifikator dinas memeriksa kelengkapan scan KTP, KK, serta persyaratan administratif lainnya.</p>
                                    </div>
                                </div>

                                <!-- Step 3: Verifikasi Data SIKS-NG -->
                                <div class="relative flex items-start gap-4">
                                    <div class="absolute -left-[27px] w-7 h-7 rounded-full {{ in_array($statusValue, ['document_check', 'data_verification', 'eligibility_verification']) ? 'bg-blue-600 text-white animate-pulse' : (in_array($statusValue, ['submitted']) ? 'bg-surface-container-high text-on-surface-variant' : 'bg-emerald-600 text-white') }} flex items-center justify-center ring-4 ring-white shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">sync</span>
                                    </div>
                                    <div class="flex-1 bg-surface-container-low/60 rounded-xl p-3 border border-outline-variant/30">
                                        <span class="font-bold text-xs text-on-surface">3. Pengecekan Data Basis Terpadu SIKS-NG</span>
                                        <p class="text-xs text-on-surface-variant mt-1">Penyelarasan status kepesertaan DTSEN / desil ekonomi pada basis data Kementerian Sosial RI.</p>
                                    </div>
                                </div>

                                <!-- Step 4: Persetujuan Pejabat & TTE -->
                                <div class="relative flex items-start gap-4">
                                    <div class="absolute -left-[27px] w-7 h-7 rounded-full {{ in_array($statusValue, ['awaiting_approval']) ? 'bg-blue-600 text-white animate-pulse' : ($isFinished ? 'bg-emerald-600 text-white' : 'bg-surface-container-high text-on-surface-variant') }} flex items-center justify-center ring-4 ring-white shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">draw</span>
                                    </div>
                                    <div class="flex-1 bg-surface-container-low/60 rounded-xl p-3 border border-outline-variant/30">
                                        <span class="font-bold text-xs text-on-surface">4. Validasi Paraf Kabid & Tanda Tangan Kadis</span>
                                        <p class="text-xs text-on-surface-variant mt-1">Pengesahan dokumen resmi oleh Kepala Dinas Sosial Kabupaten Blitar menggunakan Sertifikat Elektronik BSrE.</p>
                                    </div>
                                </div>

                                <!-- Step 5: Dokumen Terbit -->
                                <div class="relative flex items-start gap-4">
                                    <div class="absolute -left-[27px] w-7 h-7 rounded-full {{ $isFinished ? 'bg-emerald-600 text-white' : 'bg-surface-container-high text-on-surface-variant' }} flex items-center justify-center ring-4 ring-white shadow-sm shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">task_alt</span>
                                    </div>
                                    <div class="flex-1 bg-surface-container-low/60 rounded-xl p-3 border border-outline-variant/30">
                                        <span class="font-bold text-xs text-on-surface">5. Dokumen Selesai / Terbit</span>
                                        <p class="text-xs text-on-surface-variant mt-1">Dokumen resmi ber-QR Code siap diunduh secara mandiri oleh pemohon.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                <!-- ================= HASIL PELACAKAN PENGADUAN ================= -->
                @if($complaint)
                    <section class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-outline-variant/30">
                            <div>
                                <span class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-mono font-bold text-xs">
                                    {{ $complaint->complaint_number }}
                                </span>
                                <h3 class="font-bold text-base text-on-surface mt-2">
                                    Pengaduan: {{ $complaint->category?->name ?? 'Laporan Masalah Sosial' }}
                                </h3>
                                <p class="text-xs text-on-surface-variant mt-0.5">
                                    Dilaporkan: {{ $complaint->reported_at?->translatedFormat('d F Y, H:i') }} WIB | Wilayah: {{ $complaint->village?->name }}, {{ $complaint->village?->district?->name }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-900 font-bold text-xs self-start sm:self-auto">
                                Status: {{ $complaint->status?->label() ?? 'Diterima' }}
                            </span>
                        </div>

                        <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 text-xs text-on-surface space-y-2">
                            <span class="font-bold block text-on-surface">Uraian Laporan:</span>
                            <p class="leading-relaxed text-on-surface-variant">{{ $complaint->description }}</p>
                            @if($complaint->location_detail)
                                <p class="text-[11px] text-on-surface-variant">Patokan Lokasi: {{ $complaint->location_detail }}</p>
                            @endif
                        </div>

                        <!-- Status Timeline Pengaduan -->
                        <div class="space-y-3">
                            <h4 class="font-bold text-xs uppercase tracking-wider text-on-surface">Progres Penanganan:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 text-center text-xs">
                                <div class="p-3 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 font-semibold">
                                    ✓ 1. Diterima
                                </div>
                                <div class="p-3 rounded-lg bg-surface-container-low text-on-surface border border-outline-variant/30 font-semibold">
                                    2. Verifikasi Pengawas
                                </div>
                                <div class="p-3 rounded-lg bg-surface-container-low text-on-surface-variant border border-outline-variant/30">
                                    3. Tindak Lapangan
                                </div>
                                <div class="p-3 rounded-lg bg-surface-container-low text-on-surface-variant border border-outline-variant/30">
                                    4. Selesai Ditangani
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>

            <!-- Right Column (4 Cols): Quick Assist & Tips -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Info Panel -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-4">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Panduan Tiket</span>
                    <h3 class="font-bold text-base text-on-surface">Format Nomor Registrasi Tiket</h3>

                    <div class="space-y-3 text-xs text-on-surface-variant">
                        <div class="p-3 rounded-lg bg-surface-container-low border border-outline-variant/30">
                            <span class="font-bold text-primary block">DTSEN-YYYYMM-XXXXX</span>
                            <span class="text-[11px] mt-0.5 block">Surat Keterangan DTSEN untuk keperluan sekolah/beasiswa.</span>
                        </div>
                        <div class="p-3 rounded-lg bg-surface-container-low border border-outline-variant/30">
                            <span class="font-bold text-secondary block">PBI-YYYYMM-XXXXX</span>
                            <span class="text-[11px] mt-0.5 block">Reaktivasi KIS / PBI-JK jaminan kesehatan darurat.</span>
                        </div>
                        <div class="p-3 rounded-lg bg-surface-container-low border border-outline-variant/30">
                            <span class="font-bold text-tertiary block">ADU-YYYYMM-XXXXX</span>
                            <span class="text-[11px] mt-0.5 block">Pengaduan dan laporan masalah sosial masyarakat.</span>
                        </div>
                    </div>
                </div>

                <!-- Assistance Card -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-3">
                    <span class="material-symbols-outlined text-primary text-3xl">contact_support</span>
                    <h4 class="font-bold text-sm text-on-surface">Butuh Bantuan Pelacakan?</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Jika status tidak berubah lebih dari 3 hari kerja atau Anda kehilangan nomor tiket, hubungi tim konsultasi resmi kami.
                    </p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-full py-2.5 px-4 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-bold text-xs transition flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">chat</span>
                        <span>WhatsApp Bantuan Dinsos</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
