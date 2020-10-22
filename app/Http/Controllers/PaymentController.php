<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cart;
use Session;
use Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    public function Payment(Request $request){
        $data = array();
       $data['name'] = $request->name;
       $data['phone'] = $request->phone;
       $data['email'] = $request->email;
       $data['address'] = $request->name;
       $data['city'] = $request->city;
       $data['post_code'] = $request->post_code;
       $data['payment'] = $request->payment;
    
       if($request->payment == 'stripe'){
        return view('pages.payment.stripe', compact('data'));
       }elseif($request->payment == 'paypal'){

       }elseif($request->payment == 'ideal'){

       }else{
           echo "Cash On Delivery";
       }

    }

    public function StripeCharge(Request $request){
        $email = Auth::user()->email;
        $total = $request->total;
        \Stripe\Stripe::setApiKey('sk_test_51Fs4FlGv1rAVrFW0TjJPvkIN3CNvyjpVbusvqq14J2F5SxrYgjUtEslsCltaaBJU4NauDt8dnXqsKc13b1vA32S500qATZT8vl');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total*100,
        'currency' => 'bdt',
        'description' => 'Ecommerce Details',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);
        //Insert Order Table
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['transaction'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        if(Session::has('coupon_code')){
            $data['subtotal'] = Session::get('coupon_code')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['payment_type'] = $request->payment_type;
        $data['shipping'] = $request->shipping;
        $data['total'] = $request->total;
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        Mail::to($email)->send(new InvoiceMail($data));

        //Insert Shipping
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        $shipping['ship_post'] = $request->ship_post;
        DB::table('shipping')->insert($shipping);

        //Insert Order Details
        $details = array();
        $content = Cart::content();
        foreach ($content as $row){
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['single_price'] = $row->price;
            $details['total_price'] = $row->qty * $row->price;
            DB::table('order_details')->insert($details);
        }
        Cart::destroy();
        if(Session::has('coupon_code')){
            $coupon = Session::get('coupon_code');
            Session::forget('coupon_code');
            DB::table('coupons')->where('coupon_code',$coupon)->delete();
        }
        $notification=array(
            'messege'=>'Congrats! Your Order Successfully Submited!',
            'alert-type'=>'success'
             );
        return Redirect()->to('/')->with($notification);

    }

    public function SuccessList(){

        $order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(5)->get();
      
        return view('pages.returnorder',compact('order'));
      
        }
      
        public function RequestReturn($id){
          DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
           $notification=array(
                'messege'=>'Order Request Done',
                'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
      
        }

}
