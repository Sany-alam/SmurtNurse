function show_nurse_assesment_form(scheduler_id) {
    $("#hidden_scheduler_id").val(scheduler_id);
    var formdata = new FormData();


    formdata.append('scheduler_id', scheduler_id);
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        url: "nurse_assesment_form_value",
        data: formdata,
        success: function(data, status) {
            $("#assign_nurse").html(data);
            $("#nurse_assesment_form_modal").modal('show');
            $('.edit_form_field').hide();
            $("#send_form").hide();
            $("#cancel_edit").hide();
            $("#error_text_field").hide();


        }


    });


}

function accept_form() {

    var scheduler_id = $("#hidden_scheduler_id").val();
    var formdata = new FormData();
    formdata.append('scheduler_id', scheduler_id);
    $.ajax({
        processData: false,
        contentType: false,
        url: "accept_nurse_assesment_form",
        type: "POST",
        data: formdata,
        success: function(data, status) {
            alert('form accepted');
            $("#nurse_assesment_form_modal").modal('hide');
            location.reload();

        }

    })


}

function send_form() {
    var error_question = [];
    $('.edit_form_field:checked').each(function() {
        error_question.push($(this).val());
    });

    var error_text = document.getElementById("error_text").value.trim();
    var scheduler_id = $("#hidden_scheduler_id").val();
    var formdata = new FormData();
    formdata.append('scheduler_id', scheduler_id);
    formdata.append('error_question_list', error_question);
    formdata.append('error_text', error_text);

    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        url: "send_nurse_form_error",
        data: formdata,
        success: function(data, status) {

            alert('Error Mote Send to Nurse');
            location.reload();


        }
    });
    // alert(error_question);
}

function edit_form_checkbox_show() {
    $('.edit_form_field').show();
    $("#edit_form").hide();
    $("#accept_form").hide();
    $("#send_form").show();
    $("#cancel_edit").show();
    $("#error_text_field").show();

}

function cancel_edit() {
    $('.edit_form_field').hide();
    $("#edit_form").show();
    $("#accept_form").show();
    $("#send_form").hide();
    $("#cancel_edit").hide();

}

$(function() {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


});