<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'user_id',
        'file',
        'status',
        'reviewed_by'
    ];

    // Client
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pharmacien
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}