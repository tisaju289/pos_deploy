<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function ProductPage(){
        return view('pages.dashboard.product-page');
    }

    public function ProductList(Request $request){
        $user_id = $request->header('id');
        return Product::where('user_id', $user_id)->get();
    }

    public function ProductCreate(Request $request){
        $user_id = $request->header('id');
            // Prepare File Name & Path
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";
    
    
            // Upload File
            $img->move(public_path('uploads'),$img_name);
    
        return Product::create([
            'user_id' => $user_id,
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'cost_price' => $request->input('cost_price'),
            'unit' => $request->input('unit'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'status' => $request->input('status'),
            'date_added' => $request->input('date_added'),
            'expiry_date' => $request->input('expiry_date'),
            'img_url'=>$img_url,
        ]);
    }

    public function DeleteProduct(Request $request){
        $product_id = $request->input('id');
        $user_id = $request->header('id');
        return Product::where('id', $product_id)->where('user_id', $user_id)->delete();
    }

    public function ProductByID(Request $request){
        $product_id = $request->input('id');
        $user_id = $request->header('id');
        return Product::where('id', $product_id)->where('user_id', $user_id)->first();
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->input('id');
        $user_id = $request->header('id');
        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";
            $img->move(public_path('uploads'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

        return Product::where('id', $product_id)->where('user_id', $user_id)->update([
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'cost_price' => $request->input('cost_price'),
            'unit' => $request->input('unit'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'status' => $request->input('status'),
            'date_added' => $request->input('date_added'),
            'expiry_date' => $request->input('expiry_date'),
            'img_url'=>$img_url,
        ]);
    }
    else {
        return Product::where('id',$product_id)->where('user_id',$user_id)->update([
           'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'cost_price' => $request->input('cost_price'),
            'unit' => $request->input('unit'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'status' => $request->input('status'),
            'date_added' => $request->input('date_added'),
            'expiry_date' => $request->input('expiry_date'),
            ]);
        }
    }




}