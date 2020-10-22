@extends('layouts.app')

@section('content')

@php
$featured = DB::table('products')->where('status',1)->orderBy('id', 'DESC')->limit(8)->get();
$trend = DB::table('products')->join('categories','products.category_id','categories.id')
->select('products.*','categories.category_name')->where('status',1)->where('trend',1)->orderBy('id',
'DESC')->limit(8)->get();
$best_rated =
DB::table('products')->join('categories','products.category_id','categories.id')
->select('products.*','categories.category_name')->where('status',1)->where('best_rated',1)->orderBy('id',
'DESC')->limit(8)->get();
$hot_deal =
DB::table('products')->where('status',1)->where('hot_deal',1)->orderBy('id',
'DESC')->limit(8)->get();

$recent = DB::table('recent_view')->join('products','recent_view.product_id','products.id')
->select('recent_view.*','products.*')->where('recent_view.user_id',Auth::id())->orderBy('recent_view.id',
'DESC')->limit(20)->get();
$slider = DB::table('products')->where('main_slider', 1)
->orderBy('id','DESC')->first();

$category = DB::table('categories')->get();
$site = DB::table('sitesetting')->first();
@endphp
<!-- Hero Section Begin -->
<section class="hero">
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
							<input type="search" name="search" placeholder="What do yo u need?">
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
				<div class="hero__item set-bg" data-setbg="{{asset('public/frontend/img/hero/banner.jpg')}}">
					<div class="hero__text">
						<span>FRUIT FRESH</span>
						<h2>Vegetable <br />100% Organic</h2>
						<p>Free Pickup and Delivery Available</p>
						<a href="#" class="primary-btn">SHOP NOW</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
	<div class="container">
		<div class="row">
			<div class="categories__slider owl-carousel">
				<div class="col-lg-3">
					<div class="categories__item set-bg"
						data-setbg="{{asset('public/frontend/img/categories/cat-1.jpg')}}">
						<h5><a href="#">Fresh Fruit</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg"
						data-setbg="{{asset('public/frontend/img/categories/cat-2.jpg')}}">
						<h5><a href="#">Dried Fruit</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg"
						data-setbg="{{asset('public/frontend/img/categories/cat-3.jpg')}}">
						<h5><a href="#">Vegetables</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg"
						data-setbg="{{asset('public/frontend/img/categories/cat-4.jpg')}}">
						<h5><a href="#">drink fruits</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg"
						data-setbg="{{asset('public/frontend/img/categories/cat-5.jpg')}}">
						<h5><a href="#">drink fruits</a></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Featured Product</h2>
				</div>

			</div>
		</div>
		<div class="row featured__filter">
			<div class="categories__slider owl-carousel">
				@foreach ($featured as $row)
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="{{asset($row->image_one)}}">
							@if($row->discount_price == NULL && $row->hot_new==1)
							<div class="featured__percent" style="background-color: #7fad39">
								New
							</div>
							@elseif($row->discount_price != NULL)
							<div class="featured__percent">
								@php
								$amount = ($row->selling_price - $row->discount_price) /
								$row->selling_price * 100;
								@endphp
								{{intval($amount)}}%
							</div>
							@endif

							<ul class="featured__item__pic__hover">
								<li><a data-id="{{$row->id}}" class="addwishlist" style="cursor: pointer;"><i
											class="fa fa-heart"></i></a>
								</li>
								<li><a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i
											class="fa fa-eye"></i></a></li>
								<li><a data-id="{{$row->id}}" class="addcart" style="cursor: pointer;"><i
											class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
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
		</div>
	</div>
</section>
<!-- Featured Section End -->



<!-- Featured Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>New Arrivals</h2>
				</div>

			</div>
		</div>
		<div class="row featured__filter">
			<div class="categories__slider owl-carousel">
				@foreach ($hot_deal as $row)
				<div class="col-lg-3 col-md-4 col-sm-6">

					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="{{$row->image_one}}">
							@if($row->discount_price == NULL && $row->hot_new==1)
							<div class="featured__percent" style="background-color: #7fad39">
								New
							</div>
							@elseif($row->discount_price != NULL)
							<div class="featured__percent">
								@php
								$amount = ($row->selling_price - $row->discount_price) /
								$row->selling_price * 100;
								@endphp
								{{intval($amount)}}%
							</div>
							@endif
							<ul class="featured__item__pic__hover">
								<li><a data-id="{{$row->id}}" class="addwishlist" style="cursor: pointer;"><i
											class="fa fa-heart"></i></a>
								</li>
								<li><a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i
											class="fa fa-eye"></i></a></li>
								<li><a data-id="{{$row->id}}" class="addcart" style="cursor: pointer;"><i
											class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
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
		</div>
	</div>
</section>
<!-- Featured Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Recently Viewed</h2>
				</div>

			</div>
		</div>
		<div class="row featured__filter">
			<div class="categories__slider owl-carousel">
				@foreach ($recent as $row)
				<div class="col-lg-3 col-md-4 col-sm-6">

					<div class="featured__item">
						<div class="featured__item__pic set-bg" data-setbg="{{$row->image_one}}">
							<div class="featured__percent">
								@if($row->discount_price == NULL && $row->hot_new==1)
								New
								@elseif($row->discount_price != NULL)
								@php
								$amount = ($row->selling_price - $row->discount_price) /
								$row->selling_price * 100;
								@endphp
								{{intval($amount)}}%
								@endif
							</div>
							<ul class="featured__item__pic__hover">
								<li><a data-id="{{$row->id}}" class="addwishlist" style="cursor: pointer;"><i
											class="fa fa-heart"></i></a>
								</li>
								<li><a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i
											class="fa fa-eye"></i></a></li>
								<li><a data-id="{{$row->id}}" class="addcart" style="cursor: pointer;"><i
											class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
						<div class="featured__item__text">
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
		</div>
	</div>
</section>
<!-- Featured Section End -->
{{-- <!-- Banner Begin -->
<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="{{asset('public/frontend/img/banner/banner-1.jpg')}}" alt="">
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
	<div class="banner__pic">
		<img src="{{asset('public/frontend/img/banner/banner-2.jpg')}}" alt="">
	</div>
</div>
</div>
</div>
</div>
<!-- Banner End --> --}}


<!-- Blog Section Begin -->
{{-- <section class="from-blog spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title from-blog__title">
					<h2>From The Blog</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="blog__item">
					<div class="blog__item__pic">
						<img src="img/blog/blog-1.jpg" alt="">
					</div>
					<div class="blog__item__text">
						<ul>
							<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
							<li><i class="fa fa-comment-o"></i> 5</li>
						</ul>
						<h5><a href="#">Cooking tips make cooking simple</a></h5>
						<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="blog__item">
					<div class="blog__item__pic">
						<img src="img/blog/blog-2.jpg" alt="">
					</div>
					<div class="blog__item__text">
						<ul>
							<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
							<li><i class="fa fa-comment-o"></i> 5</li>
						</ul>
						<h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
						<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="blog__item">
					<div class="blog__item__pic">
						<img src="img/blog/blog-3.jpg" alt="">
					</div>
					<div class="blog__item__text">
						<ul>
							<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
							<li><i class="fa fa-comment-o"></i> 5</li>
						</ul>
						<h5><a href="#">Visit the clean farm in the US</a></h5>
						<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> --}}
<!-- Blog Section End -->



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
						
						console.log(data.count);
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
						console.log(data.total);
						console.log(data.count);
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