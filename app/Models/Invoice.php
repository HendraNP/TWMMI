<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceDetail;
use App\Traits\TracksUserstamps;
use App\Traits\HasUserstamps;
use App\Traits\LogsModelHistory;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;


class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'payment_term',
        'po_number',
        'customer_id',
        'shipping_date',
        'dpp',
        'ppn',
        'grand_total',
        'total_in_words',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'shipping_date' => 'date',
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function salesperson()
    {
        return $this->belongsTo(User::class, 'salesperson_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    use HasUserstamps, LogsModelHistory, TracksUserstamps;
}
