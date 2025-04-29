
$(document).ready(function () {
    $('.close-jc-btn').click(function(e) {
        e.preventDefault();

        
var jc_id = $('#jc_id').val();

// product and item
var selectedProducts = selectedData;
var selectedItems = selectedDataItem;


var requestData = {
    
    // 'close-jc-btn': true,
    'jc_id': jc_id,
    // product and item
    'selected_products': selectedProducts,
    'selected_items': selectedItems      
};

$.ajax({
    type: 'POST',
    url: 'edit_jobcard.php',
    data: requestData,
    dataType: 'json',
    
    success: function(response) {

        if (response.status === 'success'){


        window.location.href = 'assign-jc-page.php';
        // console.log('AJAX Response:', response); // Add this line for debugging
        // ... rest of your code ...
        } else if (response.status === 'error' && response.insufficient_stock) {
            // Show popup for insufficient stock
            var insufficientStockItems = response.insufficient_stock_items.join(', ');
            alert('Insufficient stock for the following: ' + insufficientStockItems);
        }
    },
    // success: function(response) {
    //     // console.log(response);
    //     if (response.status === 'success') {
    //         var serviceJcId = response.service_jc_id;
    //         if (serviceJcId) {
    //             var popupContainer = $('#popup-container');
    //             var popupMessage = $('#popup-message');
    //             var popupCloseBtn = $('#popup-close-btn');

    //             popupMessage.text('Service Job Card ID: ' + serviceJcId);
    //             popupContainer.css('display', 'block');

    //             popupCloseBtn.click(function() {
    //                 popupContainer.css('display', 'none');
    //                 window.location.href = 'assign-jc-page.php';
    //             });
    //         }
    //     }
    // },
    error: function(xhr, status, error) {
               
        window.location.href = 'assign-jc-page.php';
        console.log('AJAX Error:', error);
        // console.log('AJAX Error:', xhr, status, error);
        // You can also inspect the xhr.responseText for more details
        console.log('Server response:', xhr.responseText);
    }
});
});
});


// $.ajax({
//     type: 'POST',
//     url: 'add_service_jc.php',
//     data: requestData,
//     dataType: 'json',
//     success: function(response) {
//         if (response.status === 'success') {
//             var serviceJcId = response.service_jc_id;
//             // var jcType = response.jc_type; // Assuming your AJAX response includes jc_type

//             // if (!jcType) {
//             //     // If jc_type is empty, display an error message or take appropriate action
//             //     alert('Choose a Jobcard Type');
//             //     return;
//             // }

//             if (serviceJcId) {
//                 var popupContainer = $('#popup-container');
//                 var popupMessage = $('#popup-message');
//                 var popupCloseBtn = $('#popup-close-btn');

//                 popupMessage.text('Service Job Card ID: ' + serviceJcId);
//                 popupContainer.css('display', 'block');

//                 popupCloseBtn.click(function() {
//                     popupContainer.css('display', 'none');
//                     window.location.href = 'assign-jc-page.php';
//                 });
//             }
//         } else if (response.status === 'error jc type') {
//             // If jc_type is empty, display an error message or take appropriate action
//             alert('Choose a Jobcard Type');
//             // return;

//         } else if (response.status === 'error' && response.insufficient_stock) {
//             // Show popup for insufficient stock
//             var insufficientStockItems = response.insufficient_stock_items.join(', ');
//             alert('Insufficient stock for the following: ' + insufficientStockItems);
       
//         } else {
//             // Handle other error cases
//             console.log('Unhandled error:', response);
//         }
//     },
//         error: function(xhr, status, error) {
//             console.log('AJAX Error:', error);

//             // You can also inspect the xhr.responseText for more details
//             console.log('Server response:', xhr.responseText);
//     }
// });


// });
// });
