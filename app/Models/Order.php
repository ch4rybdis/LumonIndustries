<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $fillable = ['order_date'];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }


}
