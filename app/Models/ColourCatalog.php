<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColourCatalog extends Model
{
    protected $fillable = [
        'colour_name',
        'colour_code',
        'hex_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
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
}
