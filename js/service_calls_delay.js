// DELAY BUTTON CLICK
// function delayCall(customerId) {
//     var delayDays = document.querySelector('input[name="delay_days"]').value;
//     if (!delayDays || isNaN(delayDays)) {
//         alert("Please enter a valid number of days.");
//         return;
//     }

//     // AJAX request to update next_call_date
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             // Handle the response if needed
//             // console.log(xhr.responseText);
//             window.location.href = 'service-calls-page.php'; // Redirect on success
//         }
//     };
//     xhr.open("POST", "edit_service_calls.php", true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.send("customerId=" + customerId + "&delayDays=" + delayDays);
// }
// // DELAY BUTTON CLICK
// function delayCall(customerId) {
//     var delayDays = document.querySelector('input[name="delay_days"]').value;
//     if (!delayDays || isNaN(delayDays)) {
//         alert("Please enter a valid number of days.");
//         return;
//     }

//     var confirmDelay = confirm("Are you sure you want to delay?");
//     if (confirmDelay) {
//         // AJAX request to update next_call_date
//         var xhr = new XMLHttpRequest();
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState == 4 && xhr.status == 200) {
//                 // Handle the response if needed
//                 // console.log(xhr.responseText);
//                 window.location.href = 'service-calls-page.php'; // Redirect on success
//             }
//         };
//         xhr.open("POST", "edit_service_calls.php", true);
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.send("customerId=" + customerId + "&delayDays=" + delayDays);
//     }
// }

// function delayCall(customerId, inputId) {
//     var delayDays = document.querySelector('#' + inputId).value;
//     if (!delayDays || isNaN(delayDays)) {
//         alert("Please enter a valid number of days.");
//         return;
//     }

//     var confirmDelay = confirm("Are you sure you want to delay?");
//     if (confirmDelay) {
//         // AJAX request to update next_call_date
//         var xhr = new XMLHttpRequest();
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState == 4 && xhr.status == 200) {
//                 window.location.href = 'service-calls-page.php'; // Redirect on success
//             }
//         };
//         xhr.open("POST", "edit_service_calls.php", true);
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.send("customerId=" + customerId + "&delayDays=" + delayDays);
//     }
// }

function delayCall1(customerId, inputId, days) {
    // Set the value of the input field to the specified number of days
    document.getElementById(inputId).value = days;

    var confirmDelay = confirm("Are you sure you want to delay 1 day?");
    if (confirmDelay) {
        // AJAX request to update next_call_date
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.href = 'service-calls-page.php'; // Redirect on success
            }
        };
        xhr.open("POST", "edit_service_calls.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("customerId=" + customerId + "&delayDays=" + days);
    }
}

function delayCall2(customerId, inputId, days) {
    // Set the value of the input field to the specified number of days
    document.getElementById(inputId).value = days;

    var confirmDelay = confirm("Are you sure you want to delay 2 days?");
    if (confirmDelay) {
        // AJAX request to update next_call_date
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.href = 'service-calls-page.php'; // Redirect on success
            }
        };
        xhr.open("POST", "edit_service_calls.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("customerId=" + customerId + "&delayDays=" + days);
    }
}


// DELAY BUTTON CLICK

// DELAY BUTTON CLICK



