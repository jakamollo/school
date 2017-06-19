 //$(document).onclick('.profile_change_user_info', function(){
//   $('.profile_modal').modal({
//       show: true
//   })
//});
 $(document).ready(function($){
    $('#update_user_formjj').submit(function(e){

        //    stop normal form behavior
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    //    data from the form
        var userData = {
            name: $('#name_input').val(),
            email: $('#email_input').val(),
            password: $('#password_input').val(),
            photo: $('#photo_input').val(),
            gender: $('.male_input').val(),
        }
    //    user id
        var user_id = $('#user_id_input').val();

        $.ajax({
            type: 'PATCH',
            async: true,
            url: 'user/'+user_id ,
            data: {id: user_id},
            dataType: 'json',
            success: function(user_data){
                console.log(user_data);
                $('#update-user-flash-message').append(user_data.message);
                $('#update_user_flash_message_div').delay(8000).fadeOut(8000);
                $('#profile_modal').delay(1200).modal('hide');

            },
            error: function(resp){
                console.log('Error:', resp);
            },
        });
    });

     $('#alert_div').delay(8000).slideUp(1000);

     $('.close-modal').click(function(e){
        $('.modal-content').modal().hide()
     });
     $(".datepicker").datepicker({
         dateFormat: "d-m-yy"

     });

     $('#new_student_forms').on('submit', function(e){
         e.preventDefault()
         //    data from the form
         var userData = {
             first_name: $('#first_name').val(),
             last_name: $('#last_name').val(),
             email: $('#email').val(),
             gender: $('#gender').val(),
             age: $('#age').val(),
             school_id: $('#school_id').val(),
             form: $('#form').val(),
             admission_date: $('#admission_date').val()
         }

         $.ajax({
            type: 'post',
             url: '/school/home',
             data: userData,
             dataType: 'json',
             success: function(data){
                 console.log(data)
             },
             error: function(resp){
                console.log(resp);
             }
         });
     });
     // hide the staff other management_level option field
  $('#other').hide();
 //    is other selected?
     $('#management_level').change(function(){
         var optionSelected = $(this).find("option:selected");
         var valueSelected = optionSelected.val();
         var textSelected = optionSelected.text();
         if (textSelected == 'Others') {
             $('#other').show();
             $('#submit-new-staff').on("click", function (e) {
                 var other_mgnt = $('#other').val();
                 optionSelected.val(other_mgnt).attr('selected', true);
             })
         } else if (textSelected !== 'Others') {
             $('.management-level-other').hide();
         }
         //var selected_option = $('#management_level option').filter(':selected').text();
     });
     // hide staff other option field
     $('#other_type').hide();
     $('#employee_type').change(function(){
         var optionSelected = $(this).find("option:selected");
         var valueSelected = optionSelected.val();
         var textSelected = optionSelected.text();
         if (textSelected == 'Others') {
             $('#other_type').show();
             $('#submit-new-staff').on("click", function (e) {
                 var other_type = $('#other_type').val();
                 optionSelected.val(other_type).attr('selected', true);
             })
         } else if (textSelected !== 'Others') {
             $('#other_type').hide();
         }
     });

 });

