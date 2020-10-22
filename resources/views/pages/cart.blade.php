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

@endphp


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $row)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset($row->options->image)}}" style="width: 80px; height:80px;" alt="">
                                    <h5>{{$row->name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    Tk.{{$row->price}}

                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <form method="post" action="{{route('update.cart.item')}}">
                                            @csrf
                                            <div class="pro-qty">
                                                <input type="text" name="qty" value="{{$row->qty}}">
                                            </div>
                                            <input type="hidden" name="product_id" value="{{$row->rowId}}">
                                            <button type="submit" class="btn btn-info btn-sm"><i
                                                    class="icon_check"></i></button>
                                        </form>
                                    </div>

                                </td>
                                <td class="shoping__cart__total">
                                    Tk.{{$row->subtotal}}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{url('remove/cart/'.$row->rowId)}}"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{url('products')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                </div>
            </div>
            @if(Session::has('coupon_code'))
            <div class="col-lg-6">
            </div>
            @else

            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="{{route('apply.coupon')}}" method="POST">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Enter your coupon code" required>
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-6">
                <div class=" shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @if(Session::has('coupon_code'))
                        <li>Subtotal <span> Tk.{{  Cart::Subtotal() }}</span></li>
                        <li>Coupon ({{ Session::get('coupon_code')['name'] }} )<a
                                href="{{route('coupon.remove')}}"><span>Tk.{{ Session::get('coupon_code')['discount'] }}
                                    <i class="icon_close"></i></span></a>
                        </li>
                        <li>Subtotal (With Discount) <span> Tk.{{ Session::get('coupon_code')['balance'] }}</span></li>
                        @else
                        <li>Subtotal <span> Tk.{{  Cart::Subtotal() }}</span></li>
                        @endif

                        <li>Shiping Charge <span>Tk.{{ $charge  }}
                            </span>
                        </li>
                        @if(Session::has('coupon_code'))
                        <li>Total <span>Tk.{{ Session::get('coupon_code')['balance'] + $charge }} </span></li>
                        @else
                        <li>Total <span>Tk.{{ Cart::Subtotal() + $charge }}</span></li>
                        @endif
                    </ul>
                    <a href="{{route('user.checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection