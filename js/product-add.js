//Ajax for filtering the select options (ADD PRODUCT)
// JavaScript code
var businessSelect = document.getElementById('business_select_product');
var brandSelect = document.getElementById('brand_select');

businessSelect.addEventListener('change', function() {
    // Clear the options in the category select
    brandSelect.innerHTML = '<option selected disabled>Choose Brand</option>';

    // Get the selected value from the business select
    var selectedBusiness = businessSelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_product_ajax.php?business=' + selectedBusiness, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var options = JSON.parse(xhr.responseText);

            // Populate options for the category select
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.value = options[i].value;
                option.textContent = options[i].label;
                brandSelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});
//End Ajax for filtering the select options

//Prevent empty business in ADD
function validateAddBusiness() {
    var businessSelect = document.getElementById("business_select_product");
    var selectedOption = businessSelect.value;
    
    if (selectedOption === "Choose Business") {
      alert("Please choose a business");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty category in ADD



//Prevent empty brand in ADD
function validateAddBrand() {
    var brandSelect = document.getElementById("brand_select");
    var selectedOption = brandSelect.value;
    
    if (selectedOption === "Choose Brand") {
      alert("Please choose a brand");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty brand in ADD