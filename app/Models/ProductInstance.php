<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInstance extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'rfid_tag_id', 'status', 'location'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function tag() {
        return $this->belongsTo(Rfid::class, 'rfid_tag_id');
    }
    
}

