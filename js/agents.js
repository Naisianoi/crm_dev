/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#agentsmodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/

/*-------------Edit Modal Category form button click---------------*/

// $('.edit_agents_btn').on('click', function(){
//     $('#editagentsModal').modal('show');
//   });

/*-------------Edit Modal Category form button click---------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    

    $('.edit_agents_btn').click(function(e){
        e.preventDefault();/*-----edit button on click-------*/
  
        var agent_id = $(this).closest('tr').find('.agent_id').text();
        // console.log(category_id);

        $.ajax({
            type: "POST",
            url: "edit_agents.php",
            data: {
              'checking_edit_agents_btn': true,
              'agent_id': agent_id,
            },
            success: function (response) {
              //  console.log(response);

            $.each(response, function (key, value) {
                // console.log(value['business']);
                  $('#edit_agent_id').val(value['id']);
                  $('#edit_agent_name').val(value['agent_name']);
                  $('#edit_agent_number').val(value['agent_number']);
            });

             $('#editagentsModal').modal('show');
        }
     });

    })
})
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/