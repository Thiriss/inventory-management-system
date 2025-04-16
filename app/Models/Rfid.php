<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $fillable = ['rfid'];

    /**
     * Get the product instance associated with this RFID tag.
     */
    public function instance()
    {
        return $this->hasOne(ProductInstance::class);
    }
}
