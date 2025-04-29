
//   ITEM UPDATE
  $(document).ready(function () {
    $(".update-btn").click(function () {
      var row = $(this).closest("tr");
      var itemId = row.find(".item_id").text();
      var newPrice = row.find(".new-price").val();

       // Validate the new price input
       if (newPrice.trim() === "") {
        alert("Please enter a valid price");
        return;
       }

      // Perform AJAX request to update the data
      $.ajax({
        type: "POST",
        url: "edit_purchase_price_item.php", // Replace with your server-side update script
        data: {
          id: itemId,
          price: newPrice,
        },
        success: function (response) {
          // Update the DOM with the new data or handle success accordingly
          if (response == "success") {
            // Update the price and purchase_price_date in the current row
            row.find(".price").text(newPrice);
            row.find(".purchase_price_date").text(getCurrentDate());
            window.location.href = 'purchase-price-page.php'; // Redirect on success
          } else {
            alert("Update failed. Please try again.");
          }
        },
      });
    });

    function getCurrentDate() {
      var currentDate = new Date();
      var dd = String(currentDate.getDate()).padStart(2, "0");
      var mm = String(currentDate.getMonth() + 1).padStart(2, "0");
      var yyyy = currentDate.getFullYear();
      return yyyy + "-" + mm + "-" + dd;
    }
  });
//   ITEM UPDATE


// PRODUCT UPDATE
$(document).ready(function () {
    $(".update-btn-product").click(function () {
      var row = $(this).closest("tr");
      var productId = row.find(".product_id").text();
      var newPrice = row.find(".new-price").val();

      // Validate the new price input
      if (newPrice.trim() === "") {
        alert("Please enter a valid price");
        return;
      }

      // Perform AJAX request to update the data
      $.ajax({
        type: "POST",
        url: "edit_purchase_price_product.php", // Replace with your server-side update script
        data: {
          id: productId,
          price: newPrice,
        },
        success: function (response) {
          // Update the DOM with the new data or handle success accordingly
          if (response == "success") {
            // Update the price and purchase_price_date in the current row
            row.find(".price").text(newPrice);
            row.find(".purchase_price_date").text(getCurrentDate());
            window.location.href = 'purchase-price-page.php'; // Redirect on success
          } else {
            alert("Update failed. Please try again.");
          }
        },
      });
    });

    function getCurrentDate() {
      var currentDate = new Date();
      var dd = String(currentDate.getDate()).padStart(2, "0");
      var mm = String(currentDate.getMonth() + 1).padStart(2, "0");
      var yyyy = currentDate.getFullYear();
      return yyyy + "-" + mm + "-" + dd;
    }
  });

// PRODUCT UPDATE


