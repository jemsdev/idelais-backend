<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'villa_id', 'fasilitas_id', 'value'
    ];


    public function villa()
    {
        return $this->belongsTo('App\Models\Villa');
    }

    public function fasilitas()
    {
        return $this->belongsTo('App\Models\Fasilitas');
    }

}
