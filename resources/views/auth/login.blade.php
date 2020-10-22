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
                    <h2> Login / Register </h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1"
                style="border:1px solid grey; padding:30px; border-radius:20px; margin-bottom:20px;">
                <div class="contact_form_container">
                    <h4 class="contact_form_title text-center">Sign In</h4>
                    <br>

                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Email Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" id="password"
                                placeholder="Enter Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-success">Log In</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <label class="chech_container">Remember me
                            </label>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('password.request') }}" class="text-blue">I forgot my password</a>
                        </div>
                    </form>
                    <br>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary btn-block"><i
                            class="social_facebook"></i> Log
                        In with
                        Facebook</a>
                    <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block"><i
                            class="social_googleplus"></i> Log In
                        with Google</a>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1"
                style="border:1px solid grey; padding:30px; border-radius:20px; margin-bottom:20px;">
                <div class="contact_form_container">
                    <h4 class="contact_form_title text-center">Sign Up</h4>
                    <br>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus id="name"
                                placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone/Mobile No</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone" id="phone"
                                placeholder="Enter Phone/Mobile No">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" id="email"
                                aria-describedby="emailHelp" placeholder="Enter Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" id="password"
                                placeholder="Enter Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password1">Confirm Password</label>
                            <input type="password" class="form-control" id="password1" required
                                name="password_confirmation" placeholder="Re-Type Password" autocomplete="new-password">
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-info">Sign Up</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</section>

@endsection