@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Subscribers Table</h5>
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
          <h6 class="card-body-title">Subscribers List</h6>

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-20p">Serial No</th>
                  <th class="wd-30p">Email</th>
                  <th class="wd-30p">Subscribing Time</th>
                  <th class="wd-20p">Action</th>

                </tr>
              </thead>
              <tbody>
              @foreach($newslater as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->email}}</td>
                  <td>{{\Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                  <td>
                    <a href="{{URL::to('delete/newslater/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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