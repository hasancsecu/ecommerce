@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">HalalSell BD</a>
        <a class="breadcrumb-item" href="{{url('/admin/coupons')}}">Coupons</a>
        <span class="breadcrumb-item active">Update Coupon</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Coupon Table</h5>
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
          <h6 class="card-body-title">Update Coupon</h6>

          <div class="table-wrapper">
          <form action="{{url('update/coupon/'.$coupon->id)}}" method="post">
              @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code</label>
                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="{{ $coupon->coupon_code }}" required>
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount (%)</label>
                        <input type="text" class="form-control" name="discount" id="discount" value="{{ $coupon->discount }}" required>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-md pd-x-20">Update</button>
                </div>
              </form>
          </div><!-- modal-dialog -->
        </div><!-- modal -->

@endsection