@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category Table</h5>
    </div><!-- sl-page-title -->

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Update Category</h6>

      <div class="table-wrapper">
        <form action="{{url('update/category/'.$category->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name">Category Name</label>
              <input type="text" class="form-control" name="category_name" id="category_name"
                value="{{ $category->category_name }}" required>
            </div>
            <div class="form-group">
              <label for="category_logo">Category Logo</label>
              <input type="file" class="form-control" name="category_logo" id="category_logo">
            </div>

            <div class="form-group">
              <label for="brand_logo">Old Category Logo</label>
              <br><img src="{{URL::to($category->category_logo)}}">
              <input type="hidden" name="old_logo" value="{{ $category->category_logo }}">
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-md pd-x-20">Update</button>
          </div>
        </form>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    @endsection