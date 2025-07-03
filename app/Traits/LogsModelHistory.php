<?php

namespace App\Traits;

use App\Models\ModelHistory;
use Illuminate\Support\Facades\Auth;

trait LogsModelHistory
{
    public static function bootLogsModelHistory()
    {
        static::created(function ($model) {
            ModelHistory::create([
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'event' => 'created',
                'changes'        => 'Newly Created', // new values
                'before_changes' => '', // null values since theres no previous record
                'user_id' => Auth::id(),
            ]);
        });

        static::updated(function ($model) {
            $original = $model->getOriginal();
            $changes = $model->getChanges();
            ModelHistory::create([
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'event' => 'updated',
                'changes'        => $model->getChanges(), // new values
                'before_changes' => collect($original)->only(array_keys($changes)), // old values
                'user_id' => Auth::id(),
            ]);
        });
    }

    public function histories()
    {
        return $this->hasMany(ModelHistory::class, 'model_id')
            ->where('model_type', get_class($this))
            ->latest();
    }
}
