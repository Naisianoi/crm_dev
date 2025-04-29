// SERVICE AND TRADING JC EDIT WHEN CLOSED
$(document).ready(function () {
    var addBackToStockButtons = $('.addBackToStockBtn');

    addBackToStockButtons.click(function () {
        var jcId = $(this).data('jc-id');

        // Set the jc_id value in the hidden input field
        $('input[name="jc_id"]').val(jcId);

        // Log data before submitting the form
        // console.log('Service JC ID:', jcId);
        var requestData = {
          'jc_id': jcId,
        };


        $.ajax({
            type: 'POST',
            // url: $('#addBackToStockForm').attr('action'),
            url: 'add_back_to_stock.php',
            data: requestData,
            dataType: 'json',
            success: function (response) {
                // Check if the response contains success message
                if (response.status === 'success') {
                    var jcId2 = response.jc_id;
                    // Display a pop-up
                    alert('Stock updates were successful.');

                    // Optionally, you can redirect or perform other actions after a successful update
                    window.location.href = 'closing-the-jc-page-edit.php?jc_id='+ jcId2;
                } else {
                    // Handle other responses if needed
                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
                console.log('AJAX Error:', xhr, status, error);
            }
        });
    });
});
// SERVICE AND TRADING JC EDIT WHEN CLOSED

// PROJECT EDIT WHEN CLOSED
$(document).ready(function () {
    var addBackToStockButtons = $('.addBackToStockBtnProject');

    addBackToStockButtons.click(function () {
        var jcId = $(this).data('jc-id');

        // Set the jc_id value in the hidden input field
        $('input[name="jc_id"]').val(jcId);

        // Log data before submitting the form
        // console.log('Project JC ID:', jcId);
        var requestData = {
            'jc_id': jcId,
        };


        // Submit the form using AJAX
        $.ajax({
            type: 'POST',
            // url: $('#addBackToStockForm').attr('action'),
            url: 'add_back_to_stock.php',
            data: requestData,
            dataType: 'json',
            success: function (response) {
                // Check if the response contains success message
                if (response.status === 'success') {
                    var jcId2 = response.jc_id;
                    // Display a pop-up
                    alert('Stock updates were successful.');

                    // Optionally, you can redirect or perform other actions after a successful update
                    window.location.href = 'closing-project-jc-page-edit.php?jc_id='+ jcId2;
                } else {
                    // Handle other responses if needed
                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
                console.log('AJAX Error:', xhr, status, error);
            }
        });
    });
});
// PROJECT EDIT WHEN CLOSED