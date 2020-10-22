<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Response;
use Auth;
use Session;

class CartController extends Controller
{
    public function addCart($id){
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();
        
    if($product->discount_price == NULL){
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = 1;
        $data['price'] = $product->selling_price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        Cart::add($data);
        $total = Cart::subtotal();
        $count = Cart::count();
        return \Response::json(['success'=> 'Product Successfully Added to Cart!',
        'total' => $total, 'count' => $count]);
    }else{
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = 1;
        $data['price'] = $product->discount_price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        Cart::add($data);
        $total = Cart::subtotal();
        $count = Cart::count();
        return \Response::json(['success'=> 'Product Successfully Added to Cart!',
        'total' => $total, 'count' => $count]);
    }

    }
    public function check(){
        $content = Cart::content();
        return response()->json($content);
    }

    public function showCart(){
        $cart = Cart::content();
        return view('pages/cart',compact('cart'));
    }

    public function removeCart($rowId){
        Cart::remove($rowId);
         $notification=array(
            'messege'=>'Product Successfully Removed from Cart!',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }
    public function updateCart(Request $request){
        $rowId = $request->product_id;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        $notification=array(
            'messege'=>'Product Quantity Successfully Updated!',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }

    
    public function ViewProduct($id){
    	$product = DB::table('products')
    			->join('categories','products.category_id','categories.id')		
    			->select('products.*','categories.category_name')
    			->where('products.id',$id)
    			->first();

    	
    	$size = $product->product_size;
    	$product_size = explode(',', $size);	

        return response::json(array(
            'product' => $product,
            'size' => $product_size,
        ));

    }


   public function insertCart(Request $request){
   	$id = $request->product_id;
    $product = DB::table('products')->where('id',$id)->first();
    $size = $request->size;
    $qty = $request->qty;

  $data = array();
 
 if ($product->discount_price == NULL) {
 	$data['id'] = $product->id;
 	$data['name'] = $product->product_name;
 	$data['qty'] = $request->qty;
 	$data['price'] = $product->selling_price;
 	$data['weight'] = 1;
 	$data['options']['image'] = $product->image_one;
 	 Cart::add($data);
 	 $notification=array(
        'messege'=>'Product Successfully Added to Cart',
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
 	 Cart::add($data);
 	 $notification=array(
        'messege'=>'Product Successfully Added to Cart',
        'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);

    } 

   } 

   public function checkout(){
       if(Auth::check()) {
        $cart = Cart::content();
        return view('pages/checkout',compact('cart'));
       }else{
        $notification=array(
        'messege'=>'Please Login First!',
        'alert-type'=>'error'
        );
        return Redirect()->route('login')->with($notification);
       }
   }

   
   public function wishlist(){
    $userid = Auth::id();
    $product = DB::table('wishlist')
            ->join('products','wishlist.product_id','products.id')
            ->select('products.*','wishlist.user_id')
            ->where('wishlist.user_id',$userid)
            ->get();
           // return response()->json($product);
            return view('pages.wishlist',compact('product'));
  
    }

    public function Coupon(Request $request){
        $coupon = $request->coupon_code;
 
     $check = DB::table('coupons')->where('coupon_code',$coupon)->first();
     if ($check) {
     Session::put('coupon_code',[
     'name' => $check->coupon_code,
     'discount' => $check->discount,
     'balance' => Cart::Subtotal()-$check->discount 
     ]);
         $notification=array(
                         'messege'=>'Coupon Successfully Applied!',
                         'alert-type'=>'success'
                          );
                        return Redirect()->back()->with($notification);
 
 
     }else{
         $notification=array(
                         'messege'=>'Invalid Coupon!',
                         'alert-type'=>'error'
                          );
                        return Redirect()->back()->with($notification);
     }
 
    }
 
 
  public function CouponRemove(){
      Session::forget('coupon_code');
      $notification=array(
                         'messege'=>'Coupon Removed Successfully',
                         'alert-type'=>'success'
                          );
                        return Redirect()->back()->with($notification);
 
  }
 
 
  public function Search(Request $request){
  
   $item = $request->search;
   // echo "$item";
 
   $products = DB::table('products')
             ->where('product_name','LIKE',"%$item%")->get();
    $categories = DB::table('categories')->get();
     
     return view('pages/search',compact('products','categories'));        
 
 
  }


}
