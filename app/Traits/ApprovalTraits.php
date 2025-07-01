<?php

namespace App\Traits;
use App\Models\admin\Module;
trait ApprovalTraits {
    //Check Approval
    public function scopePending($query)
    {
        return $query->where('txtstatus', 2);
    }

    public function approve()
    {
        $this->txtstatus = 3;
        $this->save();
    }

    public function reject($reason = null)
    {
        $this->txtstatus = 'rejected';
        if (property_exists($this, 'rejection_reason')) {
            $this->rejection_reason = $reason;
        }
        $this->save();
    }

}