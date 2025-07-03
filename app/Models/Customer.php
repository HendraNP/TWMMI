<?php

namespace App\Models;

use App\Traits\HasUserstamps;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserstamps;
use App\Traits\LogsModelHistory;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_no',
        'customer_name',
        'office_address',
        'delivery_address',
        'sales_id',
        'pic', // Person in Charge
        'telp_no',
        'email',
        'npwp', // NPWP 16-digit Indonesian Tax ID
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
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

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    use HasUserstamps, LogsModelHistory, TracksUserstamps;

}
