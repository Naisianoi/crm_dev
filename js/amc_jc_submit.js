
$(document).ready(function () {
    $('.submit_amc_jc').click(function(e) {
        e.preventDefault();
        
var jcType = $('#jc_type').val();
// var amount = $('#amount').val();
var jcCreateDate = $('#jc_create_date').text();
var customerType = $('#edit_customer_type_select').text();
var jcLeadBy = $('#jc_lead_by').val();
var customerName = $('#edit_customer_name').text();
var customerId = $('#edit_customer_id').text();
var companyName = $('#edit_company_name').text();
var address = $('#edit_address').text();
var area = $('#edit_area').text();
var city = $('#edit_city').text();
var county = $('#edit_county').text();
var salesAgent = $('#edit_sales_agent_select').text();
var contactNameOne = $('#edit_contact_name_one').text();
var contactPhoneOne = $('#edit_contact_phone_one').text();
var contactNameTwo = $('#edit_contact_name_two').text();
var contactPhoneTwo = $('#edit_contact_phone_two').text();
var physicalLocation = $('#edit_physical_location').text();
var commerce = $('#edit_commerce_select').text();
var productName = $('#edit_product_select').text();
var brandName = $('#edit_brand_input').text();
var datewamc = $('#edit_date_w_amc').text();
var googleLocation = $('#edit_google_location').text();
var workStatement = $('#edit_agreement').text();
// var customerWord = $('#customer_word').val();
var business = $('#edit_business_input').text();
var lastJcNumber = $('#edit_last_jobcard_number').text();
var lastJcDate = $('#edit_last_jobcard_date').text();

var lastJcType = $('#last_jc_type').text();
var lastAssignedTo = $('#last_assigned_to').text();


var role = $('#role').val();
var amc_id = $('#edit_amc_id').text();



var requestData = {
    'submit_amc_jc': true,
    'jc_type': jcType,
    // 'amount': amount,
    'customer_type': customerType,
    'customer_name': customerName,
    'edit_customer_id': customerId,
    'company_name': companyName,
    'jc_create_date': jcCreateDate,
    'jc_lead_by': jcLeadBy,
    'address': address,
    'area': area,
    'city': city,
    'county': county,
    'sales_agent': salesAgent,
    'contact_name_one': contactNameOne,
    'contact_phone_one': contactPhoneOne,
    'contact_name_two': contactNameTwo,
    'contact_phone_two': contactPhoneTwo,
    'physical_location': physicalLocation,
    'commerce': commerce,
    'product_name_static': productName,
    'brand_name_static':  brandName,
    'date_w_amc': datewamc,
    'google_location': googleLocation,
    'agreement': workStatement,
    // 'customer_word': customerWord,
    'business_name_static': business,
    'last_jc_number': lastJcNumber,
    'last_jc_date': lastJcDate,

    'last_jc_type': lastJcType,
    'last_assigned_to': lastAssignedTo,

    'role': role,
     'amc_id': amc_id
       
};

// $.ajax({
//     type: 'POST',
//     url: 'add_service_jc.php',
//     data: requestData,
//     dataType: 'json',
//     success: function(response) {
//         // console.log(response);
//         if (response.status === 'success') {
//             var serviceJcId = response.service_jc_id;
//             var jcType = response.jc_type; // Assuming your AJAX response includes jc_type

//             if (!jcType) {
//                 // If jc_type is empty, display an error message or take appropriate action
//                 alert('Choose a Jobcard Type');
//                 return;
//             }

//             if (response.insufficient_stock) {
//                 // Show popup for insufficient stock
//                 var insufficientStockItems = response.insufficient_stock_items.join(', ');
//                 alert('Insufficient stock for the following: ' + insufficientStockItems);
//                 return;
//             }

//             if (serviceJcId) {
//                 var popupContainer = $('#popup-container');
//                 var popupMessage = $('#popup-message');
//                 var popupCloseBtn = $('#popup-close-btn');

//                 popupMessage.text('Service Job Card ID: ' + serviceJcId);
//                 popupContainer.css('display', 'block');

//                 popupCloseBtn.click(function() {
//                     popupContainer.css('display', 'none');
//                     window.location.href = 'assign-jc-page.php';
//                 });
//             }
//         }
//     },
//     error: function(xhr, status, error) {
//         console.log('AJAX Error:', error);
//         console.log('AJAX Error:', xhr, status, error);
//     }
// });


$.ajax({
    type: 'POST',
    url: 'add_amc_jc.php',
    data: requestData,
    dataType: 'json',
    success: function(response) {
        if (response.status === 'success') {
            var serviceJcId = response.service_jc_id;
            // var jcType = response.jc_type; // Assuming your AJAX response includes jc_type

            // if (!jcType) {
            //     // If jc_type is empty, display an error message or take appropriate action
            //     alert('Choose a Jobcard Type');
            //     return;
            // }

            if (serviceJcId) {
                var popupContainer = $('#popup-container');
                var popupMessage = $('#popup-message');
                var popupCloseBtn = $('#popup-close-btn');

                popupMessage.text('AMC Job Card ID: ' + serviceJcId);
                popupContainer.css('display', 'block');

                popupCloseBtn.click(function() {
                    popupContainer.css('display', 'none');
                    window.location.href = 'assign-jc-page.php';
                });
            }
        } else {
            // Handle other error cases
            console.log('Unhandled error:', response);
        }
    },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', error);

            // You can also inspect the xhr.responseText for more details
            console.log('Server response:', xhr.responseText);
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
        var customerName = $('#edit_customer_name').text();
        var role = $('#role').val();

        var requestData = {
            'lastJC': true,
            
            'customer_name': customerName,
            // 'edit_customer_id': customerId,
            'role': role,
             
                  
        };

        // Make an AJAX request to fetch the most recent data
        $.ajax({
            type: 'POST',
            url: 'add_service_jc.php', // Replace with the actual server-side script
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
