// UPDATE BUTTON
function updateCall(customerId) {
    var confirmUpdate = confirm("Are you sure you want to update?");
    if (confirmUpdate) {
        // AJAX request to update tbl_customer
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response if needed
                // console.log(xhr.responseText);
                window.location.href = 'service-calls-page.php'; // Redirect on success
            }
        };
        xhr.open("POST", "edit_service_calls_update.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("customerId=" + customerId);
    }
}
// UPDATE BUTTON