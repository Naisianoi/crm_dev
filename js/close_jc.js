
// AJAX  for selection of production and items
$(document).ready(function () {
    
        $('.close-jc-btn').click(function(e) {
            // console.log('running close jc');
            e.preventDefault();

        var jc_id = $('#jc_id').val();
        
        var selectedProducts = selectedData; // Ensure this data is correctly populated
        var selectedItems = selectedDataItem; // Ensure this data is correctly populated

        var requestData = {
            'jc_id': jc_id,
            'selected_products': selectedProducts,
            'selected_items': selectedItems
        };

        $.ajax({
            type: 'POST',
            url: 'edit_close_jc_ip.php',
            data: requestData,
            dataType: 'json',
            success: function(response) {
                console.log('AJAX Response:', response);
                if (response.status === 'success') {
                    window.location.href = 'close-jc-page.php?jc_id=' + jc_id; // Redirect on success
                } else if (response.status === 'error' && response.insufficient_stock) {
                    // Show popup for insufficient stock
                    var insufficientStockItems = response.insufficient_stock_items.join(', ');
                    alert('Insufficient stock for the following: ' + insufficientStockItems);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
                console.log('AJAX Error:', xhr, status, error);
            }
        });
    });
});

// AJAX  for selection of production and items

// EDIT JOBCARD SERVICE AND TRADING
// AJAX  for selection of production and items
$(document).ready(function () {
    
    $('.close-jc-btn-edit').click(function(e) {
        // console.log('running close jc');
        e.preventDefault();

    var jc_id = $('#jc_id').val();
    
    var selectedProducts = selectedData; // Ensure this data is correctly populated
    var selectedItems = selectedDataItem; // Ensure this data is correctly populated

    var requestData = {
        'jc_id': jc_id,
        'selected_products': selectedProducts,
        'selected_items': selectedItems
    };

    $.ajax({
        type: 'POST',
        url: 'edit_close_jc_ip.php',
        data: requestData,
        dataType: 'json',
        success: function(response) {
            console.log('AJAX Response:', response);
            if (response.status === 'success') {
                // window.location.href = 'closing-the-jc-page-edit.php'; // Redirect on success
                window.location.href = 'closing-the-jc-page-edit.php?jc_id=' + jc_id;
            } else if (response.status === 'error' && response.insufficient_stock) {
                // Show popup for insufficient stock
                var insufficientStockItems = response.insufficient_stock_items.join(', ');
                alert('Insufficient stock for the following: ' + insufficientStockItems);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', error);
            console.log('AJAX Error:', xhr, status, error);
        }
    });
});
});

// AJAX  for selection of production and items
// EDIT JOBCARD SERVICE AND TRADING

// EDIT JOBCARD PROJECT
// AJAX  for selection of production and items
$(document).ready(function () {
    
    $('.close-jc-btn-edit-project').click(function(e) {
        // console.log('running close jc');
        e.preventDefault();

    var jc_id = $('#jc_id').val();
    
    var selectedProducts = selectedData; // Ensure this data is correctly populated
    var selectedItems = selectedDataItem; // Ensure this data is correctly populated

    var requestData = {
        'jc_id': jc_id,
        'selected_products': selectedProducts,
        'selected_items': selectedItems
    };

    $.ajax({
        type: 'POST',
        url: 'edit_close_jc_ip.php',
        data: requestData,
        dataType: 'json',
        success: function(response) {
            console.log('AJAX Response:', response);
            if (response.status === 'success') {
                // window.location.href = 'closing-the-jc-page-edit.php'; // Redirect on success
                window.location.href = 'closing-project-jc-page-edit.php?jc_id=' + jc_id;
            } else if (response.status === 'error' && response.insufficient_stock) {
                // Show popup for insufficient stock
                var insufficientStockItems = response.insufficient_stock_items.join(', ');
                alert('Insufficient stock for the following: ' + insufficientStockItems);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', error);
            console.log('AJAX Error:', xhr, status, error);
        }
    });
});
});

// AJAX  for selection of production and items
// EDIT JOBCARD PROJECT


function validateFormCloseJC() {
    var workSatisfactoryButtons = document.getElementsByName("work_satisfactory");
    var clientSignButtons = document.getElementsByName("client_sign");
    var isWorkSatisfactoryChecked = false;
    var isClientSignChecked = false;

    for (var i = 0; i < workSatisfactoryButtons.length; i++) {
        if (workSatisfactoryButtons[i].checked) {
            isWorkSatisfactoryChecked = true;
            break;
        }
    }

    for (var j = 0; j < clientSignButtons.length; j++) {
        if (clientSignButtons[j].checked) {
            isClientSignChecked = true;
            break;
        }
    }

    if (!isWorkSatisfactoryChecked) {
        alert("Please select either 'Yes' or 'No' for Work Done Satisfactory.");
        return false; // Prevent form submission
    }

    if (!isClientSignChecked) {
        alert("Please select either 'Yes' or 'No' for Client Sign.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}