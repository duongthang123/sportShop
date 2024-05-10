<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'total',
        'status_payment',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'note',
        'payment',
        'user_id'
    ];

    public function products()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function scopeSearch($query)
    {
        $key = request()->key;

        return $query->when($key, function ($query, $input) {
            return $query->where(function($query) use ($input) {
                $query->where('id', '=', $input)
                    ->orWhere('customer_email', 'like', "%{$input}%");
            });
        });
    }
}
