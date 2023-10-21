<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['product_id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
