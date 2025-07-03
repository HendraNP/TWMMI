<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait TracksUserstamps
{
    public static function bootTracksUserstamps()
    {
        // This trait automatically sets the created_by and updated_by fields
        // to the ID of the currently authenticated user when a model is created or updated.
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }
}
