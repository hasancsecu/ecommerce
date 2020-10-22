<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Auth;

class ProductController extends Controller
{
    public function productView($id, $product_name){
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->select('products.*','categories.category_name')
        ->where('products.id',$id)->first();

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $userId = Auth::id();
        $check = DB::table('recent_view')->where('user_id', $userId)->where('product_id',$id)->first();
        $data = array(
            'user_id' => $userId,
            'product_id' => $id
        );

            if($check){
                
            }else{
                if($userId){
                    DB::table('recent_view')->insert($data);  
                }else{
                    //Do Nothing
                }    
            }
        
   
        return view('pages.product_details',compact('product','product_size'));

    }

    public function addCart(Request $request, $id){
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();
    if($product->discount_price == NULL){
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = $request->qty;
        $data['price'] = $product->selling_price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['size'] = $product->product_size;
        Cart::add($data);
        $notification=array(
            'messege'=>'Product Successfully Added to Cart!',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    
    }else{
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = $request->qty;
        $data['price'] = $product->discount_price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['size'] = $product->product_size;
        Cart::add($data);
        $notification=array(
            'messege'=>'Product Successfully Added to Cart!',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);

       
    }
    }

    public function ProductsView(){
        $products = DB::table('products')->paginate(15);
        $categories = DB::table('categories')->get();
       

        return view('pages/all_product', compact('products','categories'));
    }

    public function CategoryView($id){
        $products = DB::table('products')->where('category_id', $id)->paginate(15);
        $allproduct = DB::table('products')->where('category_id', $id)->get();
        $categories = DB::table('categories')->get();

        $cat_product = DB::table('products')
        ->join('categories','products.category_id','categories.id')       
        ->select('products.*', 'categories.category_name')
        ->where('products.category_id', $id)
        ->first();

        return view('pages/all_category_product', compact('products','categories','cat_product','allproduct'));
    }

    public function storeRating(Request $request, $id){
        $userId = Auth::id();
        $data = array();
        $data['user_id'] = $userId;
        $data['product_id'] = $id;
        $data['rate'] = $request->rate;
        $data['review'] = $request->review;
        DB::table('review')->where('user-id', $userId)->where('product_id', $id)->insert($data);
        $notification=array(
            'messege'=>'Your rating & review successfully submited! Thank you for your feedback',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }
        
}
