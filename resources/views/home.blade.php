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
                    <h2> Profile </h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->



@php
$user_id = Auth::id();
$order = DB::table('orders')->where('user_id', $user_id)->orderBy('id','desc')->limit(10)->get();
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
                        <li class="list-group-item"><a href="{{url('/edit/profile/'.$user_id )}}">Edit profile</a>
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
                    <div class="card-header text-center h4">Order History</div>
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $row)
                            <tr>
                                <td scope="col">{{$row->payment_type}}</td>
                                <td>Tk.{{$row->total}}</td>
                                <td>{{$row->date}}</td>
                                <td>
                                    @if($row->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif($row->status == 1)
                                    <span class="badge badge-info">Payment Accepted</span>
                                    @elseif($row->status == 2)
                                    <span class="badge badge-warning">On Progress</span>
                                    @elseif($row->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                    @else
                                    <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('view/order/'.$row->id)}}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>
@endsection