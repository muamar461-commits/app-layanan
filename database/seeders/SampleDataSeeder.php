<?php

namespace Database\Seeders;

use App\Enums\ApprovalDecision;
use App\Enums\ComplaintAttachmentType;
use App\Enums\ComplaintStatus;
use App\Enums\DocumentVerificationStatus;
use App\Enums\HandlingType;
use App\Enums\MinistryDecision;
use App\Enums\PbiReason;
use App\Enums\ReferralStatus;
use App\Enums\RehabilitationCaseStatus;
use App\Enums\ServiceRequestStatus;
use App\Models\Approval;
use App\Models\Assessment;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\Disposition;
use App\Models\District;
use App\Models\DtsenCertificate;
use App\Models\DtsenPurpose;
use App\Models\MonitoringRecord;
use App\Models\NumberSequence;
use App\Models\PbiReactivation;
use App\Models\Referral;
use App\Models\ReferralInstitution;
use App\Models\RehabilitationCase;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDocument;
use App\Models\ServiceRequirement;
use App\Models\ServiceType;
use App\Models\StatusHistory;
use App\Models\User;
use App\Models\Village;
use App\Models\WorkUnit;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Master entities reference
        $admin = User::where('email', 'admin@dinsos.blitarkab.go.id')->first();
        $petugasLinjamsos = User::where('email', 'petugas.pelayanan@dinsos.blitarkab.go.id')->first();
        $petugasRehsos = User::where('email', 'petugas.rehsos@dinsos.blitarkab.go.id')->first();
        $kabidLinjamsos = User::where('email', 'kabid.linjamsos@dinsos.blitarkab.go.id')->first();
        $kabidRehsos = User::where('email', 'kabid.rehsos@dinsos.blitarkab.go.id')->first();
        $kadis = User::where('email', 'kadis@dinsos.blitarkab.go.id')->first();
        $operatorSawentar = User::where('email', 'operator.sawentar@dinsos.blitarkab.go.id')->first();
        $budi = User::where('email', 'budi.santoso@gmail.com')->first();
        $siti = User::where('email', 'siti.aminah@gmail.com')->first();
        $joko = User::where('email', 'joko.widodo@gmail.com')->first();

        $linjamsosUnit = WorkUnit::where('name', 'Bidang Perlindungan dan Jaminan Sosial')->first();
        $rehsosUnit = WorkUnit::where('name', 'Bidang Rehabilitasi Sosial')->first();
        $sekretariatUnit = WorkUnit::where('name', 'Sekretariat')->first();

        $dtsenService = ServiceType::where('code', 'DTSEN')->first();
        $pbiService = ServiceType::where('code', 'PBI')->first();
        $rehsosService = ServiceType::where('code', 'REHSOS')->first();
        $bansosService = ServiceType::where('code', 'BANSOS')->first();

        $kanigoroDistrict = District::where('code', '35.05.10')->orWhere('name', 'Kanigoro')->first();
        $sawentarVillage = Village::where('name', 'like', '%Sawentar%')->first() ?? Village::where('code', '35.05.01.2006')->first();
        $kanigoroVillage = Village::where('name', 'like', '%Kanigoro%')->first() ?? Village::where('code', '35.05.01.1001')->first();
        $slorokVillage = Village::where('name', 'like', '%Slorok%')->first() ?? Village::where('code', '35.05.02.2004')->first();

        $spmbPurpose = DtsenPurpose::where('code', 'spmb')->first() ?? DtsenPurpose::first();
        $pipPurpose = DtsenPurpose::where('code', 'pip')->first() ?? DtsenPurpose::first();

        $catLansia = ClientCategory::where('name', 'like', '%Lanjut Usia%')->first() ?? ClientCategory::first();
        $catDisabilitas = ClientCategory::where('name', 'like', '%Disabilitas%')->first() ?? ClientCategory::first();

        $catBansos = ComplaintCategory::where('name', 'like', '%Bansos%')->first() ?? ComplaintCategory::first();
        $catPpks = ComplaintCategory::where('name', 'like', '%PPKS Terlantar%')->first() ?? ComplaintCategory::first();
        $catAlatBantu = ComplaintCategory::where('name', 'like', '%Alat Bantu%')->first() ?? ComplaintCategory::first();

        $pstwBlitar = ReferralInstitution::where('type', 'panti')->first() ?? ReferralInstitution::first();

        // 2. Seed Number Sequences
        $period = date('Ym');
        $sequences = [
            ['prefix' => 'DTSEN', 'period' => $period, 'last_number' => 3],
            ['prefix' => 'PBI', 'period' => $period, 'last_number' => 2],
            ['prefix' => 'RHS', 'period' => $period, 'last_number' => 2],
            ['prefix' => 'ADU', 'period' => $period, 'last_number' => 3],
            ['prefix' => 'RJK', 'period' => $period, 'last_number' => 1],
        ];

        foreach ($sequences as $seq) {
            NumberSequence::updateOrCreate(
                ['prefix' => $seq['prefix'], 'period' => $seq['period']],
                ['last_number' => $seq['last_number']]
            );
        }

        // ==========================================
        // 3. SERVICE REQUESTS & RELATED DATA
        // ==========================================

        // A. DTSEN 0001 (Completed with Certificate & Approvals)
        $srDtsen1 = ServiceRequest::updateOrCreate(
            ['request_number' => "DTSEN-{$period}-0001"],
            [
                'service_type_id' => $dtsenService->id,
                'submitter_id' => $budi?->id,
                'applicant_name' => 'Budi Santoso',
                'applicant_nik' => '3505011205850001',
                'family_card_number' => '3505011205850002',
                'address' => 'Dusun Sawentar RT 02 RW 03, Desa Sawentar',
                'village_id' => $sawentarVillage->id,
                'phone' => '081234567891',
                'submitted_at' => now()->subDays(5),
                'officer_id' => $petugasLinjamsos?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::Completed,
                'is_priority' => false,
                'verification_result' => 'Data NIK pemohon dan anak valid, terdaftar di basis data DTSEN Desil 2.',
                'officer_notes' => 'Dokumen lengkap dan valid. Memenuhi kriteria syarat surat keterangan DTSEN untuk pendaftaran sekolah.',
                'service_result' => 'Surat Keterangan DTSEN diterbitkan nomor 460/001/DTSEN/409.106/2026.',
                'completed_at' => now()->subDays(4),
            ]
        );

        // Documents for DTSEN 0001
        $dtsenReqs = ServiceRequirement::where('service_type_id', $dtsenService->id)->get();
        foreach ($dtsenReqs as $req) {
            ServiceRequestDocument::updateOrCreate(
                [
                    'service_request_id' => $srDtsen1->id,
                    'service_requirement_id' => $req->id,
                ],
                [
                    'file_path' => "documents/dtsen_0001_{$req->id}.pdf",
                    'original_name' => "{$req->name}_Budi_Santoso.pdf",
                    'verification_status' => DocumentVerificationStatus::Valid,
                    'notes' => 'Terverifikasi sesuai dokumen asli',
                ]
            );
        }

        // Certificate for DTSEN 0001
        $certDtsen1 = DtsenCertificate::updateOrCreate(
            ['service_request_id' => $srDtsen1->id],
            [
                'dtsen_purpose_id' => $spmbPurpose->id,
                'purpose_description' => 'Persyaratan Pendaftaran SPMB Jalur Afirmasi SMP Negeri 1 Kanigoro',
                'subject_name' => 'Ahmad Santoso',
                'subject_nik' => '3505012501120005',
                'relationship_to_applicant' => 'Anak Kandung',
                'is_registered' => true,
                'decile' => 2,
                'checked_at' => now()->subDays(5)->addHours(4),
                'checker_id' => $petugasLinjamsos?->id,
                'certificate_number' => "460/001/DTSEN/409.106/{$period}",
                'issued_at' => now()->subDays(4),
                'valid_until' => now()->subDays(4)->addDays(30)->toDateString(),
                'signer_id' => $kadis?->id,
                'file_path' => "certificates/dtsen_{$period}_0001.pdf",
                'verification_code' => 'DTSEN-V-8K9F2M1Q',
            ]
        );

        // Approvals for DTSEN 0001
        Approval::updateOrCreate(
            [
                'approvable_type' => DtsenCertificate::class,
                'approvable_id' => $certDtsen1->id,
                'step' => 1,
            ],
            [
                'approver_id' => $kabidLinjamsos?->id ?? $admin->id,
                'decision' => ApprovalDecision::Approved,
                'notes' => 'Telah diperiksa dan memenuhi kriteria desil afirmasi.',
                'decided_at' => now()->subDays(4)->subHours(3),
            ]
        );

        Approval::updateOrCreate(
            [
                'approvable_type' => DtsenCertificate::class,
                'approvable_id' => $certDtsen1->id,
                'step' => 2,
            ],
            [
                'approver_id' => $kadis?->id ?? $admin->id,
                'decision' => ApprovalDecision::Approved,
                'notes' => 'Surat Keterangan disahkan secara digital.',
                'decided_at' => now()->subDays(4),
            ]
        );

        // Status histories for DTSEN 0001
        $this->seedStatusHistories($srDtsen1, [
            ['from' => null, 'to' => 'submitted', 'user' => $budi, 'notes' => 'Permohonan diajukan secara online', 'time' => now()->subDays(5)],
            ['from' => 'submitted', 'to' => 'data_verification', 'user' => $petugasLinjamsos, 'notes' => 'Pengecekan NIK pada basis data DTSEN', 'time' => now()->subDays(5)->addHours(2)],
            ['from' => 'data_verification', 'to' => 'awaiting_approval', 'user' => $petugasLinjamsos, 'notes' => 'Draf surat diajukan untuk paraf dan TTE', 'time' => now()->subDays(4)->subHours(4)],
            ['from' => 'awaiting_approval', 'to' => 'completed', 'user' => $kadis, 'notes' => 'Surat telah ditandatangani dan siap diunduh pemohon', 'time' => now()->subDays(4)],
        ]);

        // B. DTSEN 0002 (In Process: Data Verification)
        $srDtsen2 = ServiceRequest::updateOrCreate(
            ['request_number' => "DTSEN-{$period}-0002"],
            [
                'service_type_id' => $dtsenService->id,
                'submitter_id' => $siti?->id,
                'applicant_name' => 'Siti Aminah',
                'applicant_nik' => '3505015508890002',
                'family_card_number' => '3505015508890001',
                'address' => 'Jl. Merapi No. 12, Kelurahan Kanigoro',
                'village_id' => $kanigoroVillage->id,
                'phone' => '081234567892',
                'submitted_at' => now()->subDays(1),
                'officer_id' => $petugasLinjamsos?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::DataVerification,
                'is_priority' => false,
                'verification_result' => 'Sedang dilakukan pencocokan data padan Kemensos dan Dukcapil.',
                'officer_notes' => 'Menunggu konfirmasi kelengkapan fotokopi KK terbaru.',
            ]
        );

        foreach ($dtsenReqs as $req) {
            ServiceRequestDocument::updateOrCreate(
                [
                    'service_request_id' => $srDtsen2->id,
                    'service_requirement_id' => $req->id,
                ],
                [
                    'file_path' => "documents/dtsen_0002_{$req->id}.pdf",
                    'original_name' => "{$req->name}_Siti_Aminah.pdf",
                    'verification_status' => DocumentVerificationStatus::Pending,
                ]
            );
        }

        $this->seedStatusHistories($srDtsen2, [
            ['from' => null, 'to' => 'submitted', 'user' => $siti, 'notes' => 'Permohonan diajukan', 'time' => now()->subDays(1)],
            ['from' => 'submitted', 'to' => 'data_verification', 'user' => $petugasLinjamsos, 'notes' => 'Berkas masuk ke antrean verifikasi data', 'time' => now()->subHours(6)],
        ]);

        // C. DTSEN 0003 (Rejected)
        $srDtsen3 = ServiceRequest::updateOrCreate(
            ['request_number' => "DTSEN-{$period}-0003"],
            [
                'service_type_id' => $dtsenService->id,
                'submitter_id' => $joko?->id,
                'applicant_name' => 'Joko Widodo',
                'applicant_nik' => '3505022103750003',
                'family_card_number' => '3505022103750001',
                'address' => 'Desa Slorok RT 01 RW 02, Garum',
                'village_id' => $slorokVillage->id,
                'phone' => '081234567893',
                'submitted_at' => now()->subDays(6),
                'officer_id' => $petugasLinjamsos?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::Rejected,
                'is_priority' => false,
                'rejection_reason' => 'Berdasarkan hasil penelusuran SIKS-NG, NIK terdaftar pada Desil 8 (kategori keluarga mampu) sehingga tidak memenuhi syarat penerbitan surat keterangan DTSEN untuk afirmasi bantuan.',
                'completed_at' => now()->subDays(5),
            ]
        );

        $this->seedStatusHistories($srDtsen3, [
            ['from' => null, 'to' => 'submitted', 'user' => $joko, 'notes' => 'Permohonan diajukan', 'time' => now()->subDays(6)],
            ['from' => 'submitted', 'to' => 'rejected', 'user' => $petugasLinjamsos, 'notes' => 'Ditolak: Masuk desil ekonomi mampu', 'time' => now()->subDays(5)],
        ]);

        // D. PBI 0001 (Completed with Reactivation & Ministry Approval)
        $srPbi1 = ServiceRequest::updateOrCreate(
            ['request_number' => "PBI-{$period}-0001"],
            [
                'service_type_id' => $pbiService->id,
                'submitter_id' => $budi?->id,
                'applicant_name' => 'Budi Santoso',
                'applicant_nik' => '3505011205850001',
                'family_card_number' => '3505011205850002',
                'address' => 'Dusun Sawentar RT 02 RW 03, Desa Sawentar',
                'village_id' => $sawentarVillage->id,
                'phone' => '081234567891',
                'submitted_at' => now()->subDays(10),
                'officer_id' => $petugasLinjamsos?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::Completed,
                'is_priority' => true,
                'verification_result' => 'Pasien menderita gagal ginjal kronis stadium akhir di RSUD Ngudi Waluyo Wlingi. Kartu non-aktif per Juli 2026. Data valid Desil 1.',
                'officer_notes' => 'Prioritas penanganan darurat medis. Telah dikonsultasikan langsung ke verifikator Pusdatin Kesos Kemensos RI.',
                'service_result' => 'Kepesertaan PBI-JK berhasil direaktivasi dan aktif kembali pada sistem VClaim BPJS Kesehatan.',
                'completed_at' => now()->subDays(6),
            ]
        );

        $pbiReactivation1 = PbiReactivation::updateOrCreate(
            ['service_request_id' => $srPbi1->id],
            [
                'participant_name' => 'Budi Santoso',
                'participant_nik' => '3505011205850001',
                'bpjs_card_number' => '0001458923712',
                'deactivated_date' => now()->subMonths(2)->startOfMonth()->toDateString(),
                'reason' => PbiReason::Chronic,
                'health_facility_name' => 'RSUD Ngudi Waluyo Wlingi',
                'health_letter_number' => '445/782/RSUD/IX/2026',
                'decile' => 1,
                'eligibility_notes' => 'Pasien membutuhkan hemodialisa rutin 2 kali seminggu, tergolong keluarga sangat miskin.',
                'recommendation_number' => "440/128/REK-PBI/409.106/{$period}",
                'recommendation_issued_at' => now()->subDays(9),
                'signer_id' => $kabidLinjamsos?->id,
                'proposed_to_ministry_at' => now()->subDays(8),
                'ministry_decision' => MinistryDecision::Approved,
                'ministry_decided_at' => now()->subDays(6)->subHours(2),
                'reactivated_date' => now()->subDays(6)->toDateString(),
            ]
        );

        $this->seedStatusHistories($srPbi1, [
            ['from' => null, 'to' => 'submitted', 'user' => $budi, 'notes' => 'Permohonan darurat diajukan', 'time' => now()->subDays(10)],
            ['from' => 'submitted', 'to' => 'recommendation_issued', 'user' => $kabidLinjamsos, 'notes' => 'Rekomendasi diterbitkan Dinsos Kab. Blitar', 'time' => now()->subDays(9)],
            ['from' => 'recommendation_issued', 'to' => 'proposed_to_ministry', 'user' => $petugasLinjamsos, 'notes' => 'Usulan diunggah ke aplikasi SIKS-NG Reaktivasi PBI Kemensos', 'time' => now()->subDays(8)],
            ['from' => 'proposed_to_ministry', 'to' => 'completed', 'user' => $petugasLinjamsos, 'notes' => 'Disetujui Kemensos, kartu KIS aktif kembali', 'time' => now()->subDays(6)],
        ]);

        // E. PBI 0002 (In Progress: Awaiting Approval, Emergency Facilitated by Operator Desa)
        $srPbi2 = ServiceRequest::updateOrCreate(
            ['request_number' => "PBI-{$period}-0002"],
            [
                'service_type_id' => $pbiService->id,
                'submitter_id' => $operatorSawentar?->id,
                'applicant_name' => 'Mbah Painem',
                'applicant_nik' => '3505014502500008',
                'family_card_number' => '3505014502500001',
                'address' => 'Dusun Centong RT 01 RW 04, Desa Sawentar',
                'village_id' => $sawentarVillage->id,
                'phone' => '081234567891',
                'submitted_at' => now()->subHours(12),
                'officer_id' => $petugasLinjamsos?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::AwaitingApproval,
                'is_priority' => true,
                'verification_result' => 'Pasien lansia 76 tahun serangan stroke iskemik di IGD RSUD Srengat. Desil 1.',
                'officer_notes' => 'Diajukan oleh Operator Desa Sawentar atas permohonan keluarga pasien.',
            ]
        );

        $pbiReactivation2 = PbiReactivation::updateOrCreate(
            ['service_request_id' => $srPbi2->id],
            [
                'participant_name' => 'Painem',
                'participant_nik' => '3505014502500008',
                'bpjs_card_number' => '0001928374650',
                'deactivated_date' => now()->subMonth()->startOfMonth()->toDateString(),
                'reason' => PbiReason::Emergency,
                'health_facility_name' => 'RSUD Srengat Blitar',
                'health_letter_number' => '445/890/IGD/IX/2026',
                'decile' => 1,
                'eligibility_notes' => 'Kondisi gawat darurat medis di ICU, desil 1.',
                'ministry_decision' => MinistryDecision::Pending,
            ]
        );

        Approval::updateOrCreate(
            [
                'approvable_type' => PbiReactivation::class,
                'approvable_id' => $pbiReactivation2->id,
                'step' => 1,
            ],
            [
                'approver_id' => $kabidLinjamsos?->id ?? $admin->id,
                'decision' => ApprovalDecision::Pending,
                'notes' => 'Menunggu verifikasi tanda tangan rekomendasi Kabid.',
            ]
        );

        $this->seedStatusHistories($srPbi2, [
            ['from' => null, 'to' => 'submitted', 'user' => $operatorSawentar, 'notes' => 'Didaftarkan oleh Operator Desa', 'time' => now()->subHours(12)],
            ['from' => 'submitted', 'to' => 'awaiting_approval', 'user' => $petugasLinjamsos, 'notes' => 'Verifikasi selesai, diajukan untuk tanda tangan rekomendasi', 'time' => now()->subHours(3)],
        ]);

        // ==========================================
        // 4. REHABILITATION CASES & CLIENTS
        // ==========================================

        // A. Client 1: Lansia Terlantar
        $client1 = Client::updateOrCreate(
            ['nik' => '3505010101450001'],
            [
                'name' => 'Mbah Sumiran',
                'client_category_id' => $catLansia->id,
                'birth_date' => '1945-08-17',
                'gender' => 'L',
                'address' => 'Ditemukan terlantar di emperan Pasar Kanigoro',
                'village_id' => $kanigoroVillage->id,
                'phone' => null,
            ]
        );

        $case1 = RehabilitationCase::updateOrCreate(
            ['case_number' => "RHS-{$period}-0001"],
            [
                'client_id' => $client1->id,
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'handling_type' => HandlingType::Both,
                'status' => RehabilitationCaseStatus::InService,
                'handling_result' => 'Klien telah mendapatkan penanganan medis awal di RSUD dan dirujuk ke UPT PSTW Blitar.',
                'received_at' => now()->subDays(8),
            ]
        );

        $assessment1 = Assessment::updateOrCreate(
            ['rehabilitation_case_id' => $case1->id],
            [
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'assessment_date' => now()->subDays(7)->toDateString(),
                'result' => 'Klien berusia 81 tahun dalam kondisi lemah fisik karena malnutrisi, tidak memiliki keluarga atau kerabat di Blitar.',
                'service_needs' => 'Kebutuhan sandang, pangan, tempat tinggal layak permanen, dan pendampingan perawatan geriatri.',
                'recommendation' => 'Rujukan ke Panti Sosial Tresna Werdha (UPT PSTW Blitar) Provinsi Jawa Timur.',
                'needs_referral' => true,
            ]
        );

        $referral1 = Referral::updateOrCreate(
            ['rehabilitation_case_id' => $case1->id],
            [
                'referral_number' => "RJK-{$period}-0001",
                'assessment_id' => $assessment1->id,
                'referral_institution_id' => $pstwBlitar->id,
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'referral_date' => now()->subDays(5)->toDateString(),
                'status' => ReferralStatus::Accepted,
                'service_result' => 'Pihak UPT PSTW menerima klien dan menempatkan di Ruang Mawar untuk perawatan jangka panjang.',
            ]
        );

        MonitoringRecord::updateOrCreate(
            [
                'rehabilitation_case_id' => $case1->id,
                'monitoring_date' => now()->subDays(2)->toDateString(),
            ],
            [
                'referral_id' => $referral1->id,
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'progress' => 'Kondisi kesehatan fisik membaik, nafsu makan normal, klien tampak tenang dan mulai berkomunikasi baik.',
                'result_notes' => 'Adaptasi lingkungan panti berjalan sangat baik.',
            ]
        );

        $this->seedStatusHistories($case1, [
            ['from' => null, 'to' => 'received', 'user' => $petugasRehsos, 'notes' => 'Laporan penemuan lansia terlantar diterima', 'time' => now()->subDays(8)],
            ['from' => 'received', 'to' => 'assessment', 'user' => $petugasRehsos, 'notes' => 'Asesmen awal komprehensif oleh Pekerja Sosial', 'time' => now()->subDays(7)],
            ['from' => 'assessment', 'to' => 'in_service', 'user' => $petugasRehsos, 'notes' => 'Pelaksanaan rujukan ke UPT PSTW Blitar', 'time' => now()->subDays(5)],
        ]);

        // B. Client 2: Disabilitas (Direct Aid - Closed)
        $client2 = Client::updateOrCreate(
            ['nik' => '3505011505980007'],
            [
                'name' => 'Rahmat Hidayat',
                'client_category_id' => $catDisabilitas->id,
                'birth_date' => '1998-05-15',
                'gender' => 'L',
                'address' => 'RT 03 RW 01 Desa Sawentar',
                'village_id' => $sawentarVillage->id,
                'phone' => '085712349988',
            ]
        );

        $case2 = RehabilitationCase::updateOrCreate(
            ['case_number' => "RHS-{$period}-0002"],
            [
                'client_id' => $client2->id,
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'handling_type' => HandlingType::Direct,
                'status' => RehabilitationCaseStatus::Closed,
                'handling_result' => 'Telah diserahkan 1 unit kursi roda adaptif dan paket sembako. Klien dapat beraktivitas kembali.',
                'received_at' => now()->subDays(15),
                'closed_at' => now()->subDays(3),
            ]
        );

        Assessment::updateOrCreate(
            ['rehabilitation_case_id' => $case2->id],
            [
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'assessment_date' => now()->subDays(14)->toDateString(),
                'result' => 'Klien mengalami kelumpuhan motorik ekstremitas bawah, motivasi kerja tinggi untuk usaha menjahit mandiri.',
                'service_needs' => 'Alat bantu kursi roda dan motivasi dukungan usaha.',
                'recommendation' => 'Penyaluran alat bantu langsung melalui program APBD Dinas Sosial.',
                'needs_referral' => false,
            ]
        );

        MonitoringRecord::updateOrCreate(
            [
                'rehabilitation_case_id' => $case2->id,
                'monitoring_date' => now()->subDays(3)->toDateString(),
            ],
            [
                'referral_id' => null,
                'officer_id' => $petugasRehsos?->id ?? $admin->id,
                'progress' => 'Kursi roda berfungsi optimal dan sangat membantu mobilitas usaha jahit klien di rumah.',
                'result_notes' => 'Kasus dinyatakan selesai dan ditutup.',
            ]
        );

        $this->seedStatusHistories($case2, [
            ['from' => null, 'to' => 'received', 'user' => $petugasRehsos, 'notes' => 'Permohonan bantuan masuk', 'time' => now()->subDays(15)],
            ['from' => 'received', 'to' => 'assessment', 'user' => $petugasRehsos, 'notes' => 'Home visit dan asesmen fisik', 'time' => now()->subDays(14)],
            ['from' => 'assessment', 'to' => 'in_service', 'user' => $petugasRehsos, 'notes' => 'Penyerahan alat bantu kursi roda', 'time' => now()->subDays(5)],
            ['from' => 'in_service', 'to' => 'closed', 'user' => $petugasRehsos, 'notes' => 'Monitoring akhir sukses, kasus ditutup', 'time' => now()->subDays(3)],
        ]);

        // ==========================================
        // 5. COMPLAINTS, DISPOSITIONS & ATTACHMENTS
        // ==========================================

        // A. Complaint 1: Resolved Bansos Mis-target
        $complaint1 = Complaint::updateOrCreate(
            ['complaint_number' => "ADU-{$period}-0001"],
            [
                'complaint_category_id' => $catBansos->id,
                'reporter_id' => $budi?->id,
                'reporter_name' => 'Budi Santoso',
                'reporter_phone' => '081234567891',
                'location_detail' => 'Dusun Sawentar RT 04 RW 02, sebelah timur masjid',
                'village_id' => $sawentarVillage->id,
                'description' => 'Ada warga setempat yang memiliki mobil pribadi dan toko pracangan besar tetapi masih menerima bansos sembako/PKH setiap bulan, mohon ditinjau ulang kelayakannya.',
                'reported_at' => now()->subDays(12),
                'officer_id' => $petugasLinjamsos?->id,
                'status' => ComplaintStatus::Resolved,
                'verification_result' => 'Tim TKSK Kecamatan Kanigoro bersama perangkat desa telah melakukan survei faktual. Terbukti ada peningkatan taraf ekonomi signifikan.',
                'action_taken' => 'Keluarga yang bersangkutan telah bersedia menandatangani berita acara graduasi mandiri dan dikeluarkan dari kepesertaan bansos pada pemutakhiran SIKS-NG periode ini.',
                'resolved_at' => now()->subDays(7),
            ]
        );

        ComplaintAttachment::updateOrCreate(
            [
                'complaint_id' => $complaint1->id,
                'file_path' => 'complaints/adu_0001_foto_rumah.jpg',
            ],
            [
                'type' => ComplaintAttachmentType::Photo,
            ]
        );

        Disposition::updateOrCreate(
            [
                'dispositionable_type' => Complaint::class,
                'dispositionable_id' => $complaint1->id,
                'from_user_id' => $kadis?->id ?? $admin->id,
                'to_work_unit_id' => $linjamsosUnit->id,
            ],
            [
                'to_user_id' => $kabidLinjamsos?->id,
                'instructions' => 'Segera instruksikan TKSK Kanigoro untuk kroscek data dan laporkan hasil verifikasi faktual lapangan.',
                'disposed_at' => now()->subDays(11),
            ]
        );

        $this->seedStatusHistories($complaint1, [
            ['from' => null, 'to' => 'received', 'user' => $budi, 'notes' => 'Pengaduan dikirim pelapor', 'time' => now()->subDays(12)],
            ['from' => 'received', 'to' => 'dispatched', 'user' => $kadis, 'notes' => 'Didisposisikan ke Bidang Linjamsos', 'time' => now()->subDays(11)],
            ['from' => 'dispatched', 'to' => 'in_handling', 'user' => $petugasLinjamsos, 'notes' => 'TKSK turun ke lapangan untuk survei faktual', 'time' => now()->subDays(9)],
            ['from' => 'in_handling', 'to' => 'resolved', 'user' => $petugasLinjamsos, 'notes' => 'Keluarga bersedia graduasi mandiri bansos', 'time' => now()->subDays(7)],
        ]);

        // B. Complaint 2: In Handling PPKS Terlantar
        $complaint2 = Complaint::updateOrCreate(
            ['complaint_number' => "ADU-{$period}-0002"],
            [
                'complaint_category_id' => $catPpks->id,
                'reporter_id' => $siti?->id,
                'reporter_name' => 'Siti Aminah',
                'reporter_phone' => '081234567892',
                'location_detail' => 'Pos kamling dekat Stasiun Garum',
                'village_id' => $slorokVillage->id,
                'description' => 'Ditemukan seorang kakek terlantar tampak kebingungan dan demam tinggi di pos kamling, tidak membawa identitas.',
                'reported_at' => now()->subHours(18),
                'officer_id' => $petugasRehsos?->id,
                'status' => ComplaintStatus::InHandling,
                'verification_result' => 'Tim TRC Dinsos telah berkoordinasi dengan Puskesmas Garum untuk pemeriksaan medis awal.',
                'action_taken' => 'Klien telah dievakuasi ke RSUD Ngudi Waluyo Wlingi untuk perawatan darurat.',
            ]
        );

        ComplaintAttachment::updateOrCreate(
            [
                'complaint_id' => $complaint2->id,
                'file_path' => 'complaints/adu_0002_kondisi_lansia.jpg',
            ],
            [
                'type' => ComplaintAttachmentType::Photo,
            ]
        );

        Disposition::updateOrCreate(
            [
                'dispositionable_type' => Complaint::class,
                'dispositionable_id' => $complaint2->id,
                'from_user_id' => $kadis?->id ?? $admin->id,
                'to_work_unit_id' => $rehsosUnit->id,
            ],
            [
                'to_user_id' => $petugasRehsos?->id,
                'instructions' => 'Segera terjunkan TRC Rehsos dan evakuasi bersama aparat setempat.',
                'disposed_at' => now()->subHours(15),
            ]
        );

        $this->seedStatusHistories($complaint2, [
            ['from' => null, 'to' => 'received', 'user' => $siti, 'notes' => 'Laporan pengaduan diterima sistem', 'time' => now()->subHours(18)],
            ['from' => 'received', 'to' => 'dispatched', 'user' => $kadis, 'notes' => 'Disposisi darurat ke TRC Rehsos', 'time' => now()->subHours(15)],
            ['from' => 'dispatched', 'to' => 'in_handling', 'user' => $petugasRehsos, 'notes' => 'Evakuasi dan penanganan medis di RSUD', 'time' => now()->subHours(10)],
        ]);

        // C. Complaint 3: Received (Guest Citizen / Baru Masuk)
        $complaint3 = Complaint::updateOrCreate(
            ['complaint_number' => "ADU-{$period}-0003"],
            [
                'complaint_category_id' => $catAlatBantu->id,
                'reporter_id' => null,
                'reporter_name' => 'Agus Setyawan',
                'reporter_phone' => '082199887766',
                'location_detail' => 'RT 01 RW 01 Desa Gaprang, Kanigoro',
                'village_id' => $sawentarVillage->id,
                'description' => 'Mohon bantuan kursi roda untuk anak disabilitas cerebral palsy usia 10 tahun. Orang tua buruh tani serabutan.',
                'reported_at' => now()->subHours(2),
                'officer_id' => null,
                'status' => ComplaintStatus::Received,
            ]
        );

        $this->seedStatusHistories($complaint3, [
            ['from' => null, 'to' => 'received', 'user' => null, 'notes' => 'Pengaduan masyarakat masuk ke sistem', 'time' => now()->subHours(2)],
        ]);
    }

    /**
     * Helper to seed status histories safely.
     */
    protected function seedStatusHistories(object $model, array $histories): void
    {
        foreach ($histories as $h) {
            StatusHistory::firstOrCreate(
                [
                    'statusable_type' => get_class($model),
                    'statusable_id' => $model->id,
                    'from_status' => $h['from'],
                    'to_status' => $h['to'],
                ],
                [
                    'user_id' => $h['user']?->id,
                    'notes' => $h['notes'],
                    'created_at' => $h['time'],
                    'updated_at' => $h['time'],
                ]
            );
        }
    }
}
