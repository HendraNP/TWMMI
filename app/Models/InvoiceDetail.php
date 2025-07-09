<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'colour_product_id',
        'quantity',
        'unit',
        'price',
        'discount',
        'sj_number'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function colourProduct()
    {
        return $this->belongsTo(ColourProduct::class);
    }

    public function productionJob()
    {
        return $this->hasOne(ProductionJob::class);
    }

    protected static function booted()
    {
        static::created(function ($detail) {
            if (!$detail->productionJob) {
                \App\Models\ProductionJob::create([
                    'invoice_detail_id' => $detail->id,
                    'colour_product_id' => $detail->colour_product_id,
                    'quantity' => $detail->quantity,
                    'status' => 'waiting',
                ]);
            }
        });
    }

}
