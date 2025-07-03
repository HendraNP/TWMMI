<?php

namespace App\Traits;

use App\Models\User;

trait HasUserstamps
{
    // Trait used to get user that created or updated the model
    // This trait assumes that the model has 'created_by' and 'updated_by' fields
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}