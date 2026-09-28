<?php

namespace App\Console\Commands;

use App\Models\PbiReactivation;
use App\Models\ServiceRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckStalledTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sapa:check-stalled-tickets {--days=30 : Threshold hari tiket tertahan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memeriksa dan menandai tiket pengajuan yang melebihi batas waktu penanganan (SLA)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = (int) $this->option('days');
        $this->info("Memeriksa tiket yang tertahan lebih dari {$days} hari...");

        // 1. Check PBI-JK in Kemensos
        $stalledPbi = PbiReactivation::whereNotNull('proposed_to_ministry_at')
            ->whereNull('ministry_decided_at')
            ->where('proposed_to_ministry_at', '<', now()->subDays($days))
            ->get();

        $this->info("Ditemukan {$stalledPbi->count()} pengajuan PBI-JK tertahan di Kemensos.");

        foreach ($stalledPbi as $pbi) {
            Log::warning("Pengajuan PBI-JK tertahan di Kemensos: ID {$pbi->id}, Peserta: {$pbi->participant_name}");
        }

        // 2. Check Service Requests waiting for document check > 7 days
        $stalledRequests = ServiceRequest::where('status', 'submitted')
            ->where('submitted_at', '<', now()->subDays(7))
            ->get();

        $this->info("Ditemukan {$stalledRequests->count()} pengajuan baru belum diverifikasi lebih dari 7 hari.");

        foreach ($stalledRequests as $req) {
            Log::warning("Tiket pengajuan belum diperiksa: {$req->request_number}, Pemohon: {$req->applicant_name}");
        }

        $this->info('Pemeriksaan tiket selesai.');

        return Command::SUCCESS;
    }
}
