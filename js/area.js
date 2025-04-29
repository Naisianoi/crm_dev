/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#areamodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    

    $('.edit_area_btn').click(function(e){
        e.preventDefault();/*-----edit button on click-------*/
  
        var area_id = $(this).closest('tr').find('.area_id').text();
        // console.log(area_id);

        $.ajax({
            type: "POST",
            url: "edit_area.php",
            data: {
              'checking_edit_area_btn': true,
              'area_id': area_id,
            },
            success: function (response) {
              //  console.log(response);

            $.each(response, function (key, value) {
                // console.log(value['business']);
                  $('#edit_area_id').val(value['id']);
                  $('#edit_area').val(value['area']);
                  $('#edit_distance').val(value['distance_KM']);
                 
            });

             $('#editareamodal').modal('show');
        }
     });

    })
})
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/