/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#suppliermodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

$(document).ready(function (){
  $('.edit_unit_of_measurement_btn').click(function(e) {
     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
    var unit_of_measurement_id = $(this).closest('tr').find('.unit_of_measurement_id').text();
  
    $.ajax({
      type: "POST",
      url: "edit_unit_of_measurement.php",
      data: {
        'checking_edit_unit_of_measurement_btn': true,
        'unit_of_measurement_id': unit_of_measurement_id,
      },
      success: function(response) {
         console.log(response);
    // Parse the response JSON object
    var data = JSON.parse(response);
    
    $('#unit_name').val(data.unit_name);
    $('#edit_unit_of_measurement_id').val(data.edit_unit_of_measurement_id);
    $('#unit_code').val(data.unit_code);
    
    
   
      // Prepare URL parameters
      var params = new URLSearchParams();
      params.append('unit_name', data.unit_name);
      params.append('edit_unit_of_measurement_id', data.edit_unit_of_measurement_id);
      params.append('unit_code', data.unit_code);
      
      
  
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'edit-unit-of-measurement-page.php';
        
      }
    });
  });
  });
  
  $(document).ready(function () {
    // Retrieve data from localStorage
    var editData = JSON.parse(localStorage.getItem('editData'));
  
    // Populate form fields with the data
    $('#unit_name').val(editData.unit_name);
    $('#unit_code').val(editData.unit_code);
    $('#edit_unit_of_measurement_id').val(editData.edit_unit_of_measurement_id);
    
  
  /*                                */
  

  // Clear the data from localStorage
  localStorage.removeItem('editData');
});


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/


/* RADIO BUTTON CHANGE THE INPUT VALUE IN EDIT CUSTOMER ACCORDING TO SELECT */

function changeInputValue(radio) {
  var inputValue = radio.value;
  document.getElementById("edit_status").value = inputValue;
}

/* RADIO BUTTON CHANGE THE INPUT VALUE IN EDIT CUSTOMER ACCORDING TO SELECT */

/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/