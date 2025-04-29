
// clicked AMC button
$(document).ready(function (){
  $('.service_jc_btn').click(function(e) {

     e.preventDefault(); /*-----edit button on click-------*/
  //function updateProduct() {
  
    var customer_id = $(this).closest('tr').find('.customer_id').text();
    var visitDate = $(this).closest('tr').find('.visit-date').text();
    var amc_id = $(this).closest('tr').find('.amc_id').text();
    // console.log(amc_id);
    $.ajax({
      type: "POST",
      url: "edit_amc_jc.php",
      data: {
        'checking_service_jc_btn': true,
        'customer_id': customer_id,
        'visitDate': visitDate,
        'amc_id' : amc_id
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
    // amc
    $('#edit_agreement').val(data.agreement);
    $('#edit_amc_id').val(data.amc_id);
    $('#jc_create_date').text(data.visitDate);
    // $btn.data('jc_create_date', visitDate); // Use $btn instead of $(this)
    
   
      // Prepare URL parameters
      var params = new URLSearchParams();
      params.append('edit_customer_type_select', data.customer_type);
      params.append('edit_customer_id', data.edit_customer_id);
      params.append('edit_customer_name', data.customer_name);
      params.append('edit_company_name', data.company_name);
      params.append('edit_address', data.address);
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
      // amc
      params.append('edit_agreement', data.agreement);
      params.append('edit_amc_id', data.amc_id);
      params.append('jc_create_date', visitDate);
    
      // Store the data in localStorage
      localStorage.setItem('editData', JSON.stringify(data));
  
      // Redirect to the success page
      window.location.href = 'amc-jc-page.php';
        
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
    // amc
    $('#edit_agreement').text(editData.agreement);
    $('#edit_amc_id').text(editData.amc_id);
    $('#edit_amc_id_input').val(editData.amc_id);
    $('#jc_create_date').text(editData.visitDate);

  
    // Clear the data from localStorage
    localStorage.removeItem('editData');
  });
// clicked AMC button

  
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
  
  // CLICK AMC THEN VIEW EDIT DATA FOR CUSTOMER 
// $(document).ready(function (){
//     $('.service_jc_btn').click(function(e) {
//        e.preventDefault(); /*-----edit button on click-------*/
//     //function updateProduct() {
//       var customer_id = $(this).closest('tr').find('.customer_id').text();
    
//       $.ajax({
//         type: "POST",
//         url: "edit_amc_jc.php",
//         data: {
//           'checking_service_jc_btn': true,
//           'customer_id': customer_id,
//         },
//         success: function(response) {
//           //  console.log(response);
//       // Parse the response JSON object
//       var data = JSON.parse(response);
      
//       $('#edit_customer_type_select').val(data.customer_type);
//       $('#edit_customer_name').val(data.customer_name);
//       $('#edit_customer_id').val(data.edit_customer_id);
//       $('#edit_company_name').val(data.company_name);
//       $('#edit_address').val(data.address);
//       $('#edit_area').val(data.area);
//       $('#edit_city').val(data.city);
//       $('#edit_county').val(data.county);
//       $('#edit_contact_name_one').val(data.contact_name_one);
//       $('#edit_contact_name_two').val(data.contact_name_two);
//       $('#edit_contact_phone_one').val(data.contact_phone_one);
//       $('#edit_contact_phone_two').val(data.contact_phone_two);
//       $('#edit_email').val(data.email);
//       $('#edit_sales_agent_select').val(data.sales_agent);
//       $('#edit_discount').val(data.discount);
//       $('#edit_product_select').val(data.product);
//       $('#edit_physical_location').val(data.physical_location);
//       $('#edit_google_location').val(data.google_location);
//       $('#edit_commerce_select').val(data.commerce);
//       $('#edit_date_w_amc').val(data.date_w_amc);
//       $('#edit_status').val(data.status);
//       $('#edit_brand_input').val(data.brand);
//       $('#edit_business_input').val(data.business);
//       $('#edit_referred_select').val(data.referred);
     
//         // Prepare URL parameters
//         var params = new URLSearchParams();
//         params.append('edit_customer_type_select', data.customer_type);
//         params.append('edit_customer_id', data.edit_customer_id);
//         params.append('edit_customer_name', data.customer_name);
//         params.append('edit_company_name', data.company_name);
//         params.append('edit_address', data.address);
//         params.append('edit_area', data.area);
//         params.append('edit_city', data.city);
//         params.append('edit_county', data.county);
//         params.append('edit_contact_name_one', data.contact_name_one);
//         params.append('edit_contact_name_two', data.contact_name_two);
//         params.append('edit_contact_phone_one', data.contact_phone_one);
//         params.append('edit_contact_phone_two', data.contact_phone_two);
//         params.append('edit_email', data.email);
//         params.append('edit_sales_agent_select', data.sales_agent);
//         params.append('edit_discount', data.discount);
//         params.append('edit_product_select', data.product);
//         params.append('edit_physical_location', data.physical_location);
//         params.append('edit_google_location', data.google_location);
//         params.append('edit_commerce_select', data.commerce);
//         params.append('edit_date_w_amc', data.date_w_amc);
//         params.append('edit_status', data.status);
//         params.append('edit_brand_input', data.brand);
//         params.append('edit_business_input', data.business);
//         params.append('edit_referred_select', data.referred);
        
    
//         // Store the data in localStorage
//         localStorage.setItem('editData', JSON.stringify(data));
    
//         // Redirect to the success page
//         window.location.href = 'amc-jc-page.php';
          
//         }
//       });
//     });
//     });
    
//     $(document).ready(function () {
//       // Retrieve data from localStorage
//       var editData = JSON.parse(localStorage.getItem('editData'));
    
//       // Populate form fields with the data
//       $('#edit_customer_type_select').text(editData.customer_type);
//       $('#edit_customer_name').text(editData.customer_name);
//       $('#edit_customer_id').text(editData.edit_customer_id);
//       $('#edit_company_name').text(editData.company_name);
//       $('#edit_address').text(editData.address);
//       $('#edit_area').text(editData.area);
//       $('#edit_city').text(editData.city);
//       $('#edit_county').val(editData.county);
//       $('#edit_contact_name_one').text(editData.contact_name_one);
//       $('#edit_contact_name_two').text(editData.contact_name_two);
//       $('#edit_contact_phone_one').text(editData.contact_phone_one);
//       $('#edit_contact_phone_two').text(editData.contact_phone_two);
//       $('#edit_email').text(editData.email);
//       $('#edit_sales_agent_select').text(editData.sales_agent);
//       $('#edit_discount').text(editData.discount);
//       $('#edit_product_select').text(editData.product);
//       $('#edit_physical_location').text(editData.physical_location);
//       $('#edit_google_location').text(editData.google_location);
//       $('#edit_commerce_select').text(editData.commerce);
//       $('#edit_date_w_amc').text(editData.date_w_amc);
//       $('#edit_status').text(editData.status);
//       $('#edit_brand_input').text(editData.brand);
//       $('#edit_business_input').text(editData.business);
//       $('#edit_referred_select').text(editData.referred);
  
    
//       // Clear the data from localStorage
//       localStorage.removeItem('editData');
//     });
  
    
    
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

// CLICK AMC THEN VIEW EDIT DATA FOR CUSTOMER 
    // View Details Customer
//   $(document).ready(function() {
//     // Handle the click event on the "bi-eye" icon
//     $('.add-amc').click(function() {
//       var customerId = $(this).data('id');

//       // Make an AJAX request to fetch customer data
//       $.ajax({
//         type: 'POST',
//         url: 'view-customer-details.php', // Replace with the actual URL of your PHP file
//         data: { customer_id: customerId },
//         dataType: 'json',
//         success: function(customerData) {
        
//           //console.log('Received data:',customerData);
//           // Populate the modal with customer details, including additional columns
//           $('#customerId').text(customerData.id);
//           $('#customerName').text(customerData.customer_name);
//           $('#customerType').text(customerData.customer_type);
//           $('#customerAddress').text(customerData.address);
//           $('#customerProduct').text(customerData.product);
//           $('#customerBusiness').text(customerData.business);
//           $('#customerCommerce').text(customerData.commerce);
//           $('#customerContactName1').text(customerData.contact_name_one);
//           $('#customerContactPhone1').text(customerData.contact_phone_one);
//           $('#customerContactName2').text(customerData.contact_name_two);
//           $('#customerContactPhone2').text(customerData.contact_phone_two);

//           // Additional columns
//           // $('#customerEmail').text(customerData.email);
//           // $('#customerAddress').text(customerData.address);

//           // Show the modal
//           $('#viewCustomerModal').modal('show');
//         }, 
//         error: function(xhr, status, error) {
//           console.error('Error fetching customer data:', error);
//         }
//       });
//     });

//     // Triggered when the modal is about to be shown
//     $('#viewCustomerModal').on('show.bs.modal', function (event) {
//       // $(document).on('show.bs.modal', '#viewCustomerModal', function (event) {
//       // Clear the placeholders before showing the modal
//       $('#customerId').text(customerData.id);
//       $('#customerName').text('');
//       $('#customerType').text('');
//       $('#customerAddress').text('');
//       $('#customerProduct').text('');
//       $('#customerBusiness').text('');
//       $('#customerCommerce').text('');
//       $('#customerContactName1').text('');
//       $('#customerContactPhone1').text('');
//       $('#customerContactName2').text('');
//       $('#customerContactPhone2').text('');
//       // $('#customerEmail').text('');
//       // $('#customerAddress').text('');
//     });
//   });


// // View Details Customer


// /*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
// $(document).ready(function (e){

//     $('.delete_customer_btn').click(function(e){
//         e.preventDefault();/*-----delete button on click-------*/
  
//         var product_id = $(this).closest('tr').find('.customer_id').text();
//         //console.log(product_id);
  
//         $('#delete_customer_id').val(product_id);
//         $('#deletecustomermodal').modal('show');

//       });

       
// })

// $(document).ready(function() {
//   // Click event handler for the button
//   $('.service_jc_btn').on('click', function(e) {
//       e.preventDefault(); // Prevent default anchor click behavior

//       // Gather form data
//       var formData = {
//           // Add all form field values here
//           // Example:
//           // jc_type: $('#jc_type').val(),
//           // edit_customer_id: $('#edit_customer_id').val(),
//           // role: $('#role').val(),
//           // Add more fields as needed
                            
//           jcType : $('#jc_type').val(),
//           // var amount = $('#amount').val();
//           jcCreateDate : $('#jc_create_date').text(),
//           customerType : $('#edit_customer_type_select').text(),
//           jcLeadBy : $('#jc_lead_by').val(),
//           customerName : $('#edit_customer_name').text(),
//           customerId : $('#edit_customer_id').text(),
//           companyName : $('#edit_company_name').text(),
//           address : $('#edit_address').text(),
//           area : $('#edit_area').text(),
//           city : $('#edit_city').text(),
//           county : $('#edit_county').text(),
//           salesAgent : $('#edit_sales_agent_select').text(),
//           contactNameOne : $('#edit_contact_name_one').text(),
//           contactPhoneOne : $('#edit_contact_phone_one').text(),
//           contactNameTwo : $('#edit_contact_name_two').text(),
//           contactPhoneTwo : $('#edit_contact_phone_two').text(),
//           physicalLocation : $('#edit_physical_location').text(),
//           commerce : $('#edit_commerce_select').text(),
//           productName : $('#edit_product_select').text(),
//           brandName : $('#edit_brand_input').text(),
//           datewamc : $('#edit_date_w_amc').text(),
//           googleLocation : $('#edit_google_location').text(),
//           workStatement : $('#edit_agreement').text(),
//           // var customerWord = $('#customer_word').val();
//           business : $('#edit_business_input').text(),
//           lastJcNumber : $('#edit_last_jobcard_number').text(),
//           lastJcDate : $('#edit_last_jobcard_date').text(),

//           lastJcType : $('#last_jc_type').text(),
//           lastAssignedTo : $('#last_assigned_to').text(),


//           role : $('#role').val(),
//           amc_id : $('#edit_amc_id').text(),



//       };

//       // Submit form data via AJAX
//       $.ajax({
//           type: 'POST',
//           url: 'add_service_jc.php', // Specify the URL of your PHP file
//           data: formData,
//           success: function(response) {
//               // Handle success response if needed
//               console.log(response);
//           },
//           error: function(xhr, status, error) {
//               // Handle error if needed
//               console.error(xhr.responseText);
//           }
//       });
//   });
// });