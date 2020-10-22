@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Product Table</h5>
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
            <h6 class="card-body-title">Product List
                <a href="{{route('add.product')}}" class="btn btn-sm btn-warning" style="float:right;">Add New</a>
            </h6>

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-12p">Product name</th>
                            <th class="wd-12p">Product Code</th>
                            <th class="wd-12p">Image</th>
                            <th class="wd-12p">Category</th>
                            <th class="wd-12p">Quantity</th>
                            <th class="wd-12p">Price</th>
                            <th class="wd-10p">Status</th>
                            <th class="wd-16p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key=>$row)
                        <tr>
                            <td>{{$row->product_name}}</td>
                            <td>{{$row->product_code}}</td>
                            <td><img src="{{URL::to($row->image_one)}}" height="50px" width="50px"></td>
                            <td>{{$row->category_name}}</td>
                            <td>{{$row->product_quantity}}</td>
                            <td>{{$row->discount_price}}</td>
                            <td>
                                @if($row->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{URL::to('edit/product/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/product/'.$row->id)}}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
                                <a href="{{URL::to('view/product/'.$row->id)}}" class="btn btn-sm btn-warning">Show</a>
                                @if($row->status == 1)
                                <a href="{{URL::to('inactive/product/'.$row->id)}}"
                                    class="btn btn-sm btn-danger">Inactive</a>
                                @else
                                <a href="{{URL::to('active/product/'.$row->id)}}"
                                    class="btn btn-sm btn-success">Active</a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->



    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    @endsection