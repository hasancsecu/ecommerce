@extends('admin.admin_layouts')

@section('admin_content')
@php
$category = DB::table('categories')->get();
$subcategory = DB::table('subcategories')->get();
$brand = DB::table('brands')->get();
@endphp
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Update Product</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Product
                <a href="{{route('all.product')}}" class=" btn btn-success btn-sm pull-right">All Products</a>
            </h6> <br>

            <form action="{{url('update/product/withoutphoto/'.$product->id)}}" method="post">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name"
                                    value="{{ $product->product_name }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code"
                                    value="{{ $product->product_code }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_quantity"
                                    value="{{ $product->product_quantity }}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="category_id">
                                    <option label="Choose Category"></option>
                                    @foreach($category as $row)
                                    <option value="{{ $row->id}}"
                                        <?php if($row->id == $product->category_id) echo "selected"?>>
                                        {{ $row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_size" data-role="tagsinput"
                                    value="{{$product->product_size}}" id="size">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_color"
                                    value="{{$product->product_color}}" data-role="tagsinput" id="color">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price"
                                    value="{{$product->selling_price}}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Discount Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="discount_price"
                                    value="{{$product->discount_price}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="product_details" id="summernote">
                                    {{$product->product_details}} </textarea>
                            </div>
                        </div><!-- col-12 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="video_link"
                                    value="{{$product->video_link}}">
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->
                    <hr><br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox" style="cursor:pointer">
                                <input type="checkbox" name="main_slider" value="1"
                                    <?php if($product->main_slider == 1) echo "checked"?>>
                                <span>Main Slider</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox" style="cursor:pointer">
                                <input type="checkbox" name="hot_deal" value="1"
                                    <?php if($product->hot_deal == 1) echo "checked"?>>
                                <span>Hot deal</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox" style="cursor:pointer">
                                <input type="checkbox" name="best_rated" value="1"
                                    <?php if($product->best_rated == 1) echo "checked"?>>
                                <span>Best Rated</span>
                            </label>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox" style="cursor:pointer">
                                <input type="checkbox" name="hot_new" value="1"
                                    <?php if($product->hot_new == 1) echo "checked"?>>
                                <span>New</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox" style="cursor:pointer">
                                <input type="checkbox" name="trend" value="1"
                                    <?php if($product->trend == 1) echo "checked"?>>
                                <span>Trend</span>
                            </label>
                        </div><!-- col-4 -->


                    </div><!-- row -->
                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" style="cursor:pointer" type="submit">Update Product</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div>

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Images</h6>
            <br>
            <form action="{{url('update/product/photo/'.$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Image One (Main Thumbnail): <span
                                    class="tx-danger">*</span></label>
                            <br><label class="custom-file">
                                <input type="file" name="image_one" style="cursor:pointer" class="custom-file-input">
                                <input type="hidden" name="old_image1" value="{{$product->image_one}}">
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{URL::to($product->image_one)}}" style="height:80px; width:80px;">
                    </div>
                </div>
                <!--row -->
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                            <br><label class="custom-file">
                                <input type="file" name="image_two" style="cursor:pointer" class="custom-file-input">
                                <input type="hidden" name="old_image2" value="{{$product->image_two}}">

                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{URL::to($product->image_two)}}" style="height:80px; width:80px;">
                    </div>

                </div>
                <!--row -->

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                            <br><label class="custom-file">
                                <input type="file" name="image_three" style="cursor:pointer" class="custom-file-input">
                                <input type="hidden" name="old_image3" value="{{$product->image_three}}">
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{URL::to($product->image_three)}}" style="height:80px; width:80px;">
                    </div>
                </div>
                <!--row -->
                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" style="cursor:pointer" type="submit">Update
                        Images</button>
                </div><!-- form-layout-footer -->
            </form>
        </div>
    </div>
</div>
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
 $('select[name="category_id"]').on('change',function(){
      var category_id = $(this).val();
      if (category_id) {
        
        $.ajax({
          url: "{{ url('/get/subcategory/') }}/"+category_id,
          type:"GET",
          dataType:"json",
          success:function(data) { 
          var d =$('select[name="subcategory_id"]').empty();
          $.each(data, function(key, value){
          
          $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

          });
          },
        });

      }else{
        alert('Please Select a Category');
      }

        });
  });

</script>



@endsection