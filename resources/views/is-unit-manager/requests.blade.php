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
        <div class="sidebar-brand-text mx-3">DCGMS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-list-alt"></i>
          <span>Access Request</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Access Request</h6>
            <a class="collapse-item" href="{{route('request-form-is')}}">Fill Request Form</a>
            <a class="collapse-item" href="#">View All Requests</a>
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
            <h1 class="h3 mb-0 text-gray-800">All Access Requests</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Access Requests</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Tabs navs -->
              <ul class="nav nav-tabs nav-justified mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link active"
                    id="ex3-tab-1"
                    data-mdb-toggle="tab"
                    href="#all"
                    role="tab"
                    aria-controls="ex3-tabs-1"
                    aria-selected="true"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-secondary"><i class="fa fa-list" aria-hidden="true"></i> All Requests</span> </h4></a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-2"
                    data-mdb-toggle="tab"
                    href="#pending"
                    role="tab"
                    aria-controls="ex3-tabs-2"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-primary"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Pending</span> </h4>  </a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-3"
                    data-mdb-toggle="tab"
                    href="#confirmed"
                    role="tab"
                    aria-controls="ex3-tabs-3"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-info"><i class="fa fa-check" aria-hidden="true"></i> Confirmed</span> </h4></a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-4"
                    data-mdb-toggle="tab"
                    href="#denied"
                    role="tab"
                    aria-controls="ex3-tabs-4"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-warning"><i class="fa fa-ban" aria-hidden="true"></i> Denied</span> </h4></a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-5"
                    data-mdb-toggle="tab"
                    href="#approved"
                    role="tab"
                    aria-controls="ex3-tabs-5"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approved</span> </h4></a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-6"
                    data-mdb-toggle="tab"
                    href="#rejected"
                    role="tab"
                    aria-controls="ex3-tabs-6"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Rejected</span> </h4></a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="ex3-tab-7"
                    data-mdb-toggle="tab"
                    href="#expired"
                    role="tab"
                    aria-controls="ex3-tabs-7"
                    aria-selected="false"
                    ><h4 style="color: #90199b"><span class="badge badge-outline-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Expired</span> </h4></a
                  >
                </li>
              </ul>
              <!-- Tabs content -->
              <div class="tab-content" id="ex2-content">
                <div
                  class="tab-pane fade show active"
                  id="all"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-1"
                >
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">All Access Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Remaining Days</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($requests as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>{{$request->remaining_days}}</td>
                            <td>
                              @if($request->status == 0)
                                <strong style=""><span class="badge badge-primary"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Pending</span></strong>
                              @elseif($request->status == 1)
                                <strong style=""><span class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i> Confirmed</span></strong>
                              @elseif($request->status == 2)
                                <strong style=""><span class="badge badge-warning"><i class="fa fa-ban" aria-hidden="true"></i> Denied</span></strong>
                              @elseif($request->status == 3)
                                <strong style=""><span class="badge badge-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Granted</span></strong>
                              @elseif($request->status == 4)
                                <strong style=""><span class="badge badge-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Rejected</span></strong>     
                              @elseif($request->status == 5)
                                <strong style=""><span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Expired</span></strong>                         
                              @else
                                
                              @endif
                            </td>
                            <td>
                              <div class="btn-group dropright">
                                  <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status > 5)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="pending"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-2"
                >
                
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Pending Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Remaining Days</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($pending as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>{{$request->remaining_days}}</td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status >= 4)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
                <div
                  class="tab-pane fade"
                  id="confirmed"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-3"
                >
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Confirmed Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Remaining Days</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($confirmed as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>{{$request->remaining_days}}</td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status >= 4)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="denied"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-3"
                >
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Denied Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Remaining Days</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($denied as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>{{$request->remaining_days}}</td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status >= 4)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="approved"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-3"
                >
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Approved Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Remaining Days</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($approved as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>{{$request->remaining_days}}</td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status >= 4)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="rejected"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-3"
                >
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Rejected Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Access Time</th>
                            <th>Rejection Reason</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($rejected as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->access_time}}</td>
                            <td>
                              <?php
                                // strip tags to avoid breaking any html
                                $string = strip_tags($request->rejection_reason);
                                if (strlen($string) > 50) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 50);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= '... <a href="/this/story">Read More</a>';
                                }
                                echo $string;
                              ?>
                            </td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  @if($request->status >= 4)
                                  {{-- <a class="dropdown-item" style="cursor: not-allowed; pointer-events: all !important;"><strong>&nbsp Revoke</strong></a> --}}
                                  <?php
                                    $request_no = $request->requestno;
                                  ?>
                                  @else
                                    <form action="{{route('unit-manager.revoke-request')}}" method="post">
                                      {{csrf_field()}}
                                      <input type="text" value="{{$request->requestno}}" name="revoke" style="display: none;">
                                      <button type="submit" class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> <strong>&nbsp Revoke</strong></button>
                                    </form>
                                  <!-- <button class="btn btn-warning btn-sm" style="" data-toggle="modal" data-target="#exampleModalCenter"
                                  id="#modalCenter2">Revoke</button> -->
                                  @endif                                 
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="expired"
                  role="tabpanel"
                  aria-labelledby="ex3-tab-7"
                >
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold" style="color: #460d46">Expired Requests</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                          <tr>
                            <th>Request ID</th>
                            <th>Addis Ababa Data Center</th>
                            <th>Kera/ Gofa Data Center</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($expired as $request)
                          <tr>
                            <td>{{$request->requestno}}</td>
                            <td>{{$request->addis_ababa_branch}}</td>
                            <td>{{$request->kera_gofa_branch}}</td>
                            <td>{{$request->starting_date}}</td>
                            <td>{{$request->end_date}}</td>
                            <td>
                              <div class="btn-group dropright">
                                <a type="button" class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu">                                  
                                  <a class="dropdown-item" href="{{route('request-details', ['requestno' => preg_replace('/[^a-zA-Z0-9\s]/', '', $request->requestno)])}}">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                                    <strong>&nbsp Details</strong>
                                  </a>                                
                                </div>
                              </div>
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
          <!-- Rejection Modal -->
          
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
                  {{-- <form action="{{route('unit-manager.revoke-request')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" value="<?php //echo $request->requestno; ?>" name="revoke" style="display: none;">
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </form> --}}
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
  <script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
      triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
          event.preventDefault()
          tabTrigger.show()
        })
      });
  </script>

</body>

</html>