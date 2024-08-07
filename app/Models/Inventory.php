<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'Inventory';
    protected $fillable = ['stock'];
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
