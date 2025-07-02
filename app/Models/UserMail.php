<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_name',
        'product_code',
        'image',
        'flag',
        'reply',
        'replied_by',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    public function repliedBy()
{
    return $this->belongsTo(User::class, 'replied_by');
}
}
