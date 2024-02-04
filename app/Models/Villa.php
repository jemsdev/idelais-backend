<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'thumbnail',
        'description',
        'whatsapp_number',
        'price',
        'code',
        'is_recommendation',
        'alamat'
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
