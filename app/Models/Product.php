<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = 
   [
       'user_id',
       'category_id',
       'brand_id',
       'name',
       'description',
       'price',
       'cost_price',
       'unit',
       'color',
       'size',
       'status',
       'date_added',
       'expiry_date',
       'img_url',
       

   ] ;

   public function categories()
   {
       return $this->belongsTo(Category::class, 'category_id');
   }

   public function brands()
   {
       return $this->belongsTo(Brand::class, 'brand_id');
   }
}
