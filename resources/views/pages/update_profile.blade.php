@extends('layouts.app')
@section('content')
@php
$category = DB::table('categories')->get();
$site = DB::table('sitesetting')->first();
@endphp
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        @foreach($category as $cat)
                        <li><a href="{{url('categories/'.$cat->id)}}">{{$cat->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form method="post" action="{{ route('product.search') }}">
                            @csrf
                            <div class="hero__search__categories">
                                All Categories

                            </div>
                            <input type="text" name="search" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{$site->phone_one}}</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2> Edit Profile </h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

@php
$user_id = Auth::id();
$order = DB::table('orders')->where('user_id', $user_id)->orderBy('id','desc')->limit(10)->get();

@endphp

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    @if($user->avatar)
                    <img src="{{asset($user->avatar)}}" class="card-img-top"
                        style="height:90px; width:90px; margin:0 auto; border-radius:50%;">
                    @else
                    <img src="{{asset('public/frontend/img/user_photo.png')}}" class="card-img-top"
                        style="height:90px; width:90px; margin:0 auto; border-radius:50%;">
                    @endif
                    <div class="card-body">
                        <h4 class="text-center">{{$user->name}}</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{route('home')}}">Profile</a></li>
                        <li class="list-group-item"><a href="{{url('/edit/profile/'.$user_id )}}">Edit profile</a>
                        <li class="list-group-item"><a href="{{route('password.change')}}">Change Password</a></li>
                        </li>
                        <li class="list-group-item"><a href="{{route('success.orderlist')}}">Return Order</a></li>

                    </ul>
                    <div class="card-body">
                        <a href="{{route('user.logout')}}" class="btn btn-success btn-sm btn-block">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" style="padding: 20px;">
                    <form action="{{url('/update/profile/'.$user_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="avatar">Profile Picture</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone/Mobile No</label>
                            <input type="text" class="form-control" id="phone" value="{{$user->phone}}" required
                                name="phone">
                            @if ($errors->any())

                            <ul>
                                @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>

                            @endif

                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" disabled class="form-control" value="{{$user->email}}" required
                                id="email">

                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-info">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style="padding: 20px;">
                    <form action="{{url('/update/profile/address/'.$user_id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{$user->address}}" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{$user->city}}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" class="form-control" id="post_code" value="{{$user->post_code}}" required
                                name="post_code">

                        </div>


                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-success">Update Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection