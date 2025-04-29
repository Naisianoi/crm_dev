$(document).ready(function() {
    // Handle the click event on elements with the "popup-trigger" class
    $('.popup-trigger').click(function() {
        var id = $(this).data('id');
        
        // Make an AJAX request to fetch data from PHP script
        $.ajax({
            type: 'POST',
            url: 'planner_page_modal.php',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                // Handle the fetched data
                  // Clear the placeholders before showing the modal
                  $('#id').text(data.id);
                  $('#jc_type').text(data.jc_type);
                  $('#business').text(data.business);
                  $('#jc_create_date').text(data.jc_create_date);
                  $('#jc_assigned_to').text(data.jc_assigned_to);
                  // $('#commerce').text(data.commerce);
                  $('#jc_type').text(data.jc_type);
                  $('#customer_name').text(data.customer_name);
                  $('#customer_type').text(data.customer_type);
                  $('#address').text(data.address);
                  $('#contact_name_1').text(data.contact_name_1);
                  $('#contact_name_2').text(data.contact_name_2);
                  $('#contact_number_1').text(data.contact_number_1);
                  $('#contact_number_2').text(data.contact_number_2);
                  $('#product_name').text(data.product_name);
                  $('#brand').text(data.brand);
                  $('#last_jc_number').text(data.last_jc_number);
                  $('#last_jc_type').text(data.last_jc_type);
                  $('#work_statement').text(data.work_statement);
        
                // Show the modal
                $('#dataModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Request failed. Status: ' + status);
            }
        });
    });

    // Triggered when the modal is about to be shown
    $('#dataModal').on('show.bs.modal', function (event) {
        // Clear the placeholders before showing the modal
        // $('#modalBody').html('');
            $('#id').text(event.id);
            $('#jc_type').text(event.jc_type);
            $('#business').text(event.business);
            $('#jc_create_date').text(event.jc_create_date);
            $('#jc_assigned_to').text(event.jc_assigned_to);
            // $('#commerce').text(event.commerce);
            $('#jc_type').text(event.jc_type);
            $('#customer_name').text(event.customer_name);
            $('#customer_type').text(event.customer_type);
            $('#address').text(event.address);
            $('#contact_name_1').text(event.contact_name_1);
            $('#contact_name_2').text(event.contact_name_2);
            $('#contact_number_1').text(event.contact_number_1);
            $('#contact_number_2').text(event.contact_number_2);
            $('#product_name').text(event.product_name);
            $('#brand').text(event.brand);
            $('#last_jc_number').text(event.last_jc_number);
            $('#last_jc_type').text(event.last_jc_type);
            $('#work_statement').text(event.work_statement);
    
    });
});
