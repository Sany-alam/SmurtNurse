@extends('intaker.app')



@section('content')


<div class="content-wrapper" style="background-image: url({{asset('assets')}}/Artboard.png);">
    <div class="row">
      <div class="col-md-12">
          <div class="card-body">

             <ul  class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link" href="admin" >Admin</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link active" href="intaker"  id="home-tab" data-toggle="tab"  role="tab" aria-controls="home-1" aria-selected="true" >Inteker</a>
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
                <div class="media">
                  <div class="col-12 grid-margin stretch-card">

        <div class="card" style="border: 0px;padding:60px">
          <h5 style="padding-bottom: 1rem;padding-top: 1rem;">
            <i class="fa fa-plus-square" style="color: #f5a623;"></i>
             Create Patient Profile
          </h5>

          <h4 class="card-title" style="border: 2px solid #74d8d4; border-radius: 5px; padding:10px; margin-bottom: 0rem;">
            <i class="fa fa-caret-down" style="color: #4d72c1; font-size: 1.5rem;"></i>
          Member Control
          </h4>

          <div class="card-body" style="margin-top: 0rem;">
            <form class="forms-sample">
              <div class="form-group">
                <label for="exampleInputName1">Insurance Plan <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="insurance_plan" placeholder="text">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Date Recieved <span style="color: red;">*</span></label>
                <div  class="input-group date datepicker datepicker-popup" >
                    <input type="text" class="form-control" id="date_received"  format="dd-mm-yyyy">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="far fa-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword4">Date need to finished <span style="color: red;">*</span></label>
                <div  class="input-group date datepicker datepicker-popup">
                    <input type="text" class="form-control" id="date_need_to_be_finished">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="far fa-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword4">Assesment Type <span style="color: red;">*</span></label>
                <select class="form-control" id="assesment_type">
                    <option value="primary">Primary</option>
                    <option value="re-assesment">Re-Assesment</option>
                  </select>
              </div>
            </form>
          </div>


          <h4 class="card-title" style="border: 2px solid #74d8d4; border-radius: 5px; padding:10px; margin-bottom: 0rem;">
            <i class="fa fa-caret-down" style="color: #4d72c1; font-size: 1.5rem;"></i>
         Personal Information
          </h4>

          <div class="card-body" style="margin-top: 0rem;">
            <form class="forms-sample">
              <div class="form-group">
                <label for="exampleInputName1">Medicate ID</label>
                <input type="text" class="form-control" id="medicaid_id" placeholder="p-100">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Member ID</label>
                <input type="text" class="form-control" id="member_id" placeholder="50">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">First Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="first_name" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Last Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="last_name" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Sex <span style="color: red;">*</span></label>
                <select class="form-control" id="sex">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Date of Birth <span style="color: red;">*</span></label>
                <div  class="input-group date datepicker datepicker-popup">
                    <input type="text" class="form-control" id="date_of_birth">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="far fa-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Primary Language </label>
                <input type="text" class="form-control" id="primary_language" placeholder="Bangla">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Cell-Phone</label>
                <input type="text" class="form-control" id="cell_phone" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Home-Phone </label>
                <input type="text" class="form-control" id="home_phone" placeholder="text">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Matrial Status</label>
                <input type="text" class="form-control" id="marital_status" placeholder="UM">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="email" class="form-control" id="email" placeholder="abc@gmail.com">
              </div>
            </form>
          </div>



          <h4 class="card-title" style="border: 2px solid #74d8d4; border-radius: 5px; padding:10px; margin-bottom: 0rem;">
            <i class="fa fa-caret-down" style="color: #4d72c1; font-size: 1.5rem;"></i>
          Address
          </h4>

          <div class="card-body" style="margin-top: 0rem;">

              <div class="form-group">
                <label for="exampleInputName1">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Text">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">City</label>
                <input type="text" class="form-control" id="city" placeholder="Location">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">State or Region</label>
                <input type="text" class="form-control" id="state" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Zip Code</label>
                <input type="text" class="form-control" id="zip_code" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Country</label>
                <input type="text" class="form-control" id="country" placeholder="">
              </div>

            <button type="submit" class="btn btn-primary mr-2" id="patient_form_submit">Create User</button>
          </div>

          <h4 style="text-align: center;">Or</h4><hr>

          <h5 style="padding-bottom: 1rem;">
            <i class="fa fa-plus-square" style="color: #f5a623;"></i>
             Upload the batch file
          </h5>
          <div class="form-group">
              <form method="post" enctype="multipart/form-data" action="{{ url('import') }}">
                @csrf
                <label>File upload</label>
                <input type="file" name="select_file" id="customFile"  class="file-upload-default" multiple>
                <div class="input-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Excel File">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
                  </span>
                  <div class="col-md-2 col-sm-2 col-lg-2">
                    <button class="btn btn-primary btn-md" type="button" id="upload">
                        <i class="fas fa-cloud-upload-alt" style="font-size:25px"></i>
                    </button>
                </div>

                </div>
              </form>

              </div>


              <div class="modal fade bd-example-modal-lg" id="excel_error_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="overflow-x: auto;">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card" style="overflow-x: auto;">
                                <div class="card-body" style="overflow-x: auto;">
                                    <h4>Missing Data</h4><span style="float:right" ><a href="{{ url('export') }}"><button type="button" id="export" class="btn btn-primary">Download Missing Data</button></a></span>
                                    <p style="color:red">Some record has missing data. Please fill it up and re-upload</p>
                                    <div class="m-t-25">
                                        <table id="data-table" class="table table-bordred">
                                            <thead>
                                                <tr>
                                                    <th>Row no</th>


                                                    <th>Medicaid Id</th>
                                                    <th>Member Id</th>
                                                    <th>Frst Name</th>
                                                    <th>Last Name</th>

                                                    <th>Date of Birth</th>
                                                    <th>Language</th>
                                                    <th>Cell Phone</th>
                                                    <th>Home Phone</th>

                                                    <th>Address</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Zip Code</th>
                                                    <th>Coutry</th>
                                                </tr>
                                            </thead>
                                            <tbody id="missing_data">


                                            </tbody>
                                            {{-- <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </tfoot> --}}
                                        </table>
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
          </div>

      </div>

    </div>
  </div>
  <script>

  </script>

  @include('all_js');
  <script src="{{asset('assets')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{asset('assets')}}/js/custom/patient_profile.js?{{time()}}"></script>

<script src="{{asset('assets')}}/js/app.min.js"></script>




  <script src="{{asset('assets')}}/js/formpickers.js?{{time()}}"></script>



  <script src="{{asset('assets')}}/js/file-upload.js"></script>











@endsection




