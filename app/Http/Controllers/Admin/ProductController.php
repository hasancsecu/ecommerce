<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->select('products.*', 'categories.category_name')
        ->get();

    return view('admin.product.index', compact('product'));
    }

    public function create(){
        $category = DB::table('categories')->get();
        return view('admin.product.create', compact('category'));
    }

    public function store(Request $request){
        $validateData = $request->validate([

        ]);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_details'] = $request->product_details;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['hot_new'] = $request->hot_new;
        $data['trend'] = $request->trend;
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

      if($image_one && $image_two && $image_three){
          $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
          Image::make($image_one)->resize(270,270)->save('public/media/product/'.$image_one_name);
          $data['image_one'] = 'public/media/product/'.$image_one_name;

          $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
          Image::make($image_two)->resize(270,270)->save('public/media/product/'.$image_two_name);
          $data['image_two'] = 'public/media/product/'.$image_two_name;

          $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
          Image::make($image_three)->resize(270,270)->save('public/media/product/'.$image_three_name);
          $data['image_three'] = 'public/media/product/'.$image_three_name;
        }

        $product = DB::table('products')->insert($data);
        $notification=array(
            'messege'=>'Product Inserted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }


    public function delete($id){
        $product = DB::table('products')->where('id', $id)->first();
        $recent = DB::table('recent_view')->where('product_id',$id)->delete();
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);

        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Product Deleted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function active($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        $notification=array(
            'messege'=>'Product Activated Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
    public function inactive($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        $notification=array(
            'messege'=>'Product Inactived Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function view($id){
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->select('products.*', 'categories.category_name')
        ->where('products.id', $id)->first();

    return view('admin.product.show', compact('product'));
    }


    public function edit($id){
        $product = DB::table('products')->where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
     }

     public function updateWithoutPhoto(Request $request, $id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_details'] = $request->product_details;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['hot_new'] = $request->hot_new;
        $data['trend'] = $request->trend;
        $data['status'] = 1;
        $update = DB::table('products')->where('id', $id)->update($data);
        if($update){
            $notification=array(
                'messege'=>'Product Updated Succesfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all.product')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing Updated!',
                'alert-type'=>'info'
                 );
               return Redirect()->route('all.product')->with($notification);
        }
     }
     public function updatePhoto(Request $request, $id){
        $old_image1 = $request->old_image1;
        $old_image2 = $request->old_image2;
        $old_image3 = $request->old_image3;

        $data = array();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');
        if($image_one){
            unlink($old_image1);
            $image_name = date('dmy-H-s-i');
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_one->move($upload_path,$image_full_name);
            $data['image_one'] = $image_url;   
            $product_image = DB::table('products')->where('id', $id)->update($data);
            if($product_image){
                 $notification=array(
                    'messege'=>'Image One Updated Succesfully!',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('all.product')->with($notification);
            }  
       }
       if($image_two){
        unlink($old_image2);
        $image_name = date('dmy-H-s-i');
        $ext = strtolower($image_two->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'public/media/product/';
        $image_url = $upload_path.$image_full_name;
        $success = $image_two->move($upload_path,$image_full_name);
        $data['image_two'] = $image_url;  
        $product_image = DB::table('products')->where('id', $id)->update($data);
        if($product_image){
            $notification=array(
               'messege'=>'Image Two Updated Succesfully!',
               'alert-type'=>'success'
                );
              return Redirect()->route('all.product')->with($notification);
       }    
   }
   if($image_three){
    unlink($old_image3);
    $image_name = date('dmy-H-s-i');
    $ext = strtolower($image_three->getClientOriginalExtension());
    $image_full_name = $image_name.'.'.$ext;
    $upload_path = 'public/media/product/';
    $image_url = $upload_path.$image_full_name;
    $success = $image_three->move($upload_path,$image_full_name);
    $data['image_three'] = $image_url;    
    $product_image = DB::table('products')->where('id', $id)->update($data);
    if($product_image){
        $notification=array(
           'messege'=>'Image Three Updated Succesfully!',
           'alert-type'=>'success'
            );
          return Redirect()->route('all.product')->with($notification);
        }  
    }
       else{
            $notification=array(
                'messege'=>'Nothing Updated!',
                'alert-type'=>'info'
                 );
                 return Redirect()->route('all.product')->with($notification);
        }
     }
}
