/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#suppliermodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

$(document).ready(function (){
  $('.edit_supplier_btn').click(function(e) {
     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
    var supplier_id = $(this).closest('tr').find('.supplier_id').text();
  
    $.ajax({
      type: "POST",
      url: "edit_supplier.php",
      data: {
        'checking_edit_supplier_btn': true,
        'supplier_id': supplier_id,
      },
      success: function(response) {
         console.log(response);
    // Parse the response JSON object
    var data = JSON.parse(response);
    
    $('#supplier_type').val(data.supplier_type);
    $('#supplier_name').val(data.supplier_name);
    $('#edit_supplier_id').val(data.edit_supplier_id);
    $('#company_name').val(data.company_name);
    $('#address').val(data.address);
    $('#area').val(data.area);
    $('#city').val(data.city);
    $('#county').val(data.county);
    $('#contact_name_1').val(data.contact_name_1);
    $('#contact_name_2').val(data.contact_name_2);
    $('#contact_phone_1').val(data.contact_phone_1);
    $('#contact_phone_2').val(data.contact_phone_2);
    $('#email').val(data.email);
    $('#google_location').val(data.google_location);
    $('#edit_status').val(data.status);
    $('#comment').val(data.comment);
   
      // Prepare URL parameters
      var params = new URLSearchParams();
      params.append('supplier_type', data.supplier_type);
      params.append('edit_supplier_id', data.edit_supplier_id);
      params.append('supplier_name', data.supplier_name);
      params.append('company_name', data.company_name);
      params.append('adress', data.address);
      params.append('area', data.area);
      params.append('city', data.city);
      params.append('county', data.county);
      params.append('contact_name_1', data.contact_name_1);
      params.append('contact_name_2', data.contact_name_2);
      params.append('contact_phone_1', data.contact_phone_1);
      params.append('contact_phone_2', data.contact_phone_2);
      params.append('email', data.email);
      params.append('google_location', data.google_location);
      params.append('edit_status', data.status);
      params.append('comment', data.comment);
      
  
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'edit-supplier-page.php';
        
      }
    });
  });
  });
  
  $(document).ready(function () {
    // Retrieve data from localStorage
    var editData = JSON.parse(localStorage.getItem('editData'));
  
    // Populate form fields with the data
    $('#supplier_type').val(editData.supplier_type);
    $('#supplier_name').val(editData.supplier_name);
    $('#edit_supplier_id').val(editData.edit_supplier_id);
    $('#company_name').val(editData.company_name);
    $('#address').val(editData.address);
    $('#area').val(editData.area);
    $('#city').val(editData.city);
    $('#county').val(editData.county);
    $('#contact_name_1').val(editData.contact_name_1);
    $('#contact_name_2').val(editData.contact_name_2);
    $('#contact_phone_1').val(editData.contact_phone_1);
    $('#contact_phone_2').val(editData.contact_phone_2);
    $('#email').val(editData.email);
    $('#google_location').val(editData.google_location);
    $('#edit_status').val(editData.status);
    $('#comment').val(editData.comment);
  
  /*                                */
  

/* RADIO BUTTON CHECK */

var activeRadio = document.getElementById('active_radio');
var inactiveRadio = document.getElementById('inactive_radio');

// Retrieve the edit_status value
var editStatus = editData.status;
// Check the radio buttons based on the input value
if (editStatus === 'Active') {
    activeRadio.checked = true;
} else if (editStatus === 'Inactive') {
    inactiveRadio.checked = true;
}

/* RADIO BUTTON CHECK */

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