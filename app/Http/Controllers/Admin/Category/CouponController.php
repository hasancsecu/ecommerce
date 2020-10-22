<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon(){
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupon'));
    }
    public function storeCoupon(Request $request){
        $validateData = $request->validate([
           'coupon_code' => 'required|unique:coupons|max:255',
           'discount' => 'required'
        ]);
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);
   
    
        $notification=array(
           'messege'=>'Coupon Inserted Succesfully!',
           'alert-type'=>'success'
            );
          return Redirect()->back()->with($notification);
       }
   
       public function deleteCoupon($id){
           DB::table('coupons')->where('id',$id)->delete();
           $notification=array(
               'messege'=>'Coupons Deleted Succesfully!',
               'alert-type'=>'success'
                );
              return Redirect()->back()->with($notification);
       }
   
       public function editCoupon($id){
          $coupon = DB::table('coupons')->where('id', $id)->first();
          return view('admin.coupon.edit_coupon', compact('coupon'));
       }
   
       public function updateCoupon(Request $request, $id){
           $validateData = $request->validate([
               'coupon_code' => 'required|max:255',
               'discount' => 'required'
            ]);
       
            $data = array();
            $data['coupon_code'] = $request->coupon_code;
            $data['discount'] = $request->discount;
           $update = DB::table('coupons')->where('id',$id)->update($data);
    
           if($update){
            $notification=array(
                'messege'=>'Coupon Updated Succesfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('coupons')->with($notification);
           }else{
               $notification=array(
                   'messege'=>'Nothing Updated!',
                   'alert-type'=>'info'
                    );
                  return Redirect()->route('coupons')->with($notification);
           }
        }
        public function newslater(){
            $newslater = DB::table('newslaters')->get();
            return view('admin.coupon.newslater', compact('newslater'));
        }

        public function deleteNewslater($id){
            DB::table('newslaters')->where('id',$id)->delete();
            $notification=array(
                'messege'=>'Subscriber Deleted Succesfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
        }
    
}
