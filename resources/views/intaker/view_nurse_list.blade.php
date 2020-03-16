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
                            <h4>Patients List</h4>


                            <div class="m-t-25" style="overflow-x:auto;overflow-y:scroll;height: 450px;">
                                <table id="data-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nurse Name</th>
                                            <th>Nurse Email</th>
                                            <th>Nurse Registration Number</th>
                                            <th>Phone Number</th>
                                            <th>Prfered Days</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>

                                            {{-- <th>Status</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($nurse_lists as $nurse)

                                        <tr>
                                            <td>{{ $nurse->name }}</td>
                                            <td>{{ $nurse->email_address  }}</td>
                                            <td>{{ $nurse->nurse_registration_no }}</td>
                                            <td>{{ $nurse->phone_number }}</td>
                                            <td>{{ $nurse->prefered_days }}</td>
                                            <td>{{ $nurse->prefered_start_times }}</td>
                                            <td>{{ $nurse->prefered_end_times }}</td>



                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
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






@endsection












        $(function () {

            $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});




        })
        <script src="{{asset('assets')}}/js/vendors.min.js"></script>

        <!-- page js -->
        <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
        <script src="{{asset('assets')}}/js/pages/datatables.js"></script>

        <!-- Core JS -->
        <script src="{{asset('assets')}}/js/app.min.js"></script>
        <script src="{{asset('assets')}}/js/custom/view_user_data.js"></script>

        <script>

                $('#data-table').DataTable({
                    'paging' : true,
                    'lengthChange': false,
                    'searching' : false,
                    'ordering' : false,
                    'info' : false,
                    'autoWidth' : false
                })




        </script>











