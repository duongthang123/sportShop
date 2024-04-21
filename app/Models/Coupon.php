<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'expery_date'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function firtWithExperyDate($name, $userId)
    {
        return $this->whereName($name)->whereDoesntHave('users', fn ($q) => $q->where('users.id', $userId))
            ->whereDate('expery_date', '>=', Carbon::now())->first();
    }
}
