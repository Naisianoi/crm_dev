// EXECUTING PRICE LIST PAGE
document.getElementById("btn-execute-queries").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "price_list_queries.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // console.log(xhr.responseText); // Log the response to the console
            alert("Price list updated successfully."); // Show an alert to indicate success
            window.location.href = "price-list-page.php";
        }
    };
    xhr.send();
});

// EDIT BUTTON ITEM
$(document).ready(function () {

    $('.edit_item_btn').click(function(e) {
      e.preventDefault();
  
      var item_id = $(this).closest('tr').find('.item_id').text();
  
      $.ajax({
        type: "POST",
        url: "edit_item_price_list.php",
        data: {
          'checking_edit_item_btn': true,
          'item_id': item_id,
        },
        success: function(response) {
          console.log(response);
          
  
          // Parse the response JSON object
          var data = JSON.parse(response);
  
          // Store the data in sessionStorage (instead of localStorage)
          sessionStorage.setItem('editData', JSON.stringify(data));
  
          // Redirect to the "edit-item-page.php"
          window.location.href = 'edit-item-price-list-page.php';
        }
      });
    });
  });
  
  $(document).ready(function () {
    // Retrieve data from sessionStorage instead of localStorage
    var editData = JSON.parse(sessionStorage.getItem('editData'));
  
    if (editData) {
      // Populate form fields with the data if it exists
      $('#edit_business_select_item').val(editData.business);
      $('#edit_category_select').val(editData.category);
      $('#edit_sub_category_select').val(editData.sub_category);
      $('#edit_item_id').val(editData.edit_item_id);
      $('#edit_brand_select').val(editData.brand);
      $('#edit_item_name').val(editData.item_name);
      $('#edit_price').val(editData.price);
      $('#edit_selling_price').val(editData.selling_price);
      $('#edit_stock_qty').val(editData.stock_qty);
      $('#edit_min_stock').val(editData.min_stock);
      $('#edit_supplier_name').val(editData.supplier_name);
      $('#edit_purchase_mode').val(editData.purchase_mode);
      $('#edit_purchase_price_date').val(editData.purchase_price_date);
  
      $('#edit_INR_purchase_price').val(editData.INR_purchase_price);
      $('#edit_weight').val(editData.weight);
      $('#edit_margin').val(editData.margin);
      $('#edit_price_list_price').val(editData.price_list_price);
      $('#edit_auto_purchase_price').val(editData.auto_purchase_price);
      $('#edit_auto_selling_price').val(editData.auto_selling_price);
      
  
      // Clear the data from sessionStorage
      sessionStorage.removeItem('editData');
    }
  });
  
// EDIT BUTTON ITEM


// EDIT BUTTON PRODUCT
$(document).ready(function () {
    $('.edit_product_btn').click(function(e) {
      e.preventDefault();
  
      var product_id = $(this).closest('tr').find('.product_id').text();
  
      $.ajax({
        type: "POST",
        url: "edit_product_price_list.php",
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
          window.location.href = 'edit-product-price-list-page.php';
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
  
// EDIT BUTTON PRODUCT  
