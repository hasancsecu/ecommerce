<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function NewOrder(){
        $order = DB::table('orders')->where('status',0)->get();
        return view('admin.order.pending', compact('order'));
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

        return view('admin.order.view_order', compact('order','shipping','details'));
    }

    public function PaymentAccept($id){
        DB::table('orders')->where('id',$id)->update(['status'=>1]);
        $notification=array(
            'messege'=>'Payment Accepted!',
            'alert-type'=>'success'
             );
           return Redirect()->route('admin.order.accept')->with($notification);
    }
 
    public function CancelOrder($id){
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        $notification=array(
            'messege'=>'Order Cancelled!',
            'alert-type'=>'success'
             );
           return Redirect()->route('admin.order.cancel')->with($notification);
    }

    public function ProcessOrder($id){
        DB::table('orders')->where('id',$id)->update(['status'=>2]);
        $notification=array(
            'messege'=>'Order is now on Processing!',
            'alert-type'=>'success'
             );
           return Redirect()->route('admin.order.progress')->with($notification);
    }

    public function DeliveryOrder($id){
        $product = DB::table('order_details')->where('order_id',$id)->get();
        foreach ($product as $row) {
         DB::table('products')
                ->where('id',$row->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);
        }
        DB::table('orders')->where('id',$id)->update(['status'=>3]);
        $notification=array(
            'messege'=>'Product Successfully Delivered!',
            'alert-type'=>'success'
             );
           return Redirect()->route('admin.order.delivered')->with($notification);
    }

    public function AcceptPayment(){
        $order = DB::table('orders')->where('status', 1)->get();
        return view('admin.order.pending', compact('order'));
    }
    public function OrderCancel(){
        $order = DB::table('orders')->where('status', 4)->get();
        return view('admin.order.pending', compact('order'));
    }
    public function OrderProgress(){
        $order = DB::table('orders')->where('status', 2)->get();
        return view('admin.order.pending', compact('order'));
    }
    public function OrderDelivered(){
        $order = DB::table('orders')->where('status', 3)->get();
        return view('admin.order.pending', compact('order'));
    }

    public function seo(){
        $seo = DB::table('seo')->first();
        return view('admin.seo.seo',compact('seo'));
    }

    public function seoUpdate(Request $request){
      $data = array();
      $data['meta_title'] = $request->meta_title;
      $data['meta_author'] = $request->meta_author;
      $data['meta_tag'] = $request->meta_tag;
      $data['meta_description'] = $request->meta_description;
      $data['google_analytics'] = $request->google_analytics;
      $data['bing_analytics'] = $request->bing_analytics;
      $id = $request->id;

      DB::table('seo')->where('id', $id)->update($data);
      $notification=array(
        'messege'=>'SEO Updated Successfully!',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);

    }
}
