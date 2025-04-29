// Select Supplier autofill supplier id
$(document).ready(function() {
    // When a supplier is selected
    $('#supplier_name').change(function() {
        var supplier_name = $(this).val();

        // Use AJAX to fetch the supplier ID
        $.ajax({
            url: 'fetch_data_receive_supplier.php', // Replace with the actual file to handle AJAX request
            method: 'POST',
            data: { supplier_name: supplier_name },
            success: function(response) {
                if (response.error) {
                    console.error("Error: " + response.error);
                    $('#supplier_id').val('');
                } else {
                    $('#supplier_id').val(response.id);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching supplier ID: " + textStatus, errorThrown);
            }
        });
    });
});
// Select Supplier autofill supplier id

// Entry date(CURRENT DATE)
document.addEventListener("DOMContentLoaded", function() {
    var today = new Date();
    var year = today.getFullYear();
    var month = ('0' + (today.getMonth() + 1)).slice(-2); // Months are zero-indexed, so add 1 and pad with 0
    var day = ('0' + today.getDate()).slice(-2); // Pad with 0 if necessary
    var formattedDate = year + '-' + month + '-' + day;

    document.getElementById('entry_dt').value = formattedDate;
});
    
// Entry date(CURRENT DATE)

// VIEW MODAL MATERIAL DETAILS
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    var modal = $('#viewMaterialModal');

    // Handle view button click
    $('.view-btn').click(function() {
        var id = $(this).data('id');
        fetchMaterialDetails(id);
        modal.modal('show');
    });

    // Function to fetch material details
    function fetchMaterialDetails(id) {
        $.ajax({
            url: 'fetch_data_material_modal.php',
            type: 'GET',
            data: { id: id },
           
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
                $('#productsContent').html(data.products);
                $('#itemsContent').html(data.items);
            },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', error);

            // You can also inspect the xhr.responseText for more details
            console.log('Server response:', xhr.responseText);
    }
        });
    }
});
// VIEW MODAL MATERIAL DETAILS