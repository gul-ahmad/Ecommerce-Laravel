<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table ="categories";
    //below function name is plural as we know that a category can have many products
    //so following laravel convention for the naming here and its plural as products
    //gul here
    public function products()
    {
    
        return $this->hasMany(Product::class,'category_id');



    }
}



