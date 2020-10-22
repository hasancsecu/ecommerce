<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function blogCatList(){
        $blogCat = DB::table('post_category')->get();

        return view('admin.blog.category.index', compact('blogCat'));
    }

    public function blogCatStore(Request $request){
        $validateData = $request->validate([
            'category_name_en'=> 'required|max:255|unique:post_category',
            'category_name_bn'=> 'required|max:255|unique:post_category',
        ]);
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_bn'] = $request->category_name_bn;

        DB::table('post_category')->insert($data);
        $notification=array(
            'messege'=>'Blog Category Inserted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function deleteBlogCat($id){
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Blog Category Deleted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function editBlogCat($id){
        $blogCategory = DB::table('post_category')->where('id', $id)->first();
        return view('admin.blog.category.edit', compact('blogCategory'));
     }
 
     public function updateBlogCat(Request $request, $id){
         $validateData = $request->validate([
             'category_name_en' => 'required|max:255',
             'category_name_bn' => 'required|max:255'
          ]);
     
         $data = array();
         $data['category_name_en'] = $request->category_name_en;
         $data['category_name_bn'] = $request->category_name_bn;
         $update = DB::table('post_category')->where('id',$id)->update($data);
  
         if($update){
          $notification=array(
              'messege'=>'Blog Category Updated Succesfully!',
              'alert-type'=>'success'
               );
             return Redirect()->route('add.blog.categoryList')->with($notification);
         }else{
             $notification=array(
                 'messege'=>'Nothing Updated!',
                 'alert-type'=>'info'
                  );
                return Redirect()->route('add.blog.categoryList')->with($notification);
         }
      }
      public function createPost(){
          $blogCategory = DB::table('post_category')->get();

          return view('admin.blog.create', compact('blogCategory'));
      }

      public function storePost(Request $request){
        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_bn'] = $request->post_title_bn;
        $data['post_details_en'] = $request->post_details_en;
        $data['post_details_bn'] = $request->post_details_bn;
        $data['category_id'] = $request->category_id;
        $post_image = $request->post_image;
        
      if($post_image){
        $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
        Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
        $data['post_image'] = 'public/media/post/'.$post_image_name;

      }
      DB::table('posts')->insert($data);
      $notification=array(
        'messege'=>'Post Inserted Succesfully!',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
    }

    public function allPosts(){
        $post = DB::table('posts')
        ->join('post_category', 'posts.category_id', 'post_category.id')
        ->select('posts.*', 'post_category.category_name_en')
        ->get();
        return view('admin.blog.index', compact('post'));
    }

    public function deletePost($id){
        $post = DB::table('posts')->where('id', $id)->first();
        $image = $post->post_image;
        unlink($image);

        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Post Deleted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function editPost($id){
        $post = DB::table('posts')->where('id', $id)->first();
        return view('admin.blog.edit', compact('post'));
    }

    public function updatePost(Request $request, $id){

        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_bn'] = $request->post_title_bn;
        $data['post_details_en'] = $request->post_details_en;
        $data['post_details_bn'] = $request->post_details_bn;
        $data['category_id'] = $request->category_id;
        $post_image = $request->post_image;
        $old_image = $request->old_image;
          
      if($post_image){
        unlink($old_image);
        $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
        Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
        $data['post_image'] = 'public/media/post/'.$post_image_name;
      }
      $post = DB::table('posts')->where('id', $id)->update($data);
      if($post){
        $notification=array(
        'messege'=>'Post Updated Succesfully!',
        'alert-type'=>'success'
         );
       return Redirect()->route('all.blogpost')->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Nothing Updated!',
                'alert-type'=>'info'
                 );
               return Redirect()->route('all.blogpost')->with($notification);
        }
    }
}
