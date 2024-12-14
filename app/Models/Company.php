<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name', 
        'company_address', 
        'representative_name',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}

