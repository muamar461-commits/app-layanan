<x-filament-panels::page>
    <div class="fi-page-content flex flex-col gap-y-6">
        <!-- Filter Section -->
        <x-filament::section
            icon="heroicon-o-funnel"
            heading="Filter & Rekapitulasi Data"
            description="Pilih jenis laporan dan rentang tanggal untuk merekapitulasi data layanan sosial."
        >
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Jenis Laporan -->
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 text-sm font-medium leading-6 text-gray-950 dark:text-white mb-2">
                        Jenis Laporan
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input.select wire:model.live="reportType">
                            <option value="all_services">Rekap Semua Layanan</option>
                            <option value="dtsen">Rekap SK DTSEN</option>
                            <option value="pbi">Rekap Reaktivasi PBI-JK</option>
                            <option value="rehab">Rekap Rehabilitasi Sosial</option>
                            <option value="complaints">Rekap Pengaduan Masalah Sosial</option>
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                </div>

                <!-- Dari Tanggal -->
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 text-sm font-medium leading-6 text-gray-950 dark:text-white mb-2">
                        Dari Tanggal
                    </label>
                    <x-filament::input.wrapper prefix-icon="heroicon-m-calendar">
                        <x-filament::input
                            type="date"
                            wire:model.live="startDate"
                        />
                    </x-filament::input.wrapper>
                </div>

                <!-- Sampai Tanggal -->
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 text-sm font-medium leading-6 text-gray-950 dark:text-white mb-2">
                        Sampai Tanggal
                    </label>
                    <x-filament::input.wrapper prefix-icon="heroicon-m-calendar">
                        <x-filament::input
                            type="date"
                            wire:model.live="endDate"
                        />
                    </x-filament::input.wrapper>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                        <x-filament::icon icon="heroicon-m-information-circle" class="w-4 h-4 text-gray-400 dark:text-gray-500" style="width: 1rem; height: 1rem;" />
                        <span>Tabel pratinjau di bawah otomatis memperbarui data berdasarkan filter yang dipilih.</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-filament::button
                            wire:click="exportCsv"
                            color="success"
                            icon="heroicon-m-arrow-down-tray"
                            tag="button"
                        >
                            Ekspor CSV
                        </x-filament::button>

                        <x-filament::button
                            wire:click="exportPdf"
                            color="danger"
                            icon="heroicon-m-printer"
                            tag="button"
                        >
                            Cetak PDF
                        </x-filament::button>
                    </div>
                </div>
            </x-slot>
        </x-filament::section>

        <!-- Report Data Table Preview -->
        <x-filament::section>
            <x-slot name="heading">
                {{ $reportTitle }}
            </x-slot>

            <x-slot name="description">
                Menampilkan 50 data terbaru periode {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s.d. {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </x-slot>

            <x-slot name="afterHeader">
                <x-filament::badge color="info">
                    {{ count($reportData) }} Data
                </x-filament::badge>
            </x-slot>

            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-white/10">
                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                        <tr class="bg-gray-50 dark:bg-white/5 border-b border-gray-200 dark:border-white/10">
                            @if($reportType === 'dtsen')
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Tiket</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Surat</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Nama Pemohon</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Tujuan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Desil</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Tgl Terbit</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Wilayah</th>
                            @elseif($reportType === 'pbi')
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Tiket</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Nama Peserta</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">NIK</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Kartu BPJS</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Alasan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Status</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Wilayah</th>
                            @elseif($reportType === 'rehab')
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Kasus</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Nama Klien</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Kategori</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Petugas</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Penanganan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Status</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Tgl Diterima</th>
                            @elseif($reportType === 'complaints')
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Aduan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Pelapor</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Kategori</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Wilayah</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Status</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Tgl Lapor</th>
                            @else
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">No. Pengajuan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Jenis Layanan</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Pemohon</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">NIK</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Prioritas</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Status</th>
                                <th scope="col" class="fi-ta-header-cell px-4 py-3.5 text-start text-xs font-semibold uppercase tracking-wider text-gray-950 dark:text-white" style="padding: 0.75rem 1rem;">Tgl Pengajuan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 whitespace-nowrap text-sm dark:divide-white/5">
                        @forelse($reportData as $row)
                            <tr class="fi-ta-row hover:bg-gray-50/50 dark:hover:bg-white/5 transition border-b border-gray-100 dark:border-white/5">
                                @if($reportType === 'dtsen')
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <span class="font-mono font-semibold text-primary-600 dark:text-primary-400">{{ $row->serviceRequest?->request_number ?? '-' }}</span>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-mono text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->certificate_number ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->serviceRequest?->applicant_name ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->dtsenPurpose?->name ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge color="info">
                                            {{ $row->decile ? 'Desil ' . $row->decile : '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->issued_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->serviceRequest?->village?->name ?? '-' }}{{ $row->serviceRequest?->village?->district ? ', ' . $row->serviceRequest->village->district->name : '' }}
                                    </td>
                                @elseif($reportType === 'pbi')
                                    @php
                                        $pbiStatus = $row->serviceRequest?->status;
                                        $pbiStatusColor = match ($pbiStatus?->value ?? '') {
                                            'completed', 'issued', 'reactivated', 'ministry_approved', 'recommendation_issued' => 'success',
                                            'rejected', 'ministry_rejected' => 'danger',
                                            'revision_requested', 'awaiting_approval' => 'warning',
                                            'in_process', 'proposed_to_ministry', 'document_check', 'verification' => 'info',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <span class="font-mono font-semibold text-primary-600 dark:text-primary-400">{{ $row->serviceRequest?->request_number ?? '-' }}</span>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->participant_name }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-mono text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->participant_nik }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-mono text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->bpjs_card_number ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->reason?->value ?? $row->reason ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge :color="$pbiStatusColor">
                                            {{ $pbiStatus?->label() ?? $row->serviceRequest?->status ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->serviceRequest?->village?->name ?? '-' }}{{ $row->serviceRequest?->village?->district ? ', ' . $row->serviceRequest->village->district->name : '' }}
                                    </td>
                                @elseif($reportType === 'rehab')
                                    @php
                                        $rehabStatus = $row->status;
                                        $rehabColor = match ($rehabStatus?->value ?? '') {
                                            'closed' => 'success',
                                            'in_service', 'monitoring' => 'info',
                                            'assessment', 'service_planning' => 'warning',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <span class="font-mono font-semibold text-primary-600 dark:text-primary-400">{{ $row->case_number }}</span>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->client?->name ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge color="gray">
                                            {{ $row->client?->category?->name ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->officer?->name ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->handling_type?->label() ?? $row->handling_type ?? '-' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge :color="$rehabColor">
                                            {{ $rehabStatus?->label() ?? $row->status ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->received_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                @elseif($reportType === 'complaints')
                                    @php
                                        $complaintStatus = $row->status;
                                        $complaintColor = match ($complaintStatus?->value ?? '') {
                                            'resolved' => 'success',
                                            'in_handling', 'dispatched' => 'info',
                                            'verification', 'clarification_requested' => 'warning',
                                            'invalid', 'duplicate' => 'danger',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <span class="font-mono font-semibold text-amber-600 dark:text-amber-400">{{ $row->complaint_number }}</span>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->reporter_name }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge color="gray">
                                            {{ $row->category?->name ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->village?->name ?? '-' }}{{ $row->village?->district ? ', ' . $row->village->district->name : '' }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge :color="$complaintColor">
                                            {{ $complaintStatus?->label() ?? $row->status ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->reported_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                @else
                                    @php
                                        $svcStatus = $row->status;
                                        $svcColor = match ($svcStatus?->value ?? '') {
                                            'completed', 'issued', 'reactivated', 'ministry_approved', 'recommendation_issued' => 'success',
                                            'rejected', 'ministry_rejected' => 'danger',
                                            'revision_requested', 'awaiting_approval' => 'warning',
                                            'in_process', 'proposed_to_ministry', 'document_check', 'verification' => 'info',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <span class="font-mono font-semibold text-primary-600 dark:text-primary-400">{{ $row->request_number }}</span>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge color="gray">
                                            {{ $row->serviceType?->name ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" style="padding: 0.75rem 1rem;">
                                        {{ $row->applicant_name }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm font-mono text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->applicant_nik }}
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        @if($row->is_priority)
                                            <x-filament::badge color="danger" icon="heroicon-m-exclamation-triangle">
                                                Prioritas
                                            </x-filament::badge>
                                        @else
                                            <span class="text-xs text-gray-500 dark:text-gray-400">Reguler</span>
                                        @endif
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm" style="padding: 0.75rem 1rem;">
                                        <x-filament::badge :color="$svcColor">
                                            {{ $svcStatus?->label() ?? $row->status ?? '-' }}
                                        </x-filament::badge>
                                    </td>
                                    <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300" style="padding: 0.75rem 1rem;">
                                        {{ $row->submitted_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $reportType === 'complaints' ? 6 : 7 }}" class="py-12 px-6 text-center">
                                    <x-filament::empty-state
                                        icon="heroicon-o-document-magnifying-glass"
                                        heading="Tidak Ada Data Rekapitulasi"
                                        description="Tidak ada catatan data yang ditemukan untuk periode dan parameter filter yang dipilih."
                                    />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>

