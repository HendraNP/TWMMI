<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductionJob extends Model
{
    protected $fillable = [
        'invoice_detail_id',
        'colour_product_id',
        'quantity',
        'status',
        'batch_code',
        'started_at',
        'completed_at',
        'notes',
    ];

    public function invoiceDetail()
    {
        return $this->belongsTo(InvoiceDetail::class);
    }

    public function colourProduct()
    {
        return $this->belongsTo(ColourProduct::class);
    }

    public function finalizedBy()
    {
        return $this->belongsTo(User::class, 'finalized_by');
    }

    //auto generate production job whenever invoice is created
    protected static function booted()
    {
        static::creating(function ($job) {
            if (empty($job->batch_code)) {
                $prefix = 'BATCH-' . now()->format('ymd');
                $job->batch_code = $prefix . '-' . strtoupper(Str::random(4));
            }
        });
    }

}

