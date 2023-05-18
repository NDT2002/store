<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_name', 'customer_email', 'customer_phone', 'order_date','total_price','order_type'];
    public function Order_item()
    {
        return $this->hasMany(Order_item::class,'order_id','id');
        // 1 nhóm hàng có thể có nhiều sản phẩm hasMany
    }
}
