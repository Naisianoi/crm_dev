
function redirectToPageAfterSeconds(pageURL, seconds) {
    setTimeout(function() {
        window.location.href = pageURL; // Redirect to the specified page
    }, seconds * 1000); // Multiply by 1000 to convert seconds to milliseconds
}

document.getElementById("updateAllProductButton").addEventListener("click", function() {
    var productUpdateData = [];

    // Loop through all the product rows and capture the values
    $('table tbody tr').each(function () {
        var productId = $(this).find('.product_id').text();
        var newMinStock = $(this).find('input[name^="new_min_p_stock_"]').val();
        var newStockQty = $(this).find('input[name^="new_stock_p_qty_"]').val();

        // Create an object with the captured data
        var productData = {
            product_id: productId,
            new_min_p_stock: newMinStock,
            new_stock_p_qty: newStockQty
        };

        productUpdateData.push(productData);
    });

    // Send the product update data to the server using AJAX
    $.ajax({
        type: 'POST',
        url: 'edit_stock_correction_product.php', // Replace with the actual server-side script
        data: {
            products: JSON.stringify(productUpdateData)
        },
        dataType: 'json', // Expect JSON response
        success: function (response) {
            // Check for individual success and failure messages
            var successMessages = [];
            var errorMessages = [];

            $.each(response, function (index, message) {
                if (message.startsWith("Product updated")) {
                    successMessages.push(message);
                    reloadPage();
                } else {
                    errorMessages.push(message);
                
                }
            });

            // Display success and error messages
            // if (successMessages.length > 0) {
            //     alert(successMessages.join('\n')); // Display success messages
            //     location.reload(); // Reload the page to see the updated values
            // }

            // if (errorMessages.length > 0) {
            //     alert(errorMessages.join('\n')); // Display error messages
            // }

            // Reload the page without displaying pop-up alerts
            // window.location.reload();

             // Reload the page after the updates are completed
            //  reloadPage();
        }
    });
    redirectToPageAfterSeconds("stock-correction-page.php", 1);
});


// ITEMS
// $('#updateAllButton').click(function () {
    document.getElementById("updateAllItemButton").addEventListener("click", function() {
    var updateData = [];

    // Loop through all the rows and capture the values
    $('tbody tr').each(function () {
        var itemId = $(this).find('.item_id').text();
        var newMinStock = $(this).find('input[name^="new_min_stock_"]').val();
        var newStockQty = $(this).find('input[name^="new_stock_qty_"]').val();

        // Create an object with the captured data
        var itemData = {
            item_id: itemId,
            new_min_stock: newMinStock,
            new_stock_qty: newStockQty
        };

        updateData.push(itemData);
    });

    // Send the data to the server using AJAX
    $.ajax({
        type: 'POST',
        url: 'edit_stock_correction.php',
        data: {
            items: JSON.stringify(updateData)
        },
        dataType: 'json', // Expect JSON response
        success: function (response) {
            // console.log(response);
            // Check for individual success and failure messages
            var successMessages = [];
            var errorMessages = [];
    
            $.each(response, function (index, message) {
                if (message.startsWith("Item updated")) {
                    successMessages.push(message);
                } else {
                    errorMessages.push(message);
                }
            });
    
            // Display success and error messages
            if (successMessages.length > 0) {
                alert(successMessages.join('\n')); // Display success messages
                location.reload(); // Reload the page to see the updated values
            }
    
            if (errorMessages.length > 0) {
                alert(errorMessages.join('\n')); // Display error messages
            }

            // // Reload the page without displaying pop-up alerts
            // window.location.reload();

             // Reload the page after the updates are completed
            //  reloadPage();
        }
    });
    redirectToPageAfterSeconds("stock-correction-page.php", 1);
});





// $('#updateAllButton').click(function () {
//     var updateData = [];

//     // Loop through all the rows and capture the values
//     $('tbody tr').each(function () {
//         var itemId = $(this).find('.item_id').text();
//         var newMinStock = $(this).find('input[name^="new_min_stock_"]').val();
//         var newStockQty = $(this).find('input[name^="new_stock_qty_"]').val();

//         // Create an object with the captured data
//         var itemData = {
//             item_id: itemId,
//             new_min_stock: newMinStock,
//             new_stock_qty: newStockQty
//         };

//         updateData.push(itemData);
//     });

//     // Send the data to the server using AJAX
//     $.ajax({
//         type: 'POST',
//         url: 'edit_stock_correction.php',
//         data: {
//             items: JSON.stringify(updateData)
//         },
//         success: function (response) {
//             if (response === 'success') {
//                 // The update was successful, but you may want to add a slight delay
//                 // before reloading the page to ensure the server-side changes are applied.
//                 // You can use setTimeout for this purpose.
//                 var modalTitle = document.getElementById("modalTitle");
//                 var modalBody = document.getElementById("modalBody");

//                 modalTitle.innerHTML = "Update Successful";
//                 modalBody.innerHTML = "Update successful! Page will now reload.";

//                 $('#myModal').modal('show');

//                 setTimeout(function() {
//                     location.reload(); // Reload the page after a short delay
//                 }, 1000); // Adjust the delay as needed
//             } else {
//                 var modalTitle = document.getElementById("modalTitle");
//                 var modalBody = document.getElementById("modalBody");

//                 modalTitle.innerHTML = "Update Failed";
//                 modalBody.innerHTML = "Update failed. Please try again.";

//                 $('#myModal').modal('show');
//             }
//         }
//     });
// });
