/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#suppliermodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

$(document).ready(function (){
  $('.edit_rates_btn').click(function(e) {
     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
    var rates_id = $(this).closest('tr').find('.rates_id').text();
  
    $.ajax({
      type: "POST",
      url: "edit_rates.php",
      data: {
        'checking_edit_rates_btn': true,
        'rates_id': rates_id,
      },
      success: function(response) {
         console.log(response);
    // Parse the response JSON object
    var data = JSON.parse(response);
    
    $('#rate_item').val(data.rate_item);
    $('#edit_rates_id').val(data.edit_rates_id);
    $('#rate_value').val(data.rate_value);
    
    
   
      // Prepare URL parameters
      var params = new URLSearchParams();
      params.append('rate_item', data.rate_item);
      params.append('edit_rates_id', data.edit_rates_id);
      params.append('rate_value', data.rate_value);
      
      
  
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'edit-rates-page.php';
        
      }
    });
  });
  });
  
  $(document).ready(function () {
    // Retrieve data from localStorage
    var editData = JSON.parse(localStorage.getItem('editData'));
  
    // Populate form fields with the data
    $('#rate_item').val(editData.rate_item);
    $('#rate_value').val(editData.rate_value);
    $('#edit_rates_id').val(editData.edit_rates_id);
    
  
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