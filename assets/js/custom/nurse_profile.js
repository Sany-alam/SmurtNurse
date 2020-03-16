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

 $("#nurse_information_upload").on('click', function() {
     //  var prefered_day = [];
     //  $('.prefered_day:checked').each(function() {
     //      prefered_day.push($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
     //  });

     // alert(prefered_day);

     //var gender =   $("#gender:checked").val();
     //alert (gender);

     var prefered_date = [];
     $('input[name^=prefered_date]').each(function() {
         var date = $(this).val().split('/');
         date = date[1] + '-' + date[0] + '-' + date[2];
         prefered_date.push(date);
     });

     var prefered_start_time = [];
     $('input[name^=prefered_start_time]').each(function() {
         prefered_start_time.push($(this).val());
     });

     var prefered_finish_time = [];
     $('input[name^=prefered_finish_time]').each(function() {
         prefered_finish_time.push($(this).val());
     });

     //alert(prefered_date + " " + prefered_start_time + " " + prefered_finish_time);

     var formdata = new FormData();
     formdata.append("name", $("#name").val());
     formdata.append("gender", $("#gender").val());
     formdata.append("language", $("#language").val());

     formdata.append("email", $("#email").val());
     formdata.append("registration_no", $("#registration_no").val());
     formdata.append("phone_number", $("#phone_number").val());
     formdata.append("address", $("#address").val());
     formdata.append("city", $("#city").val());
     formdata.append("country", $("#country").val());
     formdata.append("zip", $("#zip").val());
     formdata.append("prefered_date", prefered_date);
     formdata.append("prefered_area", $("#prefered_area").val());
     formdata.append("start_time", prefered_start_time);
     formdata.append("finish_time", prefered_finish_time);



     $.ajax({
         processData: false,
         contentType: false,
         url: 'nurse_information_upload',
         type: 'POST',
         data: formdata,
         success: function(data, status) {

             alert('Nurse Information Uploaded Successfully');

             //  alert("Notice send successfully");
             location.reload();
         },



     });



     //alert(prefered_day);

 });

 $("#upload").on('click', function() {
     //  alert('hello');

     var formdata = new FormData();
     formdata.append('select_file', $('#customFile')[0].files[0]);
     $.ajax({
         processData: false,
         contentType: false,
         url: 'nurse_file_import',
         type: 'POST',
         data: formdata,
         success: function(data, status) {

             var msg = $.trim(data);
             if (msg != "ok") {


                 alert('Data Uploaded Successfully');
             } else {
                 alert('Data Uploaded Successfully');
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