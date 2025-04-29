/*-------------Add Modal Technician form button click---------------*/
$('#btn').on('click', function(){
    $('#technicianmodal').modal('show');
  });

/*------------Add Modal Technician form button click----------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    

    $('.edit_technician_btn').click(function(e){
        e.preventDefault();/*-----edit button on click-------*/
  
        var technician_id = $(this).closest('tr').find('.technician_id').text();
        // console.log(category_id);

        $.ajax({
            type: "POST",
            url: "edit_technician.php",
            data: {
              'checking_edit_technician_btn': true,
              'technician_id': technician_id,
            },
            success: function (response) {
              //  console.log(response);

            $.each(response, function (key, value) {
                // console.log(value['business']);
                  $('#edit_technician_id').val(value['id']);
                  $('#edit_technician_name').val(value['technician_name']);
                  $('#edit_technician_number').val(value['technician_number']);
            });

             $('#edittechnicianmodal').modal('show');
        }
     });

    })
})
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/