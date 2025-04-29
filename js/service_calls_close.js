
// CLOSE BUTTON CLICK
function delayCall(customerId) {
    var delayDays = document.querySelector('input[name="delay_days"]').value;
    console.log(delayDays);
    if (!delayDays || isNaN(delayDays)) {
        alert("Please enter a valid number of days.");
        return;
    }

    // AJAX request to update next_call_date
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
            // console.log(xhr.responseText);
            window.location.href = 'service-calls-page.php'; // Redirect on success
        }
    };
    xhr.open("POST", "edit_service_call_close.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("customerId=" + customerId + "&delayDays=" + delayDays);
}

function confirmClose(customerId) {
    var confirmClose = confirm("Are you sure the service call is done?");
    if (confirmClose) {
        // AJAX request to update next_call_date and called_date
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response if needed
                // console.log(xhr.responseText);
                window.location.href = 'service-calls-page.php'; // Redirect on success
            }
        };
        xhr.open("POST", "edit_service_call_close.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("customerId=" + customerId);
    }
}
// CLOSE BUTTON CLICK