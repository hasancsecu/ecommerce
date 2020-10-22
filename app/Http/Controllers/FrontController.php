<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{
   public function storeNewslater(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:100'
        ]);
        $data = array();
        $data['email'] = $request->email;
        DB::table('newslaters')->insert($data);
        $notification=array(
            'messege'=>'Thnaks for Subscribing!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

   }

   public function ViewOrder($id){
    $order = DB::table('orders')
    ->join('users', 'orders.user_id','users.id')
    ->select('orders.*','users.name','users.phone')
    ->where('orders.id',$id)
    ->first();

    $shipping = DB::table('shipping')->where('order_id', $id)->first();

    $details = DB::table('order_details')
    ->join('products', 'order_details.product_id','products.id')
    ->select('order_details.*','products.image_one','products.product_code','products.product_name')
    ->where('order_details.order_id',$id)
    ->get();

    return view('pages.view_order', compact('order','shipping','details'));
   }
}
