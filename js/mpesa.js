/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

$(document).ready(function (){
  $('.edit_mpesa_btn').click(function(e) {
     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
    var mpesa_id = $(this).closest('tr').find('.mpesa_id').text();
  
    $.ajax({
      type: "POST",
      url: "edit_mpesa.php",
      data: {
        'checking_edit_mpesa_btn': true,
        'mpesa_id': mpesa_id,
      },
      success: function(response) {
         console.log(response);
    // Parse the response JSON object
    var data = JSON.parse(response);
    
    $('#mpesa_name').val(data.mpesa_name);
    $('#mpesa_number').val(data.mpesa_number);
    $('#edit_mpesa_id').val(data.edit_mpesa_id);
    
   
      // Prepare URL parameters
      var params = new URLSearchParams();
      params.append('mpesa_name', data.mpesa_name);
      params.append('edit_mpesa_id', data.edit_mpesa_id);
      params.append('mpesa_number', data.mpesa_number);
      
  
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'edit-mpesa-page.php';
        
      }
    });
  });
  });
  
  $(document).ready(function () {
    // Retrieve data from localStorage
    var editData = JSON.parse(localStorage.getItem('editData'));
  
    // Populate form fields with the data
    $('#mpesa_name').val(editData.mpesa_name);
    $('#mpesa_number').val(editData.mpesa_number);
    $('#edit_mpesa_id').val(editData.edit_mpesa_id);
  
  /*                                */
 

  // Clear the data from localStorage
  localStorage.removeItem('editData');
});


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/