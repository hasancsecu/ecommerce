<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Starlight">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/starlight">
  <meta property="og:title" content="Starlight">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>HalalSell BD Admin Panel</title>

  <!-- vendor css -->
  <link href="{{asset('public/backend/lib/highlightjs/github.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
  <link href="{{asset('public/backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <link href="{{asset('public/backend/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">

  <!-- Starlight CSS -->
  <link rel="stylesheet" href="{{asset('public/backend/css/starlight.css')}}">
</head>

<body>

  @guest

  @else

  <!-- ########## START: LEFT PANEL ########## -->
  <div class="sl-logo"><a href="{{url('/admin/home')}}"><i class="icon ion-android-star-outline"></i> HalalSell BD</a>
  </div>
  <div class="sl-sideleft">
    <div class="sl-sideleft-menu">
      <a href="{{url('/admin/home')}}" class="sl-menu-link active">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Dashboard</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->

      @if(Auth::user()->category == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Category</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('categories')}}" class="nav-link">Category</a></li>
      </ul>
      @else
      @endif


      @if(Auth::user()->product == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Products</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('add.product')}}" class="nav-link">Add Product</a></li>
        <li class="nav-item"><a href="{{route('all.product')}}" class="nav-link">All Products</a></li>
      </ul>
      @else
      @endif

      @if(Auth::user()->order == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Orders</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('admin.order.new')}}" class="nav-link">New Order</a></li>
        <li class="nav-item"><a href="{{route('admin.order.accept')}}" class="nav-link">Accepted Payment</a></li>
        <li class="nav-item"><a href="{{route('admin.order.cancel')}}" class="nav-link">Cancelled Order</a></li>
        <li class="nav-item"><a href="{{route('admin.order.progress')}}" class="nav-link">On Progress</a></li>
        <li class="nav-item"><a href="{{route('admin.order.delivered')}}" class="nav-link">Delivered</a></li>
      </ul>
      @else
      @endif

      @if(Auth::user()->return == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Return Order</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.return.request') }}" class="nav-link">Return Request</a></li>
        <li class="nav-item"><a href="{{ route('admin.all.return') }}" class="nav-link">All Request </a></li>
      </ul>
      @else
      @endif


      @if(Auth::user()->report == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Reports</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">Today's Order</a></li>
        <li class="nav-item"><a href="{{ route('today.delivery') }}" class="nav-link">Today's Delivery </a></li>
        <li class="nav-item"><a href="{{ route('this.month') }}" class="nav-link">This Month </a></li>
        <li class="nav-item"><a href="{{ route('search.report') }}" class="nav-link">Search Report </a></li>
      </ul>
      @else
      @endif

      @if(Auth::user()->role == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">User Role</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('create.admin') }}" class="nav-link">Create User</a></li>
        <li class="nav-item"><a href="{{ route('admin.all.user') }}" class="nav-link">All User </a></li>
      </ul>
      @else
      @endif



      @if(Auth::user()->stock == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Products Stock</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.product.stock') }}" class="nav-link">Stock</a></li>
      </ul>
      @else
      @endif



      @if(Auth::user()->contact == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
          <span class="menu-item-label">Contact Message</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">

        <li class="nav-item"><a href="{{ route('all.message') }}" class="nav-link">All Message </a></li>

      </ul>

      @else
      @endif

      @if(Auth::user()->comment == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
          <span class="menu-item-label">Product Comments </span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href=" " class="nav-link">New Comments</a></li>
        <li class="nav-item"><a href=" " class="nav-link">All Comments </a></li>

      </ul>
      @else
      @endif

      @if(Auth::user()->setting == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
          <span class="menu-item-label">Site Setting </span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.site.setting') }}" class="nav-link">Site Setting</a></li>


      </ul>

      @else
      @endif


      @if(Auth::user()->coupon == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Coupons</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('coupons')}}" class="nav-link">Coupons</a></li>
      </ul>
      @else
      @endif

      @if(Auth::user()->blog == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Blog</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('add.blog.categoryList')}}" class="nav-link">Blog Category</a></li>
        <li class="nav-item"><a href="{{route('add.blogpost')}}" class="nav-link">Add Posts</a></li>
        <li class="nav-item"><a href="{{route('all.blogpost')}}" class="nav-link">Post List</a></li>
      </ul>
      @else
      @endif

      @if(Auth::user()->other == 1)
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
          <span class="menu-item-label">Others</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('admin.newslater')}}" class="nav-link">Newsletter</a></li>
        <li class="nav-item"><a href="{{route('admin.seo')}}" class="nav-link">SEO Settings</a></li>
      </ul>
      @else
      @endif


    </div><!-- sl-sideleft-menu -->

    <br>
  </div><!-- sl-sideleft -->
  <!-- ########## END: LEFT PANEL ########## -->

  <!-- ########## START: HEAD PANEL ########## -->
  <div class="sl-header">
    <div class="sl-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a>
      </div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i
            class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name">{{Auth::user()->name}}</span>
            <img src="{{asset('public/frontend/img/user_img.png')}}" style="width: 30px; height:30px;">
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{route('admin.password.change')}}"><i class="icon ion-ios-gear-outline"></i>Change
                  Password</a>
              </li>
              <li><a href="{{route('admin.logout')}}"><i class="icon ion-power"></i>Log Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
      <div class="navicon-right">
        <a id="btnRightMenu" href="" class="pos-relative">
          <i class="icon ion-ios-bell-outline"></i>
          <!-- start: if statement -->
          <span class="square-8 bg-danger"></span>
          <!-- end: if statement -->
        </a>
      </div><!-- navicon-right -->
    </div><!-- sl-header-right -->
  </div><!-- sl-header -->
  <!-- ########## END: HEAD PANEL ########## -->

  @endguest

  @yield('admin_content')





  <script src="{{asset('public/backend/lib/jquery/jquery.js')}}"></script>
  <script src="{{asset('public/backend/lib/popper.js/popper.js')}}"></script>
  <script src="{{asset('public/backend/lib/bootstrap/bootstrap.js')}}"></script>
  <script src="{{asset('public/backend/lib/jquery-ui/jquery-ui.js')}}"></script>
  <script src="{{asset('public/backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>


  <script src="{{asset('public/backend/lib/highlightjs/highlight.pack.js')}}"></script>
  <script src="{{asset('public/backend/lib/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('public/backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('public/backend/lib/select2/js/select2.min.js')}}"></script>


  <script>
    $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
  </script>

  <script src="{{asset('public/backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('public/backend/lib/d3/d3.js')}}"></script>
  <script src="{{asset('public/backend/lib/rickshaw/rickshaw.min.js')}}"></script>
  <script src="{{asset('public/backend/lib/chart.js/Chart.js')}}"></script>
  <script src="{{asset('public/backend/lib/Flot/jquery.flot.js')}}"></script>
  <script src="{{asset('public/backend/lib/Flot/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('public/backend/lib/Flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('public/backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>


  <script src="{{asset('public/backend/lib/medium-editor/medium-editor.js')}}"></script>
  <script src="{{asset('public/backend/lib/summernote/summernote-bs4.min.js')}}"></script>

  <script src="{{asset('public/backend/js/starlight.js')}}"></script>
  <script>
    $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
          height: 150,
          tooltip: false
        })
      });
  </script>

  <script>
    $(function(){
      'use strict';

      // Inline editor
      var editor = new MediumEditor('.editable');

      // Summernote editor
      $('#summernote1').summernote({
        height: 150,
        tooltip: false
      })
    });
  </script>

  <script>
    $(function(){
    'use strict';

    // Inline editor
    var editor = new MediumEditor('.editable');

    // Summernote editor
    $('#summernote2').summernote({
      height: 150,
      tooltip: false
    })
  });
  </script>

  <script src="{{asset('public/backend/js/ResizeSensor.js')}}"></script>
  <script src="{{asset('public/backend/js/dashboard.js')}}"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <script>
    @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
  </script>

  <script>
    $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are You Sure to Delete?",
                  text: "Once Delete, This will be Deleted Permanently!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Safe Data!");
                  }
                });
            });
  </script>

</body>

</html>