<?php

namespace App\Traits;

use App\Models\StatusHistory;
use Illuminate\Support\Facades\Auth;

trait RecordsStatusHistory
{
    public function recordStatusChange(string $newStatus, ?string $notes = null, ?int $userId = null): StatusHistory
    {
        $oldStatus = $this->status instanceof \BackedEnum ? $this->status->value : (string) $this->status;

        $history = $this->statusHistories()->create([
            'from_status' => $oldStatus,
            'to_status' => $newStatus,
            'notes' => $notes,
            'user_id' => $userId ?? Auth::id(),
        ]);

        $this->update(['status' => $newStatus]);

        return $history;
    }
}
