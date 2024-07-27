<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'amount',
        'status',
    ];

     // Define the relationship to the User model
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Define the relationship to the Store model
     public function stores()
     {
         return $this->belongsTo(Stores::class);
     }
}
