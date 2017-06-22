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

     // save post to the database
     $('#post-form').on('submit', function(e){

         e.preventDefault();
         //var userData = {
             var body = $('#post_content').val();
             var user_id = $('#post_owner').val();
             var attachment = $('#post_attachment').val();
             var token = $('input[name=_token]').val();
             var school_id = $('#post_school_id').val();

         //}
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'POST',
             url: 'home',
             data: {_token: token, body: body, user_id: user_id, attachment: attachment, school_id: school_id},
             dataType: 'json',
             success: function(data){
                 console.log(data)
                 var photo = data.photo;
                 var username = data.username;
                 var postBody = '<div id="post_user_photo_div" class="user_photo"><img class="post_image" id="post_image" src="" height="50px" width="50px">';
                 var appendUserName = '<p id="post_user_name" class="post_user_name" style="position: absolute; left: 100px;top: 10px; width: 100px"></p>';
                 var postPara = '<p id="post-body" class="post-body" style="margin-left: 20px;"></p>';
                 '</div>';
                 // show thpost only if the post body is not empty
                 if($('#post_content').val() !==''){
                     $('.post-display-div').prepend(postBody,appendUserName,postPara).delay(5000,function(){
                         $('#post_image').attr("src",photo);
                         $('#post_user_name').text(username).css({paddingLeft:'10px',marginLeft: '10ppx', float: 'right'});
                         $('#post-body').text(body);
                     });

                     $('#post_content').val("");
                     var message = '<div class="post_message" style="background-color: lightgreen;height: 35px; border-radius: 5px;padding-left:5px;margin-bottom: 5px;font-family: Helvetica; font-style: italic ">Post was successfull</div>';
                     $('.home-post-div').prepend(message).delay(5000,function(){
                         $('.post_message').delay(5000).slideUp(3000);
                     });
                 }

             },
             error: function(data){
                 console.log(data)
             },
         });
     });

     // delete post
     $('.delete-post').on('click', function(){
        // get post id
         var id = $(this).val();
         var _token = $(this).data('token');
         $.ajax({
             type: 'DELETE',
             url: 'post/delete/'+id,
             dataType: 'json',
             data: {id: id, token: _token},
             success: function(data){
                 alert(id);
                 console.log(data);
                 $('#post'+id).remove();
             },
             error: function(resp){
                 console.log(resp);
             }
         })
     });

 });

