<div class="flex flex-col w-full pb-16">
    <!-- Breadcrumb Bar -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between text-xs text-on-surface-variant font-medium">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Masuk & Daftar Akun</span>
            </nav>
            <div class="hidden sm:flex items-center gap-2">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-container-lowest shadow-sm text-on-surface-variant text-[11px]">
                    <span class="material-symbols-outlined text-primary text-[14px]">verified_user</span>
                    Terintegrasi Dispendukcapil Blitar
                </span>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Column: Auth Card (7 cols) -->
            <div class="lg:col-span-7 bg-surface-container-lowest rounded-2xl shadow-md border border-outline-variant/60 p-6 sm:p-8">
                <!-- Auth Mode Switcher Tabs -->
                <div class="flex items-center bg-surface-container-low p-1 rounded-xl mb-6">
                    <button 
                        type="button" 
                        wire:click="switchMode('login')"
                        class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-lg text-xs font-bold transition-all {{ $mode === 'login' ? 'bg-surface-container-lowest text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        <span>Masuk (Punya Akun)</span>
                    </button>
                    <button 
                        type="button" 
                        wire:click="switchMode('register')"
                        class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-lg text-xs font-bold transition-all {{ $mode === 'register' ? 'bg-surface-container-lowest text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}"
                    >
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        <span>Daftar Akun Baru</span>
                    </button>
                </div>

                @if($errorMessage)
                    <div class="p-3 mb-4 rounded-xl bg-red-50 border border-red-200 text-error text-xs flex items-start gap-2">
                        <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">error</span>
                        <span>{{ $errorMessage }}</span>
                    </div>
                @endif

                @if($mode === 'login')
                    <!-- ================= LOGIN FORM ================= -->
                    <form wire:submit="login" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">
                                Email atau Nomor WhatsApp / HP <span class="text-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-2.5 text-on-surface-variant text-[18px] pointer-events-none">mail</span>
                                <input 
                                    type="text" 
                                    wire:model="login_id" 
                                    placeholder="Contoh: nama@email.com atau 08123456789" 
                                    required
                                    class="w-full h-11 pl-10 pr-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container focus:bg-white transition"
                                />
                            </div>
                            @error('login_id') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div x-data="{ showPass: false }">
                            <div class="flex items-center justify-between mb-1">
                                <label class="text-xs font-semibold text-on-surface">
                                    Kata Sandi (Password) <span class="text-primary">*</span>
                                </label>
                                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SAPA%20SOSIAL,%20saya%20lupa%20kata%20sandi%20akun%20warga" target="_blank" class="text-[11px] text-primary hover:underline font-semibold">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-2.5 text-on-surface-variant text-[18px] pointer-events-none">key</span>
                                <input 
                                    :type="showPass ? 'text' : 'password'" 
                                    wire:model="login_password" 
                                    placeholder="Masukkan kata sandi akun Anda..." 
                                    required
                                    class="w-full h-11 pl-10 pr-10 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container focus:bg-white transition"
                                />
                                <button 
                                    type="button" 
                                    @click="showPass = !showPass" 
                                    class="absolute right-3 top-2.5 text-on-surface-variant hover:text-on-surface"
                                >
                                    <span class="material-symbols-outlined text-[18px]" x-text="showPass ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @error('login_password') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center gap-2 py-1">
                            <input type="checkbox" id="remember" wire:model="remember" class="w-4 h-4 rounded text-primary focus:ring-primary-container accent-primary"/>
                            <label for="remember" class="text-xs text-on-surface cursor-pointer select-none">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full h-11 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-md flex items-center justify-center gap-1.5"
                        >
                            <span>Masuk ke Akun SAPA SOSIAL</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </form>

                    <div class="mt-6 pt-4 border-t border-outline-variant/30 text-center">
                        <p class="text-xs text-on-surface-variant">
                            Belum memiliki akun warga? 
                            <button type="button" wire:click="switchMode('register')" class="text-primary font-bold hover:underline">
                                Daftar Gratis di sini
                            </button>
                        </p>
                    </div>

                @else
                    <!-- ================= REGISTER FORM ================= -->
                    <form wire:submit="register" class="space-y-4">
                        <div class="p-3 rounded-lg bg-secondary-fixed/30 text-secondary border border-secondary-fixed/50 text-xs flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">badge</span>
                            <span>Pastikan NIK 16 digit sesuai e-KTP Kabupaten Blitar Anda untuk kemudahan verifikasi.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">Nama Lengkap (Sesuai KTP) <span class="text-primary">*</span></label>
                            <input type="text" wire:model="name" placeholder="Nama lengkap tanpa gelar..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                            @error('name') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">NIK (16 Digit) <span class="text-primary">*</span></label>
                            <input type="text" wire:model="nik" maxlength="16" placeholder="3505..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                            @error('nik') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Nomor WhatsApp Aktif <span class="text-primary">*</span></label>
                                <input type="text" wire:model="phone" placeholder="08..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                @error('phone') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Alamat Email Aktif <span class="text-primary">*</span></label>
                                <input type="email" wire:model="email" placeholder="nama@email.com" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                @error('email') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Kata Sandi Baru <span class="text-primary">*</span></label>
                                <input type="password" wire:model="password" placeholder="Min. 6 karakter..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                @error('password') <span class="text-error text-[11px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Ulangi Kata Sandi <span class="text-primary">*</span></label>
                                <input type="password" wire:model="password_confirmation" placeholder="Ulangi kata sandi..." class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                            </div>
                        </div>

                        <div class="flex items-start gap-2 pt-1">
                            <input type="checkbox" id="agreement" wire:model="agreement" class="mt-0.5 rounded text-primary-container focus:ring-primary-container"/>
                            <label for="agreement" class="text-xs text-on-surface-variant leading-relaxed cursor-pointer select-none">
                                Saya menyatakan data pendaftaran di atas adalah benar identitas saya sendiri dan menyetujui kebijakan privasi pelayanan SAPA SOSIAL Blitar.
                            </label>
                        </div>
                        @error('agreement') <span class="text-error text-[11px] block -mt-2">{{ $message }}</span> @enderror

                        <button 
                            type="submit" 
                            class="w-full h-11 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-md flex items-center justify-center gap-1.5"
                        >
                            <span>Buat Akun Warga Sekarang</span>
                            <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
                        </button>
                    </form>

                    <div class="mt-6 pt-4 border-t border-outline-variant/30 text-center">
                        <p class="text-xs text-on-surface-variant">
                            Sudah punya akun? 
                            <button type="button" wire:click="switchMode('login')" class="text-primary font-bold hover:underline">
                                Masuk ke sini
                            </button>
                        </p>
                    </div>
                @endif

                <!-- Shortcut Cek Status Tanpa Akun -->
                <div class="mt-6 p-4 rounded-xl bg-surface-container-low border border-outline-variant/40 flex items-center justify-between gap-3 text-xs">
                    <div>
                        <span class="font-bold text-on-surface block">Tidak Punya Akun?</span>
                        <span class="text-on-surface-variant">Anda tetap dapat memantau permohonan menggunakan nomor tiket.</span>
                    </div>
                    <a href="{{ route('cek-status') }}" class="px-3.5 py-1.5 rounded-lg bg-surface-container-lowest text-primary font-semibold border border-outline-variant/60 hover:bg-surface-container transition shrink-0">
                        Cek Status &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Column: Assistance (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/60 space-y-4">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Keuntungan Akun Warga</span>
                    <h3 class="font-bold text-base text-on-surface">Mengapa Mendaftar Akun?</h3>
                    <ul class="space-y-3 text-xs text-on-surface-variant">
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">folder_shared</span>
                            <div>
                                <strong class="text-on-surface block">Riwayat Layanan Terpusat:</strong>
                                Semua pengajuan surat keterangan DTSEN dan reaktivasi KIS tersimpan rapi.
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-[18px] mt-0.5">notifications_active</span>
                            <div>
                                <strong class="text-on-surface block">Notifikasi Real-time:</strong>
                                Dapatkan info jika berkas memerlukan perbaikan atau saat surat resmi sudah terbit.
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-tertiary text-[18px] mt-0.5">speed</span>
                            <div>
                                <strong class="text-on-surface block">Pengajuan Lebih Cepat:</strong>
                                Data identitas NIK dan alamat otomatis terisi pada setiap pengajuan baru.
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="p-5 rounded-2xl bg-surface-container-low border border-outline-variant/40 space-y-2">
                    <span class="font-bold text-xs text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-primary text-[18px]">support_agent</span>
                        Bantuan Pendaftaran
                    </span>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Jika Anda mengalami kendala saat membuat akun atau verifikasi NIK, silakan hubungi WhatsApp resmi Dinas Sosial: <strong>0812-3456-7890</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
