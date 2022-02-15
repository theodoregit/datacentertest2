<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="../img/logo/cbe_logo.png" rel="icon">
  <title>Data Centre Gate Management System - CBE</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->
  <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  <!-- Bootstrap Touchspin -->
  <link href="../vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" >
  <!-- ClockPicker -->
  <link href="../vendor/clock-picker/clockpicker.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="../img/logo/cbe_logo.png" class="rotate">
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
          <span>DC Access Request</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Access Request</h6>
            <a class="collapse-item" href="{{route('dc-manager.index')}}">Dashboard</a>
            <a class="collapse-item" href="{{route('all-requests-dc-man')}}">View All Requests</a>
            <a class="collapse-item" href="{{route('request-form-dc')}}">Fill Request Form</a>    
            <a class="collapse-item" href="{{route('visit-report')}}">Visiting Report</a>        
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
                <img class="img-profile rounded-circle" src="../img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{Auth::user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('dc-manager.my-profile')}}">
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
            <h1 class="h3 mb-0 text-gray-800">Fill New Access Request Form</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Access Request Form</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold" style="color: #460d46">Access Request Form</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('request-form-dc.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row form-group">
                        <div class="col-lg-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <label for="exampleInputFullname"><i style="color: black;">Full Name</i></label>
                              <input class="form-control" type="text" placeholder="" name="fullname" value="{{Auth::user()->name}}" readonly>
                            </div>
                            <div class="col-sm-6">
                              <label for="unit"><i style="color: black;">Unit</i></label>
                              <input class="form-control" type="text" placeholder="" name="unit" value="Infratructure Management" readonly>
                            </div>
                          </div>
                            <label for="exampleInputFullname"><i style="color: black;">Email</i></label>
                            <input class="form-control" type="text" placeholder="" name="email" value="{{Auth::user()->email}}" readonly>
                            <label for="exampleInputEmail1"><i style="color: black;">ID Number</i></label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby=""
                                placeholder="" name="idnumber">
                            <label for="exampleInputPhone"><i style="color: black;">Phone Number</i></label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #460d46" id="basic-addon1">+251</span>
                              </div>
                              <input type="number" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="phonenumber">
                            </div>
                            <label for="exampleInputEmail1"><i style="color: black;">Escorting Team</i></label>
                            <select class="form-control" name="escortingteam">
                              <option value="Infratructure">Infratructure</option>
                              <option value="Operation">Operation</option>
                              <option value="Security">Security</option>
                              <option value="Management">Management</option>
                              <option value="Networking">Networking</option>
                            </select>
                            <label for="exampleInputEmail1"><i style="color: black;">List Escorts</i></label>
                            <textarea name="escorts" class="form-control" id="" cols="30" rows="4.5"  value=""
                              style="margin-top: 0px; margin-bottom: 0px; height: 43px;" placeholder="separate with comma">{{$request->escorts ?? ''}}</textarea>
                              
                            <hr>
                            
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group" id="simple-date4">
                            <label for="dateRangePicker"><i style="color: black;">Select Dates</i></label>
                            <div class="input-daterange input-group">
                              <input type="text" value="{{$request->starting_date ?? ''}}" class="input-sm form-control" name="startdate" placeholder="start"/>
                              <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #460d46">to</span>
                              </div>
                              <input type="text" value="{{$request->end_date ?? ''}}" class="input-sm form-control" name="enddate" placeholder="end(not including)"/>
                            </div>
                          </div>
                          <label for="exampleInputFullname"><i style="color: black;">1st Personnel</i></label>
                          <input class="form-control" value="{{$request->personnel1 ?? ''}}" type="text" placeholder="" name="personnel1">
                          <label for="exampleInputFullname"><i style="color: black;">2nd Personnel</i></label>
                          <input class="form-control" value="{{$request->personnel2 ?? ''}}" type="text" placeholder="" name="personnel2">
                          <label for="exampleInputFullname"><i style="color: black;">3rd Personnel</i></label>
                          <input class="form-control" value="{{$request->personnel3 ?? ''}}" type="text" placeholder="" name="personnel3">
                          <label for="exampleInputFullname"><i style="color: black;">4th Personnel</i></label>
                          <input class="form-control" value="{{$request->personnel4 ?? ''}}" type="text" placeholder="" name="personnel4">
                          <label for="exampleInputFullname"><i style="color: black;"><strong>Add Personnel</strong></i></label>
                          <button class="btn btn-outline-secondary form-control add_button" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>


                          
                          <div class="form-group">
                            
                          </div>
                          
                            <div class="form-group">
                                
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row form-group field_wrapper">
                    </div>
                    <button type="submit" class="btn btn-primary">Save and Continue</button>
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

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../vendor/select2/dist/js/select2.min.js"></script>
  <!-- Bootstrap Datepicker -->
  <script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap Touchspin -->
  <script src="../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
  <!-- ClockPicker -->
  <script src="../vendor/clock-picker/clockpicker.js"></script>
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
<script type="text/javascript">
        $(document).ready(function(){
            var maxField = 7; //Input fields increment limitation
            var number = 5; 
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            
            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $(addButton).click(function(){
              var fieldHTML = '<div class="col-lg-6"'+
                            '<label for="exampleInputFullname"><i style="color: black;">' + number + 'th Personnel</i></label>'+
                            '<input class="form-control" value="{{$request->escorts ?? ''}}" type="text" name="personnel'+number+'" value=""/>'
                            '</div>'; //New input field html
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    number++;
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
        });
    </script>
</body>

</html>