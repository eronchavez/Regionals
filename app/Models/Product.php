<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
     public $timestamps = false;

     protected $fillable = [
         'name',
         'french_name',
         'description',
         'french_description',
         'gtin',
         'brand',
         'category_id',
         'country',
         'image',
         'company_id',
         'gross_weight',
         'net_weight',
         'weight_unit',
         'hidden'
     ];

     public function company()
     {
        return $this->belongsTo(Company::class);
     }

     public function category()
     {
        return $this->belongsTo(Category::class);
     }

     public function reviews()
     {
         return $this->hasMany(Review::class);
     }
}
