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
                    <h2>@if($cat_product){{$cat_product->category_name}}@else No Product Available in This
                        Category @endif</h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            @foreach ($categories as $row)

                            <li><a href="{{url('categories/'.$row->id)}}">{{$row->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                <div class="filter__item">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="filter__found">
                                <h6><span> {{count($allproduct)}} </span> Products found
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $row)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset($row->image_one)}}">
                                @if($row->discount_price == NULL && $row->hot_new==1)
                                <div class="product__percent" style="background-color: #7fad39">
                                    New
                                </div>
                                @elseif($row->discount_price != NULL)
                                <div class="product__percent">
                                    @php
                                    $amount = ($row->selling_price - $row->discount_price) /
                                    $row->selling_price * 100;
                                    @endphp
                                    {{intval($amount)}}%
                                </div>
                                @endif
                                <ul class="product__item__pic__hover">
                                    <li><a data-id="{{$row->id}}" class="addwishlist" style="cursor: pointer;"><i
                                                class="fa fa-heart"></i></a>
                                    </li>
                                    <li><a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li><a data-id="{{$row->id}}" class="addcart" style="cursor: pointer;"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->product_name}}</a>
                                </h6>
                                <h5>{{$row->product_size}}</h5>
                                <div class="product__item__price">@if($row->discount_price == NULL)
                                    Tk.{{$row->selling_price}}
                                    @else
                                    <span>Tk.{{$row->selling_price}}</span> Tk.{{$row->discount_price}}
                                    @endif</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->




<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script type="text/javascript">
    $(document).ready(function(){
		$('.addwishlist').on('click', function(){
			var id = $(this).data('id');
			if(id){
				$.ajax({
					url: "{{url('add/wishlist/')}}/"+id,
					type: "GET",
					dataType: "json",
					success:function(data){
						$('.wishlist_count').html(data.count);
						
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 2000,
							timerProgressBar: true,
							didOpen: (toast) => {
								toast.addEventListener('mouseenter', Swal.stopTimer)
								toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
							});
							
							if($.isEmptyObject(data.error)){
								Toast.fire({
									icon: 'success',
									title: data.success
							});
							
							}else{
								Toast.fire({
									icon: 'error',
									title: data.error
							});
							
						}
					},
				});
			}else{
				alert('danger');
			}
		});
	});
</script>


<script type="text/javascript">
    $(document).ready(function(){
		$('.addcart').on('click', function(){
			var id = $(this).data('id');
			if(id){
				$.ajax({
					url: "{{url('add/cart/')}}/"+id,
					type: "GET",
					dataType: "json",
					success:function(data){
						$('.price_cart').html(data.total);
						$('.count_cart').html(data.count);
						
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 2000,
							timerProgressBar: true,
							didOpen: (toast) => {
								toast.addEventListener('mouseenter', Swal.stopTimer)
								toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
                            });
                           
							if($.isEmptyObject(data.error)){
								Toast.fire({
									icon: 'success',
									title: data.success
							});
						
						
							}else{
								Toast.fire({
									icon: 'error',
									title: data.error
							});
							
                        }
                        
                       
                            
					},
				});
			}else{
				alert('danger');
			}
		});
	});
</script>


@endsection