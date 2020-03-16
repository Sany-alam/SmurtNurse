$(document).ajaxStart(function() {
    $(document).ajaxStart(function() {
        window.swal({
           //  title: "Loading...",
           //  text: "Please wait",
            icon: "image/loadingSWAL.gif",
   
            button: false,
            closeOnClickOutside: false,
            closeOnEsc: false
        });
        $('.swal-icon').css({
           "height":"180px",
        });
    });

});

$(document).ajaxStop(function() {
    swal.close();
});


$(function() {



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


})

$("#patient_form_submit").on('click', function() {

    //var date_received = $("#date_received").datepicker({ dateFormat: 'dd-mm-yy' }).val();


    var date_received = $("#date_received").val().split('/');
    var date_received = date_received[1] + '-' + date_received[0] + '-' + date_received[2];
    var date_need_to_be_finished = $("#date_need_to_be_finished").val();
    var date_need_to_be_finished = date_need_to_be_finished[1] + '-' + date_need_to_be_finished[0] + '-' + date_need_to_be_finished[2];
    var date_of_birth = $("#date_of_birth").val();
    var date_of_birth = date_of_birth[1] + '-' + date_of_birth[0] + '-' + date_of_birth[2];

    //alert(date_received);

    var insurance_plan = $("#insurance_plan").val();


    var medicaid_id = $("#medicaid_id").val();
    var member_id = $("#member_id").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var sex = $("#sex").val();

    var primary_language = $("#primary_language").val();
    var cell_phone = $("#cell_phone").val();
    var home_phone = $("#home_phone").val();
    var marital_status = $("#marital_status").val();
    var email = $("#email").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var zip_code = $("#zip_code").val();
    var country = $("#country").val();
    var assesment_type = $("#assesment_type").val();
    // //alert(assesment_type);

    var formdata = new FormData();
    formdata.append('insurance_plan', insurance_plan);
    formdata.append('date_received', date_received);
    formdata.append('date_need_to_be_finished', date_need_to_be_finished);
    formdata.append('medicaid_id', medicaid_id);
    formdata.append('member_id', member_id);
    formdata.append('first_name', first_name);
    formdata.append('last_name', last_name);
    formdata.append('sex', sex);
    formdata.append('date_of_birth', date_of_birth);
    formdata.append('primary_language', primary_language);
    formdata.append('cell_phone', cell_phone);
    formdata.append('home_phone', home_phone);
    formdata.append('marital_status', marital_status);
    formdata.append('email', email);
    formdata.append('address', address);
    formdata.append('city', city);
    formdata.append('state', state);
    formdata.append('zip_code', zip_code);
    formdata.append('country', country);
    formdata.append('assesment_type', assesment_type);

    $.ajax({
        processData: false,
        contentType: false,
        url: 'patient_information_upload',
        type: 'POST',
        data: formdata,
        success: function(data, status) {

            alert('Patient Information Uploaded Successfully');

            //  alert("Notice send successfully");
            location.reload();
        },



    });

    //alert(insurance_plan+" "+date_received+" "+date_need_to_be_finished+""+medicaid_id+" "+member_id+" "+first_name+" "+last_name+" "+sex+" "+date_of_birth+" "+primary_language+" "+ cell_phone+" "+home_phone+" "+marital_status+" "+email+" "+address+" "+city+" "+state+" "+zip_code+" "+country+" "+assesment_type);

});

$("#upload").on('click', function() {

    var formdata = new FormData();
    formdata.append('select_file', $('#customFile')[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        url: 'import',
        type: 'POST',
        data: formdata,
        success: function(data, status) {

            var msg = $.trim(data);
            if (msg != "ok") {
                $('#missing_data').html(data);
                $('#excel_error_modal').modal('show');
            } else {
                alert('Data uploaded successfully');
            }

            //  alert("Notice send successfully");
            //  location.reload();
        },



    });


    //  $("#excel_error_modal").modal('show');

});




$('#customFile').on('change', function() {
    //get the file name
    var fileName = $(this).val().split('\\').pop();;
    //replace the "Choose a file" label
    $(".custom-file-label").html(fileName);
});

$('#data-table').DataTable({
    'paging': true,
    'lengthChange': true,
    'searching': false,
    'ordering': false,
    'info': false,
    'autoWidth': true
})