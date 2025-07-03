<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHistory extends Model
{
    // This model tracks changes to other models, storing the type, ID, event (created/updated), changes made, and the user who made the change
    protected $fillable = [
        'model_type',
        'model_id',
        'event',
        'changes',
        'user_id',
    ];

    protected $casts = [
        'changes' => 'array',
        'before_changes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
