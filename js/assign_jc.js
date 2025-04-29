// Test
$(document).ready(function () {
    $(".assign-technician-btn").click(function () {
        var rowId = $(this).data("jc-id");
        var technicianName = $("select[name='technician[" + rowId + "]']").val();
        // var proposedWorkDate = $('#proposed_work_date').val();
        var proposedWorkDate = $('#proposed_work_date[data-jc-id="' + rowId + '"]').val();
        var timeSlot = $('#time_slot[data-jc-id="' + rowId + '"]').val();
        // console.log(proposedWorkDate);

        if (technicianName != 'Choose Technician' && proposedWorkDate != '' && timeSlot != null) {
            // Perform AJAX request to update technician in tbl_service_jc
            $.ajax({
                type: "POST",
                url: "assign_jc_technician.php", // Path to the PHP file that handles the AJAX request and updates the database
                data: {
                    technician: technicianName,
                    proposed_work_date: proposedWorkDate,
                    time_slot: timeSlot,    
                    service_jc_id: rowId
                },
                success: function (response) {
                    alert(response); // Display success or error message
                    if (response.includes("successfully")) {
                        setTimeout(function () {
                            window.location.href = 'assign-jc-page.php';
                        }, 1000); // Redirect after 1 second (adjust as needed)
                    }
                }
            });
        } else {
            alert("Please fill all the fields.");
        }
    });
});

// Test

// MODAL POP UP FOR AMC 

document.addEventListener('DOMContentLoaded', function() {
    // Access the hidden content
    var hiddenContent = document.querySelector('div[style="display:none;"]');

    // Access elements containing visit dates
    var visitDateCells = hiddenContent.querySelectorAll('.visit-date');

    // Access elements containing visit date styles
    var visitDateStyleCells = hiddenContent.querySelectorAll('.visit-date-style');

    // Extract visit dates from elements
    var visitDates = Array.from(visitDateCells).map(function(cell) {
        return cell.textContent.trim(); // Assuming visit dates are text content
    });

    // Extract visit date styles from elements
    var visitDateStyles = Array.from(visitDateStyleCells).map(function(cell) {
        return cell.textContent.trim(); // Assuming visit date styles are text content
    });

    console.log(visitDates);
    console.log(visitDateStyles);

    // Check if any visit date matches the current date and has the corresponding style
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;
    
    console.log(today); // Check the current date in console

    var showModal = false; // Initialize flag to track whether to show the modal

    visitDates.forEach(function(date, index) {
        
        if (date !== '') {
            
            if (visitDateStyles[index] == '') {
                showModal = true; // Set flag to true if the visit date has no matching ID (not hidden)
            }
        }
    });

    // Show the modal if the flag is true
    if (showModal) {
        // console.log("visit dt running");
        $('#myModal').modal('show');
    }
});

// MODAL POP UP FOR AMC 