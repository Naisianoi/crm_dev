// View Details Customer
  $(document).ready(function() {
    // Handle the click event on the "bi-eye" icon
    $('.view_btn').click(function() {
      var customerId = $(this).data('id');

      // Make an AJAX request to fetch customer data
      $.ajax({
        type: 'POST',
        url: 'view-customer-details.php', // Replace with the actual URL of your PHP file
        data: { customer_id: customerId },
        dataType: 'json',
        success: function(customerData) {
        
          //console.log('Received data:',customerData);
          // Populate the modal with customer details, including additional columns
          $('#customerId').text(customerData.id);
          $('#customerName').text(customerData.customer_name);
          $('#customerType').text(customerData.customer_type);
          $('#customerAddress').text(customerData.address);
          $('#customerProduct').text(customerData.product);
          $('#customerBusiness').text(customerData.business);
          $('#customerCommerce').text(customerData.commerce);
          $('#customerContactName1').text(customerData.contact_name_one);
          $('#customerContactPhone1').text(customerData.contact_phone_one);
          $('#customerContactName2').text(customerData.contact_name_two);
          $('#customerContactPhone2').text(customerData.contact_phone_two);

          // Additional columns
          // $('#customerEmail').text(customerData.email);
          // $('#customerAddress').text(customerData.address);

          // Show the modal
          $('#viewCustomerModal').modal('show');
        }, 
        error: function(xhr, status, error) {
          console.error('Error fetching customer data:', error);
        }
      });
    });

    // Triggered when the modal is about to be shown
    $('#viewCustomerModal').on('show.bs.modal', function (event) {
      // $(document).on('show.bs.modal', '#viewCustomerModal', function (event) {
      // Clear the placeholders before showing the modal
      $('#customerId').text(customerData.id);
      $('#customerName').text('');
      $('#customerType').text('');
      $('#customerAddress').text('');
      $('#customerProduct').text('');
      $('#customerBusiness').text('');
      $('#customerCommerce').text('');
      $('#customerContactName1').text('');
      $('#customerContactPhone1').text('');
      $('#customerContactName2').text('');
      $('#customerContactPhone2').text('');
      // $('#customerEmail').text('');
      // $('#customerAddress').text('');
    });
  });


// View Details Customer


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    $('.delete_customer_btn').click(function(e){
        e.preventDefault();/*-----delete button on click-------*/
  
        var product_id = $(this).closest('tr').find('.customer_id').text();
        //console.log(product_id);
  
        $('#delete_customer_id').val(product_id);
        $('#deletecustomermodal').modal('show');

      });

       
})


$(document).ready(function (){
$('.edit_customer_btn').click(function(e) {
   e.preventDefault(); /*-----edit button on click-------*/
//function updateProduct() {
  var customer_id = $(this).closest('tr').find('.customer_id').text();

  $.ajax({
    type: "POST",
    url: "edit_customer.php",
    data: {
      'checking_edit_customer_btn': true,
      'customer_id': customer_id,
    },
    success: function(response) {
       console.log(response);
  // Parse the response JSON object
  var data = JSON.parse(response);
  
  $('#edit_customer_type_select').val(data.customer_type);
  $('#edit_customer_name').val(data.customer_name);
  $('#edit_customer_id').val(data.edit_customer_id);
  $('#edit_company_name').val(data.company_name);
  $('#edit_address').val(data.address);
  $('#edit_area').val(data.area);
  $('#edit_city').val(data.city);
  $('#edit_county').val(data.county);
  $('#edit_contact_name_one').val(data.contact_name_one);
  $('#edit_contact_name_two').val(data.contact_name_two);
  $('#edit_contact_phone_one').val(data.contact_phone_one);
  $('#edit_contact_phone_two').val(data.contact_phone_two);
  $('#edit_email').val(data.email);
  $('#edit_sales_agent_select').val(data.sales_agent);
  $('#edit_discount').val(data.discount);
  $('#edit_product_select').val(data.product);
  $('#edit_product').val(data.product);
  $('#edit_physical_location').val(data.physical_location);
  $('#edit_google_location').val(data.google_location);
  $('#edit_commerce_select').val(data.commerce);
  $('#edit_date_w_amc').val(data.date_w_amc);
  $('#edit_status').val(data.status);
  $('#edit_brand_input').val(data.brand);
  $('#edit_business_input').val(data.business);
  $('#edit_referred_select').val(data.referred);
  $('#edit_comment').val(data.comment);
  $('#edit_frequency').val(data.frequency);
 
    // Prepare URL parameters
    var params = new URLSearchParams();
    params.append('edit_customer_type_select', data.customer_type);
    params.append('edit_customer_id', data.edit_customer_id);
    params.append('edit_customer_name', data.customer_name);
    params.append('edit_company_name', data.company_name);
    params.append('edit_adress', data.address);
    params.append('edit_area', data.area);
    params.append('edit_city', data.city);
    params.append('edit_county', data.county);
    params.append('edit_contact_name_one', data.contact_name_one);
    params.append('edit_contact_name_two', data.contact_name_two);
    params.append('edit_contact_phone_one', data.contact_phone_one);
    params.append('edit_contact_phone_two', data.contact_phone_two);
    params.append('edit_email', data.email);
    params.append('edit_sales_agent_select', data.sales_agent);
    params.append('edit_discount', data.discount);
    params.append('edit_product_select', data.product);
    params.append('edit_product', data.product);
    params.append('edit_physical_location', data.physical_location);
    params.append('edit_google_location', data.google_location);
    params.append('edit_commerce_select', data.commerce);
    params.append('edit_date_w_amc', data.date_w_amc);
    params.append('edit_status', data.status);
    params.append('edit_brand_input', data.brand);
    params.append('edit_business_input', data.business);
    params.append('edit_referred_select', data.referred);
    params.append('edit_comment', data.comment);
    params.append('edit_frequency', data.frequency);
    

    // Store the data in localStorage
    localStorage.setItem('editData', JSON.stringify(data));

    // Redirect to the success page
    window.location.href = 'edit-customer-page.php';
      
    }
  });
});
});

