<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category(){
        $category = DB::table('categories')->get();
        return view('admin.category.category', compact('category'));
    }

    public function storecategory(Request $request){
     $validateData = $request->validate([
        'category_name' => 'required|unique:categories|max:255'
     ]);
     $data = array();
     $data['category_name'] = $request->category_name;
     $image = $request->category_logo;
    if($image){
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(270,270)->save('public/media/category/'.$image_name);
        $data['category_logo'] = 'public/media/category/'.$image_name;
    }
    DB::table('categories')->insert($data);
     $notification=array(
        'messege'=>'Category Inserted Succesfully!',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
    }

    public function deletecategory($id){
       $category= DB::table('categories')->where('id',$id)->first();
       if($category->category_logo){
        unlink($category->category_logo);
       }
        DB::table('categories')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Category Deleted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function editcategory($id){
       $category = DB::table('categories')->where('id', $id)->first();
       return view('admin.category.edit_category', compact('category'));
    }

    public function updatecategory(Request $request, $id){
        $validateData = $request->validate([
            'category_name' => 'required|max:255'
         ]);
    
        $data = array();
        $data['category_name'] = $request->category_name;
        $old_logo = $request->old_logo; 
        $image = $request->file('category_logo');
        if($image){
            if( $old_logo){
            unlink($old_logo);
            }
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(270,270)->save('public/media/category/'.$image_name);
            $data['category_logo'] = 'public/media/category/'.$image_name;
        }
        $update = DB::table('categories')->where('id',$id)->update($data);
        if($update){
         $notification=array(
             'messege'=>'Category Updated Succesfully!',
             'alert-type'=>'success'
              );
            return Redirect()->route('categories')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing Updated!',
                'alert-type'=>'info'
                 );
               return Redirect()->route('categories')->with($notification);
        }
     }
}
