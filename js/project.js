
// View Details Project
$(document).ready(function() {
  console.log('running view');
  // Handle the click event on the "bi-eye" icon
  $('.view_btn').click(function() {
    var projectId = $(this).data('id');

    // Make an AJAX request to fetch customer data
    $.ajax({
      type: 'POST',
      url: 'view-project-details.php', // Replace with the actual URL of your PHP file
      data: { project_id: projectId },
      dataType: 'json',
      success: function(projectData) {
      
        // console.log('Received data:',projectData);
        // Populate the modal with customer details, including additional columns
        $('#projectId').text(projectData.id);
        $('#projectName').text(projectData.project_name);
        $('#projectType').text(projectData.project_type);
        $('#projectDetails').text(projectData.project_details);
        $('#address').text(projectData.address);
        $('#companyName').text(projectData.company_name);
        $('#customerName').text(projectData.customer_name);
        $('#quotationDate').text(projectData.quote_date);
        $('#quotationNumber').text(projectData.quote_number);
        $('#contactName1').text(projectData.contact_name_one);
        $('#contactPhone1').text(projectData.contact_phone_one);
        $('#contactName2').text(projectData.contact_name_two);
        $('#contactPhone2').text(projectData.contact_phone_two);
        $('#siteName').text(projectData.site_name);
        $('#siteAddress').text(projectData.site_address);
        $('#siteContactName1').text(projectData.site_contact_name_1);
        $('#siteContactPhone1').text(projectData.site_contact_number_1);
        $('#siteContactName2').text(projectData.site_contact_name_2);
        $('#siteContactPhone2').text(projectData.site_contact_number_2);
        // $('#invoiceDate').text(projectData.invoice_date);
        // $('#invoiceNumber').text(projectData.invoice_number);
        
        // PAYMENT
        $.ajax({
          type: 'POST',
          url: 'view-project-payment-data.php', // Replace with the URL for fetching payment data
          data: { project_id: projectId },
          dataType: 'json',
          success: function(paymentData) {
            // Populate payment data into the table in the modal
            var paymentTableBody = $('#paymentTableBody');
            paymentTableBody.empty(); // Clear existing data

            $.each(paymentData, function(index, payment) {
              var row = '<tr>' +
                '<td>' + payment.amount + '</td>' +
                '<td>' + payment.payment_code + '</td>' +
                '<td>' + payment.payment_type + '</td>' +
                '<td>' + payment.part_final + '</td>' +
                '<td>' + payment.payment_date + '</td>' +
                '</tr>';
              paymentTableBody.append(row);
            });
        // PAYMENT
      
       
            // Show the modal
            $('#viewProjectModal').modal('show');
          },
          error: function(xhr, status, error) {
            console.error('Error fetching payment data:', error);
          }
        });
      },
      error: function(xhr, status, error) {
        console.error('Error fetching project data:', error);
      }
    });
    });
        

  // Triggered when the modal is about to be shown
  $('#viewProjectModal').on('show.bs.modal', function (event) {
    // $(document).on('show.bs.modal', '#viewCustomerModal', function (event) {
    // Clear the placeholders before showing the modal
    $('#projectId').text(projectData.id);
    $('#projectName').text('');
    $('#projectType').text('');
    $('#projectDetails').text('');
    $('#address').text('');
    $('#companyName').text('');
    $('#customerName').text('');
    $('#quotationDate').text('');
    $('#quotationNumber').text('');
    $('#contactName1').text('');
    $('#contactPhone1').text('');
    $('#contactName2').text('');
    $('#contactPhone2').text('');
    $('#siteName').text('');
    $('#siteAddress').text('');
    $('#siteContactName1').text('');
    $('#siteContactPhone1').text('');
    $('#siteContactName2').text('');
    $('#siteContactPhone2').text('');
    // $('#invoiceDate').text('');
    // $('#invoiceNumber').text('');
    
    // $('#customerEmail').text('');
    // $('#customerAddress').text('');
  });

  
});


