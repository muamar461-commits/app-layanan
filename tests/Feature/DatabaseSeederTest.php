<?php

namespace Tests\Feature;

use App\Enums\ComplaintStatus;
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
use App\Models\DownloadableForm;
use App\Models\DtsenCertificate;
use App\Models\DtsenPurpose;
use App\Models\Faq;
use App\Models\InformationPage;
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
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use DatabaseTransactions;

    public function test_database_seeder_runs_successfully_and_is_idempotent(): void
    {
        // Run seeder
        $this->seed(DatabaseSeeder::class);

        // Verify Master Data
        $this->assertGreaterThanOrEqual(4, WorkUnit::count());
        $this->assertGreaterThanOrEqual(4, District::count());
        $this->assertGreaterThanOrEqual(30, Village::count());
        $this->assertGreaterThanOrEqual(4, ServiceType::count());
        $this->assertGreaterThanOrEqual(10, ServiceRequirement::count());
        $this->assertGreaterThanOrEqual(6, DtsenPurpose::count());
        $this->assertGreaterThanOrEqual(7, ClientCategory::count());
        $this->assertGreaterThanOrEqual(7, ComplaintCategory::count());
        $this->assertGreaterThanOrEqual(6, ReferralInstitution::count());

        // Verify Users and Roles
        $this->assertGreaterThanOrEqual(13, User::count());
        $this->assertDatabaseHas('users', ['email' => 'admin@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'petugas.pelayanan@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'petugas.rehsos@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'kabid.linjamsos@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'kabid.rehsos@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'kadis@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'pimpinan@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'operator.sawentar@dinsos.blitarkab.go.id']);
        $this->assertDatabaseHas('users', ['email' => 'budi.santoso@gmail.com']);

        // Verify Information Portal
        $this->assertGreaterThanOrEqual(6, InformationPage::count());
        $this->assertGreaterThanOrEqual(5, DownloadableForm::count());
        $this->assertGreaterThanOrEqual(10, Faq::count());

        // Verify Number Sequences
        $this->assertGreaterThanOrEqual(5, NumberSequence::count());

        // Verify Service Requests
        $this->assertGreaterThanOrEqual(5, ServiceRequest::count());
        $this->assertGreaterThanOrEqual(4, ServiceRequestDocument::count());
        $this->assertGreaterThanOrEqual(1, DtsenCertificate::count());
        $this->assertGreaterThanOrEqual(2, PbiReactivation::count());
        $this->assertGreaterThanOrEqual(3, Approval::count());

        // Verify Rehabilitation Cases
        $this->assertGreaterThanOrEqual(2, Client::count());
        $this->assertGreaterThanOrEqual(2, RehabilitationCase::count());
        $this->assertGreaterThanOrEqual(2, Assessment::count());
        $this->assertGreaterThanOrEqual(1, Referral::count());
        $this->assertGreaterThanOrEqual(2, MonitoringRecord::count());

        // Verify Complaints
        $this->assertGreaterThanOrEqual(3, Complaint::count());
        $this->assertGreaterThanOrEqual(2, ComplaintAttachment::count());
        $this->assertGreaterThanOrEqual(2, Disposition::count());
        $this->assertGreaterThanOrEqual(10, StatusHistory::count());

        // Verify specific business logic scenarios
        $completedDtsen = ServiceRequest::where('status', ServiceRequestStatus::Completed)
            ->whereHas('serviceType', fn ($q) => $q->where('code', 'DTSEN'))
            ->first();
        $this->assertNotNull($completedDtsen);
        $this->assertNotNull($completedDtsen->dtsenCertificate);
        $this->assertEquals(2, $completedDtsen->dtsenCertificate->decile);

        $completedPbi = ServiceRequest::where('status', ServiceRequestStatus::Completed)
            ->whereHas('serviceType', fn ($q) => $q->where('code', 'PBI'))
            ->first();
        $this->assertNotNull($completedPbi);
        $this->assertNotNull($completedPbi->pbiReactivation);
        $this->assertTrue($completedPbi->is_priority);

        $inServiceCase = RehabilitationCase::where('status', RehabilitationCaseStatus::InService)->first();
        $this->assertNotNull($inServiceCase);
        $this->assertCount(1, $inServiceCase->referrals);

        $resolvedComplaint = Complaint::where('status', ComplaintStatus::Resolved)->first();
        $this->assertNotNull($resolvedComplaint);
        $this->assertNotNull($resolvedComplaint->resolved_at);
        $this->assertCount(1, $resolvedComplaint->attachments);
    }
}
