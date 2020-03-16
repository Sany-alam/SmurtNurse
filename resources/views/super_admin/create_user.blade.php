@extends('admin.app')

{{-- @section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection --}}

@section('content')

<div class="content-wrapper" style="background-image: url({{asset('assets')}}//Artboard.png);">
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
                      <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Create User Profile</h4>
                              <p class="card-description">Information</p>
                              <form class="forms-sample">
                                <div class="form-group">
                                  <label for="exampleInputUsername1"><i class="fa fa-user-circle" style="color: #dedede;"></i> Name</label>
                                  <input type="text" class="form-control" id="name" placeholder="John">
                                  <p class="invalid-feedback" id = "name_error"></p>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1"><i class="fa fa-envelope" style="color: #dedede;"></i> Email address</label>
                                  <input type="email" class="form-control" id="email" placeholder="john@gmail.com">
                                  <p class="invalid-feedback" id = "email_error"></p>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1"><i class="fa fa-lock" style="color: #dedede;"></i> Password</label>
                                  <input type="password" class="form-control" id="password" placeholder="*****">
                                  <p class="invalid-feedback" id = "password_error"></p>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputConfirmPassword1"><i class="fa fa-lock" style="color: #dedede;"></i> Confirm Password</label>
                                  <input type="password" class="form-control" id="r-password" placeholder="*****">
                                  <p class="invalid-feedback" id = "r_password_error"></p>
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label for="exampleInputConfirmPassword1"><i class="fa fa-address-book" style="color: #dedede;"></i> User Role</label>
                                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input checkbox user_role"  value="admin">
                              Admin
                            </label>
                          </div>

                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input checkbox user_role" value="intaker">
                              Inteker
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input checkbox user_role"  value="scheduler">
                              Scheduler
                            </label>
                          </div>
                          <p class="invalid-feedback" id = "user_role_error"></p>
                        </div>

                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputConfirmPassword1"><i class="fa fa-camera" style="color: #dedede;"></i> Upload Image</label>
                                    <input type="file" id="upload" enctype="multipart/form-data" class="file-upload-default" accept="image/*" multiple>
                                    <div class="input-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload image file">
                                      <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
                                      </span>

                                    </div>

                                  </div>



                                <button type="button" id="user_creation" class="btn btn-primary mr-2">Create User</button>

                              </form>
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

    </div>
  </div>


@endsection

<script src="{{asset('assets')}}/js/vendors.min.js"></script>

<script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>

    <!-- Core JS -->
    <script src="{{asset('assets')}}/js/app.min.js"></script>
    <script src="{{asset('assets')}}/js/custom/user_creation.js?{{time()}}"></script>

    <script src="{{asset('assets')}}/js/file-upload.js"></script>


    <script>





        $(function() {

            $(".preload").hide();
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });





        })
    </script>




