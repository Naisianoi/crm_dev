// fetch data brand & business when product selected
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
              var data = JSON.parse(response);
              $('#brand_input').val(data.brand);
              $('#business_input').val(data.business);
          }
      });
  });
});

// fetch data brand & business when product selected




//Combining all the validating functions in one for avoiding empty form fields
function validateForm2() {
    var isValid = true;
  
    isValid = isValid && validateAddCustomer2();
    
  
    return isValid;
  }
  
  //Prevent empty customer type in ADD
  function validateAddCustomer2() {    
    var customerSelect = document.getElementById("customer_type_select");
      var selectedOption = customerSelect.value;
      
      if (selectedOption === "Choose Customer Type") {
        alert("Please choose Customer Type");
        return false; // Prevent form submission
      }
      
      return true; // Allow form submission
    }
    //Prevent empty category in ADD

    