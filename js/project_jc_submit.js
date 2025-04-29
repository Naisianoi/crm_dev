
$(document).ready(function () {
    $('.submit_service_jc').click(function(e) {
        e.preventDefault();
        
var jcType = $('#jc_type').val();
// var amount = $('#amount').val();
var jcCreateDate = $('#jc_create_date').val();
// var customerType = $('#edit_customer_type_select').text();
var jcLeadBy = $('#jc_lead_by').val();
var customerName = $('#customer_name').text();
var customerId = $('#customer_id').text();
var companyName = $('#company_name').text();
var address = $('#address').text();
var area = $('#area').text();
var city = $('#city').text();
var county = $('#county').text();
var salesAgent = $('#agent_name').text();
var contactNameOne = $('#contact_name_one').text();
var contactPhoneOne = $('#contact_phone_one').text();
var contactNameTwo = $('#contact_name_two').text();
var contactPhoneTwo = $('#contact_phone_two').text();
var googleLocation = $('#google_location').text();

var projectId = $('#project_id').text();
var projectType = $('#project_type').text();
var projectName = $('#project_name').text();
var projectDetails = $('#project_details').text();
var siteAddress = $('#site_address').text();
var siteName = $('#site_name').text();
var siteGLocation = $('#site_g_location').text();
var siteCity = $('#site_city').text();
var siteCounty = $('#site_county').text();
var siteContactName1 = $('#site_contact_name_1').text();
var siteContactNumber1 = $('#site_contact_number_1').text();
var siteContactName2 = $('#site_contact_name_2').text();
var siteContactNumber2 = $('#site_contact_number_2').text();

// var physicalLocation = $('#edit_physical_location').text();
// var commerce = $('#edit_commerce_select').text();
// var productName = $('#edit_product_select').text();
// var brandName = $('#edit_brand_input').text();
// var datewamc = $('#edit_date_w_amc').text();

var workStatement = $('#work_statement').val();
var customerWord = $('#customer_word').val();
// var jobFinding = $('#job_finding').val();
var lastJcNumber = $('#last_jobcard_number').text();
var lastJcDate = $('#last_jobcard_date').text();
var lastJcType = $('#last_jc_type').text();
var lastAssignedTo = $('#last_assigned_to').text();
var role = $('#role').val();

// product and item
var selectedProducts = selectedData;
var selectedItems = selectedDataItem;

var requestData = {
    'submit_service_jc': true,
    'jc_type': jcType,
    // 'amount': amount,
    // 'customer_type': customerType,
    'customer_name': customerName,
    'customer_id': customerId,
    'company_name': companyName,
    'jc_create_date': jcCreateDate,
    'jc_lead_by': jcLeadBy,
    'address': address,
    'area': area,
    'city': city,
    'county': county,
    'agent_name': salesAgent,
    'contact_name_one': contactNameOne,
    'contact_phone_one': contactPhoneOne,
    'contact_name_two': contactNameTwo,
    'contact_phone_two': contactPhoneTwo,
    // 'physical_location': physicalLocation,


    'project_id': projectId,
    'project_type': projectType,
    'project_name': projectName,
    'project_details': projectDetails,
    'site_address': siteAddress,
    'site_name': siteName,
    'site_city': siteCity,
    'site_county': siteCounty,
    'site_g_location': siteGLocation,
    'site_contact_name_1': siteContactName1,
    'site_contact_number_1': siteContactNumber1,
    'site_contact_name_2': siteContactName2,
    'site_contact_number_2': siteContactNumber2,


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
     
    // product and item
    'selected_products': selectedProducts,
    'selected_items': selectedItems      
};

        // $.ajax({
        //     type: 'POST',
        //     url: 'add_project_jc.php',
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

        //                 popupMessage.text('Project Job Card ID: ' + serviceJcId);
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
            url: 'add_project_jc.php',
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
        
                        popupMessage.text('Project Job Card ID: ' + serviceJcId);
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
        
                }  else if (response.status === 'error' && response.insufficient_stock) {
                    // Show popup for insufficient stock
                    var insufficientStockItems = response.insufficient_stock_items.join(', ');
                    alert('Insufficient stock for the following: ' + insufficientStockItems);
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
        // var customerName = $('#edit_customer_name').text();
        var projectName = $('#project_name').text();
        var role = $('#role').val();

        var requestData = {
            'lastJC': true,
            
            // 'customer_name': customerName,
            // 'edit_customer_id': customerId,
            'project_name': projectName,
            'role': role,
             
                  
        };

        // Make an AJAX request to fetch the most recent data
        $.ajax({
            type: 'POST',
            url: 'add_project_jc.php', // Replace with the actual server-side script
            data: requestData,
            dataType: 'json',
            success: function (response) {
                // Check if there is valid data
                if (response.status === 'success') {
                    // Display the data in a modal
                    $('#modalId').text(response.id);
                    $('#modalAssignedTo').text(response.jc_assigned_to);
                    $('#modalType').text(response.jc_type);
                    $('#modalProjectType').text(response.project_type);
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
