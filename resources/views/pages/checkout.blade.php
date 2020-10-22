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
@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$user = DB::table('users')->where('id',Auth::id())->first();
@endphp

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Shipping Details</h4>
            <form action="{{route('payment.process')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">


                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input type="text" placeholder="Enter Your Full Name" name="name" @if($user->name)
                            value="{{$user->name}}" @endif required>

                        </div>



                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" @if($user->address) value="{{$user->address}}"
                            @endif
                            placeholder="Enter Your Address" name="address"
                            required>

                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" @if($user->city) value="{{$user->city}}" @endif
                            placeholder="Enter Your City" name="city" required>
                        </div>

                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" @if($user->post_code)
                            value="{{$user->post_code}}"
                            @endif
                            placeholder="Enter Your Post Code" name="post_code"
                            required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone / Mobile No<span>*</span></p>
                                    <input type="text" laceholder="Enter Your Phone / Mobile No" name="phone"
                                        @if($user->phone)
                                    value="{{$user->phone}}" @endif required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" placeholder="Enter Your Email Address" name="email"
                                        @if($user->email)
                                    value="{{$user->email}}" @endif required>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach ($cart as $row)
                                <li>{{$row->name}} <span>Tk.{{$row->price * $row->qty}}</span></li>
                                @endforeach

                            </ul>
                            @if(Session::has('coupon_code'))
                            <div class="checkout__order__subtotal">Subtotal
                                <span>Tk.{{ Session::get('coupon_code')['balance'] }}</span> </div>
                            @else
                            <div class="checkout__order__subtotal">Subtotal
                                <span>Tk.{{ Cart::subtotal() }}</span> </div>
                            @endif
                            <div class="checkout__order__total">Shipping <span>Tk.{{$charge}}</span></div>
                            @if(Session::has('coupon_code'))
                            <div class="checkout__order__total">Total
                                <span>Tk.{{ Session::get('coupon_code')['balance'] + $charge }}</span> </div>
                            @else
                            <div class="checkout__order__total">Total
                                <span>Tk.{{ Cart::subtotal() + $charge }}</span> </div>
                            @endif


                            <div class="form-check">

                                <input type="checkbox" class="form-check-input" required name="payment" value="stripe">

                                <label for="stripe"> Stripe</label>
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection