/* CLICK FOR SEARCH BUSINESS */
function submitForm() {
  document.getElementById('business-search-form').submit();
}
/* CLICK FOR SEARCH CUSTOMER TYPE */


/* CLICK FOR SEARCH CATEGORY */
function submitForm2() {
  document.getElementById('category-search-form').submit();
}
/* CLICK FOR SEARCH COMMERCE */

/* CLICK FOR SEARCH SUBCATEGORY */
function submitForm3() {
document.getElementById('subcategory-search-form').submit();
}
/* CLICK FOR SEARCH AREA */

//Ajax for filtering the select options (ADD ITEM) - selected Business filter category
// JavaScript code
var businessSelect = document.getElementById('business_select_item');
var categorySelect = document.getElementById('category_select');

businessSelect.addEventListener('change', function() {
    // Clear the options in the category select
    categorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

    // Get the selected value from the business select
    var selectedBusiness = businessSelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_item_category_ajax.php?business=' + selectedBusiness, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var options = JSON.parse(xhr.responseText);

            // Populate options for the category select
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.value = options[i].value;
                option.textContent = options[i].label;
                categorySelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});
//End Ajax for filtering the select options


//Ajax for filtering the select options (ADD ITEM)
// JavaScript code
var businessSelect = document.getElementById('business_select_item');
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



//Combining all the validating functions in one for avoiding empty form fields
function validateForm2() {
  var isValid = true;

  isValid = isValid && validateAddBusiness2();
  isValid = isValid && validateAddCategory2();
  isValid = isValid && validateAddSubcategory2();
  isValid = isValid && validateAddBrand2();

  return isValid;
}

//Prevent empty business in ADD
function validateAddBusiness2() {
    var businessSelect = document.getElementById("business_select_item");
    var selectedOption = businessSelect.value;
    
    if (selectedOption === "Choose Business") {
      alert("Please choose business");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty category in ADD


//Prevent empty category in ADD
function validateAddCategory2() {
  var categorySelect = document.getElementById("category_select");
  var selectedOption = categorySelect.value;
  
  if (selectedOption === "Choose Category") {
    alert("Please choose category");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty category in ADD

//Prevent empty subcategory in ADD
function validateAddSubcategory2() {
  var subcategorySelect = document.getElementById("sub_category_select");
  var selectedOption = subcategorySelect.value;
  
  if (selectedOption === "Choose Sub-Category") {
    alert("Please choose sub-category");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty subcategory in ADD

//Prevent empty brand in ADD
function validateAddBrand2() {
  var brandSelect = document.getElementById("brand_select");
  var selectedOption = brandSelect.value;
  
  if (selectedOption === "Choose Brand") {
    alert("Please choose brand");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty brand in ADD



