<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\SubCategory;
use App\Models\VillaFacility;
use App\Models\VillaGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\FacilitiesResource;
use App\Http\Resources\GaleriesResource;

class VillaController extends Controller
{
    public function index()
    {
        $data = Villa::with('subCategory')->orderBy('id', 'DESC')->simplePaginate(10);

        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|mimes:jpg,png,doc,docx,pdf,txt,csv|max:2048',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 422);
        }

        if ($file = $request->file('thumbnail')) {
            $path = Storage::putFile('public', $file);
            $name = explode('public/', $path)[1];


            $data = Villa::create([
                'sub_category_id' => $request->sub_category_id,
                'sub_category_value' => $request->sub_category_value,
                'thumbnail' => $name,
                'description' => $request->description,
                'whatsapp_number' => $request->whatsapp_number,
                'sub_district' => $request->sub_district,
                'price' => $request->price,
                'code' => $request->code,
                'is_recommendation' => $request->is_recommendation,
            ]);

            return response()->json($data);
        }
    }
    public function show($id)
    {
        try {
            $data = Villa::where('id', $id)
                ->firstOrFail();

            return response()->json($data);
        } catch (ModelNotFoundException $e) {

            $data = [
                'data' => [],
                'message' => "Data Tidak di temukan",
                'status' => "error",
                'status_code' => 404
            ];

            return response()->json($data);
        }
    }
    public function update(Request $request, Villa $villa)
    {
        if ($request->image_new === null) {
            Villa::where('id', $villa->id)->update([
                'sub_category_id' => $request->sub_category_id,
                'sub_category_value' => $request->sub_category_value,
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'whatsapp_number' => $request->whatsapp_number,
                'sub_district' => $request->sub_district,
                'price' => $request->price,
                'is_recommendation' => $request->is_recommendation,
            ]);
        } else {
            $file = $request->file('image_new');
            $path = Storage::putFile('public', $file);
            $name = explode('public/', $path)[1];

            // delete image 
            Storage::delete('public/'.$villa->thumbnail);

            Villa::where('id', $villa->id)->update([
                'sub_category_id' => $request->sub_category_id,
                'sub_category_value' => $request->sub_category_value,
                'thumbnail' => $name,
                'description' => $request->description,
                'whatsapp_number' => $request->whatsapp_number,
                'sub_district' => $request->sub_district,
                'price' => $request->price,
                'is_recommendation' => $request->is_recommendation,
            ]);
        }

        $data = Villa::find($villa->id);

        return response()->json($data);
    }
    public function destroy(Villa $villa)
    {
        Villa::destroy($villa->id);
        $data = [
            'message' => 'Berhasil Menghapus',
            'status' => 'success',
        ];

        return response()->json($data);
    }

    public function idealis()
    {
        // make with laravel mah bisa buat ambil childrennya
        $data = Villa::with('subCategory', 'villaGalleries')->get();
        // $allProducts = $data->map(function ($data){
        //     return [
        //         'id'            => $data->id,
        //         'title'         => $data->title,
        //         'villa'         => Villa::where("sub_category_id", $data->id)->get()->map(function ($item){
        //                             return[
        //                                 'id' => $item->id,
        //                                 'thumbnail' => $item->thumbnail,
        //                                 'description' => $item->description,
        //                                 'sub_district' => $item->sub_district,
        //                                 'price' => $item->price,
        //                                 'code' => $item->code,
        //                                 'gambar' => VillaGallery::where('villa_id', $item->id)->first(),
        //                                 'facilities' => VillaFacility::where('villa_id', $item->id)->limit(4)->get()
        //                             ];
        //         })                
        //     ];
        // });

        return response()->json($data);
    }

    public function idealisDetail($id)
    {
        $villa = villa::where('id', $id)->get();

        $detailProducts = $villa->map(function ($item) {
            return [
                'id' => $item->id,
                'thumbnail' => $item->thumbnail,
                'description' => $item->description,
                'sub_district' => $item->sub_district,
                'price' => $item->price,
                'code' => $item->code,
                'gambar' => GaleriesResource::collection(VillaGallery::select(['id', 'image'])->where('villa_id', $item->id)->get()),
                'facilities' => FacilitiesResource::collection(VillaFacility::select(['id', 'icon', 'title'])->where('villa_id', $item->id)->get())
            ];
        });

        return response()->json($detailProducts);
    }

    public function idealisRekomendasi()
    {
        $villa = villa::where('is_recommendation', 1)->get();

        $recomendationProducts = $villa->map(function ($item) {
            return [
                'id' => $item->id,
                'thumbnail' => $item->thumbnail,
                'description' => $item->description,
                'sub_district' => $item->sub_district,
                'price' => $item->price,
                'code' => $item->code,
                'gambar' =>  url('storage/images/'.VillaGallery::select(['id', 'image'])->where('villa_id', $item->id)->first()->image),
                'facilities' => FacilitiesResource::collection(VillaFacility::select(['id', 'icon', 'title'])->where('villa_id', $item->id)->limit(4)->get())
            ];
        });

        return response()->json($recomendationProducts);
    }

    public function idealisDetailBlok($id)
    {
        $data = SubCategory::where('id', $id)->get();
        $allProducts = $data->map(function ($data) {
            return [
                'id'            => $data->id,
                'title'         => $data->title,
                'villa'         => Villa::where("sub_category_id", $data->id)->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'thumbnail' => $item->thumbnail,
                        'description' => $item->description,
                        'sub_district' => $item->sub_district,
                        'price' => $item->price,
                        'code' => $item->code,
                        'gambar' => VillaGallery::where('villa_id', $item->id)->first(),
                        'facilities' => VillaFacility::where('villa_id', $item->id)->limit(4)->get()
                    ];
                })
            ];
        });

        return response()->json($allProducts);
    }
}
