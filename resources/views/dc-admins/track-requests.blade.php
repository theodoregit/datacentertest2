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
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
        <div class="sidebar-brand-text mx-3">DCGMS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-list-alt"></i>
          <span>Requests</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Access Request</h6>
            <a class="collapse-item" href="{{route('approved-requests')}}">View All Requests</a>
            <a class="collapse-item" href="{{route('reception-screen')}}">Reception Screen</a>            
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
                <a class="dropdown-item" href="{{route('dc-admin.my-profile')}}">
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
            <h1 class="h3 mb-0 text-gray-800">Track Access Requests</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Track Requests</li>
            </ol>
          </div>
          @if ($errors->any())
                  <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item">
                      <div class="alert alert-danger alert-dismissible fade-show" role="alert">
                        <strong>{{$error}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>                                               
                      </div>
                    </li>                            
                    @endforeach
                  </ul> 
                  @endif
            <div class="row">
                @if($diffs >= 0 && $diffe < 0)
                  <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="">
                        <form action="{{route('track')}}" method="post">
                          {{csrf_field()}}
                          <thead class="thead-light">
                              <tr>
                                  <th>Actions</th>
                                  <th>Request ID</th>
                                  <th>Date</th>
                                  <th>Data Center Location</th>
                                  <th class="text-center">Visiting Time</th>
                                  <th><button type="submit" value="save" name="submitiontype">Save</button></th>
                                  
                              </tr>
                          </thead>
                          <tbody>                            
                              <tr>
                                  <td>
                                    <div class="btn-group dropright">
                                      <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      </a>
                                      <div class="dropdown-menu">                                  
                                        <a href="{{route('dc-admin-request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $track_request->requestno)])}}" class="dropdown-item">Details</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong">Log Book</a>
                                      </div>
                                    </div>
                                  </td>
                                  <td>{{$track_request->requestno}}</td>
                                  <td>
                                    <?php
                                      echo date('Y-m-d');
                                    ?>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio3" name="location" class="custom-control-input" value="1">
                                          <label class="custom-control-label" for="customRadio3">Addis Ababa Branch Data Centre</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio4" name="location" class="custom-control-input" value="2">
                                          <label class="custom-control-label" for="customRadio4">Kera/ GofaSefer Branch Data Centre</label>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                      
                                          <input type="text" style="display: none" name="requestno" value="{{$track_request->requestno}}">
                                          <input type="text" style="display: none" name="visiting_date" value="<?php echo date('Y-m-d'); ?>">
                                          <input type="text" style="display: none" name="admin_name" value="{{Auth::user()->name}}">
                                          <div class="row">
                                            <!-- <div class="col-xl-6 col-md-6 mb-4">
                                              <div class="card h-100">
                                                <div class="card-body">
                                                  <div class="row align-items-center">
                                                    <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-uppercase mb-1">Morning Time</div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                      </div>
                                                      <div class="row mt-2 mb-0 text-muted text-xs">
                                                        
                                                        <div class="col-sm-6">
                                                          <div class="form-group">
                                                            <label for="clockPicker2">start</label>
                                                            <div class="input-group clockpicker" id="clockPicker1">
                                                              <input type="text" class="form-control" value="{{$track->morning_start}}" name="morning_start">
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <div class="form-group">
                                                            <label for="clockPicker2">end</label>
                                                            <div class="input-group clockpicker" id="clockPicker2">
                                                              <input type="text" class="form-control" value="{{$track->morning_end}}" name="morning_end">
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> -->

                                            <div class="col-xl-12 col-md-6 mb-4">
                                              <div class="card h-100">
                                                <div class="card-body">
                                                  <div class="row align-items-center">
                                                    <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-uppercase mb-1">Log book</div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                      </div>
                                                      <div class="row mt-2 mb-0 text-muted text-xs">
                                                        
                                                        <div class="col-sm-6">
                                                          <div class="form-group">
                                                            <label for="clockPicker2">check-in</label>
                                                            <div class="input-group clockpicker" id="clockPicker3">
                                                              <input type="text" class="form-control" value="{{$track->afternoon_start}}" name="checkin">
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <div class="form-group">
                                                            <label for="clockPicker2">check-out</label>
                                                            <div class="input-group clockpicker" id="clockPicker4">
                                                              <input type="text" class="form-control" value="{{$track->afternoon_end}}" name="checkout">
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>                                            
                                          </div>
                                      
                                  </td>
                              </tr>                            
                          </tbody>
                      </table>
                      <table class="table align-items-center table-flush table-hover" id="">
                          <thead class="thead-light">
                              <tr>
                                  <!-- <th>
                                    <label for="">Data Center Location</label>
                                  </th> -->
                                  <th>
                                    <label for="select2Multiple">Select Visiting Personnels</label>
                                  </th>                                  
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <!-- <td>
                                    <div class="form-group">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio3" name="location" class="custom-control-input" value="1">
                                          <label class="custom-control-label" for="customRadio3">Addis Ababa Branch Data Centre</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio4" name="location" class="custom-control-input" value="2">
                                          <label class="custom-control-label" for="customRadio4">Kera/ GofaSefer Branch Data Centre</label>
                                      </div>
                                    </div>
                                  </td> -->
                                  <td>
                                      <div class="form-group">
                                          
                                          <select class="select2-multiple form-control" name="personnels[]" multiple="multiple"
                                          id="select2Multiple">
                                              @foreach($personnels as $personnel)
                                                  <option value="{{$personnel}}" selected>{{$personnel}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </td>                           
                              </tr>                  
                          </tbody>
                          </form>
                      </table>
                  </div>
                @else
                  <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="">
                        <form action="{{route('track')}}" method="post">
                          <thead class="thead-light">
                              <tr>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>                            
                              <tr>                                  
                                  <td>
                                    No active visiting dates!
                                  </td>
                              </tr>                            
                          </tbody>
                      </table>                      
                  </div>
                @endif
            </div>

            {{-- Modal LogBook --}}
            <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Log Book for Request: {{$track_request->requestno}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table class="table align-items-center table-flush table-hover" id="">
                        <thead class="thead-light">
                          <tr>
                            {{-- <th>Admin Name</th> --}}
                            <th>Visiting Date</th>
                            <th>DC Admin</th>
                            <th>Location</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Visiting Personnels</th>
                            <th></th>
                          </tr>
                        </thead>                    
                        <tbody>
                          @foreach($checks as $check)
                          <tr>
                            {{-- <td>{{Auth::user()->name}}</td> --}}
                            <td>{{$check->date}}</td>
                            <td>{{$check->admin}}</td>
                            <td>
                              @if ($check->location == 1)
                                  Addis Ababa Branch
                              @else
                                  Kera/ Gofa Branch
                              @endif  
                            </td>
                            <td>{{$check->checkedin}}</td>
                            <td>
                              @if ($check->checkedout == '')
                                <form action="{{route('dc-admin.update-check')}}" method="post">
                                  {{csrf_field()}}
                                  <input type="text" name="created_at" value="{{$check->created_at}}" style="display: none">
                                  <input type="text" class="" name="checkoutupdate">                                  
                              @else
                                {{$check->checkedout}}
                              @endif                              
                            </td>
                            <td>{{$check->personnels}}</td>
                            <td>
                              @if ($check->checkedout == '')
                                  <button type="submit">update</button> </form>
                              @else
                                  
                              @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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
  <!-- datatables -->
  <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
        autoclose: true
      });

      $('#clockPicker2').clockpicker({
        autoclose: true
      });

      $('#clockPicker3').clockpicker({
        autoclose: true
      });

      $('#clockPicker4').clockpicker({
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

  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>