<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserstamps;
use App\Traits\TracksUserstamps;
use App\Traits\LogsModelHistory;


class Colour extends Model
{
    protected $fillable = [
        'id',
        'colour_name',
        'english_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        ];
    }

    protected function getColourName(): string
    {
        return $this->colour_name.' '.$this->mandarin_name;
    }

    use HasUserstamps, LogsModelHistory, TracksUserstamps;
}
