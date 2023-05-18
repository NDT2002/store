<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'price', 'category_id','quantity','image_url'];
    public function category()
    {
        return $this->belongsTo(Categorie::class);
        //belongsto nhiều sản phẩm đều thuộc 1 nhóm hàng
    }
}
