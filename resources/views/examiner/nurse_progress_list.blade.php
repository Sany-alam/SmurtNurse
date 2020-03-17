@extends('examiner.app')
@section('content')

<div class="content-wrapper" style="background-image: url({{asset('assets')}}/Artboard.png);">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card-body">

                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link" href="admin">Admin</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="intaker">Inteker</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="scheduler">Scheduler</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="examiner" id="home-tab" data-toggle="tab" role="tab" aria-controls="home-1" aria-selected="true">Examiner</a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div style="width:100%;" class="examinar main-panel">
                                <div class="content-wrapper">
                                    <div class="page-header">


                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Patients List</h4>

                                            <div class="col-md-12 col-sm-12 col-lg-12 m-t-25">
                                                <table id="data-table" class="table table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nurse Name</th>
                                                            <th>Nurse Email</th>
                                                            <th>Phone Number</th>
                                                            <th>Nurse Status</th>
                                                            <th>Nurse Progresson</th>
                                                            <th>Assesment Form Confirmation</th>
                                                            <th>Assesment Form</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($nurse_lists as $nurse)

                                                        <tr>
                                                            <td>{{ $nurse->nurse_name }}</td>
                                                            <td>{{ $nurse->nurse_email }}</td>
                                                            <td>{{ $nurse->nurse_phone_number }}</td>
                                                            <td>{{ $nurse->nurse_status }}</td>
                                                            <td>
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $nurse->nurse_progression }}%" aria-valuenow="{{ $nurse->nurse_progression }}" aria-valuemin="0" aria-valuemax="100">{{ $nurse->nurse_progression }}%</div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $nurse->assesment_form_confirmation }}</td>
                                                            @if($nurse->form === "Form Not Available")
                                                            <td>{{ $nurse->form }}</td>
                                                            @else
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" onclick="show_nurse_assesment_form({{ $nurse->form }})">Form</button>
                                                            </td>
                                                            @endif

                                                        </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>>

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<div class="modal fade modal-lg" id="nurse_assesment_form_modal" style="padding-right:0px;margin-left:100px;align:center" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="overflow-x: auto;">
            <div class="modal-header" style="text-align:center">

                <h4 style="text-align:center">Nurse Assesment Form</h4>

                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="card" style="overflow-x: auto;">

                    <div class="card-body" style="overflow-x: auto;">


                        <div class="m-t-25">

                            <table id="data-table" class="table">

                                <tbody id="assign_nurse">


                                </tbody>

                            </table>
                            <button type="button" class="btn btn-primary btn-sm" id="edit_form" onclick="edit_form_checkbox_show()">Edit</button>
                            <button type="button" class="btn btn-primary btn-sm" id="accept_form" onclick="accept_form()">Accept</button>

                            <button type="button" class="btn btn-primary btn-sm" id="send_form" onclick="send_form()">Send Form</button>
                            <button type="button" class="btn btn-primary btn-sm" id="cancel_edit" onclick="cancel_edit()">Cancel</button>
                           <input type="hidden" id="hidden_scheduler_id">

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

<script src="{{asset('assets')}}/js/app.min.js"></script>
<script src="{{asset('assets')}}/js/custom/nurse_assesment_form.js?{{time()}}"></script>

<script>
    $('#data-table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false

    })
</script>

