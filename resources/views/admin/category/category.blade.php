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
        <li class="text-dark">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Category List
        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modaldemo3"
          style="float:right;">Add New</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-25p">Serial No</th>
              <th class="wd-50p">Category name</th>
              <th class="wd-30p">Category Logo</th>
              <th class="wd-25p">Action</th>

            </tr>
          </thead>
          <tbody>
            @foreach($category as $key=>$row)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$row->category_name}}</td>
              <td><img src="{{URL::to($row->category_logo)}}" style="width:50px; height:50px;"></td>
              <td>
                <a href="{{URL::to('edit/category/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                <a href="{{URL::to('delete/category/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->


  <!-- LARGE MODAL -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="{{route('store.category')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name">Category Name</label>
              <input type="text" class="form-control" name="category_name" id="category_name"
                placeholder="Enter Category Name" required>
            </div>
            <div class="form-group">
              <label for="category_logo">Category Logo</label>
              <input type="file" class="form-control" name="category_logo" id="category_logo" required>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-md pd-x-20">Add Item</button>
            <button type="button" class="btn btn-danger btn-md pd-x-20" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

  @endsection