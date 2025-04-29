/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#categorymodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/


/*--------------------ajax for EDITING data when edit clicked----------------------*/
$(document).ready(function (e){

      //EDIT
      $('.edit_category_btn').click(function(e) {
        e.preventDefault();
  
        var category_id = $(this).closest('tr').find('.category_id').text();
        var business = $(this).closest('tr').find('.business').text();
        var category = $(this).closest('tr').find('.category').text();
  
        // Populate the modal fields with the fetched values
        $('#edit_category_id').val(category_id);
        $('#edit_business').val(business);
        $('#edit_category').val(category);
  
        // Show the "Edit Category" modal
        $('#editcategorymodal').modal('show');
    });

    
})
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/



