<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;
    protected $table = 'orders_items';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'order_id', 'product_id', 'quantity', 'price'];
    
    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }   
    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}