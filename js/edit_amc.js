
  // CLICK FOR VIEW HISTORY JC
//   function AMCEdit(customerId) {
//     // Redirect to customer-history-page with the customer ID
//     window.location.href = 'edit-amc-page.php?id=' + customerId;
//   }

//   function AMCEdit(customerId, ) {
//     // AJAX request
//     $.ajax({
//       type: 'POST',
//       url: 'edit_amc.php', // PHP script to handle the request
//       data: { customerId: customerId }, // Send customerId to the server
//       dataType: 'json',
//       success: function(data) {
//         // Populate form fields with fetched data
//         $('#edit_start_dt').val(data.start_date);
//         $('#edit_end_dt').val(data.end_date);
//         $('#edit_visits').val(data.agreed_visits);
//         $('#edit_amc_amount').val(data.amount);
//         $('#edit_agreement').val(data.agreement);
//         // Populate other fields as needed
//       },
//       error: function(xhr, status, error) {
//         console.error('AJAX Error: ' + status + ' - ' + error);
//       }
//     });
//   }
  
// function AMCEdit(cId, aId) {
//     // AJAX request
//     $.ajax({
//       type: 'POST',
//       url: 'edit_amc.php', // PHP script to handle the request
//       data: { cId: cId, aId: aId }, // Send cId and aId to the server
//       dataType: 'json',
//       success: function(data) {
//         // Redirect to edit-amc-page.php after the AJAX call succeeds
//         // window.location.href = 'edit-amc-page.php';
//       },
//       error: function(xhr, status, error) {
//         console.error('AJAX Error: ' + status + ' - ' + error);
//       }
//     });
//   }
  
  $(document).ready(function() {
    // Add click event listener to edit-amc buttons
    $('.edit-amc').click(function(e) {
        e.preventDefault(); // Prevent default action of anchor tag

        // Get customer_id and amc_id from data attributes
        var customer_id = $(this).closest('tr').find('.customer_id').text();
        var amc_id = $(this).closest('tr').find('.amc_id').text();
        // var customerId = $(this).data('c_id');
        // var amcId = $(this).data('a_id');
        // console.log(customer_id);
        // console.log(amc_id);
        
        // AJAX request to fetch data from both tables
        $.ajax({
            type: 'POST',
            url: 'edit_amc.php', // Your PHP script to handle the request
            data: {
              'checking_edit_amc_btn': true,
              'customer_id': customer_id,
              'amc_id': amc_id,
            },
            // data: { customerId: customerId, amcId: amcId },
            success: function(response) {
              // console.log(response);
              
      
              // Parse the response JSON object
              var data = JSON.parse(response);
             
              // Store the data in sessionStorage (instead of localStorage)
              sessionStorage.setItem('editData', JSON.stringify(data));
      
              // Redirect to the "edit-item-page.php"
              window.location.href = 'edit-amc-page.php';
            }
          });
        });
      });


      $(document).ready(function () {
        // Retrieve data from sessionStorage instead of localStorage
        var editData = JSON.parse(sessionStorage.getItem('editData'));
      
        if (editData) {
          
          $('#edit_start_dt').val(editData.start_dt);
          $('#edit_end_dt').val(editData.end_dt);
          $('#edit_visits').val(editData.visits);
          $('#edit_amc_amount').val(editData.amc_amount);
          $('#edit_agreement').val(editData.agreement);
          $('#edit_amc_id').val(editData.amc_id);
          $('#edit_customer_id').val(editData.customer_id);

          $('#edit_customer_name').text(editData.customer_name);
          $('#edit_customer_type').text(editData.customer_type);
          // $('#edit_customer_id').text();
          $('#edit_company_name').text(editData.company_name);
          $('#edit_address').text(editData.address);
          $('#edit_area').text(editData.area);
          $('#edit_city').text(editData.city);
          $('#edit_county').text(editData.county);
          $('#edit_sales_agent').text(editData.sales_agent);
          $('#edit_contact_name_one').text(editData.contact_name_one);
          $('#edit_contact_phone_one').text(editData.contact_phone_one);
          $('#edit_contact_name_two').text(editData.contact_name_two);
          $('#edit_contact_phone_two').text(editData.contact_phone_two);
          $('#edit_physical_location').text(editData.physical_location);
          $('#edit_commerce').text(editData.commerce);
          $('#edit_product').text(editData.product);
          $('#edit_brand').text(editData.brand);
          $('#edit_date_w_amc').text(editData.date_w_amc);
          $('#edit_google_location').text(editData.google_location);
          // Populate form fields with the data if it exists
          // $('#edit_business_select_item').val(editData.business);
          // $('#edit_category_select').val(editData.category);
          // $('#edit_sub_category_select').val(editData.sub_category);
          // $('#edit_item_id').val(editData.edit_item_id);
          // $('#edit_brand_select').val(editData.brand);
          // $('#edit_item_name').val(editData.item_name);
          // $('#edit_price').val(editData.price);
          // $('#edit_selling_price').val(editData.selling_price);
          // $('#edit_stock_qty').val(editData.stock_qty);
          // $('#edit_min_stock').val(editData.min_stock);
          // $('#edit_supplier_name').val(editData.supplier_name);
          // $('#edit_purchase_mode').val(editData.purchase_mode);
          // $('#edit_purchase_price_date').val(editData.purchase_price_date);
      
          // $('#edit_INR_purchase_price').val(editData.INR_purchase_price);
          // $('#edit_weight').val(editData.weight);
          // $('#edit_margin').val(editData.margin);
          // $('#edit_price_list_price').val(editData.price_list_price);
          // $('#edit_auto_purchase_price').val(editData.auto_purchase_price);
          // $('#edit_auto_selling_price').val(editData.auto_selling_price);
          
      
          // Clear the data from sessionStorage
          sessionStorage.removeItem('editData');
        }
      });
      
