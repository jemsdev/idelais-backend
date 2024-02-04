<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\VillaFacility;
use App\Models\VillaGallery;
use App\Models\Fasilitas;

class KatalogController extends Controller
{
    public function index()
    {
        $data = Villa::all();
        $fasilitas = Fasilitas::all();
        return view('katalogs.index', compact(['data', 'fasilitas']));
    }

    public function store(Request $request)
    { 
        // $path = Storage::putFile('public', $file);
        // $name = explode('public/', $path)[1];

        // dd($request->all());

        $gambar = $request->file('gambar');
        $fasilitas_id = $request->get('fasilitas_id');


        $data = Villa::create([
            'sub_category_id' => $request->sub_category_id,
            'sub_category_value' => $request->sub_category_value,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'alamat' => $request->alamat,
            'whatsapp_number' => $request->whatsapp_number,
            'sub_district' => $request->sub_district,
            'price' => $request->price,
            'code' => $request->code,
            'is_recommendation' => $request->is_recommendation,
        ]);

        if ($gambar) {
            foreach ($gambar as $key => $g) {
                $fileName = 'IMG-'.time(). '.' . $g->extension();
                $filePath = $g->storeAs('images', $fileName, 'public'); 
                
                VillaGallery::create([
                    'villa_id' => $data->id,
                    'image' => $fileName
                ]);
            }
        }

        if ($fasilitas_id) {
            foreach ($fasilitas_id as $key => $value) {
                VillaFacility::create([
                    'villa_id' => $data->id,
                    'fasilitas_id' => $value,
                    'value' => $request->get('value')[$key]
                ]);                
            }
        }

        return back()->with('success', 'Berhasil create data');
    }
}
