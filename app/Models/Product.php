<?php

namespace App\Models;

use App\Traits\HandleUploadImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HandleUploadImageTrait;

    protected $fillable = [
        'name',
        'description',
        'sale',
        'price',
        'quantity_sell',
        'active',
    ];

    public function details()
    {
        return $this->hasMany(ProductDetails::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function assignCategory($categoryIds)
    {
        return $this->categories()->sync($categoryIds);
    }

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

    public function scopeSearch($query)
    {
        $key = request()->key;
        $category = request()->category;

        return $query->when($key, function ($query, $input) {
            return $query->where('name', 'like', "%{$input}%");
        })->when($category, function ($query, $categoryId) {
            return $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        });
    }


}