// View Details Customer

// View Jobcard Details
$(document).ready(function() {
  // Handle the click event on the "bi-eye" icon
  $('.view_btn_jc').click(function() {
    var projectId = $(this).data('id');

    // Make an AJAX request to fetch job card data based on project_id
    $.ajax({
      type: 'POST',
      url: 'view-project-jc-details.php', // Replace with the actual URL of your PHP file
      data: { project_id: projectId },
      dataType: 'json',
      success: function(jobCardData) {
        // Populate job card data into the table in the modal
        var tableBody = $('#jcTableBody');
        tableBody.empty(); // Clear existing data

        $.each(jobCardData, function(index, jcData) {
          var row = '<tr>' +
            '<td>' + jcData.id + '</td>' +
            '<td>' + jcData.project_id + '</td>' +
            '<td>' + jcData.jc_type + '</td>' +
            '<td>' + jcData.jc_assigned_to + '</td>' +
            '<td>' + jcData.work_done_date + '</td>' +
            '</tr>';
          tableBody.append(row);
        });

        // Show the modal
        $('#viewJcProjectModal').modal('show');
      },
      error: function(xhr, status, error) {
        console.error('Error fetching job card data:', error);
      }
    });
  });
});


// View Jobcard Details



/* CLICK FOR SEARCH CUSTOMER TYPE */
function submitForm() {
  document.getElementById('project-type-search-form').submit();
}
/* CLICK FOR SEARCH CUSTOMER TYPE */


/* CLICK FOR SEARCH COMMERCE */
function submitForm2() {
  document.getElementById('project-commerce-search-form').submit();
}
/* CLICK FOR SEARCH COMMERCE */

/* CLICK FOR SEARCH AREA */
function submitForm3() {
document.getElementById('project-area-search-form').submit();
}
/* CLICK FOR SEARCH AREA */

// View Details Customer
// $(document).ready(function() {
//     // Handle the click event on the "bi-eye" icon
//     $('.view_btn').click(function() {
//       var customerId = $(this).data('id');

//       // Make an AJAX request to fetch customer data
//       $.ajax({
//         type: 'POST',
//         url: 'view-customer-details.php', // Replace with the actual URL of your PHP file
//         data: { customer_id: customerId },
//         dataType: 'json',
//         success: function(customerData) {
        
//           //console.log('Received data:',customerData);
//           // Populate the modal with customer details, including additional columns
//           $('#customerId').text(customerData.id);
//           $('#customerName').text(customerData.customer_name);
//           $('#customerType').text(customerData.customer_type);
//           $('#customerAddress').text(customerData.address);
//           $('#customerProduct').text(customerData.product);
//           $('#customerBusiness').text(customerData.business);
//           $('#customerCommerce').text(customerData.commerce);
//           $('#customerContactPhone').text(customerData.contact_phone_one);
//           $('#customerContactPhone2').text(customerData.contact_phone_two);

//           // Additional columns
//           // $('#customerEmail').text(customerData.email);
//           // $('#customerAddress').text(customerData.address);

//           // Show the modal
//           $('#viewCustomerModal').modal('show');
//         }, 
//         error: function(xhr, status, error) {
//           console.error('Error fetching customer data:', error);
//         }
//       });
//     });

//     // Triggered when the modal is about to be shown
//     $('#viewCustomerModal').on('show.bs.modal', function (event) {
//       // $(document).on('show.bs.modal', '#viewCustomerModal', function (event) {
//       // Clear the placeholders before showing the modal
//       $('#customerId').text(customerData.id);
//       $('#customerName').text('');
//       $('#customerType').text('');
//       $('#customerAddress').text('');
//       $('#customerProduct').text('');
//       $('#customerBusiness').text('');
//       $('#customerCommerce').text('');
//       $('#customerContactPhone').text('');
//       $('#customerContactPhone2').text('');
//       // $('#customerEmail').text('');
//       // $('#customerAddress').text('');
//     });
//   });


// View Details Customer







