  $(document).ready(function (){
  $('.service_jc_btn').click(function(e) {
     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
    var customer_id = $(this).closest('tr').find('.customer_id').text();
  
    $.ajax({
      type: "POST",
      url: "edit_service_jc.php",
      data: {
        'checking_service_jc_btn': true,
        'customer_id': customer_id,
      },
      success: function(response) {
        //  console.log(response);
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
    $('#edit_physical_location').val(data.physical_location);
    $('#edit_google_location').val(data.google_location);
    $('#edit_commerce_select').val(data.commerce);
    $('#edit_date_w_amc').val(data.date_w_amc);
    $('#edit_status').val(data.status);
    $('#edit_brand_input').val(data.brand);
    $('#edit_business_input').val(data.business);
    $('#edit_referred_select').val(data.referred);
   
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
      params.append('edit_physical_location', data.physical_location);
      params.append('edit_google_location', data.google_location);
      params.append('edit_commerce_select', data.commerce);
      params.append('edit_date_w_amc', data.date_w_amc);
      params.append('edit_status', data.status);
      params.append('edit_brand_input', data.brand);
      params.append('edit_business_input', data.business);
      params.append('edit_referred_select', data.referred);
      
  
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'service-jc-page.php';
        
      }
    });
  });
  });
  
  $(document).ready(function () {
    // Retrieve data from localStorage
    var editData = JSON.parse(localStorage.getItem('editData'));
  
    // Populate form fields with the data
    $('#edit_customer_type_select').text(editData.customer_type);
    $('#edit_customer_name').text(editData.customer_name);
    $('#edit_customer_id').text(editData.edit_customer_id);
    $('#edit_company_name').text(editData.company_name);
    $('#edit_address').text(editData.address);
    $('#edit_area').text(editData.area);
    $('#edit_city').text(editData.city);
    $('#edit_county').val(editData.county);
    $('#edit_contact_name_one').text(editData.contact_name_one);
    $('#edit_contact_name_two').text(editData.contact_name_two);
    $('#edit_contact_phone_one').text(editData.contact_phone_one);
    $('#edit_contact_phone_two').text(editData.contact_phone_two);
    $('#edit_email').text(editData.email);
    $('#edit_sales_agent_select').text(editData.sales_agent);
    $('#edit_discount').text(editData.discount);
    $('#edit_product_select').text(editData.product);
    $('#edit_physical_location').text(editData.physical_location);
    $('#edit_google_location').text(editData.google_location);
    $('#edit_commerce_select').text(editData.commerce);
    $('#edit_date_w_amc').text(editData.date_w_amc);
    $('#edit_status').text(editData.status);
    $('#edit_brand_input').text(editData.brand);
    $('#edit_business_input').text(editData.business);
    $('#edit_referred_select').text(editData.referred);

  
    // Clear the data from localStorage
    localStorage.removeItem('editData');
  });

  
  
  /*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
  
  
// Validate Form Not Empty
//Combining all the validating functions in one for avoiding empty form fields
function validateFormServiceJC() {
  var isValid = true;

  isValid = isValid && validateFormJCType();
 

  return isValid;
}

//Prevent empty jc type in Service JC
function validateFormJCType() {
  var jcSelect = document.getElementById("jc_type");
  var selectedOption = jcSelect.value;
  
  if (selectedOption === "") {
    alert("Please choose Jobcard Type");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty JC Type Service JC


  // Validate Form Not Empty