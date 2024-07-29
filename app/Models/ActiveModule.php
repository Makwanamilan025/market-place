<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveModule extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'status', 'user_id']; 

    protected $castes = [ 'status' => 'boolean'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
