//Display Company input to fill if Company in CUSTOMER TYPE is selected 
// Get the customer type select element
let customerTypeSelect = document.getElementById('customer_type_select');
    
// Get the company name input element
let companyNameInput = document.getElementById('company_name_input');

// Add an event listener to the customer type select
customerTypeSelect.addEventListener('change', function() {
    // Check if the selected option is "Company"
    if (customerTypeSelect.value === 'Company') {
        // Show the company name input
        companyNameInput.style.display = 'block';
    } else {
        // Hide the company name input
        companyNameInput.style.display = 'none';
    }
});
//Display Company input to fill if Company in CUSTOMER TYPE is selected 


//Display Discount input to fill if Reseller in CUSTOMER TYPE is selected 
// Get the customer type select element
let customerTypeResellerSelect = document.getElementById('customer_type_select');
    
// Get the company name input element
let discountNameInput = document.getElementById('discount_input');

// Add an event listener to the customer type select
customerTypeResellerSelect.addEventListener('change', function() {
    // Check if the selected option is "Reseller"
    if (customerTypeResellerSelect.value === 'Reseller') {
        // Show the company name input
        discountNameInput.style.display = 'block';
    } else {
        // Hide the company name input
        discountNameInput.style.display = 'none';
    }
});
//Display Discount input to fill if Reseller in CUSTOMER TYPE is selected 


//Display Date input to fill if Warranty/AMC in COMMERCE is selected 
// Get the customer type select element
let commerceSelect = document.getElementById('commerce_select');
    
// Get the company name input element
let commerceInput = document.getElementById('commerce_input');

// Add an event listener to the commerce select
commerceSelect.addEventListener('change', function() {
    // Check if the selected option is "Warranty/AMC"
    if (commerceSelect.value === 'Warranty' || commerceSelect.value === 'AMC') {
        // Show the commerce input
        commerceInput.style.display = 'block';
    } else {
        // Hide the commerce input
        commerceInput.style.display = 'none';
    }
});
//Display Date input to fill if Warranty/AMC in COMMERCE is selected

// fetch data brand & business when product selected
console.log('selected product');
$(document).ready(function() {
  // When a product is selected

  $('#product_select').change(function() {
      var selectedProduct = $(this).val();

      // Use AJAX to fetch brand and business information
      $.ajax({
          url: 'fetch_data_customer_product.php', // Replace with the actual file to handle AJAX request
          method: 'POST',
          data: { product: selectedProduct },
          success: function(response) {
            console.log(response);
              
              $('#brand_input').val(response.brand);
              $('#business_input').val(response.business);
              
          },
          error: function(xhr, status, error) {
               console.log("AJAX Error:", error);
    }
      });
  });
});

// fetch data brand & business when product selected
    