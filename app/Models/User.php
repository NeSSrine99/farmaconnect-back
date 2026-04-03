<?php



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    // علاقة مع Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    // Consultations (client)
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    // Consultations (pharmacien)
    public function pharmacienConsultations()
    {
        return $this->hasMany(Consultation::class, 'pharmacien_id');
    }

    // Favorites ❤️
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    // Subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}