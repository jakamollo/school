 //$(document).onclick('.profile_change_user_info', function(){
//   $('.profile_modal').modal({
//       show: true
//   })
//});
 $(document).ready(function($){
    $('.user-update-submit-btns').on('click', function(e){

        //    stop normal form behavior
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //    user id
        var user_id = $(this).val();

        var username = $('#name_input').val();
        var email = $('#email_input').val();
        var password = $('#password').val();
        var gender = $('.male_input').val();
        var image_file = document.getElementById('photo');
        var photo = image_file.files[0];
        var form_data = new FormData();
         //add the data to the formData
        form_data['user_id'] = user_id;
        form_data['username'] = username;
        form_data['email'] = email;
        form_data['password'] = password;
        form_data['gender'] = gender;
        form_data['photo'] = photo;

        //alert(form_data);
        $.ajax({
            type: 'PATCH',
            //async: true,
            url: 'user_update' ,
            data: form_data,
            dataType: false,
            contentType: 'text',
            processData: false,
            success: function(data){
                console.log(data);
                $('#update-user-flash-message').append(data.message);
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
     $('.delete-post').on('click', function(e){
         e.preventDefault();
        // get post id and token
         var id = $(this).val();
         var token = $('input[name=_token]').val();

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         var confirmation = confirm("Are you sure you want to delete?");
         if(confirmation == true){
             $.ajax({
                 type: 'DELETE',
                 url: 'post/delete/'+id,
                 dataType: 'json',
                 data: {id: id, token: token},
                 success: function(data){
                     console.log(data);
                     $('#post'+id).remove();
                     var message = '<div class="post_message" style="background-color: lightpink;height: 35px; border-radius: 5px;padding-left:5px;margin-bottom: 5px;font-family: Helvetica; font-style: italic ">Post was successfully deleted</div>';
                     $('.home-post-div').prepend(message).delay(5000,function(){
                         $('.post_message').delay(5000).slideUp(3000);
                     });
                 },
                 error: function(resp){
                     console.log(resp);
                 }
             })
         }

     });

     // edit post
     $('.edit-post-btn').on('click', function(f){
         f.preventDefault();
         // get user input
         var id = $(this).val();
         var body = $('#edit_post_content'+id).val();
         var user_id = $('#post-owner'+id).val();
         var attachment = $('#post-attachment'+id).val();
         var token = $('input[name=_token]').val();
         var school_id = $('#post-school-id'+id).val();

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $.ajax({
            type: 'PATCH',
             url: 'post/'+id,
             dataType: 'json',
             data: {id: id,body: body,user_id: user_id,attachment: attachment,token: token,school_id: school_id},
             success: function(data){
                 console.log(data);
                 var photo = data.photo;
                 var username = data.username;

                 var user_photo_div_id = 'user_photo'+id;
                 var user_photo_div = '<div class="user_photo" id=""></div>'
                 var postBody = '<img class="post_image" id="post_image" src="" height="50px" width="50px">';
                 var appendUserName = '<p id="post_user_name" class="post_user_name" style="position: relative; left: -20px;top: 10px;"></p>';
                 var postPara = '<p id="post-body" class="post-body" style="padding-left: 15px;"></p>';


                 if($('#edit_post_content'+id).val() !==''){
                     // remove the modal
                     $('#'+id).hide();
                     $('.body').removeClass('modal-open');

                     $('#user_image'+id).remove();
                     $('#post_user_name'+id).remove();
                     $('#post-body'+id).remove();
                     $('#'+user_photo_div_id).prepend(postBody,appendUserName,postPara).delay(5000,function(){
                         $('#post_image').attr("src",photo);
                         $('#post_user_name').text(username).css({paddingLeft:'10px',marginLeft: '10ppx', float: 'right'});
                         $('#post-body').text(body);
                     });

                     var message = '<div class="post_message" style="background-color: lightgreen;height: 35px; border-radius: 5px;padding-left:5px;margin-bottom: 5px;font-family: Helvetica; font-style: italic ">Post was successfully updated</div>';
                     $('.home-post-div').prepend(message).delay(5000,function(){
                         $('.post_message').delay(5000).slideUp(3000);
                     });
                 }

             },
             error: function(resp){
                 console.log(resp);
             }
         })
     });

     // submit new subject
     $('#new-subj-submit-btn').on('click', function(e){
         e.preventDefault();
         // get user inputs
         var name = $('#new_subj_name').val();
         var code = $('#new_subj_code').val();
         var grading_choice = $('#new_subj_grading').find("option:selected").val();
         var category = $('#new_subj_category').find("option:selected").val();
         var week_length = $('#new_subj_week_length').val();
         var token = $('input[name=_token]').val();

         // validate the presence of integer for week_length field
         if(isNaN(week_length)){
             $('#new_subj_week_length').focus();
             errorMessage('new_subj_week_length_error_message', 'new-subj-week-length-error', 'Please provide numeric value only');
         }else{
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 type: 'POST',
                 url: '/subject/new',
                 dataType: 'json',
                 data: {token: token,name: name, code: code, grading_choice: grading_choice, category: category,week_length: week_length},
                 success: function(data){
                     console.log(data);
                     $('.subject_modal').hide();
                     successMessage('new-subj-success-submit', 'success_message', 'Subject successfully submited');
                 },
                 error: function(resp){
                     console.log(resp);
                 },
             });
         }
     });

     // define error message div
     function errorMessage(message_class, parent_class, error_message){
         var message = '<div'+' '+'class'+'='+'"'+message_class+'"'+'style="background-color: lightpink;height: 35px; border-radius: 5px;padding-left:5px;margin-bottom: 5px;font-family: Helvetica; font-style: italic ">'+error_message+'</div>';
         $('.'+message_class).remove();
         $('#'+parent_class).prepend(message).delay(5000,function(){
             $('.'+message_class).delay(5000).slideUp(3000);
         });
     }
     // define a success message
     function successMessage(message_class, parent_class, error_message){
         var message = '<div'+' '+'class'+'='+'"'+message_class+'"'+'style="background-color: lightgreen;height: 35px; border-radius: 5px;padding-left:5px;margin-bottom: 5px;font-family: Helvetica; font-style: italic ">'+error_message+'</div>';
         $('.'+message_class).remove();
         $('#'+parent_class).prepend(message).delay(5000,function(){
             $('.'+message_class).delay(5000).slideUp(3000);
         });
     }
     $('.close_modal').click(function(){
         var id  = $(this).val();
       $('#'+id).hide();
     });

     $('.subject-dismiss-btn').click(function(){
         $('.subject_modal').hide();
     });

     $('.close_subj_modal').click(function(){
         $('.subject_modal').hide();
     });

     // Packages drop-down
     $('#form-filter').change(function(){
         $('.hide_student').hide();
         $('.' + $(this).val()).show();
     });

     $('#combined-filter').change(function(){
         $('.hide_student').hide();
         $('.' + $(this).val()).show();
     });

 });

