<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Favorites ❤️
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // Subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}