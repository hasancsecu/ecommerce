@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Posts Table</h5>
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
            <h6 class="card-body-title">Posts List
                <a href="{{route('add.blogpost')}}" class="btn btn-sm btn-warning" style="float:right;">Add New</a>
            </h6>

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-20p">Serial No</th>
                            <th class="wd-20p">Post Title</th>
                            <th class="wd-20p">Post Category</th>
                            <th class="wd-20p">Post Image</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->post_title_en}}</td>
                            <td>{{$row->category_name_en}}</td>
                            <td><img src="{{URL::to($row->post_image)}}" height="50px" width="50px"></td>
                            <td>
                                <a href="{{URL::to('edit/post/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/post/'.$row->id)}}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
                                <a href="{{URL::to('view/post/'.$row->id)}}" class="btn btn-sm btn-warning">Show</a>
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