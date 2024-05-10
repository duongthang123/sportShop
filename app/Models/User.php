<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\Auth\RegisterController;
use App\Traits\HandleUploadImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HandleUploadImageTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function getImagePathAttribute()
    {
        $imageUrl = $this->images->first();
        if($imageUrl)
        {
            return asset('uploads/'. $imageUrl->url);
        }

        return asset('uploads/default.png');
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    public function scopeSearch($query)
    {
        $key = request()->key;

        return $query->when($key, function ($query, $input) {
            return $query->where(function($query) use ($input) {
                $query->where('id', '=', $input)
                    ->orWhere('name', 'like', "%{$input}%")
                    ->orWhere('email', 'like', "%{$input}%");
            });
        });
    }
}
