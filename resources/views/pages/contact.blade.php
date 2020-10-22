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
					<h2>Contact Us</h2>
					<div class="breadcrumb__option">

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 text-center">
				<div class="contact__widget">
					<span class="icon_phone"></span>
					<h4>Phone</h4>
					<p>{{$site->phone_one}}</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 text-center">
				<div class="contact__widget">
					<span class="icon_phone"></span>
					<h4>Phone</h4>
					<p>{{$site->phone_two}}</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 text-center">
				<div class="contact__widget">
					<span class="icon_pin_alt"></span>
					<h4>Address</h4>
					<p>{{$site->company_address}}</p>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6 text-center">
				<div class="contact__widget">
					<span class="icon_mail_alt"></span>
					<h4>Email</h4>
					<p>{{$site->email}}</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
{{-- <div class="map">
	<iframe
		src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
		height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	<div class="map-inside">
		<i class="icon_pin"></i>
		<div class="inside-widget">
			<h4>Dhaka</h4>
			<ul>
				<li>Phone: {{$site->phone_one}}</li>
<li>Address: {{$site->company_address}}</li>
</ul>
</div>
</div>
</div> --}}
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="contact__form__title">
					<h2>Get In Touch</h2>
				</div>
			</div>
		</div>
		<form method="post" action="{{ route('contact.form') }}">
			@csrf
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<input type="text" required name="name" placeholder="Your name">
				</div>
				<div class="col-lg-6 col-md-6">
					<input type="email" required name="email" placeholder="Your Email">
				</div>
				<div class="col-lg-12 text-center">
					<textarea name="message" required placeholder="Your message"></textarea>
					<button type="submit" class="site-btn">SEND MESSAGE</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Contact Form End -->

@endsection