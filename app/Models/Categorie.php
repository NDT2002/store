<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'Categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
        // 1 nhóm hàng có thể có nhiều sản phẩm hasMany
    }
}
