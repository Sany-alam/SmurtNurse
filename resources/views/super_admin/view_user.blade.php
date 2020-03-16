@extends('admin.app')

{{-- @section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection --}}

@section('content')

<div class="modal fade bd-example-modal" id="update_password_modal">
    <input type ="hidden" id ="user_id_password" >
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-x: auto;">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa fa-window-close"></i>
                </button>
            </div>
            <div class="modal-body">


                <div class="card" style="overflow-x: auto;">

                    <div class="card-body" style="overflow-x: auto;">


                        <div class="m-t-25">
                         <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="*****">
                                <div class="invalid-feedback" id = "password_error">

                                </div>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Re-type Password</label>
                                <input type="password" class="form-control" id="r-password" placeholder="*****">

                                <div class="invalid-feedback" id = "r_password_error">

                                </div>
                            </div>

                        <div class="form-group col-md-3">

                            <button type="button" id = "update_password" style="float:right" class="btn btn-primary m-t-15">Update</button>

                        </div>

                         </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper" style="background-image: url({{asset('assets')}}/Artboard.png);">
    <div class="row">
      <div class="col-md-12">
          <div class="card-body">


          <ul  class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" href="admin"  id="home-tab" data-toggle="tab"  role="tab" aria-controls="home-1" aria-selected="true" >Admin</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="intaker"  id="home-tab" >Inteker</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="scheduler">Scheduler</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="examiner">Examiner</a>
                  </li>


             </ul>

            <div class="tab-content">
              <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">

                <div class="main-panel">
                    <div class="content-wrapper">
                      <div class="page-header">

                        {{-- <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">view user</li>
                          </ol>
                        </nav> --}}
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="table-responsive">
                                <table id="data-table" class="table table-bordered">
                                  <thead>
                                    <tr style="color: #4d72c1;">
                                        <th></th>
                                        <th>Name</th>
                                        <th>Admin</th>
                                        <th>Inteker</th>
                                        <th>Scheduler</th>
                                        <th>Update Password</th>
                                        <th>Remove User</th>

                                    </tr>
                                  </thead>

                                  <tbody id="user_data_super_admin">



                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- content-wrapper ends -->
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
    <script src="{{asset('assets')}}/js/custom/view_user_data.js"></script>

    <script>
            $( document ).ajaxStart(function() {
                $( ".preload" ).show();
            });

            $( document ).ajaxStop(function() {
                $( ".preload" ).hide();
            });



            $('#data-table').DataTable({
                'paging' : true,
                'lengthChange': false,
                'searching' : false,
                'ordering' : false,
                'info' : false,
                'autoWidth' : false
            })




    </script>






@endsection


