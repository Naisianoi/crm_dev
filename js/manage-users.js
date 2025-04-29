/*-------------Add Modal Brand form button click---------------*/
$('#addusersbtn').on('click', function(){
    $('#addusersmodal').modal('show');
  });

/*------------Add Modal Brand form button click----------------*/

/*-------------Edit Modal Users form button click---------------*/

$('.edit_user').on('click', function(){
    $('#editusermodal').modal('show');
  });

/*-------------Edit Modal Users form button click---------------*/

/*--------------------------ajax EDITING data when edit clicked-----------------------------------*/
$(document).ready(function (e){

    $('.delete_user_btn').click(function(e){
      e.preventDefault();/*-----delete button on click-------*/

      var user_id = $(this).closest('tr').find('.user_id').text();
      //console.log(brand_id);

      $('#delete_user_id').val(user_id);
      $('#deleteUserModal').modal('show');
      
    });
    
    $('.edit_user').click(function(e){
      e.preventDefault();/*-----edit button on click-------*/

      var user_id = $(this).closest('tr').find('.user_id').text();
      //console.log(brand_id);

      $.ajax({
        type: "POST",
        url: "edit_user.php",
        data: {
          'checking_user_btn': true,
          'user_id': user_id,
        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
              //console.log(value['brand']);
              $('#edit_user_id').val(value['id']);
              $('#edit_usertype').val(value['user_type']);
              $('#username').val(value['username']);
              $('#password').val(value['password']);
              
          });

          $('#editusermodal').modal('show');
        }
      })
    })
  })
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/