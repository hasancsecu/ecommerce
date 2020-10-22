<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ContactController extends Controller
{
    public function Contact(){
  	return view('pages.contact');
  }


  public function ContactForm(Request $request){

  	$data = array();
  	$data['name'] = $request->name;
  	$data['email'] = $request->email;
  	$data['message'] = $request->message;
  	DB::table('contact')->insert($data);
  	$notification=array(
            'messege'=>'Thanks for Sending Message. Your Message Successfully Sent!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification); 
  }





}
