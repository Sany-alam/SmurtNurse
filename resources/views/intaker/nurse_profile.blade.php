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
          <h5 style="padding-bottom: 1rem;padding-top: 1rem">
            <i class="fa fa-plus-square" style="color: #f5a623;"></i>
             Create Nurse Profile
          </h5>




          <h4 class="card-title" style="border: 2px solid #74d8d4; border-radius: 5px; padding:10px; margin-bottom: 0rem;">
            <i class="fa fa-caret-down" style="color: #4d72c1; font-size: 1.5rem;"></i>
         Nurse Information
          </h4>

          <div class="card-body" style="margin-top: 0rem;">
            <form class="forms-sample">

              <div class="form-group">
                <label for="exampleInputName1">Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Gender <span style="color: red;">*</span></label>
                <select class="form-control" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Language <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="language" placeholder="Bangla">
              </div>


              <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="email" class="form-control" id="email" placeholder="abc@gmail.com">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Nurse Registration No</label>
                <input type="text" class="form-control" id="registration_no" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Phone Number <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="phone_number" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Text">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">City</label>
                <input type="text" class="form-control" id="city" placeholder="Location">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Zip Code</label>
                <input type="text" class="form-control" id="zip" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">County</label>
                <input type="text" class="form-control" id="country" placeholder="">
              </div>

              <div class="form-group">
                <form>
              <div class="row">
                <div class="col-md-12 col-sm-12">

                    <table  class="table table-bordered table-striped" id="tb">
                        <tr class="tr-header">
                            <th>Date</th>
                            <th>Start Time</th>

                            <th></th>

                            <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person"><span class="fa fa-plus"></span></a></th>
                        </tr>
                            <tr class="addrows">

                                <td> <div  class="input-group date datepicker datepicker-popup" >
                                    <input type="text" class="form-control" name="prefered_date[]">
                                    <span class="input-group-addon input-group-append border-left">
                                      <span class="far fa-calendar input-group-text"></span>
                                    </span>
                                  </div></td>
                                <td id="timetd">
                                <!-- <div class="addTime">
                                <input type="text" name="prefered_start_time[]" class="form-control">
                                <a href='javascript:void(0);'  class='removeTime'><span class='fa fa-trash'></span></a>
                                </div> -->
                                <div class="input-group date addDateTime timepicker-example"  data-target-input="nearest">
                                  <div class="input-group datetimepicker" data-target=".timepicker-example" data-toggle="datetimepicker">
                                    <input type="text" class="form-control datetimepicker-input" data-target=".timepicker-example"/>
                                    <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
                                    <a href='javascript:void(0);'  class='removeTime'><span class='fa fa-trash'></span></a>
                                  </div>
                                </div>
                                </td>
                                <td>
                                <a href="javascript:void(0);" style="font-size:18px;" id="addMoretime" title="Add More shift"><span class="fa fa-plus"></span></a>
                                  <!-- <input type="text" name="prefered_finish_time[]" class="form-control"> -->
                                </td>
                                <td>
                                  <a href='javascript:void(0);'  class='remove'><span class='fa fa-trash'></span></a>
                                </td>
                            </tr>


                        </table>

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



								<script>
									$(function(){
										var newRow = $(".addDateTime").clone();
                    $("#timepicker-example").datetimepicker();
                    $("#addMoretime").on("click", function () {

                        newRow.clone().appendTo("#timetd").find(".datetimepicker").datetimepicker();
                    });
										$(document).on('click', '.removeTime', function() {
											var trIndex = $(this).closest(".addDateTime").index();
											if(trIndex>0) {
												$(this).closest(".addDateTime").remove();
											} else {
												alert("Sorry!! Can't remove first td!");
											}
										});
									});


									$(function(){
										var newRow = $(".addrows").clone();

                    $(".datepicker").datepicker();
                    $("#addMore").on("click", function () {

                        newRow.clone().appendTo("#tb").find(".datepicker").datepicker();
                    });


										$(document).on('click', '.remove', function() {
											var trIndex = $(this).closest("tr").index();
											if(trIndex>1) {
												$(this).closest("tr").remove();
											} else {
												alert("Sorry!! Can't remove first row!");
											}
										});
									});
								</script>

                </div>

              </div>
            </form>
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Prefered Area</label>
                <input type="text" class="form-control" id="prefered_area" placeholder="">
              </div>


              <button type="button" id="nurse_information_upload" class="btn btn-primary mr-2">Create Nurse</button>

            </form>
          </div>

          <h4 style="text-align: center;">Or</h4><hr>

          <h5 style="padding-bottom: 1rem;">
            <i class="fa fa-plus-square" style="color: #f5a623;"></i>
             Upload the batch file
          </h5>
          <form method="post" enctype="multipart/form-data" action="{{ url('nurse_file_import') }}">
                        @csrf
          <div class="form-group">
            <label>File upload</label>
            <input type="file" class="file-upload-default" name="select_file" id="customFile" multiple>
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
                                                    <p style="color:red">This record has missing data. Please fill it up and re-upload</p>
                                                    <div class="m-t-25">
                                                        <table id="data-table" class="table table-bordred">
                                                            <thead>
                                                                <tr>
                                                                    <th>Row no</th>
                                                                    <th>Name</th>
                                                                    <th>Gender</th>
                                                                    <th>Language</th>
                                                                    <th>Trained Plan</th>
                                                                    <th>Email Address</th>
                                                                    <th>Nurse Registration No</th>
                                                                    <th>Phone_number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Prefereed Days</th>
                                                                    <th>Prefered Location</th>
                                                                    <th>Prefered Start Times</th>
                                                                    <th>Prefered End Times</th>
                                                                    <th>Prefered Notes</th>

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



  @include('all_js');

  <script src="{{asset('assets')}}/js/formpickers.js"></script>
  <script src="{{asset('assets')}}/js/form-addons.js"></script>
  <script src="{{asset('assets')}}/js/x-editable.js"></script>
  <script src="{{asset('assets')}}/js/dropify.js"></script>
  <script src="{{asset('assets')}}/js/dropzone.js"></script>
  <script src="{{asset('assets')}}/js/jquery-file-upload.js"></script>

  <script src="{{asset('assets')}}/js/form-repeater.js"></script>
  <script src="{{asset('assets')}}/js/file-upload.js"></script>
  <script src="{{asset('assets')}}/js/custom/nurse_profile.js?{{time()}}"></script>




@endsection





