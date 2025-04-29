// View Details Customer
$(document).ready(function() {
  // Handle the click event on the "bi-eye" icon
    $('.view_btn').click(function() {
        console.log('running phone 3');
      var customerId = $(this).data('id');

      // Make an AJAX request to fetch customer data
      $.ajax({
        type: 'POST',
        url: 'view-customer-details.php', // Replace with the actual URL of your PHP file
        data: { customer_id: customerId },
        dataType: 'json',
        success: function(customerData) {
        
          console.log('Received data:',customerData);
          // Populate the modal with customer details, including additional columns
          $('#customerId').text(customerData.id);
          $('#customerName').text(customerData.customer_name);
          $('#customerType').text(customerData.customer_type);
          $('#customerAddress').text(customerData.address);
          $('#customerProduct').text(customerData.product);
          $('#customerBusiness').text(customerData.business);
          $('#customerCommerce').text(customerData.commerce);
          $('#customerContactName1').text(customerData.contact_name_one);
          $('#customerContactPhone1').text(customerData.contact_phone_one);
          $('#customerContactName2').text(customerData.contact_name_two);
          $('#customerContactPhone2').text(customerData.contact_phone_two);

          // Additional columns
          // $('#customerEmail').text(customerData.email);
          // $('#customerAddress').text(customerData.address);

          // Show the modal
          $('#viewCustomerModal').modal('show');
        }, 
        error: function(xhr, status, error) {
          console.error('Error fetching customer data:', error);
        }
      });
    });

    // Triggered when the modal is about to be shown
    $('#viewCustomerModal').on('show.bs.modal', function (event) {
      // $(document).on('show.bs.modal', '#viewCustomerModal', function (event) {
      // Clear the placeholders before showing the modal
      $('#customerId').text(customerData.id);
      $('#customerName').text('');
      $('#customerType').text('');
      $('#customerAddress').text('');
      $('#customerProduct').text('');
      $('#customerBusiness').text('');
      $('#customerCommerce').text('');
      $('#customerContactName1').text('');
      $('#customerContactPhone1').text('');
      $('#customerContactName2').text('');
      $('#customerContactPhone2').text('');
      // $('#customerEmail').text('');
      // $('#customerAddress').text('');
    });
  });


// View Details Customer


// $(document).ready(function() {
//   $("#search-form").on("submit", function(event) {
//       event.preventDefault(); // Prevent the default form submission

//       var search = $(this).find('input[name="search"]').val();

//       if (search !== "") {
//           $.ajax({
//               url: "phone-search-results.php",
//               method: "POST",
//               data: { search: search },
//               success: function(data) {
//                   $("#search-results").html(data);
//               }
//           });
//       } else {
//           $("#search-results").html("No search query provided.");
//       }
//   });
// });





// $(document).ready(function() {

//     $("#search-input").on("keyup", function() {
//       console.log('running phone 2');
//         var search = $(this).val();
//         if (search !== "") {
//             $.ajax({
//                 url: "phone-search-results.php",
//                 method: "POST",
//                 data: { search: search },
//                 success: function(data) {
//                     $("#search-results").html(data);
//                 }
//             });
//         } else {
//             $("#search-results").html("");
//         }
//     });

    
//   });

  
  
//   function redirectToSearchPage(event) {
//     if (event.keyCode === 13) { // Check if Enter key is pressed
//         var searchValue = document.getElementById("search-input").value;
//         if (searchValue !== "") {
//             window.location.href = "phone-search.php?search=" + encodeURIComponent(searchValue);
//         }
//     }
//   }


$(document).ready(function() {
  function performSearch() {
      var search = $("#search-input").val();
      if (search !== "") {
          $.ajax({
              url: "phone-search-results.php",
              method: "POST",
              data: { search: search },
              success: function(data) {
                  $("#search-results").html(data);
              }
          });
      } else {
          $("#search-results").html("");
      }
  }

  // $("#search-icon").on("click", function() {
  //   console.log('search clicked');
  //     performSearch();
  // });

  $("#search-icon").on("mousedown", function(event) {
    if (event.which === 1 || event.which === 13) { // Check if it's a left mouse click (1) or "Enter" key (13)
        performSearch();
    }
});

  $("#search-input").on("keyup", function(event) {
      
      if (event.keyCode === 13) { // Check if Enter key is pressed
        console.log('enter clicked');
          performSearch();
      }
  });
});




