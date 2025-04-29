
$(document).ready(function () {
    $('.submit_admin_jc').click(function(e) {
        e.preventDefault();
        
var jcType = $('#jc_type').val();
var supplierType = $('#supplier_type').text();
// var amount = $('#amount').val();
var jcCreateDate = $('#jc_create_date').val();
// var customerType = $('#edit_customer_type_select').text();
var jcLeadBy = $('#jc_lead_by').val();
var supplierName = $('#supplier_name').text();
var supplierId = $('#supplier_id').text();
var companyName = $('#company_name').text();
var address = $('#address').text();
var area = $('#area').text();
var city = $('#city').text();
var county = $('#county').text();

var contactName1 = $('#contact_name_1').text();
var contactPhone1 = $('#contact_phone_1').text();
var contactName2 = $('#contact_name_2').text();
var contactPhone2 = $('#contact_phone_2').text();
var googleLocation = $('#google_location').text();

var workStatement = $('#work_statement').val();
var customerWord = $('#customer_word').val();
// var jobFinding = $('#job_finding').val();
var lastJcNumber = $('#last_jobcard_number').text();
var lastJcDate = $('#last_jobcard_date').text();
var lastJcType = $('#last_jc_type').text();
var lastAssignedTo = $('#last_assigned_to').text();
var role = $('#role').val();



var requestData = {
    'submit_admin_jc': true,
    'jc_type': jcType,
    // 'amount': amount,
    // 'customer_type': customerType,
    'supplier_name': supplierName,
    'supplier_type': supplierType,
    'supplier_id': supplierId,
    'company_name': companyName,
    'jc_create_date': jcCreateDate,
    'jc_lead_by': jcLeadBy,
    'address': address,
    'area': area,
    'city': city,
    'county': county,

    'contact_name_1': contactName1,
    'contact_phone_1': contactPhone1,
    'contact_name_2': contactName2,
    'contact_phone_2': contactPhone2,
    // 'physical_location': physicalLocation,
    'google_location': googleLocation,
    // 'job_finding': jobFinding,
    'work_statement': workStatement,
    'customer_word': customerWord,
    // 'business_name_static': business,
    'last_jc_number': lastJcNumber,
    'last_jc_date': lastJcDate,
    'last_jc_type': lastJcType,
    'last_assigned_to': lastAssignedTo,
    'role': role,     
};

$.ajax({
    type: 'POST',
    url: 'add_admin_jc.php',
    data: requestData,
    dataType: 'json',
    success: function(response) {
        // console.log(response);
        if (response.status === 'success') {
            var serviceJcId = response.service_jc_id;
            if (serviceJcId) {
                var popupContainer = $('#popup-container');
                var popupMessage = $('#popup-message');
                var popupCloseBtn = $('#popup-close-btn');

                popupMessage.text('Admin Job Card ID: ' + serviceJcId);
                popupContainer.css('display', 'block');

                popupCloseBtn.click(function() {
                    popupContainer.css('display', 'none');
                    window.location.href = 'assign-jc-page.php';
                });
            }
        } else if (response.status === 'error jc type') {
            // If jc_type is empty, display an error message or take appropriate action
            alert('Choose a Jobcard Type');
            // return;

        }
    },
    error: function(xhr, status, error) {
        console.log('AJAX Error:', error);
        console.log('AJAX Error:', xhr, status, error);
    }
});
});
});


// console.log('running last jc');
// FETCH DATA LAST JC
$(document).ready(function () {
    $('.lastJC').click(function (e) {
        e.preventDefault();

        // Extract customer_name and role
        var supplierName = $('#supplier_name').text();
        var role = $('#role').val();

        var requestData = {
            'lastJC': true,
            
            'supplier_name': supplierName,
            'role': role,
             
                  
        };

        // Make an AJAX request to fetch the most recent data
        $.ajax({
            type: 'POST',
            url: 'add_admin_jc.php', // Replace with the actual server-side script
            data: requestData,
            dataType: 'json',
            success: function (response) {
                // Check if there is valid data
                if (response.status === 'success') {
                    // Display the data in a modal
                    $('#modalId').text(response.id);
                    $('#modalAssignedTo').text(response.jc_assigned_to);
                    $('#modalType').text(response.jc_type);
                    $('#modalCreateDate').text(response.jc_create_date);
                    $('#modalWorkStatement').text(response.work_statement);
                    $('#modalJobFinding').text(response.job_finding);

                    // Show the modal
                    $('#myModal').modal('show');
                } else {
                    // Handle error cases or show a message
                    alert('No matching data found.');
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error:', error);
              

                // You can also inspect the xhr.responseText for more details
                console.log('Server response:', xhr.responseText);
            }
        });
    });
});

// FETCH DATA LAST JC
