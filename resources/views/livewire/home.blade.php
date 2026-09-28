<div>
    <div class="flex flex-col w-full">
        <!-- Section 1: Hero Civic Portal -->
        <section class="relative w-full rounded-2xl bg-gradient-to-b from-surface-container-lowest via-surface-container-low to-surface-container p-6 sm:p-8 lg:p-12 overflow-hidden shadow-sm">
            <div class="absolute -right-20 -top-24 w-96 h-96 rounded-full bg-primary-container/5 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-secondary-container/10 blur-2xl pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 flex flex-col gap-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed w-fit">
                            <span class="material-symbols-outlined text-[18px]">verified_user</span>
                            <span class="text-xs font-semibold tracking-tight">Portal Resmi Dinas Sosial Kabupaten Blitar</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-on-surface tracking-tight leading-tight">
                            Satu Pintu Layanan Sosial <span class="text-primary-container">Kabupaten Blitar</span>
                        </h1>
                        <p class="text-base sm:text-lg text-on-surface-variant max-w-2xl leading-relaxed">
                            Ajukan layanan, sampaikan pengaduan, dan pantau prosesnya dengan nomor tiket — kapan saja, dari mana saja secara inklusif dan terpercaya.
                        </p>
                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <a href="{{ route('pengajuan') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary-container text-on-primary font-semibold hover:bg-primary transition-all shadow-md hover:shadow-lg">
                                <span>Ajukan Layanan</span>
                                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                            </a>
                            <a href="#lacak-tiket" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-surface-container-lowest text-primary-container font-semibold border border-outline-variant/60 shadow-sm hover:bg-surface-container transition-all">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                                <span>Cek Status Tiket</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Visual Card -->
                    <div class="lg:col-span-5 flex flex-col items-center">
                        <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl p-5 shadow-md border border-outline-variant/40 flex flex-col gap-4">
                            <div class="relative w-full h-48 rounded-xl overflow-hidden bg-gradient-to-tr from-primary-container via-red-800 to-amber-700 flex items-center justify-center p-6 text-white text-center">
                                <div class="absolute inset-0 bg-black/20"></div>
                                <div class="relative z-10 space-y-2">
                                    <div class="w-12 h-12 mx-auto rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center">
                                        <span class="material-symbols-outlined text-2xl text-white">volunteer_activism</span>
                                    </div>
                                    <p class="font-bold text-lg leading-snug">Pelayanan Ramah & Aksesibel</p>
                                    <p class="text-xs text-white/90">Dinas Sosial Kabupaten Blitar Siap Melayani Warga</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div class="bg-surface-container-low rounded-xl p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary-container shrink-0">
                                        <span class="material-symbols-outlined text-[22px]">diversity_3</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-lg text-on-surface">{{ $districtCount }}</span>
                                        <span class="text-xs text-on-surface-variant leading-none">Kecamatan Terjangkau</span>
                                    </div>
                                </div>
                                <div class="bg-surface-container-low rounded-xl p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-secondary-container/20 flex items-center justify-center text-secondary shrink-0">
                                        <span class="material-symbols-outlined text-[22px]">schedule</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-lg text-on-surface">&lt; 48 Jam</span>
                                        <span class="text-xs text-on-surface-variant leading-none">Rata-rata Respon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges Strip -->
                <div class="mt-8 pt-6 grid grid-cols-1 md:grid-cols-3 gap-4 bg-surface-container-lowest rounded-xl p-4 shadow-sm border border-outline-variant/40">
                    <div class="flex items-center gap-3 px-2">
                        <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary-container shrink-0">
                            <span class="material-symbols-outlined text-[22px]">payments</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-on-surface">100% Layanan Gratis</span>
                            <span class="text-xs text-on-surface-variant">Bebas pungli dan retribusi apapun</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-2">
                        <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[22px]">timeline</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-on-surface">Proses Transparan & Terlacak</span>
                            <span class="text-xs text-on-surface-variant">Pantau status berkas secara realtime</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-2">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-tertiary shrink-0">
                            <span class="material-symbols-outlined text-[22px]">link</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-on-surface">Terhubung Resmi</span>
                            <span class="text-xs text-on-surface-variant">Sinkron dengan Kemensos RI & BPJS</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Quick Ticket Tracker (Elevated Anchor) -->
        <section class="relative z-20 -mt-6 sm:-mt-8 mx-auto w-full max-w-5xl px-4" id="lacak-tiket">
            <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-xl border border-outline-variant/60">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-[22px]">manage_search</span>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-on-surface">Lacak Berkas & Cek Tiket Cepat</h2>
                            <p class="text-xs text-on-surface-variant">Ketahui posisi dokumen atau tindak lanjut pengaduan Anda</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-medium">
                        <span class="material-symbols-outlined text-[14px]">lock</span>
                        Validasi NIK Terproteksi
                    </span>
                </div>

                <form wire:submit="trackQuickTicket" class="grid grid-cols-1 sm:grid-cols-12 gap-3 pt-2">
                    <div class="sm:col-span-6 relative">
                        <label for="ticketNumber" class="block text-xs font-semibold text-on-surface mb-1">Nomor Registrasi Tiket</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="ticketNumber" 
                                wire:model="ticketNumber"
                                placeholder="Contoh: DTSEN-202610-00012" 
                                required
                                class="w-full h-11 px-3.5 pl-10 rounded-lg bg-surface-container-low border border-outline-variant/80 text-on-surface text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary-container focus:bg-white transition"
                            />
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">confirmation_number</span>
                        </div>
                    </div>
                    <div class="sm:col-span-3 relative">
                        <label for="nikLastDigits" class="block text-xs font-semibold text-on-surface mb-1">4 Digit NIK Pemohon</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="nikLastDigits" 
                                wire:model="nikLastDigits"
                                maxlength="4"
                                placeholder="Contoh: 1234" 
                                class="w-full h-11 px-3.5 pl-10 rounded-lg bg-surface-container-low border border-outline-variant/80 text-on-surface text-sm placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary-container focus:bg-white transition"
                            />
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-on-surface-variant">pin</span>
                        </div>
                    </div>
                    <div class="sm:col-span-3 flex items-end">
                        <button 
                            type="submit" 
                            class="w-full h-11 px-4 rounded-lg bg-primary-container text-on-primary font-semibold text-sm hover:bg-primary transition-all flex items-center justify-center gap-1.5 shadow-sm"
                        >
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            <span>Lacak Tiket</span>
                        </button>
                    </div>
                </form>

                <div class="mt-3 pt-3 border-t border-outline-variant/30 flex flex-wrap items-center justify-between text-xs text-on-surface-variant">
                    <span>Lupa nomor tiket Anda? Cek pesan SMS/WhatsApp konfirmasi atau kunjungi kantor Dinsos.</span>
                    <a href="{{ route('cek-status') }}" class="text-primary-container hover:underline font-semibold flex items-center gap-0.5">
                        Buka Halaman Pelacakan Lengkap &rarr;
                    </a>
                </div>
            </div>
        </section>

        <!-- Section 3: Layanan Prioritas -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16" id="layanan-prioritas">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-block w-2.5 h-6 bg-primary-container rounded-full"></span>
                        <span class="text-xs font-bold text-primary-container uppercase tracking-wider">Layanan Unggulan</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Tiga Layanan Prioritas Masyarakat</h2>
                    <p class="text-sm text-on-surface-variant mt-1">Layanan terpadu yang paling sering dibutuhkan oleh warga Kabupaten Blitar</p>
                </div>
                <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:text-primary-container">
                    Lihat Semua Katalog Layanan
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Priority Card 1: DTSEN -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-primary-container/40 transition flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-red-50 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-2xl">description</span>
                        </div>
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-red-100/70 text-primary-container text-xs font-semibold mb-2">
                            Prioritas 1 • SPMB & Beasiswa
                        </div>
                        <h3 class="text-lg font-bold text-on-surface mb-2">Surat Keterangan DTSEN</h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                            Penerbitan surat keterangan status desil dalam Data Tunggal Sosial Ekonomi Nasional sebagai syarat SPMB jalur afirmasi, PIP, KIP Kuliah, bansos, dan kesehatan.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                        <a href="{{ route('layanan.detail', ['slug' => 'surat-keterangan-dtsen']) }}" class="text-xs font-medium text-on-surface-variant hover:text-primary">
                            Persyaratan & Alur &rarr;
                        </a>
                        <a href="{{ route('pengajuan', ['service' => 'dtsen']) }}" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg bg-primary-container text-on-primary text-xs font-semibold hover:bg-primary transition shadow-sm">
                            <span>Ajukan Sekarang</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Priority Card 2: PBI-JK -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-amber-500/40 transition flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-2xl">health_and_safety</span>
                        </div>
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-100/70 text-secondary text-xs font-semibold mb-2">
                            Prioritas 2 • Kesehatan Gratis
                        </div>
                        <h3 class="text-lg font-bold text-on-surface mb-2">Reaktivasi KIS / PBI-JK</h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                            Fasilitasi pengaktifan kembali kartu BPJS Kesehatan Penerima Bantuan Iuran yang nonaktif bagi warga sakit darurat, penyakit kronis/katastropik, atau bayi baru lahir.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                        <a href="{{ route('layanan.detail', ['slug' => 'reaktivasi-kis']) }}" class="text-xs font-medium text-on-surface-variant hover:text-secondary">
                            Persyaratan & Alur &rarr;
                        </a>
                        <a href="{{ route('pengajuan', ['service' => 'pbi']) }}" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg bg-secondary-container text-on-secondary-container text-xs font-semibold hover:bg-amber-600 transition shadow-sm">
                            <span>Ajukan Sekarang</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Priority Card 3: Rehabilitasi Sosial -->
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 hover:shadow-md hover:border-blue-500/40 transition flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-tertiary flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <span class="material-symbols-outlined text-2xl">diversity_1</span>
                        </div>
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-100/70 text-tertiary text-xs font-semibold mb-2">
                            Prioritas 3 • Perlindungan Khusus
                        </div>
                        <h3 class="text-lg font-bold text-on-surface mb-2">Pelayanan Rehabilitasi Sosial</h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                            Assessment, penanganan kedaruratan, pendampingan, dan fasilitasi rujukan panti untuk lansia terlantar, penyandang disabilitas, ODGJ terlantar, dan korban kekerasan.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                        <a href="{{ route('layanan.detail', ['slug' => 'rehabilitasi-sosial']) }}" class="text-xs font-medium text-on-surface-variant hover:text-tertiary">
                            Persyaratan & Alur &rarr;
                        </a>
                        <a href="{{ route('pengajuan', ['service' => 'rehab']) }}" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg bg-tertiary-container text-on-tertiary text-xs font-semibold hover:bg-blue-700 transition shadow-sm">
                            <span>Permohonan Layanan</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Secondary Shortcut Tiles -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <a href="{{ route('pengajuan', ['service' => 'lainnya']) }}" class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/50 hover:border-primary transition flex items-center gap-4 group">
                    <div class="w-11 h-11 rounded-lg bg-surface-container-high flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition shrink-0">
                        <span class="material-symbols-outlined text-2xl">category</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-on-surface group-hover:text-primary">Layanan Sosial Lainnya</h4>
                        <p class="text-xs text-on-surface-variant mt-0.5">Rekomendasi bantuan, alat bantu disabilitas, dll</p>
                    </div>
                </a>

                <a href="{{ route('pengaduan') }}" class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/50 hover:border-primary transition flex items-center gap-4 group">
                    <div class="w-11 h-11 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary group-hover:bg-secondary-container group-hover:text-on-secondary transition shrink-0">
                        <span class="material-symbols-outlined text-2xl">campaign</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-on-surface group-hover:text-primary">Pengaduan Sosial</h4>
                        <p class="text-xs text-on-surface-variant mt-0.5">Lapor masalah bantuan, ODGJ terlantar, atau dugaan pungli</p>
                    </div>
                </a>

                <a href="{{ route('verifikasi') }}" class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/50 hover:border-primary transition flex items-center gap-4 group">
                    <div class="w-11 h-11 rounded-lg bg-surface-container-high flex items-center justify-center text-tertiary group-hover:bg-tertiary-container group-hover:text-on-tertiary transition shrink-0">
                        <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-on-surface group-hover:text-primary">Verifikasi Keaslian Surat</h4>
                        <p class="text-xs text-on-surface-variant mt-0.5">Cek keabsahan kode barcode & SK DTSEN terbit</p>
                    </div>
                </a>
            </div>
        </section>

        <!-- Section 5: "Bagaimana Caranya?" 4-Step Flow -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-10 border border-outline-variant/60 shadow-sm">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <span class="text-xs font-bold text-primary uppercase tracking-widest">Alur Mudah</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface mt-1 tracking-tight">Bagaimana Cara Mengajukan Layanan?</h2>
                    <p class="text-sm text-on-surface-variant mt-2">Empat langkah mudah pengurusan berkas di SAPA SOSIAL Blitar tanpa harus bolak-balik</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-low/50 relative">
                        <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary font-bold text-lg flex items-center justify-center mb-3 shadow-sm">
                            1
                        </div>
                        <h4 class="font-bold text-sm text-on-surface mb-1">Pilih Layanan</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Tentukan jenis layanan yang sesuai dengan kebutuhan Anda (DTSEN, KIS, atau lainnya).
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-low/50 relative">
                        <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary font-bold text-lg flex items-center justify-center mb-3 shadow-sm">
                            2
                        </div>
                        <h4 class="font-bold text-sm text-on-surface mb-1">Isi Formulir & Berkas</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Lengkapi identitas diri pemohon dan unggah foto/scan e-KTP serta Kartu Keluarga.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-low/50 relative">
                        <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary font-bold text-lg flex items-center justify-center mb-3 shadow-sm">
                            3
                        </div>
                        <h4 class="font-bold text-sm text-on-surface mb-1">Dapatkan Nomor Tiket</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Simpan kode registrasi tiket unik untuk memantau proses verifikasi dokumen Anda.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-low/50 relative">
                        <div class="w-12 h-12 rounded-full bg-emerald-700 text-on-primary font-bold text-lg flex items-center justify-center mb-3 shadow-sm">
                            4
                        </div>
                        <h4 class="font-bold text-sm text-on-surface mb-1">Pantau & Unduh Surat</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Petugas memverifikasi berkas, dan surat resmi dapat diunduh langsung dalam format PDF ber-QR.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 6: FAQ Accordion -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-4 flex flex-col gap-3">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Pertanyaan Umum</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Informasi & Bantuan Teknis</h2>
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        Temukan jawaban cepat atas pertanyaan seputar pemanfaatan portal SAPA SOSIAL Dinas Sosial Kabupaten Blitar.
                    </p>
                    <div class="mt-3 p-4 bg-secondary-fixed/40 rounded-xl flex items-start gap-3 border border-secondary-fixed">
                        <span class="material-symbols-outlined text-secondary text-[24px]">lightbulb</span>
                        <div class="flex flex-col">
                            <span class="font-bold text-xs text-on-secondary-fixed">Perlu bantuan tatap muka?</span>
                            <span class="text-xs text-on-surface mt-0.5">Petugas Dinsos siap melayani di Mall Pelayanan Publik (MPP) Kanigoro.</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 flex flex-col gap-3">
                    @forelse($faqs as $index => $faq)
                        <details class="group bg-surface-container-lowest rounded-xl p-4 shadow-sm border border-outline-variant/60 transition-all" {{ $index === 0 ? 'open' : '' }}>
                            <summary class="flex items-center justify-between cursor-pointer font-semibold text-sm sm:text-base text-on-surface select-none list-none">
                                <span>{{ $faq->question }}</span>
                                <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                            </summary>
                            <div class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/30">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </details>
                    @empty
                        <details class="group bg-surface-container-lowest rounded-xl p-4 shadow-sm border border-outline-variant/60 transition-all" open>
                            <summary class="flex items-center justify-between cursor-pointer font-semibold text-sm sm:text-base text-on-surface select-none list-none">
                                <span>Apakah pengajuan layanan di SAPA SOSIAL dipungut biaya?</span>
                                <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/30">
                                Semua pelayanan Dinas Sosial Kabupaten Blitar <strong>100% GRATIS</strong> tanpa pungutan biaya apapun. Apabila menemukan pihak yang meminta imbalan mengatasnamakan dinas, segera laporkan ke kanal Pengaduan Sosial.
                            </p>
                        </details>
                        <details class="group bg-surface-container-lowest rounded-xl p-4 shadow-sm border border-outline-variant/60 transition-all">
                            <summary class="flex items-center justify-between cursor-pointer font-semibold text-sm sm:text-base text-on-surface select-none list-none">
                                <span>Berapa lama waktu yang dibutuhkan hingga surat keterangan terbit?</span>
                                <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-sm text-on-surface-variant leading-relaxed pt-2 border-t border-outline-variant/30">
                                Untuk Surat Keterangan DTSEN estimasi pengerjaan adalah 1 sampai 2 hari kerja setelah dokumen e-KTP dan KK berhasil diverifikasi oleh verifikator dinas.
                            </p>
                        </details>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Section 7: Contact & Assistance Strip -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-gradient-to-r from-primary-container via-red-800 to-primary text-on-primary rounded-2xl p-6 sm:p-8 shadow-lg flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[32px] text-white">support_agent</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-lg text-white">Butuh Panduan Langsung?</h3>
                        <p class="text-sm text-white/90 max-w-xl">
                            Tim konsultasi SAPA SOSIAL siap membantu kendala permohonan Anda melalui pesan resmi WhatsApp.
                        </p>
                        <span class="text-xs text-white/80 mt-1">
                            Jam Operasional: Senin – Jumat | 07.30 – 16.00 WIB
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto px-6 py-3 rounded-xl bg-surface-container-lowest text-primary font-bold text-sm hover:bg-surface-container-low transition-colors shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">chat</span>
                        <span>WhatsApp Layanan Dinsos</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>
