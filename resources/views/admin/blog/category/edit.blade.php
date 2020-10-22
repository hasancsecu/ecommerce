@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog Category Table</h5>
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
            <h6 class="card-body-title">Update Blog Category</h6>

            <div class="table-wrapper">
                <form action="{{url('update/blog/category/'.$blogCategory->id)}}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="category_name_en">Category Name (EN)</label>
                            <input type="text" class="form-control" name="category_name_en" id="category_name_en"
                                value="{{ $blogCategory->category_name_en }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category_name_bn">Category Name (BN)</label>
                            <input type="text" class="form-control" name="category_name_bn" id="category_name_bn"
                                value="{{ $blogCategory->category_name_bn }}" required>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-md pd-x-20">Update</button>
                    </div>
                </form>
            </div><!-- modal-dialog -->
        </div><!-- modal -->

        @endsection