/*----------------------Toggle Button-------------------------------*/ 
const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
const body = document.querySelector('body');

toggleSidebarBtn.addEventListener('click', function() {
  body.classList.toggle('toggle-sidebar');
});

/*----------------------Toggle Button-------------------------------*/ 

/*-------------Add Modal Brand form button click---------------*/
  $('#btn').on('click', function(){
    $('#goalmodal').modal('show');
  });

/*------------Add Modal Brand form button click----------------*/

/*----------------------reset form after form submission-------------------------------------*/
    var btnClear = document.querySelector('button');
    var inputs = document.querySelectorAll('input');
    
    
    btnClear.addEventListener('click', () => {
        inputs.forEach(input =>  input.value = '');
    });

    

  //$('#reset_brand_form')[0].reset();
  //document.getElementById("reset_brand_form").reset();
/*-----------------------reset form after form submission------------------------------------*/

/*-------------Edit Modal Brand form button click---------------*/

  // $('.edit-brand-btn').on('click', function(){
  //   $('#editbrandmodal').modal('show');
  // });

/*-------------Edit Modal Brand form button click---------------*/

/*-------------------------Delete click----------------------------------*/
$(document).ready(function (){

  $('.delete_brand').on('click', function(){
     $('#deleteBrandModal').modal('show');

        str = $(this).closest('tr');

        var data = $str.children("td").map(function() {
          return $(this).text();
          
        }).get();

        console.log(data);

        $('#delete_brand_id').val(data[0]);
  });
});

/*-------------------------Delete click----------------------------------*/

/*----------------------Message alert and hide----------------------------------*/
  $(document).ready(function()
    {
        setTimeout(function()
        {
            $('#message').hide();
        }, 3000);
    })

    $(document).ready(function()
    {
        setTimeout(function()
        {
            $('#login-message').hide();
        }, 3000);
    })
/*----------------------Message alert and hide----------------------------------*/

/*--------------------------ajax EDITING data when edit clicked-----------------------------------*/
      $(document).ready(function (e){

        $('.delete_btn').click(function(e){
          e.preventDefault();/*-----delete button on click-------*/

          var brand_id = $(this).closest('tr').find('.brand_id').text();
          //console.log(brand_id);

          $('#delete_brand_id').val(brand_id);
          $('#deleteBrandModal').modal('show');
          
        });
        
        // $('.edit_btn').click(function(e){
        //   e.preventDefault();/*-----edit button on click-------*/

        //   var brand_id = $(this).closest('tr').find('.brand_id').text();
        //   // console.log(brand_id);

        //   $.ajax({
        //     type: "POST",
        //     url: "edit_ajax.php",
        //     data: {
        //       'checking_edit_btn': true,
        //       'brand_id': brand_id,
        //     },
        //     success: function (response) {
        //       // console.log(response);
        //       $.each(response, function (key, value) {
        //           //console.log(value['brand']);
        //           $('#edit_brand_id').val(value['id']);
        //           $('#edit_business').val(value['business']);
        //           $('#edit_brand').val(value['brand']);
        //       });

        //       $('#editBrandModal').modal('show');
        //     }
        //   })
        // })

        //EDIT
      $('.edit_btn').click(function(e) {
        e.preventDefault();
  
        var brand_id = $(this).closest('tr').find('.brand_id').text();
        var business = $(this).closest('tr').find('.business').text();
        var brand = $(this).closest('tr').find('.brand').text();
  
        // Populate the modal fields with the fetched values
        $('#edit_brand_id').val(brand_id);
        $('#edit_business').val(business);
        $('#edit_brand').val(brand);
  
        // Show the "Edit Category" modal
        $('#editBrandModal').modal('show');
    });




      })
/*--------------------------ajax for EDITING data when edit clicked---------------------------------*/

/*-------------------------------add(get function)--------------------------------------------------*/
// $(document).ready(function () {
//     getdata();

//     $('.ad_ajax').click(function (e) {
//         e.preventDefault();

//         var business = $('.business').val();
//         var brand = $('.brand').val();

//         //console.log(brand);
//     });
// });

/*-------------------------------add(get function)------------------------------------------------*/

/*------------------------------Edit button clicked-----------------------------------------------*/
/*$(document).ready(function () {
  getdata();

  $(document).on("click", ".edit_btn", function (){

    var brand_id = $(this).closest('value').find('.brand_id').text();
    alert(brand_id);

  });

  $('.update_brand').click(function (e){

  });

});*/
/*------------------------------Edit button clicked-----------------------------------------------*/

/*$(document).ready(function (){

  $('.delete_brand').on('click', function(){
     $('#deleteBrandModal').modal('show');

        str = $(this).closest('tr');

        var data = $str.children("td").map(function() {
          return $(this).text();
          
        }).get();

        console.log(data);

        $('#delete_brand_id').val(data[0]);
  });
});*/

/*--------------------------stopping form resubmission------------------------*/

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

/*--------------------------stopping form resubmission------------------------*/

// Get all subcategory elements
const subcategoryElements = document.querySelectorAll('.subcategory');

// Add click event listener to each subcategory element
subcategoryElements.forEach(subcategory => {
subcategory.addEventListener('click', function() {
// Reset state of all subcategory elements
subcategoryElements.forEach(subcategory => {
subcategory.classList.remove('active');
});

// Set state of clicked subcategory element
this.classList.add('active');
});
});


$('#goalmodal').modal('hide');
myModal.hide()

//Prevent empty category in ADD
function validateForm() {
  var categorySelect = document.getElementById("business_select");
  var selectedOption = categorySelect.value;
  
  if (selectedOption === "Choose Business") {
    alert("Please choose a business");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty category in ADD

//Prevent empty category in EDIT
function validateForm() {
  var categorySelect = document.getElementById("edit_category");
  var selectedOption = categorySelect.value;
  
  if (selectedOption === "Choose Category") {
    alert("Please choose a category");
    return false; // Prevent form submission
  }
  
  return true; // Allow form submission
}
//Prevent empty category in EDIT

/*-----------------------Toggle button------------------------------*/ 
const searchToggle = document.querySelector('.search-bar-toggle');
const searchBar = document.querySelector('.search-bar');

searchToggle.addEventListener('click', function(e) {
  searchBar.classList.toggle('search-bar-show');
});


if (select('.search-bar-toggle')) {
  on('click', '.search-bar-toggle', function(e) {
    select('.search-bar').classList.toggle('search-bar-show')
  })
}