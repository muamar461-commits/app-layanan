<div class="flex flex-col w-full pb-16">
    <!-- Sub-header Ribbon -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between text-xs text-on-surface-variant font-medium">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <a href="{{ route('layanan.index') }}" class="hover:text-primary transition-colors">Layanan</a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Formulir Pengajuan</span>
            </nav>
            <div class="hidden sm:flex items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                    Portal Registrasi Mandiri
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @if($isSubmitted)
            <!-- ================= HALAMAN 9: PENGAJUAN BERHASIL ================= -->
            <div class="max-w-4xl mx-auto bg-surface-container-lowest rounded-2xl shadow-md p-6 sm:p-10 border border-outline-variant/60 flex flex-col gap-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container via-secondary-container to-emerald-600"></div>

                <!-- Hero Success Header -->
                <div class="flex flex-col items-center text-center gap-3 max-w-xl mx-auto pt-2">
                    <div class="relative flex items-center justify-center">
                        <div class="absolute w-20 h-20 rounded-full bg-emerald-500/20 animate-ping opacity-75"></div>
                        <div class="w-16 h-16 rounded-full bg-emerald-600 text-on-primary flex items-center justify-center shadow-lg relative z-10">
                            <span class="material-symbols-outlined text-[36px]">check</span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        Registrasi Berhasil Terkirim ke Sistem
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Pengajuan Berhasil Dikirim!</h1>
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        Permohonan Anda untuk <strong class="text-on-surface">{{ $submittedServiceName }}</strong> telah diterima oleh sistem SAPA SOSIAL Dinas Sosial Kabupaten Blitar dan telah masuk ke antrean verifikator dinas.
                    </p>
                </div>

                <!-- Ticket Number Highlight Box -->
                <div class="bg-surface-container-low rounded-xl p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-4 border-primary-container">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Nomor Registrasi Tiket Anda</span>
                        <div class="text-2xl sm:text-3xl font-extrabold text-primary tracking-tight font-mono select-all">
                            {{ $generatedTicketNumber }}
                        </div>
                        <p class="text-xs text-on-surface-variant flex items-center gap-1 pt-0.5">
                            <span class="material-symbols-outlined text-[16px] text-secondary">info</span>
                            Simpan nomor tiket ini untuk melacak proses verifikasi dokumen Anda.
                        </p>
                    </div>
                    <div class="flex items-center gap-2 shrink-0" x-data="{ copied: false }">
                        <button 
                            type="button" 
                            @click="navigator.clipboard.writeText('{{ $generatedTicketNumber }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="px-4 py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-semibold text-xs border border-outline-variant/60 hover:bg-surface-container shadow-sm transition flex items-center gap-1.5"
                        >
                            <span class="material-symbols-outlined text-[18px] text-primary" x-show="!copied">content_copy</span>
                            <span class="material-symbols-outlined text-[18px] text-emerald-600" x-show="copied" style="display:none;">check</span>
                            <span x-text="copied ? 'Tersalin!' : 'Salin Nomor Tiket'">Salin Nomor Tiket</span>
                        </button>
                    </div>
                </div>

                <!-- Summary Details -->
                <div class="bg-surface rounded-xl p-5 border border-outline-variant/40 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <span class="text-on-surface-variant block mb-1">Layanan yang Diajukan</span>
                        <span class="font-bold text-on-surface text-sm block">{{ $submittedServiceName }}</span>
                    </div>
                    <div>
                        <span class="text-on-surface-variant block mb-1">Waktu Pendaftaran</span>
                        <span class="font-bold text-on-surface text-sm block">{{ $submittedDate }}</span>
                    </div>
                    <div>
                        <span class="text-on-surface-variant block mb-1">Status Dokumen</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 font-semibold text-xs">
                            Diajukan (Menunggu Antrean)
                        </span>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant/40 space-y-3">
                    <h3 class="font-bold text-sm text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">checklist</span>
                        Langkah Selanjutnya yang Perlu Anda Ketahui:
                    </h3>
                    <ul class="space-y-2 text-xs text-on-surface-variant pl-6 list-disc leading-relaxed">
                        <li>Petugas verifikator Dinas Sosial akan memeriksa keabsahan dan kejelasan dokumen dalam 1-2 hari kerja.</li>
                        <li>Jika ada berkas yang kurang jelas (foto buram/terpotong), sistem akan meminta perbaikan berkas yang dapat diunggah ulang pada halaman Cek Status.</li>
                        <li>Setelah disahkan oleh Kepala Dinas, dokumen resmi (PDF ber-QR Code) dapat langsung diunduh secara mandiri.</li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-outline-variant/30">
                    <button 
                        type="button" 
                        wire:click="resetForm" 
                        class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:bg-surface-container transition"
                    >
                        &larr; Ajukan Permohonan Baru
                    </button>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a 
                            href="{{ route('cek-status', ['ticket' => $generatedTicketNumber]) }}" 
                            class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-primary-container text-on-primary text-xs font-bold hover:bg-primary transition shadow-md flex items-center justify-center gap-1.5"
                        >
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            <span>Lacak Status Tiket Ini</span>
                        </a>
                        <a 
                            href="{{ route('home') }}" 
                            class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-surface-container text-on-surface text-xs font-semibold hover:bg-surface-container-high transition"
                        >
                            Beranda
                        </a>
                    </div>
                </div>
            </div>

        @else

            <!-- ================= MODE SWITCHER / SERVICE SELECTION TABS ================= -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-block w-2.5 h-6 bg-primary-container rounded-full"></span>
                            <span class="text-xs font-bold text-primary-container uppercase tracking-wider">Formulir Pendaftaran Online</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">
                            @if($mode === 'dtsen') Formulir Surat Keterangan DTSEN
                            @elseif($mode === 'pbi') Formulir Reaktivasi KIS / PBI-JK
                            @elseif($mode === 'rehab') Permohonan Pelayanan Rehabilitasi Sosial
                            @else Formulir Pengajuan Layanan Sosial Lainnya
                            @endif
                        </h1>
                        <p class="text-xs sm:text-sm text-on-surface-variant mt-1">
                            Isi formulir berikut dengan data yang valid sesuai identitas e-KTP dan Kartu Keluarga Anda.
                        </p>
                    </div>

                    <!-- Trust Tag -->
                    <div class="flex items-center gap-2 text-xs">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 font-semibold border border-emerald-200">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                            Layanan Gratis (Rp 0)
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-surface-container-high text-on-surface-variant font-medium">
                            <span class="material-symbols-outlined text-[16px]">timer</span>
                            Proses 1-2 Hari
                        </span>
                    </div>
                </div>

                <!-- Service Selector Pills -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-outline-variant/30">
                    <button 
                        type="button" 
                        wire:click="switchMode('dtsen')"
                        class="whitespace-nowrap px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition-all {{ $mode === 'dtsen' ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">description</span>
                        <span>Surat Keterangan DTSEN</span>
                    </button>
                    <button 
                        type="button" 
                        wire:click="switchMode('pbi')"
                        class="whitespace-nowrap px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition-all {{ $mode === 'pbi' ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">health_and_safety</span>
                        <span>Reaktivasi KIS / PBI-JK</span>
                    </button>
                    <button 
                        type="button" 
                        wire:click="switchMode('rehab')"
                        class="whitespace-nowrap px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition-all {{ $mode === 'rehab' ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">diversity_1</span>
                        <span>Rehabilitasi Sosial</span>
                    </button>
                    <button 
                        type="button" 
                        wire:click="switchMode('lainnya')"
                        class="whitespace-nowrap px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition-all {{ $mode === 'lainnya' ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container border border-outline-variant/60' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">category</span>
                        <span>Layanan Lainnya</span>
                    </button>
                </div>
            </div>

            <!-- ================= FORM CONTENT CONTAINER ================= -->
            <div class="max-w-4xl mx-auto">

                @if($mode === 'dtsen')
                    <!-- ================= 4. DTSEN (4 LANGKAH) ================= -->
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 sm:p-8">
                        <!-- Stepper Nav Header -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-8 bg-surface-container-low p-2 rounded-xl">
                            <!-- Step 1 -->
                            <div class="flex items-center gap-2.5 p-2 rounded-lg {{ $dtsenStep === 1 ? 'bg-primary-container text-on-primary shadow-sm' : ($dtsenStep > 1 ? 'bg-emerald-50 text-emerald-800' : 'text-on-surface-variant') }}">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold shrink-0 {{ $dtsenStep === 1 ? 'bg-white text-primary' : ($dtsenStep > 1 ? 'bg-emerald-600 text-white' : 'bg-surface-container-high') }}">
                                    @if($dtsenStep > 1) <span class="material-symbols-outlined text-[16px]">check</span> @else 1 @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] uppercase font-semibold leading-none">Langkah 1</p>
                                    <p class="text-xs font-bold truncate mt-0.5">Tujuan Penggunaan</p>
                                </div>
                            </div>
                            <!-- Step 2 -->
                            <div class="flex items-center gap-2.5 p-2 rounded-lg {{ $dtsenStep === 2 ? 'bg-primary-container text-on-primary shadow-sm' : ($dtsenStep > 2 ? 'bg-emerald-50 text-emerald-800' : 'text-on-surface-variant') }}">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold shrink-0 {{ $dtsenStep === 2 ? 'bg-white text-primary' : ($dtsenStep > 2 ? 'bg-emerald-600 text-white' : 'bg-surface-container-high') }}">
                                    @if($dtsenStep > 2) <span class="material-symbols-outlined text-[16px]">check</span> @else 2 @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] uppercase font-semibold leading-none">Langkah 2</p>
                                    <p class="text-xs font-bold truncate mt-0.5">Data Pemohon</p>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="flex items-center gap-2.5 p-2 rounded-lg {{ $dtsenStep === 3 ? 'bg-primary-container text-on-primary shadow-sm' : ($dtsenStep > 3 ? 'bg-emerald-50 text-emerald-800' : 'text-on-surface-variant') }}">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold shrink-0 {{ $dtsenStep === 3 ? 'bg-white text-primary' : ($dtsenStep > 3 ? 'bg-emerald-600 text-white' : 'bg-surface-container-high') }}">
                                    @if($dtsenStep > 3) <span class="material-symbols-outlined text-[16px]">check</span> @else 3 @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] uppercase font-semibold leading-none">Langkah 3</p>
                                    <p class="text-xs font-bold truncate mt-0.5">Unggah Berkas</p>
                                </div>
                            </div>
                            <!-- Step 4 -->
                            <div class="flex items-center gap-2.5 p-2 rounded-lg {{ $dtsenStep === 4 ? 'bg-primary-container text-on-primary shadow-sm' : 'text-on-surface-variant' }}">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold shrink-0 {{ $dtsenStep === 4 ? 'bg-white text-primary' : 'bg-surface-container-high' }}">
                                    4
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] uppercase font-semibold leading-none">Langkah 4</p>
                                    <p class="text-xs font-bold truncate mt-0.5">Tinjau & Kirim</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 1: Tujuan Penggunaan -->
                        @if($dtsenStep === 1)
                            <div class="space-y-6">
                                <div>
                                    <h3 class="font-bold text-base text-on-surface">Pilih Tujuan Penggunaan Surat DTSEN</h3>
                                    <p class="text-xs text-on-surface-variant mt-1">
                                        Pilihlah salah satu peruntukan surat yang sesuai. Batas desil akan diverifikasi berdasarkan ketentuan masing-masing tujuan.
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($dtsenPurposes as $purpose)
                                        <label class="relative flex items-start gap-3 p-4 rounded-xl border cursor-pointer transition {{ $dtsen_purpose_id == $purpose->id ? 'border-primary-container bg-primary-fixed/20 shadow-sm' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                            <input 
                                                type="radio" 
                                                wire:model.live="dtsen_purpose_id" 
                                                value="{{ $purpose->id }}" 
                                                class="mt-1 text-primary-container focus:ring-primary-container"
                                            />
                                            <div class="flex-1">
                                                <span class="font-bold text-sm text-on-surface block">{{ $purpose->name }}</span>
                                                <span class="text-xs text-on-surface-variant mt-0.5 block leading-relaxed">{{ $purpose->description }}</span>
                                                <span class="inline-block mt-2 text-[11px] font-semibold text-primary">
                                                    Maksimal Desil: Desil {{ $purpose->max_decile ?? 'Semua' }}
                                                </span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="pt-2">
                                    <label for="purpose_description" class="block text-xs font-semibold text-on-surface mb-1">Keterangan Tambahan / Nama Sekolah/Universitas/Instansi (Opsional)</label>
                                    <textarea 
                                        id="purpose_description" 
                                        wire:model="purpose_description" 
                                        rows="2" 
                                        placeholder="Contoh: Keperluan SPMB Jalur Afirmasi SMAN 1 Talun / KIP Kuliah UB Malang"
                                        class="w-full p-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"
                                    ></textarea>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-outline-variant/30">
                                    <button 
                                        type="button" 
                                        wire:click="nextDtsenStep" 
                                        class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm flex items-center gap-1"
                                    >
                                        <span>Lanjut: Data Pemohon</span>
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </button>
                                </div>
                            </div>

                        <!-- Step 2: Data Pemohon & Orang Yang Diterangkan -->
                        @elseif($dtsenStep === 2)
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-base text-on-surface">Data Identitas Pemohon</h3>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Identitas pemohon harus sesuai dengan e-KTP Kabupaten Blitar.</p>
                                    </div>
                                    @if($selectedPurpose)
                                        <span class="px-2.5 py-1 rounded-full bg-primary-fixed text-primary text-xs font-semibold">
                                            Tujuan: {{ $selectedPurpose->name }}
                                        </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="applicant_name" class="block text-xs font-semibold text-on-surface mb-1">Nama Lengkap Pemohon (Sesuai KTP) <span class="text-error">*</span></label>
                                        <input type="text" id="applicant_name" wire:model="applicant_name" placeholder="Nama lengkap..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        @error('applicant_name') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="applicant_nik" class="block text-xs font-semibold text-on-surface mb-1">NIK Pemohon (16 Digit) <span class="text-error">*</span></label>
                                        <input type="text" id="applicant_nik" wire:model="applicant_nik" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        @error('applicant_nik') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="family_card_number" class="block text-xs font-semibold text-on-surface mb-1">Nomor Kartu Keluarga (KK)</label>
                                        <input type="text" id="family_card_number" wire:model="family_card_number" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-xs font-semibold text-on-surface mb-1">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                                        <input type="text" id="phone" wire:model="phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        @error('phone') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="district_id" class="block text-xs font-semibold text-on-surface mb-1">Kecamatan <span class="text-error">*</span></label>
                                        <select id="district_id" wire:model.live="district_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                            <option value="">Pilih Kecamatan...</option>
                                            @foreach($districts as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="village_id" class="block text-xs font-semibold text-on-surface mb-1">Desa / Kelurahan <span class="text-error">*</span></label>
                                        <select id="village_id" wire:model="village_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                            <option value="">Pilih Desa...</option>
                                            @foreach($villages as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('village_id') <span class="text-error text-[11px] block mt-1">Wajib pilih desa</span> @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="address" class="block text-xs font-semibold text-on-surface mb-1">Alamat Lengkap (RT/RW, Dusun, Jalan) <span class="text-error">*</span></label>
                                        <input type="text" id="address" wire:model="address" placeholder="RT 02 RW 01 Dusun..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        @error('address') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Orang yang Diterangkan -->
                                <div class="pt-4 border-t border-outline-variant/30 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-bold text-sm text-on-surface">Data Orang yang Diterangkan</h4>
                                            <p class="text-[11px] text-on-surface-variant">Isi jika yang membutuhkan surat adalah anak / siswa / anggota keluarga lain.</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div>
                                            <label for="subject_name" class="block text-xs font-semibold text-on-surface mb-1">Nama Siswa / Yang Diterangkan</label>
                                            <input type="text" id="subject_name" wire:model="subject_name" placeholder="Nama siswa..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        </div>
                                        <div>
                                            <label for="subject_nik" class="block text-xs font-semibold text-on-surface mb-1">NIK Siswa / Yang Diterangkan</label>
                                            <input type="text" id="subject_nik" wire:model="subject_nik" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                        </div>
                                        <div>
                                            <label for="relationship_to_applicant" class="block text-xs font-semibold text-on-surface mb-1">Hubungan dengan Pemohon</label>
                                            <select id="relationship_to_applicant" wire:model="relationship_to_applicant" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                                <option value="Diri Sendiri">Diri Sendiri</option>
                                                <option value="Anak Kandung">Anak Kandung</option>
                                                <option value="Suami / Istri">Suami / Istri</option>
                                                <option value="Orang Tua">Orang Tua</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant/30">
                                    <button type="button" wire:click="prevDtsenStep" class="px-5 py-2.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:bg-surface-container transition">
                                        &larr; Kembali
                                    </button>
                                    <button type="button" wire:click="nextDtsenStep" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm flex items-center gap-1">
                                        <span>Lanjut: Unggah Berkas</span>
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </button>
                                </div>
                            </div>

                        <!-- Step 3: Unggah Berkas -->
                        @elseif($dtsenStep === 3)
                            <div class="space-y-6">
                                <div>
                                    <h3 class="font-bold text-base text-on-surface">Unggah Dokumen Persyaratan</h3>
                                    <p class="text-xs text-on-surface-variant mt-0.5">Unggah foto atau scan KTP dan Kartu Keluarga asli. Format: JPG, PNG, atau PDF (maks. 2 MB per berkas).</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Upload KTP -->
                                    <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center justify-center text-center gap-2">
                                        <span class="material-symbols-outlined text-3xl text-primary">badge</span>
                                        <div>
                                            <span class="font-bold text-xs text-on-surface block">Foto e-KTP Pemohon <span class="text-error">*</span></span>
                                            <span class="text-[11px] text-on-surface-variant">Pastikan NIK dan nama terbaca jelas</span>
                                        </div>
                                        <input type="file" wire:model="file_ktp" class="text-xs text-on-surface-variant file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-primary-container file:text-white hover:file:bg-primary cursor-pointer"/>
                                        @if($file_ktp)
                                            <span class="text-emerald-700 text-xs font-semibold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                                File terpilih
                                            </span>
                                        @endif
                                        @error('file_ktp') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Upload KK -->
                                    <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center justify-center text-center gap-2">
                                        <span class="material-symbols-outlined text-3xl text-primary">family_restroom</span>
                                        <div>
                                            <span class="font-bold text-xs text-on-surface block">Foto Kartu Keluarga (KK) <span class="text-error">*</span></span>
                                            <span class="text-[11px] text-on-surface-variant">Lembar KK terbaru Kabupaten Blitar</span>
                                        </div>
                                        <input type="file" wire:model="file_kk" class="text-xs text-on-surface-variant file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-primary-container file:text-white hover:file:bg-primary cursor-pointer"/>
                                        @if($file_kk)
                                            <span class="text-emerald-700 text-xs font-semibold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                                File terpilih
                                            </span>
                                        @endif
                                        @error('file_kk') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="p-3 rounded-lg bg-surface-container text-xs text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">security</span>
                                    <span>Dokumen Anda disimpan secara aman pada server terlindungi dan hanya dipergunakan untuk kepentingan verifikasi pelayanan Dinas Sosial.</span>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant/30">
                                    <button type="button" wire:click="prevDtsenStep" class="px-5 py-2.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:bg-surface-container transition">
                                        &larr; Kembali
                                    </button>
                                    <button type="button" wire:click="nextDtsenStep" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm flex items-center gap-1">
                                        <span>Lanjut: Tinjau & Kirim</span>
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </button>
                                </div>
                            </div>

                        <!-- Step 4: Tinjau & Kirim -->
                        @elseif($dtsenStep === 4)
                            <div class="space-y-6">
                                <div>
                                    <h3 class="font-bold text-base text-on-surface">Tinjau Ringkasan & Konfirmasi Pengajuan</h3>
                                    <p class="text-xs text-on-surface-variant mt-0.5">Periksa kembali data yang telah diisi sebelum mengirimkan permohonan ke verifikator dinas.</p>
                                </div>

                                <div class="bg-surface-container-low rounded-xl p-5 space-y-4 text-xs">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-3 border-b border-outline-variant/40">
                                        <div>
                                            <span class="text-on-surface-variant block">Tujuan Surat:</span>
                                            <span class="font-bold text-on-surface text-sm">{{ $selectedPurpose?->name ?? '-' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-on-surface-variant block">Keterangan Instansi:</span>
                                            <span class="font-medium text-on-surface">{{ $purpose_description ?: 'Keperluan pendidikan / beasiswa' }}</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-3 border-b border-outline-variant/40">
                                        <div>
                                            <span class="text-on-surface-variant block">Nama Pemohon:</span>
                                            <span class="font-bold text-on-surface">{{ $applicant_name }} (NIK: {{ $applicant_nik }})</span>
                                        </div>
                                        <div>
                                            <span class="text-on-surface-variant block">Nomor WhatsApp:</span>
                                            <span class="font-bold text-on-surface">{{ $phone }}</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-3 border-b border-outline-variant/40">
                                        <div>
                                            <span class="text-on-surface-variant block">Yang Diterangkan:</span>
                                            <span class="font-bold text-on-surface">{{ $subject_name ?: $applicant_name }} (Hubungan: {{ $relationship_to_applicant }})</span>
                                        </div>
                                        <div>
                                            <span class="text-on-surface-variant block">Domisili:</span>
                                            <span class="text-on-surface">{{ $address }}, {{ $selectedVillage?->name }}, {{ $selectedDistrict?->name }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 text-emerald-800">
                                        <span class="flex items-center gap-1 font-semibold">
                                            <span class="material-symbols-outlined text-[16px]">check</span> Berkas KTP terlampir
                                        </span>
                                        <span class="flex items-center gap-1 font-semibold">
                                            <span class="material-symbols-outlined text-[16px]">check</span> Berkas KK terlampir
                                        </span>
                                    </div>
                                </div>

                                <!-- Pernyataan Kebenaran Data -->
                                <div class="p-4 rounded-xl border border-secondary-fixed bg-secondary-fixed/20 flex items-start gap-3">
                                    <input 
                                        type="checkbox" 
                                        id="agreement" 
                                        wire:model="statement_agreement" 
                                        class="mt-1 rounded text-primary-container focus:ring-primary-container"
                                    />
                                    <label for="agreement" class="text-xs text-on-surface leading-relaxed cursor-pointer select-none">
                                        <strong>Pernyataan Tanggung Jawab Mutlak:</strong> Saya menyatakan bahwa seluruh data dan dokumen yang saya unggah adalah benar dan sah. Apabila di kemudian hari ditemukan keterangan yang tidak benar, saya bersedia diproses sesuai ketentuan hukum yang berlaku.
                                    </label>
                                </div>
                                @error('statement_agreement') <span class="text-error text-xs block -mt-3">Wajib menyetujui pernyataan kebenaran data</span> @enderror

                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant/30">
                                    <button type="button" wire:click="prevDtsenStep" class="px-5 py-2.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:bg-surface-container transition">
                                        &larr; Ubah Data
                                    </button>
                                    <button 
                                        type="button" 
                                        wire:click="submit" 
                                        class="px-8 py-3 rounded-xl bg-primary-container text-on-primary font-bold text-sm hover:bg-primary transition shadow-md flex items-center gap-2"
                                    >
                                        <span class="material-symbols-outlined text-[20px]">send</span>
                                        <span>Kirim Pengajuan Sekarang</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($mode === 'pbi')
                    <!-- ================= 5. REAKTIVASI KIS / PBI-JK ================= -->
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 sm:p-8 space-y-6">
                        <div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider">Layanan Jaminan Kesehatan</span>
                            <h2 class="text-xl font-bold text-on-surface mt-0.5">Formulir Usulan Reaktivasi KIS / PBI-JK</h2>
                            <p class="text-xs text-on-surface-variant mt-1">
                                Digunakan untuk memfasilitasi pengaktifan kembali kepesertaan BPJS Kesehatan PBI-JK yang nonaktif oleh Kemensos RI.
                            </p>
                        </div>

                        <!-- Notice Prioritas Medis -->
                        @if($pbi_reason === 'emergency')
                            <div class="p-4 rounded-xl bg-red-50 border border-red-200 flex items-start gap-3 text-red-900">
                                <span class="material-symbols-outlined text-primary text-[24px]">emergency</span>
                                <div>
                                    <h4 class="font-bold text-xs uppercase tracking-wide text-primary">Status Prioritas Darurat Medis Diaktifkan</h4>
                                    <p class="text-xs mt-0.5 text-red-800 leading-relaxed">
                                        Pengajuan dengan alasan kondisi darurat medis akan diprioritaskan paling atas di antrean verifikator dinas. Mohon pastikan melampirkan Surat Keterangan Rawat Inap/Darurat Faskes.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Section: Data Peserta -->
                        <div class="space-y-4">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">1. Data Identitas Peserta BPJS</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Peserta KIS (Sesuai KTP) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="applicant_name" placeholder="Nama peserta..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    @error('applicant_name') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">NIK Peserta (16 Digit) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="applicant_nik" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    @error('applicant_nik') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor Kartu BPJS / KIS (13 Digit) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="bpjs_card_number" maxlength="20" placeholder="0001234567890" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    @error('bpjs_card_number') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor HP / WhatsApp Aktif <span class="text-error">*</span></label>
                                    <input type="text" wire:model="phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Perkiraan Tanggal Kartu Nonaktif</label>
                                    <input type="date" wire:model="deactivated_date" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor Kartu Keluarga (KK)</label>
                                    <input type="text" wire:model="family_card_number" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kecamatan <span class="text-error">*</span></label>
                                    <select wire:model.live="district_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Kecamatan...</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Desa / Kelurahan <span class="text-error">*</span></label>
                                    <select wire:model="village_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Desa...</option>
                                        @foreach($villages as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Alamat Lengkap (RT/RW, Dusun) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="address" placeholder="Alamat sesuai KTP..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Alasan Reaktivasi -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">2. Alasan Kebutuhan Reaktivasi</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="p-3.5 rounded-xl border cursor-pointer flex items-center gap-3 {{ $pbi_reason === 'emergency' ? 'border-primary-container bg-red-50/50' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                    <input type="radio" wire:model.live="pbi_reason" value="emergency" class="text-primary-container focus:ring-primary-container"/>
                                    <div>
                                        <span class="font-bold text-xs text-on-surface block">Kondisi Darurat Medis (Rawat Inap)</span>
                                        <span class="text-[11px] text-on-surface-variant">Pasien sedang dirawat darurat di RS</span>
                                    </div>
                                </label>
                                <label class="p-3.5 rounded-xl border cursor-pointer flex items-center gap-3 {{ $pbi_reason === 'chronic' ? 'border-primary-container bg-red-50/50' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                    <input type="radio" wire:model.live="pbi_reason" value="chronic" class="text-primary-container focus:ring-primary-container"/>
                                    <div>
                                        <span class="font-bold text-xs text-on-surface block">Penyakit Kronis / Rutin Kontrol</span>
                                        <span class="text-[11px] text-on-surface-variant">Kebutuhan obat rutin / hemodialisa / kemoterapi</span>
                                    </div>
                                </label>
                                <label class="p-3.5 rounded-xl border cursor-pointer flex items-center gap-3 {{ $pbi_reason === 'newborn' ? 'border-primary-container bg-red-50/50' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                    <input type="radio" wire:model.live="pbi_reason" value="newborn" class="text-primary-container focus:ring-primary-container"/>
                                    <div>
                                        <span class="font-bold text-xs text-on-surface block">Bayi Baru Lahir dari Ibu PBI</span>
                                        <span class="text-[11px] text-on-surface-variant">Ibu telah terdaftar PBI-JK aktif</span>
                                    </div>
                                </label>
                                <label class="p-3.5 rounded-xl border cursor-pointer flex items-center gap-3 {{ $pbi_reason === 'other' ? 'border-primary-container bg-red-50/50' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                    <input type="radio" wire:model.live="pbi_reason" value="other" class="text-primary-container focus:ring-primary-container"/>
                                    <div>
                                        <span class="font-bold text-xs text-on-surface block">Lainnya / Pra-Sejahtera</span>
                                        <span class="text-[11px] text-on-surface-variant">Kondisi ekonomi kurang mampu</span>
                                    </div>
                                </label>
                            </div>

                            @if($pbi_reason === 'emergency' || $pbi_reason === 'chronic')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1">Nama Fasilitas Kesehatan (RS/Puskesmas)</label>
                                        <input type="text" wire:model="health_facility_name" placeholder="RSUD Ngudi Waluyo Wlingi / RSUD Srengat..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1">Nomor Surat Keterangan Rawat/Medis (Jika Ada)</label>
                                        <input type="text" wire:model="health_letter_number" placeholder="445/..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Section: Upload Berkas -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">3. Unggah Dokumen Pendukung</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="p-3 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                                    <span class="material-symbols-outlined text-2xl text-primary">badge</span>
                                    <span class="text-xs font-bold">KTP Peserta *</span>
                                    <input type="file" wire:model="file_ktp" class="text-[11px] w-full"/>
                                    @if($file_ktp) <span class="text-[10px] text-emerald-700 font-bold">File terpilih</span> @endif
                                </div>
                                <div class="p-3 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                                    <span class="material-symbols-outlined text-2xl text-primary">family_restroom</span>
                                    <span class="text-xs font-bold">Kartu Keluarga *</span>
                                    <input type="file" wire:model="file_kk" class="text-[11px] w-full"/>
                                    @if($file_kk) <span class="text-[10px] text-emerald-700 font-bold">File terpilih</span> @endif
                                </div>
                                <div class="p-3 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                                    <span class="material-symbols-outlined text-2xl text-primary">medical_information</span>
                                    <span class="text-xs font-bold">Kartu KIS / Surat Faskes</span>
                                    <input type="file" wire:model="file_faskes" class="text-[11px] w-full"/>
                                    @if($file_faskes) <span class="text-[10px] text-emerald-700 font-bold">File terpilih</span> @endif
                                </div>
                            </div>
                        </div>

                        <!-- Agreement Checkbox -->
                        <div class="p-3.5 rounded-xl border border-outline-variant/50 bg-surface-container flex items-start gap-2.5">
                            <input type="checkbox" id="agreePbi" wire:model="statement_agreement" class="mt-0.5 rounded text-primary-container focus:ring-primary-container"/>
                            <label for="agreePbi" class="text-xs text-on-surface leading-relaxed cursor-pointer select-none">
                                Saya menyatakan bahwa peserta benar-benar membutuhkan reaktivasi jaminan kesehatan untuk pengobatan, dan data yang diisi adalah benar.
                            </label>
                        </div>
                        @error('statement_agreement') <span class="text-error text-xs block -mt-2">Wajib dicentang</span> @enderror

                        <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                            <button type="button" wire:click="submit" class="px-8 py-3 rounded-xl bg-primary-container text-on-primary font-bold text-sm hover:bg-primary transition shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                <span>Kirim Permohonan Reaktivasi</span>
                            </button>
                        </div>
                    </div>

                @elseif($mode === 'rehab')
                    <!-- ================= 7. PERMOHONAN REHABILITASI SOSIAL ================= -->
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 sm:p-8 space-y-6">
                        <div>
                            <span class="text-xs font-bold text-tertiary uppercase tracking-wider">Perlindungan & Rehabilitasi</span>
                            <h2 class="text-xl font-bold text-on-surface mt-0.5">Permohonan Pelayanan Rehabilitasi Sosial</h2>
                            <p class="text-xs text-on-surface-variant mt-1">
                                Layanan pendampingan, assessment kebutuhan, dan fasilitasi rujukan panti bagi warga rentan dan pemerlu pelayanan kesejahteraan sosial.
                            </p>
                        </div>

                        <!-- Confidential Notice -->
                        <div class="p-3.5 rounded-xl bg-blue-50 border border-blue-200 flex items-start gap-3 text-blue-900">
                            <span class="material-symbols-outlined text-tertiary text-[22px]">privacy_tip</span>
                            <p class="text-xs leading-relaxed text-blue-800">
                                <strong>Kerahasiaan Terjamin:</strong> Data identitas klien dan keluarga bersifat rahasia dan hanya dapat diakses oleh petugas pekerja sosial dinas yang ditugaskan.
                            </p>
                        </div>

                        <!-- Pilih Kategori Klien -->
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-2">Kategori Pemerlu Pelayanan (PPKS) <span class="text-error">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                @foreach($clientCategories as $cat)
                                    <label class="p-3 rounded-xl border cursor-pointer text-center transition {{ $client_category_id == $cat->id ? 'border-tertiary-container bg-blue-50/70 text-tertiary font-bold shadow-sm' : 'border-outline-variant/60 hover:bg-surface-container text-on-surface-variant' }}">
                                        <input type="radio" wire:model="client_category_id" value="{{ $cat->id }}" class="sr-only"/>
                                        <span class="text-xs block">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Data Calon Klien -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">Identitas Calon Klien yang Membutuhkan Layanan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Calon Klien <span class="text-error">*</span></label>
                                    <input type="text" wire:model="client_name" placeholder="Nama lengkap klien..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"/>
                                    @error('client_name') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Perkiraan Usia (Tahun)</label>
                                    <input type="number" wire:model="client_age" placeholder="Contoh: 65" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Jenis Kelamin</label>
                                    <select wire:model="client_gender" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container">
                                        <option value="male">Laki-Laki</option>
                                        <option value="female">Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kecamatan Domisili <span class="text-error">*</span></label>
                                    <select wire:model.live="district_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container">
                                        <option value="">Pilih Kecamatan...</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Desa / Kelurahan <span class="text-error">*</span></label>
                                    <select wire:model="village_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container">
                                        <option value="">Pilih Desa...</option>
                                        @foreach($villages as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kondisi & Kebutuhan Klien Saat Ini <span class="text-error">*</span></label>
                                    <textarea wire:model="client_condition" rows="3" placeholder="Ceritakan kondisi kesehatan, kondisi keluarga, penelantaran, atau kebutuhan alat bantu/rujukan panti..." class="w-full p-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"></textarea>
                                    @error('client_condition') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Pemohon / Pelapor -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">Identitas Pemohon / Pihak yang Menghubungi</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Pemohon <span class="text-error">*</span></label>
                                    <input type="text" wire:model="applicant_name" placeholder="Nama Anda..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">No. WhatsApp Pemohon <span class="text-error">*</span></label>
                                    <input type="text" wire:model="phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Hubungan dengan Calon Klien</label>
                                    <input type="text" wire:model="applicant_relation_rehab" placeholder="Keluarga / Tetangga / Perangkat Desa..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-tertiary-container"/>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Pendukung -->
                        <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                            <span class="material-symbols-outlined text-2xl text-tertiary">upload_file</span>
                            <span class="text-xs font-bold">Unggah Foto Kondisi Klien / Dokumen Pendukung (Opsional)</span>
                            <span class="text-[11px] text-on-surface-variant">Foto situasi tempat tinggal atau dokumen identitas jika ada</span>
                            <input type="file" wire:model="file_dokumen_lain" class="text-xs mt-1"/>
                        </div>

                        <!-- Agreement Checkbox -->
                        <div class="p-3.5 rounded-xl border border-outline-variant/50 bg-surface-container flex items-start gap-2.5">
                            <input type="checkbox" id="agreeRehab" wire:model="statement_agreement" class="mt-0.5 rounded text-tertiary-container focus:ring-tertiary-container"/>
                            <label for="agreeRehab" class="text-xs text-on-surface leading-relaxed cursor-pointer select-none">
                                Saya menyatakan permohonan ini diajukan untuk kepentingan perlindungan dan penanganan sosial calon klien, serta bersedia dihubungi oleh petugas untuk assessment lebih lanjut.
                            </label>
                        </div>
                        @error('statement_agreement') <span class="text-error text-xs block -mt-2">Wajib dicentang</span> @enderror

                        <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                            <button type="button" wire:click="submit" class="px-8 py-3 rounded-xl bg-tertiary-container text-on-tertiary font-bold text-sm hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                <span>Kirim Permohonan Rehabilitasi</span>
                            </button>
                        </div>
                    </div>

                @else
                    <!-- ================= 6. LAYANAN SOSIAL LAINNYA ================= -->
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 sm:p-8 space-y-6">
                        <div>
                            <span class="text-xs font-bold text-primary uppercase tracking-wider">Formulir Pelayanan Terpadu</span>
                            <h2 class="text-xl font-bold text-on-surface mt-0.5">Pengajuan Layanan Sosial Lainnya</h2>
                            <p class="text-xs text-on-surface-variant mt-1">
                                Pilih jenis layanan yang Anda butuhkan untuk melihat persyaratan dan mengajukan secara online.
                            </p>
                        </div>

                        <!-- Step 1: Pilih Layanan -->
                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">Pilih Jenis Layanan Sosial <span class="text-error">*</span></label>
                            <select wire:model.live="service_type_id" class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                @foreach($serviceTypes as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }} ({{ $st->category }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Persyaratan Checklist Box -->
                        <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/40 space-y-2">
                            <span class="text-xs font-bold text-on-surface flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-[18px]">rule</span>
                                Persyaratan yang Perlu Disiapkan:
                            </span>
                            <ul class="text-xs text-on-surface-variant space-y-1 pl-5 list-disc leading-relaxed">
                                <li>Foto e-KTP Pemohon asli Kabupaten Blitar (Wajib)</li>
                                <li>Kartu Keluarga (KK) terbaru (Wajib)</li>
                                <li>Surat Pengantar RT/RW atau Surat Keterangan Desa (Jika diperlukan)</li>
                            </ul>
                        </div>

                        <!-- Form Data Pemohon -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">Identitas Diri Pemohon</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Lengkap Pemohon <span class="text-error">*</span></label>
                                    <input type="text" wire:model="applicant_name" placeholder="Nama..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">NIK Pemohon (16 Digit) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="applicant_nik" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                                    <input type="text" wire:model="phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor Kartu Keluarga (KK)</label>
                                    <input type="text" wire:model="family_card_number" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kecamatan <span class="text-error">*</span></label>
                                    <select wire:model.live="district_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Kecamatan...</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Desa / Kelurahan <span class="text-error">*</span></label>
                                    <select wire:model="village_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Desa...</option>
                                        @foreach($villages as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Alamat Lengkap (RT/RW, Dusun) <span class="text-error">*</span></label>
                                    <input type="text" wire:model="address" placeholder="Alamat lengkap..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Berkas -->
                        <div class="space-y-4 pt-2">
                            <h3 class="font-bold text-sm text-on-surface border-b border-outline-variant/30 pb-2">Unggah Berkas Persyaratan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                                    <span class="material-symbols-outlined text-2xl text-primary">badge</span>
                                    <span class="text-xs font-bold">KTP Pemohon (Wajib)</span>
                                    <input type="file" wire:model="file_ktp" class="text-xs"/>
                                </div>
                                <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center text-center gap-1.5">
                                    <span class="material-symbols-outlined text-2xl text-primary">family_restroom</span>
                                    <span class="text-xs font-bold">Kartu Keluarga (Wajib)</span>
                                    <input type="file" wire:model="file_kk" class="text-xs"/>
                                </div>
                            </div>
                        </div>

                        <!-- Agreement Checkbox -->
                        <div class="p-3.5 rounded-xl border border-outline-variant/50 bg-surface-container flex items-start gap-2.5">
                            <input type="checkbox" id="agreeGeneral" wire:model="statement_agreement" class="mt-0.5 rounded text-primary-container focus:ring-primary-container"/>
                            <label for="agreeGeneral" class="text-xs text-on-surface leading-relaxed cursor-pointer select-none">
                                Saya menyatakan bahwa data yang saya kirimkan adalah benar dan dapat dipertanggungjawabkan.
                            </label>
                        </div>
                        @error('statement_agreement') <span class="text-error text-xs block -mt-2">Wajib dicentang</span> @enderror

                        <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                            <button type="button" wire:click="submit" class="px-8 py-3 rounded-xl bg-primary-container text-on-primary font-bold text-sm hover:bg-primary transition shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                <span>Kirim Pengajuan</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

        @endif
    </div>
</div>
