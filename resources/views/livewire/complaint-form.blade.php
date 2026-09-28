<div class="flex flex-col w-full pb-16">
    <!-- Top Breadcrumb & Status Bar -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-2">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Pengaduan Sosial</span>
            </nav>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-semibold">
                    <span class="material-symbols-outlined text-[15px] text-emerald-600">verified</span>
                    Layanan Bebas Biaya (Rp 0)
                </span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-rose-50 text-rose-900 text-xs font-semibold">
                    <span class="material-symbols-outlined text-[15px] text-primary">security</span>
                    Kerahasiaan Terjamin
                </span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-50 text-amber-900 text-xs font-semibold">
                    <span class="material-symbols-outlined text-[15px] text-secondary">bolt</span>
                    Respon Awal &lt; 48 Jam
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @if($isSubmitted)
            <!-- ================= FRAME: LAPORAN TERKIRIM ================= -->
            <div class="max-w-3xl mx-auto bg-surface-container-lowest rounded-2xl shadow-md p-6 sm:p-10 border border-outline-variant/60 flex flex-col gap-6 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container via-primary to-emerald-600"></div>

                <div class="w-16 h-16 rounded-full bg-emerald-600 text-white flex items-center justify-center mx-auto shadow-lg shadow-emerald-600/20">
                    <span class="material-symbols-outlined text-[36px]">check</span>
                </div>

                <div>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-semibold mb-2">
                        Laporan Berhasil Diterima
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface">Laporan Pengaduan Berhasil Dikirim!</h1>
                    <p class="text-xs sm:text-sm text-on-surface-variant max-w-lg mx-auto mt-2 leading-relaxed">
                        Terima kasih atas partisipasi Anda dalam mengawasi dan melaporkan permasalahan sosial di Kabupaten Blitar. Laporan Anda telah masuk ke kanal pengawasan dinas.
                    </p>
                </div>

                <!-- Nomor Laporan Box -->
                <div class="bg-surface-container-low rounded-xl p-5 border-l-4 border-secondary-container text-left flex flex-col sm:flex-row sm:items-center justify-between gap-4" x-data="{ copied: false }">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Nomor Registrasi Laporan</span>
                        <div class="text-2xl sm:text-3xl font-extrabold text-primary font-mono select-all">
                            {{ $generatedComplaintNumber }}
                        </div>
                        <span class="text-xs text-on-surface-variant mt-1 block">Waktu: {{ $submittedDate }}</span>
                    </div>
                    <button 
                        type="button" 
                        @click="navigator.clipboard.writeText('{{ $generatedComplaintNumber }}'); copied = true; setTimeout(() => copied = false, 2000)"
                        class="px-4 py-2 rounded-lg bg-surface-container-lowest text-on-surface font-semibold text-xs border border-outline-variant/60 hover:bg-surface-container shadow-sm transition flex items-center gap-1.5 self-start sm:self-auto shrink-0"
                    >
                        <span class="material-symbols-outlined text-[18px] text-primary" x-show="!copied">content_copy</span>
                        <span class="material-symbols-outlined text-[18px] text-emerald-600" x-show="copied" style="display:none;">check</span>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Nomor Tiket'">Salin Nomor Tiket</span>
                    </button>
                </div>

                <!-- Info Catatan -->
                <div class="bg-surface-container-low/60 rounded-xl p-4 text-left text-xs text-on-surface-variant space-y-2">
                    <h4 class="font-bold text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                        Tahapan Tindak Lanjut:
                    </h4>
                    <p class="leading-relaxed">
                        1. Petugas verifikator pengawasan akan memeriksa kejelasan lokasi dan bukti yang dilaporkan.<br/>
                        2. Laporan akan didisposisikan kepada Pekerja Sosial / Tim Reaksi Cepat (TRC) di kecamatan terkait.<br/>
                        3. Anda dapat memantau hasil penanganan secara transparan menggunakan nomor laporan di atas.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4 border-t border-outline-variant/30">
                    <a href="{{ route('cek-status', ['ticket' => $generatedComplaintNumber]) }}" class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-md flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        <span>Lacak Tindak Lanjut</span>
                    </a>
                    <button type="button" wire:click="resetForm" class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-semibold text-xs hover:bg-surface-container-high transition">
                        Buat Laporan Baru
                    </button>
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-lg border border-outline-variant/60 text-on-surface-variant text-xs font-semibold hover:bg-surface-container transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

        @else

            <!-- ================= FORM PENGADUAN ================= -->
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Pengaduan & Laporan Masalah Sosial</h1>
                <p class="text-xs sm:text-sm text-on-surface-variant mt-1 max-w-3xl leading-relaxed">
                    Sampaikan keluhan penyaluran bansos, dugaan kecurangan, orang terlantar, atau permasalahan sosial di sekitar Anda secara transparan dan terpantau.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left Column: Form -->
                <div class="lg:col-span-8 flex flex-col gap-6">
                    <!-- Whistleblower Protection Banner -->
                    <div class="bg-primary/5 rounded-2xl p-5 border border-primary/20 shadow-sm flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[24px]">verified_user</span>
                        </div>
                        <div class="flex-1 space-y-1">
                            <h3 class="font-bold text-sm text-primary">Jaminan Perlindungan Pelapor (Whistleblower)</h3>
                            <p class="text-xs text-on-surface leading-relaxed">
                                Identitas Anda dijamin kerahasiaannya berdasarkan UU Pelayanan Publik dan Kode Etik Penanganan Pengaduan Dinas Sosial Kabupaten Blitar. Setiap laporan diverifikasi oleh Tim Pengawasan sebelum ditindaklanjuti ke lapangan.
                            </p>
                        </div>
                    </div>

                    <!-- Main Form Sheet -->
                    <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60 space-y-6">
                        <!-- Section 1: Kategori Permasalahan -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-primary-container text-on-primary text-xs font-bold flex items-center justify-center">1</span>
                                <h3 class="font-bold text-sm text-on-surface">Kategori Permasalahan Sosial <span class="text-error">*</span></h3>
                            </div>
                            <p class="text-xs text-on-surface-variant">Pilih rumpun permasalahan yang paling sesuai dengan kejadian yang ditemukan:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($categories as $cat)
                                    <label class="p-3.5 rounded-xl border cursor-pointer flex items-start gap-3 transition {{ $complaint_category_id == $cat->id ? 'border-primary-container bg-primary-fixed/20 shadow-sm' : 'border-outline-variant/60 hover:bg-surface-container-low' }}">
                                        <input type="radio" wire:model.live="complaint_category_id" value="{{ $cat->id }}" class="mt-0.5 text-primary-container focus:ring-primary-container"/>
                                        <div class="flex-1 min-w-0">
                                            <span class="font-bold text-xs text-on-surface block">{{ $cat->name }}</span>
                                            <span class="text-[11px] text-on-surface-variant block mt-0.5 leading-snug">{{ $cat->description }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('complaint_category_id') <span class="text-error text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Section 2: Lokasi Kejadian -->
                        <div class="space-y-3 pt-2 border-t border-outline-variant/30">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-primary-container text-on-primary text-xs font-bold flex items-center justify-center">2</span>
                                <h3 class="font-bold text-sm text-on-surface">Lokasi Kejadian Permasalahan <span class="text-error">*</span></h3>
                            </div>
                            <p class="text-xs text-on-surface-variant">Tentukan wilayah terjadinya permasalahan di Kabupaten Blitar:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kecamatan <span class="text-error">*</span></label>
                                    <select wire:model.live="district_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Kecamatan...</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Desa / Kelurahan <span class="text-error">*</span></label>
                                    <select wire:model="village_id" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container">
                                        <option value="">Pilih Desa...</option>
                                        @foreach($villages as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('village_id') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Alamat Rinci / Patokan Lokasi</label>
                                    <input type="text" wire:model="location_detail" placeholder="Contoh: RT 03 RW 02 Dusun Kebonagung, dekat Masjid..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Uraian & Bukti -->
                        <div class="space-y-3 pt-2 border-t border-outline-variant/30">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-primary-container text-on-primary text-xs font-bold flex items-center justify-center">3</span>
                                <h3 class="font-bold text-sm text-on-surface">Uraian Kejadian & Bukti Pendukung <span class="text-error">*</span></h3>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">
                                    Deskripsi Kejadian Secara Rinci (Siapa, Apa, Kapan, di Mana) <span class="text-error">*</span>
                                </label>
                                <textarea 
                                    wire:model="description" 
                                    rows="4" 
                                    placeholder="Jelaskan secara kronologis permasalahan yang Anda temukan. Semakin lengkap rincian, semakin cepat petugas dapat memverifikasi..."
                                    class="w-full p-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"
                                ></textarea>
                                @error('description') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Unggah Foto Kejadian / Bukti Dokumen (Opsional)</label>
                                <div class="p-4 rounded-xl border border-dashed border-outline-variant/80 bg-surface-container-low/50 flex flex-col items-center justify-center text-center gap-2">
                                    <span class="material-symbols-outlined text-3xl text-secondary">add_a_photo</span>
                                    <span class="text-xs font-bold text-on-surface">Pilih File Foto atau Dokumen Pendukung</span>
                                    <span class="text-[11px] text-on-surface-variant">JPG, PNG, atau PDF (Maks. 3 MB)</span>
                                    <input type="file" wire:model="attachment_file" class="text-xs"/>
                                    @if($attachment_file)
                                        <span class="text-emerald-700 text-xs font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                            File terpilih: {{ $attachment_file->getClientOriginalName() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Identitas Pelapor -->
                        <div class="space-y-3 pt-2 border-t border-outline-variant/30">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-primary-container text-on-primary text-xs font-bold flex items-center justify-center">4</span>
                                <h3 class="font-bold text-sm text-on-surface">Identitas Pelapor</h3>
                            </div>
                            <p class="text-xs text-on-surface-variant">Kontak diperlukan agar petugas dapat meminta klarifikasi atau menginformasikan hasil tindak lanjut.</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Pelapor <span class="text-error">*</span></label>
                                    <input type="text" wire:model="reporter_name" placeholder="Nama Anda / Inisial..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    @error('reporter_name') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                                    <input type="text" wire:model="reporter_phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                    @error('reporter_phone') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                            <button type="button" wire:click="submit" class="px-8 py-3 rounded-xl bg-primary-container text-on-primary font-bold text-sm hover:bg-primary transition shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">campaign</span>
                                <span>Kirim Laporan Pengaduan</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar Guidance -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-4">
                        <span class="text-xs font-bold text-primary uppercase tracking-wider">Standar Penanganan</span>
                        <h3 class="font-bold text-base text-on-surface">Alur Pengaduan Dinsos Blitar</h3>
                        
                        <div class="space-y-3 text-xs text-on-surface-variant">
                            <div class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-surface-container text-on-surface font-bold text-[11px] flex items-center justify-center shrink-0">1</span>
                                <p><strong class="text-on-surface">Penerimaan & Verifikasi:</strong> Petugas memeriksa bukti dan kelayakan materi aduan.</p>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-surface-container text-on-surface font-bold text-[11px] flex items-center justify-center shrink-0">2</span>
                                <p><strong class="text-on-surface">Disposisi & Koordinasi:</strong> Aduan diteruskan ke unit teknis atau TRC lapangan.</p>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-surface-container text-on-surface font-bold text-[11px] flex items-center justify-center shrink-0">3</span>
                                <p><strong class="text-on-surface">Tindakan Lapangan:</strong> Dilakukan penjangkauan, klarifikasi, atau fasilitasi bantuan.</p>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-emerald-600 text-white font-bold text-[11px] flex items-center justify-center shrink-0">4</span>
                                <p><strong class="text-on-surface">Penyelesaian:</strong> Hasil dicatat dalam sistem dan tiket ditutup.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hotline Direct -->
                    <div class="bg-secondary-fixed/30 rounded-2xl p-5 border border-secondary-fixed/80 space-y-2">
                        <span class="text-xs font-bold text-secondary uppercase tracking-wider flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">call</span>
                            Kontak Kedaruratan
                        </span>
                        <h4 class="font-bold text-xs text-on-surface">Laporan Kedaruratan (ODGJ / Orang Terlantar di Jalan)</h4>
                        <p class="text-[11px] text-on-surface-variant leading-relaxed">
                            Untuk kasus yang butuh evakuasi segera, Anda juga dapat menghubungi Call Center Satpol PP / Dinsos Blitar: <strong>(0342) 801-445</strong>
                        </p>
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>
