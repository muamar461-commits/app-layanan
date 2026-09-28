<?php

namespace App\Filament\Pages;

use App\Models\Complaint;
use App\Models\District;
use App\Models\DtsenCertificate;
use App\Models\PbiReactivation;
use App\Models\RehabilitationCase;
use App\Models\ServiceRequest;
use App\Models\Village;
use BackedEnum;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class ReportsPage extends Page
{
    protected string $view = 'filament.pages.reports-page';

    protected static ?string $title = 'Laporan & Rekapitulasi';

    protected static ?string $navigationLabel = 'Laporan Layanan';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan & Statistik';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentChartBar;

    public string $reportType = 'all_services';

    public string $startDate = '';

    public string $endDate = '';

    public ?int $districtId = null;

    public ?int $villageId = null;

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->toDateString();
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Ekspor CSV')
                ->color('success')
                ->icon(Heroicon::ArrowDownTray)
                ->action('exportCsv'),
            Action::make('exportPdf')
                ->label('Cetak PDF')
                ->color('danger')
                ->icon(Heroicon::Printer)
                ->action('exportPdf'),
        ];
    }

    public function exportCsv(): StreamedResponse
    {
        $filename = 'laporan_'.$this->reportType.'_'.date('Ymd_His').'.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            // Add UTF-8 BOM
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            switch ($this->reportType) {
                case 'dtsen':
                    fputcsv($handle, ['No. Tiket', 'No. Surat', 'Pemohon', 'NIK', 'Tujuan', 'Desil', 'Tanggal Terbit', 'Desa', 'Kecamatan']);
                    $records = DtsenCertificate::with(['serviceRequest.village.district', 'dtsenPurpose'])
                        ->whereBetween('created_at', [$this->startDate.' 00:00:00', $this->endDate.' 23:59:59'])
                        ->get();
                    foreach ($records as $r) {
                        fputcsv($handle, [
                            $r->serviceRequest?->request_number ?? '-',
                            $r->certificate_number ?? '-',
                            $r->serviceRequest?->applicant_name ?? '-',
                            $r->described_person_nik ?? '-',
                            $r->dtsenPurpose?->name ?? '-',
                            $r->decile ?? '-',
                            $r->issued_at?->format('Y-m-d') ?? '-',
                            $r->serviceRequest?->village?->name ?? '-',
                            $r->serviceRequest?->village?->district?->name ?? '-',
                        ]);
                    }
                    break;

                case 'pbi':
                    fputcsv($handle, ['No. Tiket', 'Nama Peserta', 'NIK', 'No. BPJS', 'Alasan', 'Status Usulan', 'Desa', 'Kecamatan']);
                    $records = PbiReactivation::with(['serviceRequest.village.district'])
                        ->whereBetween('created_at', [$this->startDate.' 00:00:00', $this->endDate.' 23:59:59'])
                        ->get();
                    foreach ($records as $r) {
                        fputcsv($handle, [
                            $r->serviceRequest?->request_number ?? '-',
                            $r->participant_name,
                            $r->participant_nik,
                            $r->bpjs_card_number ?? '-',
                            $r->reason?->value ?? $r->reason,
                            $r->serviceRequest?->status?->label() ?? $r->serviceRequest?->status ?? '-',
                            $r->serviceRequest?->village?->name ?? '-',
                            $r->serviceRequest?->village?->district?->name ?? '-',
                        ]);
                    }
                    break;

                case 'rehab':
                    fputcsv($handle, ['No. Kasus', 'Nama Klien', 'Kategori', 'Petugas', 'Jenis Penanganan', 'Status', 'Tgl Terima', 'Tgl Selesai']);
                    $records = RehabilitationCase::with(['client.category', 'officer'])
                        ->whereBetween('created_at', [$this->startDate.' 00:00:00', $this->endDate.' 23:59:59'])
                        ->get();
                    foreach ($records as $r) {
                        fputcsv($handle, [
                            $r->case_number,
                            $r->client?->name ?? '-',
                            $r->client?->category?->name ?? '-',
                            $r->officer?->name ?? '-',
                            $r->handling_type?->label() ?? $r->handling_type ?? '-',
                            $r->status?->label() ?? $r->status ?? '-',
                            $r->received_at?->format('Y-m-d') ?? '-',
                            $r->closed_at?->format('Y-m-d') ?? '-',
                        ]);
                    }
                    break;

                case 'complaints':
                    fputcsv($handle, ['No. Pengaduan', 'Pelapor', 'No. HP', 'Kategori', 'Status', 'Desa', 'Kecamatan', 'Tgl Lapor']);
                    $records = Complaint::with(['category', 'village.district'])
                        ->whereBetween('created_at', [$this->startDate.' 00:00:00', $this->endDate.' 23:59:59'])
                        ->get();
                    foreach ($records as $r) {
                        fputcsv($handle, [
                            $r->complaint_number,
                            $r->reporter_name,
                            $r->reporter_phone,
                            $r->category?->name ?? '-',
                            $r->status?->label() ?? $r->status ?? '-',
                            $r->village?->name ?? '-',
                            $r->village?->district?->name ?? '-',
                            $r->reported_at?->format('Y-m-d') ?? '-',
                        ]);
                    }
                    break;

                default:
                    fputcsv($handle, ['No. Tiket', 'Jenis Layanan', 'Nama Pemohon', 'NIK', 'Status', 'Prioritas', 'Desa', 'Kecamatan', 'Tgl Pengajuan']);
                    $records = ServiceRequest::with(['serviceType', 'village.district'])
                        ->whereBetween('submitted_at', [$this->startDate.' 00:00:00', $this->endDate.' 23:59:59'])
                        ->get();
                    foreach ($records as $r) {
                        fputcsv($handle, [
                            $r->request_number,
                            $r->serviceType?->name ?? '-',
                            $r->applicant_name,
                            $r->applicant_nik,
                            $r->status?->label() ?? $r->status ?? '-',
                            $r->is_priority ? 'Ya' : 'Tidak',
                            $r->village?->name ?? '-',
                            $r->village?->district?->name ?? '-',
                            $r->submitted_at?->format('Y-m-d') ?? '-',
                        ]);
                    }
                    break;
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportPdf(): StreamedResponse
    {
        $data = $this->getReportData();

        $pdf = Pdf::loadView('reports.summary-pdf', [
            'reportType' => $this->reportType,
            'reportTitle' => $this->getReportTitle(),
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        Notification::make()
            ->title('Laporan PDF berhasil di-generate')
            ->success()
            ->send();

        return response()->streamDownload(
            fn () => print ($pdf->output()),
            'laporan_'.$this->reportType.'_'.date('Ymd_His').'.pdf'
        );
    }

    protected function getReportTitle(): string
    {
        return match ($this->reportType) {
            'dtsen' => 'Rekapitulasi Penerbitan Surat Keterangan DTSEN',
            'pbi' => 'Rekapitulasi Pengajuan Reaktivasi KIS / PBI-JK',
            'rehab' => 'Rekapitulasi Pelayanan Rehabilitasi Sosial',
            'complaints' => 'Rekapitulasi Laporan Pengaduan Masyarakat',
            default => 'Rekapitulasi Seluruh Pengajuan Layanan Sosial',
        };
    }

    public function getReportData(): Collection
    {
        $start = $this->startDate.' 00:00:00';
        $end = $this->endDate.' 23:59:59';

        return match ($this->reportType) {
            'dtsen' => DtsenCertificate::with(['serviceRequest.village.district', 'dtsenPurpose'])
                ->whereBetween('created_at', [$start, $end])
                ->latest()
                ->take(50)
                ->get(),
            'pbi' => PbiReactivation::with(['serviceRequest.village.district'])
                ->whereBetween('created_at', [$start, $end])
                ->latest()
                ->take(50)
                ->get(),
            'rehab' => RehabilitationCase::with(['client.category', 'officer'])
                ->whereBetween('created_at', [$start, $end])
                ->latest()
                ->take(50)
                ->get(),
            'complaints' => Complaint::with(['category', 'village.district', 'officer'])
                ->whereBetween('created_at', [$start, $end])
                ->latest()
                ->take(50)
                ->get(),
            default => ServiceRequest::with(['serviceType', 'village.district', 'officer'])
                ->whereBetween('submitted_at', [$start, $end])
                ->latest()
                ->take(50)
                ->get(),
        };
    }

    public function getViewData(): array
    {
        $districts = District::orderBy('name')->pluck('name', 'id');
        $villages = $this->districtId
            ? Village::where('district_id', $this->districtId)->orderBy('name')->pluck('name', 'id')
            : collect();

        return [
            'districts' => $districts,
            'villages' => $villages,
            'reportTitle' => $this->getReportTitle(),
            'reportData' => $this->getReportData(),
        ];
    }
}
