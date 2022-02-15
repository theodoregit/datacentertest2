<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="../../img/logo/cbe_logo.png" rel="icon">
  <title>Data Centre Gate Management System - CBE</title>
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->
  <link href="../../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  <!-- Bootstrap Touchspin -->
  <link href="../../vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" >
  <!-- ClockPicker -->
  <link href="../../vendor/clock-picker/clockpicker.css" rel="stylesheet">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/ruang-admin.min.css" rel="stylesheet">

  <style>
    .rotate {
        animation: rotation 5s infinite linear;
    }

    @keyframes rotation {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(359deg);
        }
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          <img src="../../img/logo/cbe_logo.png" class="rotate">
        </div>
        <div class="sidebar-brand-text mx-3">
          <div class="sidebar-brand-text mx-3">DCGMS</div>
        </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-list-alt"></i>
          <span>Access Request Form</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Access Request</h6>
            <a class="collapse-item" href="{{route('request-form-is')}}">Fill Request Form</a>
            <a class="collapse-item" href="{{route('all-requests')}}">View All Requests</a>
          </div>
        </div>
      </li>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #9106bb;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">0</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifications
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    
                  </div>
                </a>
                
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="../../img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{Auth::user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('unit-manager.my-profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"
                  data-toggle="modal"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" styel="margin-left: 50px;">Access Request Details</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="./">Access Requests</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$request->requestno}}</li>
            </ol>
          </div>
          <div class="row">
            <div class="col-md-2">
              @if($request->is_confirmed == 0 && $request->is_denied == 0)
                <button class="btn btn-block" style="color: blue" data-toggle="modal"
                              data-target="#exampleModalScrollable" id="#modalScroll">Edit Request</button>
                <button class="btn btn-block" style="color: orange" data-toggle="modal" data-target="#exampleModalCenter"
                      id="#modalCenter2">Revoke Request</button>
              @elseif($request->is_denied == 1 && $request->is_confirmed == 0)

              @endif
            </div>
            <div class="col-md-8">
              <table class="table table-bordered align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-light">
                      <tr>
                          <th>Full Name</th>
                          <th>ID Number</th>
                          <th>Phone Number</th>
                      </tr>
                  </thead>
                  <tbody style="color: black; font-weight: bold; font-size: larger">
                      <tr>
                          <td>{{$request->fullname}}</td>
                          <td>{{$request->id_number}}</td>
                          <td>+251-{{$request->phone_number}}</td>
                      </tr>
                  </tbody>
                  <thead class="thead-light">
                      <tr>
                          <th>Personnels</th>
                          <th>Impact</th>
                          <th>Purpose</th>
                      </tr>
                  </thead>                
                  <tbody style="color: black; font-weight: bold; font-size: larger">
                      <tr>
                          <td>
                              <?php
                                  echo $request->personnel1 . '</br>' . $request->personnel2 . '</br>' . $request->personnel3 . '</br>' . $request->personnel4 . '</br>';
                              ?>
                          </td>
                          <td>{{$request->impact}}</td>
                          <td>{{$request->purpose}}</td>
                      </tr>
                  </tbody>
              </table>
              <table class="table table-bordered align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-light">
                      <tr>
                          <th>Access Time</th>
                          <th>Addis Ababa Branch</th>
                          <th>Kera Gofa Branch</th>
                          <th>Locations</th>
                      </tr>
                  </thead>
                  <tbody style="color: black; font-weight: bold; font-size: larger">
                      <tr>
                          <td>{{$request->access_time}}</td>
                          <td>{{$request->addis_ababa_branch}}</td>
                          <td>{{$request->kera_gofa_branch}}</td>
                          <td>{{$request->location}}</td>
                      </tr>
                  </tbody>
                  <thead class="thead-light">
                      <tr>
                          <th>Access is to begin on</th>
                          <th>Access is to end at</th>
                          <th>Duration in days</th>
                          <th>Remaining days</th>
                      </tr>
                  </thead>
                  <tbody style="color: black; font-weight: bold; font-size: larger">
                      <tr>
                          <td>{{$request->starting_date}}</td>
                          <td>{{$request->end_date}}</td>
                          <td>{{$request->visiting_days}}</td>
                          <td>{{$request->remaining_days}}</td>
                      </tr>
                  </tbody>
              </table>
              
          </div>
            <div class="col-md-2">
              
            </div>
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Access Request Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <small>Requester's Contact Information</small>
                      <div class="row">
                          <div class="col-sm-4">
                              <input type="text" value="{{$request->fullname}}">
                          </div>
                          <div class="col-sm-4">
                          <input type="text" value="{{$request->id_number}}">
                          </div>
                          <div class="col-sm-4">
                          <input type="text" value="{{$request->phone_number}}">
                          </div>
                      </div>
                      <hr>
                      <small>Access Request Dates</small>
                      <div class="row">
                          <div class="col-sm-4">
                              <i>From: 11/11/21</i>
                          </div>
                          <div class="col-sm-4">
                              <i>To: 15/11/21</i>
                          </div>
                          <div class="col-sm-4">
                              <i>For: 5 Days</i>
                          </div>
                      </div>
                      <hr>
                      <small>Requester Location and Time</small>
                      <div class="row">
                          <div class="col-sm-4">
                              <i>Addis Ababa Branch Data Centre</i>
                          </div>
                          <div class="col-sm-4">
                              <i>During Normal Business Hours</i>
                          </div>
                          <div class="col-sm-4">
                              <i>Computer Rooms</i>
                          </div>
                      </div>
                      <hr>
                      <small>Visitors</small>
                      <div class="row">
                          <div class="col-sm-6">
                              <i>Tewodros Yesmaw</i><br>
                              <i>Tewodros Yesmaw</i>
                          </div>
                          <div class="col-sm-6">
                              <i>Tewodros Yesmaw</i><br>
                              <i>Tewodros Yesmaw</i>
                          </div>
                      </div>
                      <hr>
                      <small>Location and Impacts</small>
                      <div class="row">
                          <div class="col-sm-6">
                              <i>Rack</i><br>
                              <i>Rack</i>
                          </div>
                          <div class="col-sm-6">
                              <i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                  et dolore magna aliqua.</i>
                          </div>
                      </div>
                      <hr>
                      <small>Purpose</small>
                      <div class="row">
                          <div class="col-sm-12">
                              <i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                  et dolore magna aliqua. Lacinia quis vel eros donec. Nec tincidunt praesent semper feugiat nibh sed
                                  pulvinar proin gravida. Urna cursus eget nunc scelerisque viverra mauris in. Risus sed vulputate
                                  odio ut enim blandit volutpat maecenas. Etiam sit amet nisl purus in mollis nunc. Aliquet bibendum
                                  enim facilisis gravida neque convallis a. Aliquam id diam maecenas ultricies mi eget mauris. Et
                                  malesuada fames ac turpis egestas sed. Venenatis cras sed felis eget.</i>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter">Close </button>
                    <button type="button" class="btn btn-success">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Revoke modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Revoke a Request</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you want to revoke this request?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
                  <form action="{{route('unit-manager.revoke-request')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>      
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="">cbe-sdc team</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../js/ruang-admin.min.js"></script>
  <script src="../../vendor/chart.js/Chart.min.js"></script>
  <script src="../../js/demo/chart-area-demo.js"></script>
  <script src="../../vendor/select2/dist/js/select2.min.js"></script>
  <!-- Bootstrap Datepicker -->
  <script src="../../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap Touchspin -->
  <script src="../../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
  <!-- ClockPicker -->
  <script src="../../vendor/clock-picker/clockpicker.js"></script>
  <script>
    $(document).ready(function () {


      $('.select2-single').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();

      // Bootstrap Date Picker
      $('#simple-date1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,        
      });

      $('#simple-date2 .input-group.date').datepicker({
        startView: 1,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date3 .input-group.date').datepicker({
        startView: 2,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date4 .input-daterange').datepicker({        
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });    

      // TouchSpin

      $('#touchSpin1').TouchSpin({
        min: 0,
        max: 100,                
        boostat: 5,
        maxboostedstep: 10,        
        initval: 0
      });

      $('#touchSpin2').TouchSpin({
        min:0,
        max: 100,
        decimals: 2,
        step: 0.1,
        postfix: '%',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
      });

      $('#touchSpin3').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });

      $('#clockPicker1').clockpicker({
        donetext: 'Done'
      });

      $('#clockPicker2').clockpicker({
        autoclose: true
      });

      let input = $('#clockPicker3').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'top',
        align: 'left',
      });

      $('#check-minutes').click(function(e){        
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
      });

    });
  </script>
  <script language="JavaScript">
    function selects(){  
      var ele=document.getElementsByName('time');  
      for(var i=0; i<ele.length; i++){  
        if(ele[i].type=='checkbox')  
          ele[i].checked=true;  
        }  
      }  
    }
</script>
</body>

</html>