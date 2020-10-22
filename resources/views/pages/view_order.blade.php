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
                    <h2> View Order </h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<section class="product spad">
    <div class="container">
        <div class="pd-20 pd-sm-40 col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h4 class="card-header"><strong>Order Details</strong> </h4>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th> Name: </th>
                                    <th> {{ $order->name }} </th>
                                </tr>

                                <tr>
                                    <th> Phone: </th>
                                    <th> {{ $order->phone }} </th>
                                </tr>



                                <tr>
                                    <th> Payment Type: </th>
                                    <th>{{ $order->payment_type }} </th>
                                </tr>



                                <tr>
                                    <th> Payment Id: </th>
                                    <th> {{ $order->payment_id }} </th>
                                </tr>


                                <tr>
                                    <th> Total : </th>
                                    <th> Tk.{{ $order->total }} </th>
                                </tr>


                                <tr>
                                    <th> Order Date: </th>
                                    <th> {{ $order->date }} </th>
                                </tr>

                            </table>


                        </div>



                    </div>
                </div>



                <div class="col-md-6">
                    <div class="card">
                        <h4 class="card-header"><strong>Shipping Details</strong></h4>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th> Name: </th>
                                    <th> {{ $shipping->ship_name }} </th>
                                </tr>

                                <tr>
                                    <th> Phone: </th>
                                    <th> {{ $shipping->ship_phone }} </th>
                                </tr>



                                <tr>
                                    <th> Email: </th>
                                    <th>{{ $shipping->ship_email }} </th>
                                </tr>



                                <tr>
                                    <th> Address: </th>
                                    <th> {{ $shipping->ship_address }} </th>
                                </tr>


                                <tr>
                                    <th> City : </th>
                                    <th> {{ $shipping->ship_city }} </th>
                                </tr>

                                <tr>
                                    <th> Post Code : </th>
                                    <th> {{ $shipping->ship_post }} </th>
                                </tr>

                                <tr>
                                    <th> Status: </th>
                                    <th>
                                        @if($order->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 1)
                                        <span class="badge badge-info">Payment Accepted</span>
                                        @elseif($order->status == 2)
                                        <span class="badge badge-warning">On Progress</span>
                                        @elseif($order->status == 3)
                                        <span class="badge badge-success">Delivered</span>
                                        @else
                                        <span class="badge badge-danger">Cancelled</span>

                                        @endif

                                    </th>

                                </tr>


                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <br><br>


            <div class="row">

                <div class="pd-20 pd-sm-40 col-lg-12">
                    <h4 class="card-body-title">Product Details </h4>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $row)
                                    <tr>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td> <img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;">
                                        </td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>Tk.{{ $row->single_price }}</td>
                                        <td>Tk.{{ $row->total_price }}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div>
                </div><!-- card -->


            </div>

            <div class="card col-lg-12">
                <br>
                @if($order->status == 0)
                <h3 class="text-danger text-center">Your Order is now on Pending </h3>
                @elseif($order->status == 1)
                <h3 class="text-danger text-center">Your Payment is Successfuly Accepted</h3>
                @elseif($order->status == 2)
                <h3 class="text-danger text-center">Your Order is now on Processing</h3>
                @elseif($order->status == 4)
                <h3 class="text-danger text-center"> Your Order is Cancelled and Not Valid Yet</h3>
                @else
                <h3 class="text-success text-center"> Your Product is Successfuly Delivered!</h3>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection