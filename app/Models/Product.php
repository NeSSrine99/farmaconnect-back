<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price',
        'discount',
        'stock',
        'category_id',
        'availability',
        'isNew',
        'requiresPrescription', // ✅ keep as is (your DB column)
        'description',
        'image'
    ];

    protected $casts = [
        'images' => 'array',
        'requiresPrescription' => 'boolean', // ✅ IMPORTANT FIX
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
