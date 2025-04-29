/* CLICK FOR SEARCH BUSINESS */
function submitForm() {
  document.getElementById('business-search-form').submit();
}
/* CLICK FOR SEARCH BUSINESS */


/* CLICK FOR SEARCH BRAND */
function submitForm2() {
  document.getElementById('brand-search-form').submit();
}
/* CLICK FOR SEARCH BRAND */




//Ajax for filtering the select options (EDIT PRODUCT)
// JavaScript code

var editbusinessSelect = document.getElementById('edit_business_select_product');
var editbrandSelect = document.getElementById('edit_brand_select');

editbusinessSelect.addEventListener('change', function() {
    // Clear the options in the category select
    editbrandSelect.innerHTML = '<option selected disabled>Choose Brand</option>';

    // Get the selected value from the business select
    var selectedBusiness = editbusinessSelect.value;

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
                editbrandSelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});


/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    $('.delete_product_btn').click(function(e){
        e.preventDefault();/*-----delete button on click-------*/
  
        var product_id = $(this).closest('tr').find('.product_id').text();
        //console.log(product_id);
  
        $('#delete_product_id').val(product_id);
        $('#deleteproductmodal').modal('show');

      });

       
})


$(document).ready(function () {
  $('.edit_product_btn').click(function(e) {
    e.preventDefault();

    var product_id = $(this).closest('tr').find('.product_id').text();

    $.ajax({
      type: "POST",
      url: "edit_product.php",
      data: {
        'checking_edit_product_btn': true,
        'product_id': product_id,
      },
      success: function(response) {
        console.log(response);

        // Parse the response JSON object
        var data = JSON.parse(response);

        // Store the data in sessionStorage (instead of localStorage)
        sessionStorage.setItem('editProductData', JSON.stringify(data));

        // Redirect to the "edit-product-page.php"
        window.location.href = 'edit-product-page.php';
      }
    });
  });
});

$(document).ready(function () {
  // Retrieve data from sessionStorage instead of localStorage
  var editProductData = JSON.parse(sessionStorage.getItem('editProductData'));

  if (editProductData) {
    // Populate form fields with the data if it exists
    $('#edit_business_select_product').val(editProductData.business);
    $('#edit_product_id').val(editProductData.edit_product_id);
    $('#edit_brand_select').val(editProductData.brand);
    $('#edit_name').val(editProductData.name);
    $('#edit_price').val(editProductData.price);
    $('#edit_selling_price').val(editProductData.selling_price);
    $('#edit_stock_qty').val(editProductData.stock_qty);
    $('#edit_min_stock').val(editProductData.min_stock);
    $('#edit_supplier_name').val(editProductData.supplier_name);
    $('#edit_purchase_mode').val(editProductData.purchase_mode);
    $('#edit_purchase_price_date').val(editProductData.purchase_price_date);

    $('#edit_INR_purchase_price').val(editProductData.INR_purchase_price);
    $('#edit_weight').val(editProductData.weight);
    $('#edit_margin').val(editProductData.margin);
    $('#edit_price_list_price').val(editProductData.price_list_price);
    $('#edit_auto_purchase_price').val(editProductData.auto_purchase_price);
    $('#edit_auto_selling_price').val(editProductData.auto_selling_price);

    // Clear the data from sessionStorage
    sessionStorage.removeItem('editProductData');
  }
});



/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/



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

  //Prevent empty brand in EDIT
  function validateForm2() {
    var editbusinessSelect = document.getElementById("edit_business_select_product");
    var selectedOption = editbusinessSelect.value;
    
    if (selectedOption === "Choose Business") {
      alert("Please choose a business");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty category in EDIT
  
  //Prevent empty brand in EDIT
  function validateEditBrand() {
    var brandSelect = document.getElementById("edit_brand_select");
    var selectedOption = brandSelect.value;
    
    if (selectedOption === "Choose Brand") {
      alert("Please choose a brand");
      return false; // Prevent form submission
    }
    
    return true; // Allow form submission
  }
  //Prevent empty category in EDIT