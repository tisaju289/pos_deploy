<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function BrandPage(){
        return view('pages.dashboard.brand-page');
    }

    function BrandList(Request $request){
        $user_id = $request->header('id');
        return Brand::where('user_id', $user_id)->get();
    }

    public function BrandCreate(Request $request){
        $user_id = $request->header('id');
        return Brand::create([
            'name' => $request->input('name'),
            'user_id' => $user_id
        ]);
    }

    public function BrandDelete(Request $request){
        $brand_id = $request->input('id');
        $user_id = $request->header('id');
        return Brand::where('id', $brand_id)->where('user_id', $user_id)->delete();
    }

    function BrandByID(Request $request){
        $brand_id = $request->input('id');
        $user_id = $request->header('id');
        return Brand::where('id', $brand_id)->where('user_id', $user_id)->first();
    }

    function BrandUpdate(Request $request){
        $brand_id = $request->input('id');
        $user_id = $request->header('id');
        return Brand::where('id', $brand_id)->where('user_id', $user_id)->update([
            'name' => $request->input('name'),
        ]);
    }
}
