<?php

namespace App\Http\Controllers;
use Auth;
use DB;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addWishlist($id){
        $userId = Auth::id();
        $check = DB::table('wishlist')->where('user_id', $userId)->where('product_id',$id)->first();
        $data = array(
            'user_id' => $userId,
            'product_id' => $id
        );

        if(Auth::check()) {
            if($check){
                DB::table('wishlist')->where('user_id', $userId)->where('product_id',$id)->delete();
                $row = DB::table('wishlist')->where('user_id',$userId)->get();
                $count = count($row);
                return \Response::json(['error'=> 'Product Successfully Removed From Your Wishlist!',
                'count' => $count]);
            }else{
                DB::table('wishlist')->insert($data);
                $row = DB::table('wishlist')->where('user_id',$userId)->get();
                $count = count($row);
                return \Response::json(['success'=> 'Product Successfully Added to Your Wishlist!',
            'count' => $count]);
            }
        }else{
            return \Response::json(['error'=> 'Please Login First!']);
        }
    }

    public function removeWishlist($id){
      
        DB::table('wishlist')->where('product_id',$id)->delete();
      
         $notification=array(
            'messege'=>'Product Successfully Removed from Wishlist!',
            'alert-type'=>'success'
             );
        return Redirect()->back()->with($notification);
    }
}
