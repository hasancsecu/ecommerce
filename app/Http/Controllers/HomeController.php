<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use app\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request){
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();  
                      $notification=array(
                        'messege'=>'You Have Successfully Changed Your Password! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('login')->with($notification); 
                 }else{
                     $notification=array(
                        'messege'=>'New password and Confirm Password not matched!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }     
      }else{
        $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }

    }

    public function editProfile($id){
      $user = DB::table('users')->where('id',$id)->first();

      return view('pages.update_profile', compact('user'));
    }

    public function updateProfile(Request $request, $id){
    //   $validateData = $request->validate([
    //     'phone' => 'unique:users'
    //  ]);
     $old_avatar = $request->old_avatar;
     $data = array();
     $data['name'] = $request->name;
     $data['phone'] = $request->phone; 
     $image = $request->file('avatar');
     if($image){
       if($old_avatar){
         unlink($old_avatar);
       }
         $image_name = date('dmy-H-s-i');
         $ext = strtolower($image->getClientOriginalExtension());
         $image_full_name = $image_name.'.'.$ext;
         $upload_path = 'public/media/user/';
         $image_url = $upload_path.$image_full_name;
         $success = $image->move($upload_path,$image_full_name);

         $data['avatar'] = $image_url;
         
    }
    $user = DB::table('users')->where('id', $id)->update($data);
    if($user){
         $notification=array(
            'messege'=>'User Profile Updated Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->route('home')->with($notification);
            } else{
         $notification=array(
             'messege'=>'Nothing Updated!',
             'alert-type'=>'info'
              );
              return Redirect()->route('home')->with($notification);
     }
    }

    public function updateAddress(Request $request, $id){
      $data = array();
      $data['address'] = $request->address;
      $data['city'] = $request->city;
      $data['post_code'] = $request->post_code;
      $user = DB::table('users')->where('id', $id)->update($data);
      if($user){
           $notification=array(
              'messege'=>'Address Updated Succesfully!',
              'alert-type'=>'success'
               );
             return Redirect()->route('home')->with($notification);
              } else{
           $notification=array(
               'messege'=>'Nothing Updated!',
               'alert-type'=>'info'
                );
                return Redirect()->route('home')->with($notification);
       }
    }



    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            $notification=array(
                'messege'=>'You Have Successfully Logged out!',
                'alert-type'=>'success'
                 );
             return Redirect()->route('login')->with($notification);
       

    }
}
