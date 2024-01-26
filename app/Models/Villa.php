<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'sub_category_value',
        'thumbnail',
        'description',
        'whatsapp_number',
        'sub_district',
        'price',
        'code',
        'is_recommendation'
    ];

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }

    public function villaGalleries()
    {
        return $this->hasMany('App\Models\VillaGallery');
    }

}
