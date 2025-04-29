
$(document).ready(function () {
    $(".edit-technician-btn").click(function () {
        var serviceJcId = $(this).data("jc-id");
        
        // Perform AJAX request to clear technician
        $.ajax({
            type: "POST",
            url: "unassign_jc_technician.php",
            data: {
                service_jc_id: serviceJcId
            },
            success: function (response) {
                // Display success or error message
                if (response.includes("successfully")) {
                    setTimeout(function () {
                        
                        window.location.href = 'assign-jc-page.php';
                    }, 1000); // Redirect after 1 seconds (adjust as needed)
                }
                alert(response);
                // Optionally, you can refresh the table or page here
            }
        });
    });
});