$(document).ready(function () {
  // Retrieve data from localStorage
  var editData = JSON.parse(localStorage.getItem('editData'));

  // Populate form fields with the data
  $('#edit_customer_type_select').val(editData.customer_type);
  $('#edit_customer_name').val(editData.customer_name);
  $('#edit_customer_id').val(editData.edit_customer_id);
  $('#edit_company_name').val(editData.company_name);
  $('#edit_address').val(editData.address);
  $('#edit_area').val(editData.area);
  $('#edit_city').val(editData.city);
  $('#edit_county').val(editData.county);
  $('#edit_contact_name_one').val(editData.contact_name_one);
  $('#edit_contact_name_two').val(editData.contact_name_two);
  $('#edit_contact_phone_one').val(editData.contact_phone_one);
  $('#edit_contact_phone_two').val(editData.contact_phone_two);
  $('#edit_email').val(editData.email);
  $('#edit_sales_agent_select').val(editData.sales_agent);
  $('#edit_discount').val(editData.discount);
  $('#edit_product_select').val(editData.product);
  $('#edit_product').val(editData.product);
  $('#edit_physical_location').val(editData.physical_location);
  $('#edit_google_location').val(editData.google_location);
  $('#edit_commerce_select').val(editData.commerce);
  $('#edit_date_w_amc').val(editData.date_w_amc);
  $('#edit_status').val(editData.status);
  $('#edit_brand_input').val(editData.brand);
  $('#edit_business_input').val(editData.business);
  $('#edit_referred_select').val(editData.referred);
  $('#edit_comment').val(editData.comment);
  $('#edit_frequency').val(editData.frequency);

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


/* CLICK FOR SEARCH CUSTOMER TYPE */
  function submitForm() {
    document.getElementById('customer-type-search-form').submit();
  }
/* CLICK FOR SEARCH CUSTOMER TYPE */


/* CLICK FOR SEARCH COMMERCE */
  function submitForm2() {
    document.getElementById('commerce-search-form').submit();
  }
/* CLICK FOR SEARCH COMMERCE */

/* CLICK FOR SEARCH AREA */
function submitForm3() {
  document.getElementById('area-search-form').submit();
}
/* CLICK FOR SEARCH AREA */

// CLICK FOR VIEW HISTORY JC
function viewCustomerHistory(customerId) {
  // Redirect to customer-history-page with the customer ID
  window.location.href = 'customer-history-page.php?id=' + customerId;
}
// CLICK FOR VIEW HISTORY JC

// CLICK FOR VIEW HISTORY JC
function AMC(customerId) {
  // Redirect to customer-history-page with the customer ID
  window.location.href = 'add-amc-page.php?id=' + customerId;
}
// CLICK FOR VIEW HISTORY JC





