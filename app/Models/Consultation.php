<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'user_id',
        'pharmacien_id',
        'message',
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pharmacien()
    {
        return $this->belongsTo(User::class, 'pharmacien_id');
    }
}