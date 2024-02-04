<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon', 'title'
    ];


    public function villaFacility()
    {
        return $this->hasMany('App\Models\VillaFacility');
    }

}
