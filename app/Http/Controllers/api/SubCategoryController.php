<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Resources\BlokResource;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data = SubCategory::with('villa')->get();

        return response()->json([
			'status'=> true,
			'message' => 'Menampilkan data', 
			'data' => BlokResource::collection($data)
		]);
    }

    public function store(StoreSubCategory $request)
    {
        $data = SubCategory::create([
            'title' => $request->title,
        ]);

        return response()->json($data);
    }

    public function show($id)
    {
        try {
            $data = SubCategory::where('id', $id)
                ->firstOrFail();

            return response()->json($data);
        } catch (ModelNotFoundException $e) {

            $data = [];

            return response()->json($data);
        }
    }

    public function update(UpdateSubCategory $request, SubCategory $subCategory)
    {
        SubCategory::where('id', $subCategory->id)->update([
            'title' => $request->title,
        ]);

        $data = SubCategory::find($subCategory->id);

        return response()->json($data);
    }

    public function destroy(SubCategory $subCategory)
    {
        SubCategory::destroy($subCategory->id);
        $data = [
            'message' => 'Berhasil Menghapus',
            'status' => 'success',
        ];

        return response()->json($data);
    }
}
