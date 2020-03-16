@extends('admin.app')

{{-- @section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection --}}

@section('content')

<div class="content-wrapper" style="background-image: url({{asset('assets')}}/Artboard.png);">
    <div class="row">
      <div class="col-md-12">
          <div class="card-body">


            @include('nav_list')
            <div class="tab-content">
              <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">


                    <div class="content-wrapper">
                      <div class="page-header">

                        {{--  <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">view user</li>
                          </ol>
                        </nav>  --}}
                      </div>
                      <div class="card">
                        <div class="card-body">
                            <div class="row" style="margin-bottom:20px">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card custom-card-admin">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-b-0" style="color:white;font-weight:bold;font-size:16px">Total Pending Patient</p>
                                                    <h2 class="m-b-0" style="color:white;font-weight:bold">
                                                        <span>{{$total_pedning_patient}}</span>
                                                    </h2>
                                                </div>
                                                <div class="avatar avatar-icon avatar-lg avatar-gold" style="color:white;font-weight:bold">
                                                    <i class="icon-lg fa fa-stethoscope mr-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="card custom-card-admin">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-b-0" style="color:white;font-weight:bold;font-size:16px">Assigned Patient</p>
                                                    <h2 class="m-b-0" style="color:white;font-weight:bold">
                                                        <span>{{ $total_assign_patient }}</span>
                                                    </h2>
                                                </div>
                                                <div class="avatar avatar-icon avatar-lg avatar-cyan" style="color:white;font-weight:bold">
                                                    <i class="icon-lg fa fa-hospital mr-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="card custom-card-admin">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-b-0" style="color:white;font-weight:bold;font-size:16px">Assigned Nurse</p>
                                                    <h2 class="m-b-0" style="color:white;font-weight:bold">
                                                        <span>{{ $total_assign_nurse }}</span>
                                                    </h2>
                                                </div>
                                                <div class="avatar avatar-icon avatar-lg avatar-red;" style="color:white;font-weight:bold">
                                                    <i class="icon-lg fa fa-female mr-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="card custom-card-admin">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-b-0" style="color:white;font-weight:bold;font-size:16px">Occupied Nurse</p>
                                                    <h2 class="m-b-0" style="color:white;font-weight:bold">
                                                        <span>{{ $occupied_nurse }}</span>
                                                    </h2>
                                                </div>
                                                <div class="avatar avatar-icon avatar-lg avatar-gold" style="color:white;font-weight:bold">
                                                    <i class="icon-lg fa fa-user-md mr-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                              <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h5>Assigned Patients</h5>
                                                            <div>
                                                                <div class="btn-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-t-50" style="height: 330px">
                                                            <canvas class="chart" id="assigned_patient"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h5>Assigned Nurse</h5>
                                                            <div>
                                                                <div class="btn-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-t-50" style="height: 330px">
                                                            <canvas class="chart" id="assigned_nurse"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h5>Occupied Nurse</h5>
                                                            <div>
                                                                <div class="btn-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-t-50" style="height: 330px">
                                                            <canvas class="chart" id="occupied_nurse"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>


                                          <script src="{{asset('assets')}}/js/vendors.min.js"></script>
                                          <script src="{{asset('assets')}}/js/app.min.js"></script>
                                          <script src="{{ asset('assets') }}/vendors/chartjs/Chart.min.js"></script>
                                          <script src="{{asset('assets')}}/js/custom/custom_chart.js"></script>




                    {{--
                                        <script>
                    var ctx = document.getElementById('assigned_patient').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['21-12-2019', '22-12-2019', '23-12-2019', '24-12-2019', '25-12-2019', '26-12-2019','27-12-2019'],
                            datasets: [{
                                label: '# of Patients',
                                data: [12, 19, 3, 5, 8, 3,10],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });





                    </script> --}}



                            <script src="{{ asset('assets') }}/js/vendors.min.js"></script>

                            <!-- page js -->

                            <script src="{{ asset('assets') }}/js/pages/dashboard-default.js"></script>

                            <!-- Core JS -->
                            <script src="{{ asset('assets') }}/js/app.min.js"></script>
                        </div>
                      </div>
                    </div>



              </div>


            </div>
          </div>

      </div>

    </div>
  </div>
  <script src="{{asset('assets')}}/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>

    <!-- Core JS -->
    <script src="{{asset('assets')}}/js/app.min.js"></script>


    <script>
            $( document ).ajaxStart(function() {
                $( ".preload" ).show();
            });

            $( document ).ajaxStop(function() {
                $( ".preload" ).hide();
            });



            $('#data-table').DataTable({
                'paging' : true,
                'lengthChange': true,
                'searching' : true,
                'ordering' : false,
                'info' : false,
                'autoWidth' : false
            })







    </script>






@endsection


