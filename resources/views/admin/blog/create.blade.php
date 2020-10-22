@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Add Post</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Add New Post
                <a href="{{route('all.blogpost')}}" class=" btn btn-success btn-sm pull-right">All Posts</a>
            </h6> <br>

            <form action="{{route('store.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (EN): <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_en"
                                    placeholder="Enter Post Title (EN)">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (BN): <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_bn"
                                    placeholder="Enter Post Title (BN)"">
                            </div>
                        </div><!-- col-6 -->

                        <div class=" col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Post Category: <span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="category_id">
                                        <option label="Choose Category"></option>
                                        @foreach($blogCategory as $row)
                                        <option value="{{ $row->id}}">{{ $row->category_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Post Image: <span
                                            class="tx-danger">*</span></label>
                                    <br><label class="custom-file">
                                        <input type="file" style="cursor:pointer" name="post_image"
                                            onchange="readURL(this);" class="custom-file-input">
                                        <span class="custom-file-control"></span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                            <img src="#" id="one" alt="">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Details (EN): <span
                                            class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="post_details_en" id="summernote">

                                    </textarea>
                                </div>
                            </div><!-- col-12 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Details (BN): <span
                                            class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="post_details_bn" id="summernote1">

                                    </textarea>
                                </div>
                            </div><!-- col-12 -->

                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" style="cursor:pointer" type="submit">Add
                                Post</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </div><!-- card -->
            </form>
        </div>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

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
    @endsection