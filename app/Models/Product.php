<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    public function image()
{
    return $this->belongsTo(Image::class, 'image_id', 'image_id');
}
public function inventory()
{
    return $this->hasOne(Inventory::class, 'product_id', 'product_id');
}

}
