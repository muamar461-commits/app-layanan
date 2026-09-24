<?php

namespace Tests\Feature;

use App\Enums\ApprovalDecision;
use App\Enums\ComplaintAttachmentType;
use App\Enums\ComplaintStatus;
use App\Enums\DocumentVerificationStatus;
use App\Enums\HandlingType;
use App\Enums\InformationCategory;
use App\Enums\MinistryDecision;
use App\Enums\PbiReason;
use App\Enums\PublishStatus;
use App\Enums\ReferralStatus;
use App\Enums\RehabilitationCaseStatus;
use App\Enums\ServiceHandler;
use App\Enums\ServiceRequestStatus;
use App\Models\ActivityLog;
use App\Models\Approval;
use App\Models\Assessment;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\Disposition;
use App\Models\District;
use App\Models\DownloadableForm;
use App\Models\DtsenCertificate;
use App\Models\DtsenPurpose;
use App\Models\Faq;
use App\Models\InformationPage;
use App\Models\MonitoringRecord;
use App\Models\NumberSequence;
use App\Models\PageVisit;
use App\Models\PbiReactivation;
use App\Models\Referral;
use App\Models\ReferralInstitution;
use App\Models\RehabilitationCase;
use App\Models\SearchLog;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDocument;
use App\Models\ServiceRequirement;
use App\Models\ServiceType;
use App\Models\StatusHistory;
use App\Models\User;
use App\Models\Village;
use App\Models\WorkUnit;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ModelsAndMigrationsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_all_sapa_sosial_tables_exist(): void
    {
        $tables = [
            'work_units',
            'districts',
            'villages',
            'service_types',
            'service_requirements',
            'service_requests',
            'service_request_documents',
            'dtsen_purposes',
            'dtsen_certificates',
            'pbi_reactivations',
            'approvals',
            'client_categories',
            'clients',
            'rehabilitation_cases',
            'assessments',
            'referral_institutions',
            'referrals',
            'monitoring_records',
            'complaint_categories',
            'complaints',
            'complaint_attachments',
            'information_pages',
            'downloadable_forms',
            'faqs',
            'page_visits',
            'search_logs',
            'status_histories',
            'dispositions',
            'number_sequences',
            'activity_log',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(Schema::hasTable($table), "Table {$table} does not exist.");
        }

        $this->assertTrue(Schema::hasColumns('users', [
            'phone',
            'nik',
            'work_unit_id',
            'district_id',
            'village_id',
            'is_active',
        ]));
    }

    public function test_all_models_can_be_created_and_associated(): void
    {
        $workUnit = WorkUnit::create([
            'name' => 'Bidang Perlindungan dan Jaminan Sosial',
            'is_active' => true,
        ]);

        $district = District::create([
            'code' => '35.05.01',
            'name' => 'Kecamatan Kanigoro',
        ]);

        $village = Village::create([
            'district_id' => $district->id,
            'code' => '35.05.01.2001',
            'name' => 'Desa Kanigoro',
        ]);

        $officer = User::create([
            'name' => 'Petugas Dinsos',
            'email' => 'officer@example.com',
            'password' => bcrypt('secret123'),
            'phone' => '081234567890',
            'nik' => '3505011234567890',
            'work_unit_id' => $workUnit->id,
            'district_id' => $district->id,
            'village_id' => $village->id,
            'is_active' => true,
        ]);

        $this->assertEquals($workUnit->id, $officer->workUnit->id);
        $this->assertEquals($district->id, $officer->district->id);
        $this->assertEquals($village->id, $officer->village->id);

        $serviceType = ServiceType::create([
            'code' => 'DTSEN',
            'name' => 'Surat Keterangan DTSEN',
            'category' => 'Data Sosial',
            'description' => 'Penerbitan surat keterangan data DTSEN',
            'handler' => ServiceHandler::Dtsen,
            'needs_assessment' => false,
            'sla_days' => 1,
            'is_active' => true,
        ]);

        $this->assertEquals(ServiceHandler::Dtsen, $serviceType->handler);

        $requirement = ServiceRequirement::create([
            'service_type_id' => $serviceType->id,
            'name' => 'Kartu Tanda Penduduk (KTP)',
            'is_mandatory' => true,
            'allowed_mimes' => 'pdf,jpg,png',
            'sort_order' => 1,
        ]);

        $this->assertEquals($serviceType->id, $requirement->serviceType->id);

        $serviceRequest = ServiceRequest::create([
            'request_number' => 'DTSEN-202610-00001',
            'service_type_id' => $serviceType->id,
            'submitter_id' => $officer->id,
            'applicant_name' => 'Budi Santoso',
            'applicant_nik' => '3505012345678901',
            'family_card_number' => '3505012345678902',
            'address' => 'Jl. Merdeka No. 10',
            'village_id' => $village->id,
            'phone' => '081987654321',
            'submitted_at' => now(),
            'officer_id' => $officer->id,
            'work_unit_id' => $workUnit->id,
            'status' => ServiceRequestStatus::Submitted,
            'is_priority' => false,
        ]);

        $this->assertEquals(ServiceRequestStatus::Submitted, $serviceRequest->status);

        $document = ServiceRequestDocument::create([
            'service_request_id' => $serviceRequest->id,
            'service_requirement_id' => $requirement->id,
            'file_path' => 'documents/ktp.pdf',
            'original_name' => 'ktp.pdf',
            'verification_status' => DocumentVerificationStatus::Pending,
        ]);

        $this->assertEquals(DocumentVerificationStatus::Pending, $document->verification_status);

        $dtsenPurpose = DtsenPurpose::create([
            'code' => 'spmb',
            'name' => 'SPMB Jalur Afirmasi',
            'max_decile' => 5,
            'validity_days' => 30,
            'is_active' => true,
        ]);

        $dtsenCertificate = DtsenCertificate::create([
            'service_request_id' => $serviceRequest->id,
            'dtsen_purpose_id' => $dtsenPurpose->id,
            'purpose_description' => 'Untuk pendaftaran sekolah',
            'subject_name' => 'Anak Budi',
            'subject_nik' => '3505012345678903',
            'relationship_to_applicant' => 'Anak Kandung',
            'is_registered' => true,
            'decile' => 2,
            'checked_at' => now(),
            'checker_id' => $officer->id,
            'certificate_number' => '400.9/001/409.01/2026',
            'issued_at' => now(),
            'valid_until' => now()->addDays(30),
            'signer_id' => $officer->id,
            'verification_code' => 'DTSEN-ABC123XYZ',
        ]);

        $this->assertTrue($dtsenCertificate->is_registered);
        $this->assertEquals($serviceRequest->id, $dtsenCertificate->serviceRequest->id);

        $approval = Approval::create([
            'approvable_type' => DtsenCertificate::class,
            'approvable_id' => $dtsenCertificate->id,
            'step' => 1,
            'approver_id' => $officer->id,
            'decision' => ApprovalDecision::Approved,
            'notes' => 'Paraf disetujui',
            'decided_at' => now(),
        ]);

        $this->assertEquals(ApprovalDecision::Approved, $approval->decision);
        $this->assertEquals(1, $dtsenCertificate->approvals()->count());

        $pbiRequest = ServiceRequest::create([
            'request_number' => 'PBI-202610-00001',
            'service_type_id' => $serviceType->id,
            'applicant_name' => 'Siti Rahma',
            'applicant_nik' => '3505013456789012',
            'family_card_number' => '3505013456789013',
            'address' => 'Jl. Melati No. 5',
            'village_id' => $village->id,
            'phone' => '081234567899',
            'submitted_at' => now(),
            'status' => ServiceRequestStatus::Submitted,
        ]);

        $pbiReactivation = PbiReactivation::create([
            'service_request_id' => $pbiRequest->id,
            'participant_name' => 'Siti Rahma',
            'participant_nik' => '3505013456789012',
            'bpjs_card_number' => '0001234567890',
            'deactivated_date' => now()->subMonths(2),
            'reason' => PbiReason::Emergency,
            'health_facility_name' => 'RSUD Ngudi Waluyo',
            'health_letter_number' => 'SK/123/2026',
            'decile' => 1,
            'recommendation_number' => '400.9/PBI-001/2026',
            'ministry_decision' => MinistryDecision::Pending,
        ]);

        $this->assertEquals(PbiReason::Emergency, $pbiReactivation->reason);

        $clientCategory = ClientCategory::create([
            'name' => 'Lanjut Usia Terlantar',
        ]);

        $client = Client::create([
            'name' => 'Mbah Slamet',
            'client_category_id' => $clientCategory->id,
            'nik' => '3505014567890123',
            'gender' => 'L',
            'address' => 'Dusun Krajan',
            'village_id' => $village->id,
        ]);

        $complaintCategory = ComplaintCategory::create([
            'name' => 'Permasalahan Lansia Terlantar',
            'is_active' => true,
        ]);

        $complaint = Complaint::create([
            'complaint_number' => 'ADU-202610-00001',
            'complaint_category_id' => $complaintCategory->id,
            'reporter_name' => 'Joko',
            'reporter_phone' => '081333444555',
            'location_detail' => 'Dekat pasar',
            'village_id' => $village->id,
            'description' => 'Ditemukan lansia sebatang kara',
            'reported_at' => now(),
            'status' => ComplaintStatus::Received,
        ]);

        $attachment = ComplaintAttachment::create([
            'complaint_id' => $complaint->id,
            'file_path' => 'photos/evidence.jpg',
            'type' => ComplaintAttachmentType::Photo,
        ]);

        $this->assertEquals(ComplaintAttachmentType::Photo, $attachment->type);

        $case = RehabilitationCase::create([
            'case_number' => 'RHS-202610-00001',
            'client_id' => $client->id,
            'complaint_id' => $complaint->id,
            'officer_id' => $officer->id,
            'handling_type' => HandlingType::Both,
            'status' => RehabilitationCaseStatus::Received,
            'received_at' => now(),
        ]);

        $this->assertEquals(RehabilitationCaseStatus::Received, $case->status);

        $assessment = Assessment::create([
            'rehabilitation_case_id' => $case->id,
            'officer_id' => $officer->id,
            'assessment_date' => now(),
            'result' => 'Lansia memerlukan perawatan panti',
            'service_needs' => 'Kebutuhan tempat tinggal dan perawatan',
            'recommendation' => 'Rujuk ke panti lansia',
            'needs_referral' => true,
        ]);

        $this->assertTrue($assessment->needs_referral);

        $institution = ReferralInstitution::create([
            'name' => 'Panti Sosial Tresna Werdha',
            'type' => 'Panti',
            'address' => 'Blitar',
            'contact' => '0342-123456',
            'is_active' => true,
        ]);

        $referral = Referral::create([
            'referral_number' => 'RJK-202610-00001',
            'rehabilitation_case_id' => $case->id,
            'assessment_id' => $assessment->id,
            'referral_institution_id' => $institution->id,
            'officer_id' => $officer->id,
            'referral_date' => now(),
            'status' => ReferralStatus::Draft,
        ]);

        $this->assertEquals(ReferralStatus::Draft, $referral->status);

        $monitoring = MonitoringRecord::create([
            'rehabilitation_case_id' => $case->id,
            'referral_id' => $referral->id,
            'officer_id' => $officer->id,
            'monitoring_date' => now(),
            'progress' => 'Kondisi klien membaik di panti',
            'result_notes' => 'Adaptasi lancar',
        ]);

        $this->assertEquals($case->id, $monitoring->rehabilitationCase->id);

        $page = InformationPage::create([
            'title' => 'Panduan DTSEN',
            'slug' => 'panduan-dtsen',
            'category' => InformationCategory::Program,
            'service_type_id' => $serviceType->id,
            'description' => 'Informasi lengkap tentang DTSEN',
            'publish_status' => PublishStatus::Published,
            'published_at' => now(),
            'manager_id' => $officer->id,
        ]);

        $form = DownloadableForm::create([
            'information_page_id' => $page->id,
            'name' => 'Formulir Permohonan',
            'file_path' => 'forms/form-dtsen.pdf',
            'version' => '1.0',
            'is_current' => true,
        ]);

        $faq = Faq::create([
            'information_page_id' => $page->id,
            'question' => 'Berapa lama prosesnya?',
            'answer' => 'Maksimal 1 hari kerja',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $visit = PageVisit::create([
            'information_page_id' => $page->id,
            'visit_date' => now(),
            'visit_count' => 10,
        ]);

        $this->assertEquals(10, $visit->visit_count);

        $searchLog = SearchLog::create([
            'keyword' => 'DTSEN',
            'result_count' => 5,
            'searched_at' => now(),
        ]);

        $this->assertEquals('DTSEN', $searchLog->keyword);

        $statusHistory = StatusHistory::create([
            'statusable_type' => ServiceRequest::class,
            'statusable_id' => $serviceRequest->id,
            'from_status' => null,
            'to_status' => ServiceRequestStatus::Submitted->value,
            'notes' => 'Pengajuan baru masuk',
            'user_id' => $officer->id,
        ]);

        $this->assertEquals(1, $serviceRequest->statusHistories()->count());

        $disposition = Disposition::create([
            'dispositionable_type' => ServiceRequest::class,
            'dispositionable_id' => $serviceRequest->id,
            'from_user_id' => $officer->id,
            'to_work_unit_id' => $workUnit->id,
            'instructions' => 'Mohon segera diverifikasi berkasnya',
            'disposed_at' => now(),
        ]);

        $this->assertEquals(1, $serviceRequest->dispositions()->count());

        $sequence = NumberSequence::create([
            'prefix' => 'DTSEN',
            'period' => '202610',
            'last_number' => 1,
        ]);

        $this->assertEquals(1, $sequence->last_number);

        $activity = ActivityLog::create([
            'log_name' => 'service_requests',
            'description' => 'Membuat tiket DTSEN baru',
            'subject_type' => ServiceRequest::class,
            'subject_id' => $serviceRequest->id,
            'event' => 'created',
            'causer_type' => User::class,
            'causer_id' => $officer->id,
            'properties' => ['ip' => '127.0.0.1'],
        ]);

        $this->assertEquals('service_requests', $activity->log_name);
        $this->assertIsArray($activity->properties);
    }
}
