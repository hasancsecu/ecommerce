@extends('layouts.app')

@section('content')

@php
$category = DB::table('categories')->get();
$site = DB::table('sitesetting')->first();
@endphp


@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
@endphp
<style>
  /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
  .StripeElement {
    box-sizing: border-box;

    height: 40px;
    width: 100%;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
</style>

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
          <h2> Payment </h2>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->


<section class="product spad">
  <form action="{{route('stripe.charge')}}" method="post" id="payment-form">
    @csrf

    <div class="container">


      <div class="col-lg-8" style="border: 1px solid grey; border-radius: 10px; padding: 20px; margin: 0 auto;">
        <h2 class="text-center">Final Payment</h2>
        <div class="row">

          <div class="col-lg-12">
            <div class="form-group">
              <label for="card-element">
                Credit or debit card
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>
                <input type="hidden" name="shipping" value="{{$charge}}">
                <input type="hidden" name="total" value="{{Cart::Subtotal() + $charge}}">
                <input type="hidden" name="payment_type" value="{{$data['payment']}}">
                <input type="hidden" name="ship_name" value="{{$data['name']}}">
                <input type="hidden" name="ship_phone" value="{{$data['phone']}}">
                <input type="hidden" name="ship_email" value="{{$data['email']}}">
                <input type="hidden" name="ship_address" value="{{$data['address']}}">
                <input type="hidden" name="ship_city" value="{{$data['city']}}">
                <input type="hidden" name="ship_post" value="{{$data['post_code']}}">
              </label>
              <button type="submit" class="btn btn-warning">Pay Now</button>
            </div>
          </div>
        </div>

      </div>
    </div>

  </form>
</section>

<script type="text/javascript">
  // Create a Stripe client.
var stripe = Stripe('pk_test_4aeZGREbFTAn7Tr0cWy1N3eK00o8AIDZmk');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection