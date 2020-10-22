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
                    <h2> Change Password </h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


@php
$user_id = Auth::id();
$user = Auth::user();
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
                        <li class="list-group-item"><a href="{{url('/edit/profile/'.Auth::user()->id )}}">Edit
                                profile</a>
                        </li>
                        <li class="list-group-item"><a href="{{route('password.change')}}">Change Password</a></li>
                        <li class="list-group-item"><a href="{{route('success.orderlist')}}">Return Order</a></li>

                    </ul>
                    <div class="card-body">
                        <a href="{{route('user.logout')}}" class="btn btn-success btn-sm btn-block">Logout</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center h3">{{ __('Change Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}"
                            aria-label="{{ __('Reset Password') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="oldpass"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpass" type="password"
                                        class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}"
                                        name="oldpass" value="{{ $oldpass ?? old('oldpass') }}"
                                        placeholder="Enter Old Password" required autofocus>

                                    @if ($errors->has('oldpass'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpass') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="Enter New Password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Re-Type New Password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection