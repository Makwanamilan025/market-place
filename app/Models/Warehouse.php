<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'phone',
        'location_tag',
    ];

    public function store()
    {
        return $this->belongsTo(Stores::class);
    }

}
