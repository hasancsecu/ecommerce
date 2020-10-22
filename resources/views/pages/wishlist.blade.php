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
                    <h2>Your Wish List</h2>
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
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $row)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset($row->image_one)}}" style="width: 80px; height:80px;" alt="">
                                    <h5>{{$row->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    Tk.{{$row->selling_price}}

                                </td>
                                <td class="shoping__cart__quantity">
                                    1
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-success addcart" style="cursor:pointer;"
                                        data-id="{{$row->id}}">Add to Cart
                                    </button>
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{url('remove/wishlist/'.$row->id)}}"><span class="icon_close"></span></a>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


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