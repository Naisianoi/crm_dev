/*-------------Add Modal Category form button click---------------*/
$('#btn').on('click', function(){
    $('#subcategorymodal').modal('show');
  });

/*------------Add Modal Category form button click----------------*/

/*-------------Edit Modal Category form button click---------------*/

// $('.edit_subcategory_btn').on('click', function(){
//     $('#editsubcategorymodal').modal('show');
//   });

/*-------------Edit Modal Category form button click---------------*/

/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
$(document).ready(function (e){

    $('.delete_subcategory_btn').click(function(e){
        e.preventDefault();/*-----delete button on click-------*/
  
        var subcategory_id = $(this).closest('tr').find('.subcategory_id').text();
        //console.log(brand_id);
  
        $('#delete_subcategory_id').val(subcategory_id);
        $('#deletesubcategorymodal').modal('show');

      });

    // $('.edit_subcategory_btn').click(function(e){
    //     e.preventDefault();/*-----edit button on click-------*/
  
    //     var subcategory_id = $(this).closest('tr').find('.subcategory_id').text();
    //     // console.log(category_id);       

    //     $.ajax({
    //         type: "POST",
    //         url: "edit_subcategory.php",
    //         data: {
    //           'checking_edit_subcategory_btn': true,
    //           'subcategory_id': subcategory_id,
    //         },
    //         success: function (response) {
    //            //console.log(response);

    //         $.each(response, function (key, value) {
    //              //console.log(value['id']);
    //               $('#edit_subcategory_id').val(value['id']);
    //               $('#edit_business').val(value['business']);
    //               $('#edit_category').val(value['category']);
    //               $('#edit_subcategory').val(value['subcategory']);
    //          });

    //         //   $('#editsubcategorymodal').modal('show');
    //     }
    //  });

    // })


    //EDIT
    $('.edit_subcategory_btn').click(function(e) {
      e.preventDefault();

      var subcategory_id = $(this).closest('tr').find('.subcategory_id').text();
      var business = $(this).closest('tr').find('.business').text();
      var category = $(this).closest('tr').find('.category').text();
      var subcategory = $(this).closest('tr').find('.subcategory').text();

      // Populate the modal fields with the fetched values
      $('#edit_subcategory_id').val(subcategory_id);
      $('#edit_business').val(business);
      $('#edit_category').val(category);
      $('#edit_subcategory').val(subcategory);

      // Show the "Edit Sub Category" modal
      $('#editsubcategorymodal').modal('show');
  });

})
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

//Ajax for filtering the select options (ADD SUBCATEGORY)
// JavaScript code
var businessSelect = document.getElementById('business_select');
var categorySelect = document.getElementById('category_select');

businessSelect.addEventListener('change', function() {
    // Clear the options in the category select
    categorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

    // Get the selected value from the business select
    var selectedBusiness = businessSelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_subcategory_ajax.php?business=' + selectedBusiness, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var options = JSON.parse(xhr.responseText);

            // Populate options for the category select
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.value = options[i].value;
                option.textContent = options[i].label;
                categorySelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});
//End Ajax for filtering the select options

//Ajax for filtering the select options (EDIT SUBCATEGORY)
// JavaScript code
  //var editbusinessSelect = document.getElementById('edit_btn_filter');
  
  var editbusinessSelect = document.getElementById('edit_business');
  var editcategorySelect = document.getElementById('edit_category');
  
  editbusinessSelect.addEventListener('change', function() {
      // Clear the options in the category select
      editcategorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

      // Get the selected value from the business select
      var selectedBusiness = editbusinessSelect.value;

      // Make an AJAX request to fetch the options for the category select
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetch_data_subcategory_ajax.php?business=' + selectedBusiness, true);
      xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              // Parse the response as JSON
              var options = JSON.parse(xhr.responseText);

              // Populate options for the category select
              for (var i = 0; i < options.length; i++) {
                  var option = document.createElement('option');
                  option.value = options[i].value;
                  option.textContent = options[i].label;
                  editcategorySelect.appendChild(option);
              }
              
          }
      };
      xhr.send();
 });
//End Ajax for filtering the select options


// function updateCategorySelect(selectedBusiness) {
//   var editcategorySelect = document.getElementById('edit_category');

//   // Clear the options in the category select
//   editcategorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

//   // Make an AJAX request to fetch the options for the category select
//   var xhr = new XMLHttpRequest();
//   xhr.open('GET', 'fetch_data_subcategory_ajax.php?business=' + selectedBusiness, true);
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//       // Parse the response as JSON
//       var options = JSON.parse(xhr.responseText);

//       // Populate options for the category select
//       for (var i = 0; i < options.length; i++) {
//         var option = document.createElement('option');
//         option.value = options[i].value;
//         option.textContent = options[i].label;
//         editcategorySelect.appendChild(option);
//       }
//     }
//   };
//   xhr.send();
// }

// // Call the function initially to populate the category select options
// updateCategorySelect(document.getElementById('edit_business').value);



// function filterForm() {
//   var selectedBusiness = document.getElementById('edit_business').value;
//   updateCategorySelect(selectedBusiness);
// }

// // Call the filterForm() function to trigger the filtering process
// filterForm();


// function updateCategorySelect(selectedBusiness) {
//   var editbusinessSelect = document.getElementById('edit_business');
//   var editcategorySelect = document.getElementById('edit_category');

//   // Clear the options in the category select
//   editcategorySelect.innerHTML = '<option selected disabled>Choose Category</option>';

//   // Get the selected value from the business select
//   var selectedBusiness = editbusinessSelect.value;

//   // Make an AJAX request to fetch the options for the category select
//   var xhr = new XMLHttpRequest();
//   xhr.open('GET', 'fetch_data_subcategory_ajax.php?business=' + selectedBusiness, true);
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//       // Parse the response as JSON
//       var options = JSON.parse(xhr.responseText);

//       // Populate options for the category select
//       for (var i = 0; i < options.length; i++) {
//         var option = document.createElement('option');
//         option.value = options[i].value;
//         option.textContent = options[i].label;
//         editcategorySelect.appendChild(option);
//       }
//     }
//   };
//   xhr.send();
// }

// // Call the function initially to populate the category select options
// updateCategorySelect(document.getElementById('edit_business').value);


//Prevent empty category in ADD
function validateForm1() {
  var categorySelect = document.getElementById("category_select");
  var selectedOption = categorySelect.value;
  
  if (selectedOption === "Choose Category") {
    alert("Please choose a category");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty category in ADD

//Prevent empty category in EDIT
function validateForm3() {
  var categorySelect = document.getElementById("edit_category");
  var selectedOption = categorySelect.value;
  
  if (selectedOption === "Choose Category") {
    alert("Please choose a category");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty category in EDIT