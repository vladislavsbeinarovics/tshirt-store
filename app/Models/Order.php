<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'guest_token',
        'name',
        'email',
        'phone',
        'address',
        'postal_code',
        'payment_method',
        'cart_total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'guest_token' => 'string',
    ];
}
