@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Add Product</h5>

    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Add New
        <a href="{{route('all.product')}}" class=" btn btn-success btn-sm pull-right">All Products</a>
      </h6> <br>

      <form action="{{route('store.product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_name" placeholder="Enter Product Name">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_code" placeholder="Enter Product Code">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_quantity" placeholder="Enter Product Quantity">
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                <select class="form-control select2" name="category_id">
                  <option label="Choose Category"></option>
                  @foreach($category as $row)
                  <option value="{{ $row->id}}">{{ $row->category_name}}</option>
                  @endforeach
                </select>
              </div>
            </div><!-- col-4 -->



            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_size" data-role="tagsinput" id="size">
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_color" data-role="tagsinput" id="color">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="selling_price" placeholder="Enter Selling Price">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="discount_price" placeholder="Enter Discount Price">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-8">
              <div class="form-group">
                <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="video_link" placeholder="Enter Video Link">
              </div>
            </div><!-- col-8 -->

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                <textarea class="form-control" name="product_details" id="summernote">

                </textarea>
              </div>
            </div><!-- col-12 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Image One (Main Thumbnail): <span class="tx-danger">*</span></label>
                <br><label class="custom-file">
                  <input type="file" style="cursor:pointer" name="image_one" onchange="readURL(this);"
                    class="custom-file-input">
                  <span class="custom-file-control"></span>
                  <br><img src="#" id="one" alt="">
                </label>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                <br><label class="custom-file">
                  <input type="file" style="cursor:pointer" name="image_two" class="custom-file-input"
                    onchange="readURL2(this);">
                  <span class="custom-file-control"></span>
                  <br><img src="#" id="two" alt="">
                </label>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                <br><label class="custom-file">
                  <input type="file" style="cursor:pointer" name="image_three" class="custom-file-input"
                    onchange="readURL3(this);">
                  <span class="custom-file-control"></span>
                  <br><img src="#" id="three" alt="">
                </label>
              </div>
            </div><!-- col-4 -->
          </div><!-- row -->
          <hr><br>
          <div class="row">
            <div class="col-lg-4">
              <label class="ckbox" style="cursor:pointer">
                <input type="checkbox" name="main_slider" value="1">
                <span>Main Slider</span>
              </label>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <label class="ckbox" style="cursor:pointer">
                <input type="checkbox" name="hot_deal" value="1">
                <span>Hot deal</span>
              </label>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <label class="ckbox" style="cursor:pointer">
                <input type="checkbox" name="best_rated" value="1">
                <span>Best Rated</span>
              </label>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <label style="cursor:pointer" class="ckbox">
                <input type="checkbox" name="hot_new" value="1">
                <span>New</span>
              </label>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <label style="cursor:pointer" class="ckbox">
                <input type="checkbox" name="trend" value="1">
                <span>Trend</span>
              </label>
            </div><!-- col-4 -->


          </div><!-- row -->
          <br>
          <div class="form-layout-footer">
            <button class="btn btn-info mg-r-5" style="cursor:pointer" type="submit">Add Product</button>
          </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
    </div><!-- card -->
    </form>
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

<script type="text/javascript">
  function readURL(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#one')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

<script type="text/javascript">
  function readURL2(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#two')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script type="text/javascript">
  function readURL3(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#three')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection