<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'phone',
        'currency',
        'multi_location_enabled',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
