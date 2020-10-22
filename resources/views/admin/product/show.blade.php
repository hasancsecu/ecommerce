@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Product Details</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product Details
                <a href="{{route('all.product')}}" class=" btn btn-success btn-sm pull-right">All Products</a>
            </h6> <br>

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Name: </label>
                            <strong>{{$product->product_name}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Code: </label>
                            <strong>{{$product->product_code}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Quantity: </label>
                            <strong>{{$product->product_quantity}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Category: </label>
                            <strong>{{$product->category_name}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Size: </label>
                            <strong>{{$product->product_size}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Color: </label>
                            <strong>{{$product->product_color}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Selling Price: </label>
                            <strong>{{$product->selling_price}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Discount Price: </label>
                            <strong>{{$product->discount_price}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Product Details: </label>
                            <br>
                            <p>{!! $product->product_details !!}</p>
                        </div>
                    </div><!-- col-12 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Video Link: </label>
                            <strong>{{$product->video_link}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image One (Main Thumbnail): </label>
                            <br><img src="{{URL::to($product->image_one)}}" style="height:80px; width:80px">
                            </label>
                        </div>
                    </div> <!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Two: </label>
                            <br><img src="{{URL::to($product->image_two)}}" style="height:80px; width:80px">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Three: </label>
                            <br><img src="{{URL::to($product->image_three)}}" style="height:80px; width:80px">
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <hr><br>
                <div class="row">
                    <div class="col-lg-4">
                        @if($product->main_slider == 1)
                        <p class="badge badge-success">Active</p>
                        @else
                        <p class="badge badge-danger">Inactive</p>
                        @endif
                        <span>Main Slider</span>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        @if($product->hot_deal == 1)
                        <p class="badge badge-success">Active</p>
                        @else
                        <p class="badge badge-danger">Inactive</p>
                        @endif
                        <span>Hot deal</span>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        @if($product->best_rated == 1)
                        <p class="badge badge-success">Active</p>
                        @else
                        <p class="badge badge-danger">Inactive</p>
                        @endif
                        <span>Best Rated</span>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        @if($product->hot_new == 1)
                        <p class="badge badge-success">Active</p>
                        @else
                        <p class="badge badge-danger">Inactive</p>
                        @endif
                        <span>New</span>

                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        @if($product->trend == 1)
                        <p class="badge badge-success">Active</p>
                        @else
                        <p class="badge badge-danger">Inactive</p>
                        @endif
                        <span>Trend</span>
                    </div><!-- col-4 -->

                </div><!-- row -->

            </div><!-- form-layout -->
        </div><!-- card -->

    </div>
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection