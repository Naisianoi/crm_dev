

//Ajax for filtering the select options (ADD ITEM) - selected Business filter category
// JavaScript code
var editbusinessSelect = document.getElementById('edit_business_select_item');
var categorySelect = document.getElementById('edit_category_select');

editbusinessSelect.addEventListener('change', function() {
    // Clear the options in the category select
    categorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

    // Get the selected value from the business select
    var editselectedBusiness = editbusinessSelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_item_category_ajax.php?business=' + editselectedBusiness, true);
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


//Ajax for filtering the select options (ADD ITEM) - selected Business filter sub-category
// JavaScript code
var categorySelect = document.getElementById('edit_category_select');
var subcategorySelect = document.getElementById('edit_sub_category_select');

categorySelect.addEventListener('change', function() {
    // Clear the options in the sub-category select
    subcategorySelect.innerHTML = '<option selected disabled>Choose Sub-Category</option>';

    // Get the selected value from the business select
    var selectedCategory = categorySelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_item_subcategory_ajax.php?category=' + selectedCategory, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var options = JSON.parse(xhr.responseText);

            // Populate options for the category select
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.value = options[i].value;
                option.textContent = options[i].label;
                subcategorySelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});
//End Ajax for filtering the select options





//Ajax for filtering the select options (EDIT ITEM) selected business filters brand
// JavaScript code
var businessSelect = document.getElementById('edit_business_select_item');
var brandSelect = document.getElementById('edit_brand_select');

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


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    $('.delete_item_btn').click(function(e){
        e.preventDefault();/*-----delete button on click-------*/
  
        var item_id = $(this).closest('tr').find('.item_id').text();
        //console.log(item_id);
  
        $('#delete_item_id').val(item_id);
        $('#deleteitemmodal').modal('show');

      });
       
})

// EDIT 

//Combining all the validating functions in one for avoiding empty form fields
function validateForm2() {
    var isValid = true;
  
    isValid = isValid && validateEditBusiness2();
    isValid = isValid && validateEditCategory2();
    isValid = isValid && validateEditSubcategory2();
    isValid = isValid && validateEditBrand2();
  
    return isValid;
  }
  
  //Prevent empty business in EDIT
  function validateEditBusiness2() {
      var businessSelect = document.getElementById("edit_business_select_item");
      var selectedOption = businessSelect.value;
      
      if (selectedOption === "Choose Business") {
        alert("Please choose business");
        return false; // Prevent form submission
      }
      
      return true; // Allow form submission
    }
    //Prevent empty category in EDIT
  
  
  //Prevent empty category in EDIT
  function validateEditCategory2() {
    var categorySelect = document.getElementById("edit_category_select");
    var selectedOption = categorySelect.value;
    
    if (selectedOption === "Choose Category") {
      alert("Please choose category");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty category in EDIT
  
  //Prevent empty subcategory in EDIT
  function validateEditSubcategory2() {
    var subcategorySelect = document.getElementById("edit_sub_category_select");
    var selectedOption = subcategorySelect.value;
    
    if (selectedOption === "Choose Sub-Category") {
      alert("Please choose sub-category");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty subcategory in EDIT
  
  //Prevent empty brand in EDIT
  function validateEditBrand2() {
    var brandSelect = document.getElementById("edit_brand_select");
    var selectedOption = brandSelect.value;
    
    if (selectedOption === "Choose Brand") {
      alert("Please choose brand");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty brand in EDIT
  