@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('public/frontend/css/rating.css')}}" type="text/css">
@php
$check = DB::table('review')->where('user_id', Auth::id())->where('product_id',
$product->id)->first();
$user = Auth::user();
$ratingTotal = DB::table('review')->where('product_id', $product->id)->sum('rate');
$review = DB::table('review')->where('product_id',$product->id)->get();
if(count($review) > 0){
$rating = ceil($ratingTotal / count($review));
}else{
$rating = 0;
}
if($user){
$allReview = DB::table('review')->join('users','review.user_id','users.id')
->select('review.*','users.*')->where('review.product_id',$product->id)
->where('user_id','!=',$user->id)->paginate(3);
}else{
$allReview = DB::table('review')->join('users','review.user_id','users.id')
->select('review.*','users.*')->where('review.product_id',$product->id)
->paginate(3);
}
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
                    <h2>{{$product->category_name}}</h2>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{asset($product->image_one)}}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{asset($product->image_one)}}" src="{{asset($product->image_one)}}"
                            alt="">
                        <img data-imgbigurl="{{asset($product->image_two)}}" src="{{asset($product->image_two)}}"
                            alt="">
                        <img data-imgbigurl="{{asset($product->image_three)}}" src="{{asset($product->image_three)}}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$product->product_name}}</h3>
                    <div class="product__details__rating">
                        @if($rating > 0)
                        @for ($i = 0; $i < $rating; $i++) <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5-$rating; $i++) <i class="fa fa-star-o"></i>
                                @endfor
                                @else
                                @for ($i = 0; $i < 5; $i++) <i class="fa fa-star-o"></i>
                                    @endfor
                                    @endif
                                    <span>({{count($review)}} reviews)</span>
                    </div>

                    <div class="product__details__price">
                        Unit Price: Tk.{{$product->selling_price}}
                    </div>

                    <ul>
                        <li><b>Availability</b> @if($product->status == 0)<span class="badge badge-danger">Not
                                Available</span>
                            @else <span class="badge badge-success">
                                In Stock</span>
                            @endif
                        </li>
                        <li><b>Weight</b> <span>{{$product->product_size}}</span></li>
                        <li><b>Share on</b><span class="share addthis_inline_share_toolbox"></span>



                        </li>
                    </ul>
                    <br>
                    <form action="{{url('add/cart/product/'.$product->id)}}" method="post">
                        @csrf
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="qty" min="1" value="1">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn">ADD TO CART</button>
                        <a style="cursor: pointer;" data-id="{{$product->id}}" class="heart-icon addwishlist"><span
                                class="icon_heart_alt"></span></a>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Reviews <span>({{count($review)}})</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Q & A
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">

                                {!! $product->product_details !!}
                            </div>
                        </div>


                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">

                                @guest


                                @else

                                <h4 class="text-center">Your rating & review about this product</h4>
                                <hr>
                                @if($check)
                                <div class="row">
                                    <div class="col-md-2  text-center">
                                        @if ($user->avatar)
                                        <img style=" height:70px; width:70px; border-radius: 50%;"
                                            src="{{asset($user->avatar)}}">
                                        @else
                                        <img style=" height:70px; width:70px; border-radius: 50%;"
                                            src="{{asset('public/frontend/img/user_photo.png')}}">
                                        @endif

                                        <p>{{$user->name}}</p>
                                        <div class="product__details__text">
                                            <div class="product__details__rating">
                                                @for ($i = 0; $i < $check->rate; $i++)
                                                    <i class="fa fa-star"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5-$check->rate; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                        @endfor


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10" style="margin: auto;">
                                        <span>{!! $check->review !!}</span>
                                    </div>
                                </div>
                                <hr>
                                @else

                                <div class="container">
                                    <div class=" rating">

                                        <form action="{{url('store/rating/'.$product->id)}}" method="POST">
                                            @csrf
                                            <div class="star-widget">
                                                <input type="radio" value="5" name="rate" id="rate-5">
                                                <label for="rate-5" class="fa fa-star"></label>
                                                <input type="radio" value="4" name="rate" id="rate-4">
                                                <label for="rate-4" class="fa fa-star"></label>
                                                <input type="radio" value="3" name="rate" id="rate-3">
                                                <label for="rate-3" class="fa fa-star"></label>
                                                <input type="radio" value=25" name="rate" id="rate-2">
                                                <label for="rate-2" class="fa fa-star"></label>
                                                <input type="radio" value="1" name="rate" id="rate-1">
                                                <label for="rate-1" class="fa fa-star"></label>
                                                <div class="hide">
                                                    <h4></h4>
                                                    <div class="form-group">
                                                        <textarea cols="50" rows="5" name="review" class="form-control"
                                                            placeholder="Describe your experience about this product.."></textarea>

                                                        <!-- Due to more textarea tags I got a problem So I've changed the textarea tag to textare. Please correct it. -->

                                                    </div>
                                                    <div class="btn">
                                                        <button class="btn_sb btn btn-success" type="submit">Add
                                                            Review</button>
                                                    </div>
                                                </div>

                                                <br>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                @endguest
                                <div>
                                    <h4 class="text-center">Users ratings & reviews about this product</h4>
                                    <hr>
                                    @foreach ($allReview as $row)

                                    <div class="row">

                                        <div class="col-md-2  text-center">
                                            @if ($row->avatar)
                                            <img style=" height:70px; width:70px; border-radius: 50%;"
                                                src="{{asset($row->avatar)}}">
                                            @else
                                            <img style=" height:70px; width:70px; border-radius: 50%;"
                                                src="{{asset('public/frontend/img/user_photo.png')}}">
                                            @endif
                                            <p>{{$row->name}}</p>
                                            <div class="product__details__text">
                                                <div class="product__details__rating">
                                                    @for ($i = 0; $i < $row->rate; $i++)
                                                        <i class="fa fa-star"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5-$row->rate; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                            @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10" style="margin: auto;">
                                            <span>{!! $row->review !!}</span>
                                        </div>

                                    </div>
                                    <hr>

                                    @endforeach
                                    <div>
                                        {{$allReview->links()}}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h4 class="text-center">Have any question about this Product?</h4>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success">Ask Question</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
@php
$cat = DB::table('categories')->where('category_name', $product->category_name)->first();
$cat_id = $cat->id;
$products =
DB::table('products')->where('category_id',$cat_id)->where('id','!=',$product->id)->where('status',1)->orderBy('id',
'desc')->get();
@endphp
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $row)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset($row->image_one)}}">
                        <ul class="featured__item__pic__hover">
                            <li><a data-id="{{$row->id}}" class="addwishlist" style="cursor: pointer;"><i
                                        class="fa fa-heart"></i></a>
                            </li>
                            <li><a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}"><i
                                        class="fa fa-eye"></i></a></li>
                            <li><a data-id="{{$row->id}}" style="cursor: pointer;" class="addcart"><i
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
</section>
<!-- Related Product Section End -->



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
						$('#price_cart').html(data.total);
						$('#count_cart').html(data.count);
						
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

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f91040557e9bf47"></script>



@endsection