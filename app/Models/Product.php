<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserstamps;
use App\Traits\HasUserstamps;
use App\Traits\LogsModelHistory;


class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_name',
        'product_type',
        'product_brand',
        'image'
    ];

    protected $primaryKey = 'product_id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'product_id',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    use HasUserstamps, LogsModelHistory, TracksUserstamps;
}
