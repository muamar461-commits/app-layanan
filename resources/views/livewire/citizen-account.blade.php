<div class="flex flex-col w-full pb-16">
    <!-- Breadcrumb Navigation -->
    <div class="w-full bg-surface-container-low/70 py-3 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between text-xs text-on-surface-variant font-medium">
            <nav aria-label="Breadcrumb" class="flex items-center gap-1.5">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    Beranda
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Akun Saya</span>
            </nav>
            <button wire:click="logout" class="text-error hover:underline flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">logout</span>
                Keluar
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full space-y-8">
        <!-- Welcome Banner & Quick Action Hero Card -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/60 p-6 lg:p-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative overflow-hidden">
            <div class="space-y-2 z-10 max-w-2xl">
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Halo, {{ $name }}!</h1>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-semibold">
                        <span class="material-symbols-outlined text-[16px]">verified</span>
                        e-KTP Terverifikasi
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                    Kelola riwayat pengajuan layanan sosial, pantau perkembangan tindak lanjut pengaduan, dan perbarui data profil Anda dalam satu pintu terintegrasi.
                </p>
                <div class="flex items-center gap-4 text-xs text-on-surface-variant pt-1">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-primary">pin_drop</span>
                        Kabupaten Blitar
                    </span>
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-secondary">shield</span>
                        Akses Pemohon Mandiri
                    </span>
                </div>
            </div>

            <!-- Quick CTAs -->
            <div class="flex flex-col sm:flex-row lg:flex-col gap-2.5 z-10 shrink-0">
                <a href="{{ route('pengajuan') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary-container text-on-primary font-bold text-xs hover:bg-primary shadow-sm transition">
                    <span class="material-symbols-outlined text-[18px]">add_circle</span>
                    <span>Ajukan Layanan Baru</span>
                </a>
                <a href="{{ route('pengaduan') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-surface-container text-on-surface font-bold text-xs hover:bg-surface-container-high transition">
                    <span class="material-symbols-outlined text-[18px] text-secondary">report_problem</span>
                    <span>Buat Pengaduan Warga</span>
                </a>
            </div>
        </div>

        <!-- Main Account Content Tabs -->
        <div>
            <!-- Tabs Nav -->
            <div class="flex items-center gap-2 border-b border-outline-variant/30 pb-2 overflow-x-auto">
                <button 
                    type="button" 
                    wire:click="setTab('requests')"
                    class="whitespace-nowrap px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'requests' ? 'bg-primary-container text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}"
                >
                    <span class="material-symbols-outlined text-[18px]">folder</span>
                    <span>Pengajuan Layanan ({{ $serviceRequests->count() }})</span>
                </button>
                <button 
                    type="button" 
                    wire:click="setTab('complaints')"
                    class="whitespace-nowrap px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'complaints' ? 'bg-primary-container text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}"
                >
                    <span class="material-symbols-outlined text-[18px]">campaign</span>
                    <span>Pengaduan Warga ({{ $complaints->count() }})</span>
                </button>
                <button 
                    type="button" 
                    wire:click="setTab('profile')"
                    class="whitespace-nowrap px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'profile' ? 'bg-primary-container text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container' }}"
                >
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    <span>Profil Akun</span>
                </button>
            </div>

            <!-- Tab 1: Pengajuan Layanan -->
            @if($activeTab === 'requests')
                <div class="pt-6 space-y-4">
                    @forelse($serviceRequests as $req)
                        @php
                            $status = $req->status;
                            $statusVal = $status?->value ?? $status;
                            $isRev = ($statusVal === 'revision_requested');
                            $isDone = in_array($statusVal, ['completed', 'issued', 'reactivated']);
                            $badge = match($statusVal) {
                                'completed', 'issued', 'reactivated' => 'bg-emerald-100 text-emerald-800',
                                'revision_requested' => 'bg-amber-100 text-amber-800 animate-pulse',
                                'rejected', 'ministry_rejected' => 'bg-red-100 text-red-800',
                                default => 'bg-blue-100 text-blue-800',
                            };
                        @endphp
                        <div class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-outline-variant/60 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1.5 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-mono font-bold text-xs text-primary bg-primary-fixed px-2.5 py-0.5 rounded">
                                        {{ $req->request_number }}
                                    </span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $badge }}">
                                        {{ $status?->label() ?? ucfirst(str_replace('_', ' ', $statusVal)) }}
                                    </span>
                                    @if($isRev)
                                        <span class="px-2 py-0.5 rounded-full bg-amber-200 text-amber-950 font-bold text-[10px]">
                                            Perlu Unggah Ulang Berkas
                                        </span>
                                    @endif
                                </div>
                                <h3 class="font-bold text-sm text-on-surface">
                                    {{ $req->serviceType?->name ?? 'Pengajuan Layanan Sosial' }}
                                </h3>
                                <p class="text-xs text-on-surface-variant flex items-center gap-3">
                                    <span>Diajukan: {{ $req->submitted_at?->translatedFormat('d M Y, H:i') }} WIB</span>
                                    <span>•</span>
                                    <span>Wilayah: {{ $req->village?->name ?? 'Blitar' }}</span>
                                </p>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <a href="{{ route('cek-status', ['ticket' => $req->request_number]) }}" class="px-4 py-2 rounded-lg bg-surface-container-lowest border border-outline-variant/60 hover:bg-surface-container text-primary font-bold text-xs transition flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">travel_explore</span>
                                    <span>Lacak Detail</span>
                                </a>
                                @if($isDone)
                                    <a href="{{ route('cek-status', ['ticket' => $req->request_number]) }}" class="px-3.5 py-2 rounded-lg bg-emerald-700 text-white font-bold text-xs hover:bg-emerald-800 transition shadow-sm flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">download</span>
                                        <span>Unduh SK</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest rounded-2xl p-12 text-center border border-outline-variant/60">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-2">folder_open</span>
                            <h3 class="font-bold text-base text-on-surface">Belum Ada Riwayat Pengajuan</h3>
                            <p class="text-xs text-on-surface-variant mt-1 max-w-sm mx-auto">
                                Anda belum mengajukan layanan sosial. Mulai pengajuan Surat Keterangan DTSEN atau Reaktivasi KIS secara online.
                            </p>
                            <a href="{{ route('pengajuan') }}" class="inline-flex items-center gap-1.5 mt-4 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm">
                                <span>Ajukan Layanan Sekarang</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    @endforelse
                </div>

            <!-- Tab 2: Pengaduan Warga -->
            @elseif($activeTab === 'complaints')
                <div class="pt-6 space-y-4">
                    @forelse($complaints as $comp)
                        <div class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-outline-variant/60 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1.5 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono font-bold text-xs text-secondary bg-secondary-fixed px-2.5 py-0.5 rounded">
                                        {{ $comp->complaint_number }}
                                    </span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800">
                                        {{ $comp->status?->label() ?? 'Diterima' }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-sm text-on-surface">
                                    {{ $comp->category?->name ?? 'Pengaduan Masalah Sosial' }}
                                </h3>
                                <p class="text-xs text-on-surface-variant line-clamp-2">
                                    {{ $comp->description }}
                                </p>
                                <span class="text-[11px] text-on-surface-variant block">
                                    Dilaporkan: {{ $comp->reported_at?->translatedFormat('d M Y, H:i') }} WIB
                                </span>
                            </div>
                            <div class="shrink-0">
                                <a href="{{ route('cek-status', ['ticket' => $comp->complaint_number]) }}" class="px-4 py-2 rounded-lg bg-surface-container-lowest border border-outline-variant/60 hover:bg-surface-container text-primary font-bold text-xs transition flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">travel_explore</span>
                                    <span>Lacak Penanganan</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest rounded-2xl p-12 text-center border border-outline-variant/60">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-2">campaign</span>
                            <h3 class="font-bold text-base text-on-surface">Belum Ada Pengaduan yang Dikirim</h3>
                            <p class="text-xs text-on-surface-variant mt-1 max-w-sm mx-auto">
                                Laporkan permasalahan bantuan sosial atau warga terlantar di sekitar Anda melalui kanal pengaduan resmi.
                            </p>
                            <a href="{{ route('pengaduan') }}" class="inline-flex items-center gap-1.5 mt-4 px-5 py-2.5 rounded-lg bg-secondary-container text-on-secondary-container font-bold text-xs hover:bg-amber-600 transition shadow-sm">
                                <span>Buat Laporan Baru</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    @endforelse
                </div>

            <!-- Tab 3: Profil Akun -->
            @elseif($activeTab === 'profile')
                <div class="pt-6 max-w-2xl bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-outline-variant/60">
                    <h3 class="font-bold text-base text-on-surface mb-1">Informasi Kependudukan & Profil</h3>
                    <p class="text-xs text-on-surface-variant mb-6">Perbarui data kontak agar verifikator dapat dengan mudah berkoordinasi.</p>

                    @if($profileSaved)
                        <div class="p-3 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            <span>Perubahan data profil berhasil disimpan!</span>
                        </div>
                    @endif

                    <form wire:submit="updateProfile" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">Nomor Induk Kependudukan (NIK Terkunci)</label>
                            <input type="text" value="{{ $nik }}" disabled class="w-full h-10 px-3 rounded-lg bg-surface-container text-xs text-on-surface-variant font-mono cursor-not-allowed"/>
                            <span class="text-[11px] text-on-surface-variant mt-0.5 block">NIK terkunci sesuai identitas e-KTP.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">Nama Lengkap</label>
                            <input type="text" wire:model="name" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                            @error('name') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Nomor WhatsApp Aktif</label>
                                <input type="text" wire:model="phone" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                @error('phone') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Alamat Email</label>
                                <input type="email" wire:model="email" class="w-full h-10 px-3 rounded-lg bg-surface-container-low border border-outline-variant/60 text-xs text-on-surface focus:outline-none focus:border-primary-container"/>
                                @error('email') <span class="text-error text-[11px]">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-bold text-xs hover:bg-primary transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
