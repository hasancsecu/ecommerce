@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Order Details</h5>
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
            <h6 class="card-body-title">Order List </h6>

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-13p">Payment Type</th>
                            <th class="wd-13p">Transaction Amount</th>
                            <th class="wd-13p">SubTotal</th>
                            <th class="wd-13p">Shipping</th>
                            <th class="wd-13p">Total</th>
                            <th class="wd-13p">Date</th>
                            <th class="wd-13p">Status</th>
                            <th class="wd-13p">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $row)
                        <tr>
                            <td>{{$row->payment_type}}</td>
                            <td>{{$row->transaction}}</td>
                            <td>Tk.{{$row->subtotal}}</td>
                            <td>Tk.{{$row->shipping}}</td>
                            <td>Tk.{{$row->total}}</td>
                            <td>Tk.{{$row->date}}</td>
                            <td> @if($row->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($row->status == 1)
                                <span class="badge badge-info">Payment Accepted</span>
                                @elseif($row->status == 2)
                                <span class="badge badge-warning">On Progress</span>
                                @elseif($row->status == 3)
                                <span class="badge badge-success">Delivered</span>

                                @else
                                <span class="badge badge-danger">Cancelled</span>

                                @endif</td>
                            <td>
                                <a href="{{URL::to('admin/view/order/'.$row->id)}}" class="btn btn-sm btn-info">View</a>

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