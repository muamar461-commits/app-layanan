<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 11px; color: #1e293b; line-height: 1.4; margin: 0; padding: 15px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 15px; }
        .header h2 { margin: 0; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; }
        .header h1 { margin: 2px 0; font-size: 17px; text-transform: uppercase; letter-spacing: 1px; }
        .header p { margin: 2px 0; font-size: 10px; color: #475569; }
        .meta { margin-bottom: 12px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
        th, td { border: 1px solid #94a3b8; padding: 6px 8px; text-align: left; }
        th { background-color: #f1f5f9; font-weight: bold; text-transform: uppercase; font-size: 9px; }
        .footer { margin-top: 30px; width: 100%; }
        .signature { float: right; width: 220px; text-align: center; }
        .signature-space { height: 60px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pemerintah Kabupaten Blitar</h2>
        <h1>Dinas Sosial</h1>
        <p>Jl. Raya Kanigoro, Kec. Kanigoro, Kabupaten Blitar, Jawa Timur 66171 &bull; Telp: (0342) 801-xxx</p>
    </div>

    <div class="meta">
        <strong>{{ $reportTitle }}</strong><br>
        Periode: {{ date('d F Y', strtotime($startDate)) }} s.d. {{ date('d F Y', strtotime($endDate)) }}<br>
        Dicetak pada: {{ date('d/m/Y H:i') }} WIB
    </div>

    <table>
        <thead>
            @if($reportType === 'dtsen')
                <tr>
                    <th>No. Tiket</th>
                    <th>No. SK DTSEN</th>
                    <th>Nama Pemohon</th>
                    <th>NIK</th>
                    <th>Tujuan SK</th>
                    <th>Desil</th>
                    <th>Tgl Terbit</th>
                    <th>Desa / Kecamatan</th>
                </tr>
            @elseif($reportType === 'pbi')
                <tr>
                    <th>No. Tiket</th>
                    <th>Nama Peserta</th>
                    <th>NIK</th>
                    <th>No. Kartu BPJS</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Desa / Kecamatan</th>
                </tr>
            @elseif($reportType === 'rehab')
                <tr>
                    <th>No. Kasus</th>
                    <th>Nama Klien</th>
                    <th>Kategori</th>
                    <th>Petugas</th>
                    <th>Penanganan</th>
                    <th>Status</th>
                    <th>Tgl Terima</th>
                </tr>
            @elseif($reportType === 'complaints')
                <tr>
                    <th>No. Aduan</th>
                    <th>Nama Pelapor</th>
                    <th>No. Telepon</th>
                    <th>Kategori Masalah</th>
                    <th>Status Laporan</th>
                    <th>Wilayah</th>
                    <th>Tgl Lapor</th>
                </tr>
            @else
                <tr>
                    <th>No. Tiket</th>
                    <th>Jenis Layanan</th>
                    <th>Nama Pemohon</th>
                    <th>NIK</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tgl Diajukan</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    @if($reportType === 'dtsen')
                        <td>{{ $row->serviceRequest?->request_number ?? '-' }}</td>
                        <td>{{ $row->certificate_number ?? '-' }}</td>
                        <td>{{ $row->serviceRequest?->applicant_name ?? '-' }}</td>
                        <td>{{ $row->described_person_nik ?? '-' }}</td>
                        <td>{{ $row->dtsenPurpose?->name ?? '-' }}</td>
                        <td style="text-align: center;">{{ $row->decile ?? '-' }}</td>
                        <td>{{ $row->issued_at?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $row->serviceRequest?->village?->name ?? '-' }}</td>
                    @elseif($reportType === 'pbi')
                        <td>{{ $row->serviceRequest?->request_number ?? '-' }}</td>
                        <td>{{ $row->participant_name }}</td>
                        <td>{{ $row->participant_nik }}</td>
                        <td>{{ $row->bpjs_card_number ?? '-' }}</td>
                        <td>{{ $row->reason?->value ?? $row->reason }}</td>
                        <td>{{ $row->serviceRequest?->status?->label() ?? $row->serviceRequest?->status ?? '-' }}</td>
                        <td>{{ $row->serviceRequest?->village?->name ?? '-' }}</td>
                    @elseif($reportType === 'rehab')
                        <td>{{ $row->case_number }}</td>
                        <td>{{ $row->client?->name ?? '-' }}</td>
                        <td>{{ $row->client?->category?->name ?? '-' }}</td>
                        <td>{{ $row->officer?->name ?? '-' }}</td>
                        <td>{{ $row->handling_type?->label() ?? $row->handling_type ?? '-' }}</td>
                        <td>{{ $row->status?->label() ?? $row->status ?? '-' }}</td>
                        <td>{{ $row->received_at?->format('d/m/Y') ?? '-' }}</td>
                    @elseif($reportType === 'complaints')
                        <td>{{ $row->complaint_number }}</td>
                        <td>{{ $row->reporter_name }}</td>
                        <td>{{ $row->reporter_phone }}</td>
                        <td>{{ $row->category?->name ?? '-' }}</td>
                        <td>{{ $row->status?->label() ?? $row->status ?? '-' }}</td>
                        <td>{{ $row->village?->name ?? '-' }}</td>
                        <td>{{ $row->reported_at?->format('d/m/Y') ?? '-' }}</td>
                    @else
                        <td>{{ $row->request_number }}</td>
                        <td>{{ $row->serviceType?->name ?? '-' }}</td>
                        <td>{{ $row->applicant_name }}</td>
                        <td>{{ $row->applicant_nik }}</td>
                        <td style="text-align: center;">{{ $row->is_priority ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $row->status?->label() ?? $row->status ?? '-' }}</td>
                        <td>{{ $row->submitted_at?->format('d/m/Y') ?? '-' }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 15px;">Tidak ada rekapan data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Blitar, {{ date('d F Y') }}<br><strong>Kepala Dinas Sosial</strong></p>
            <div class="signature-space"></div>
            <p><strong><u>Dr. Ir. H. Bambang Widjanarko, M.Si</u></strong><br>Pembina Utama Muda<br>NIP. 19680505 199403 1 006</p>
        </div>
    </div>
</body>
</html>
