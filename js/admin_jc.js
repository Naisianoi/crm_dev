$(document).ready(function (){
    $('.admin_jc_btn').click(function(e) {
       e.preventDefault(); /*-----edit button on click-------*/
    //function updateProduct() {
      var supplier_id = $(this).closest('tr').find('.supplier_id').text();
    
      $.ajax({
        type: "POST",
        url: "edit_admin_jc.php",
        data: {
          'checking_admin_jc_btn': true,
          'supplier_id': supplier_id,
        },
        success: function(response) {
        //    console.log(response);
      // Parse the response JSON object
      var data = JSON.parse(response);
      
    //   $('#edit_customer_type_select').val(data.customer_type);
      $('#supplier_name').val(data.supplier_name);
      $('#supplier_id').val(data.supplier_id);
      
      $('#supplier_type').val(data.supplier_type);
      $('#company_name').val(data.company_name);
      $('#address').val(data.address);
      $('#area').val(data.area);
      $('#city').val(data.city);
      $('#county').val(data.county);
      $('#contact_name_1').val(data.contact_name_1);
      $('#contact_name_2').val(data.contact_name_2);
      $('#contact_phone_1').val(data.contact_phone_1);
      $('#contact_phone_2').val(data.contact_phone_2);
    //   $('#edit_email').val(data.email);
      
    //   $('#edit_discount').val(data.discount);
    //   $('#edit_product_select').val(data.product);
    //   $('#edit_physical_location').val(data.physical_location);
      $('#google_location').val(data.google_location);
      

   
     
        // Prepare URL parameters
        var params = new URLSearchParams();
        // params.append('edit_customer_type_select', data.customer_type);
        params.append('supplier_id', data.supplier_id);
    
        params.append('supplier_type', data.supplier_type);
        params.append('supplier_name', data.supplier_name);
        params.append('company_name', data.company_name);
        params.append('address', data.address);
        params.append('area', data.area);
        params.append('city', data.city);
        params.append('county', data.county);
        params.append('contact_name_1', data.contact_name_1);
        params.append('contact_name_2', data.contact_name_2);
        params.append('contact_phone_1', data.contact_phone_1);
        params.append('contact_phone_2', data.contact_phone_2);
        // params.append('edit_email', data.email);
        // params.append('agent_name', data.agent_name);
        // params.append('edit_discount', data.discount);
        // params.append('edit_product_select', data.product);
        // params.append('edit_physical_location', data.physical_location);
        params.append('google_location', data.google_location);
       
        
        
    
        // Store the data in localStorage
        localStorage.setItem('editData', JSON.stringify(data));
    
        // Redirect to the success page
        window.location.href = 'admin-jc-page.php';
          
        }
      });
    });
    });
    
    $(document).ready(function () {
      // Retrieve data from localStorage
      var editData = JSON.parse(localStorage.getItem('editData'));
    
      // Populate form fields with the data
    //   $('#edit_customer_type_select').text(editData.customer_type);
      $('#supplier_name').text(editData.supplier_name);
      $('#supplier_id').text(editData.supplier_id);
    
      $('#supplier_type').text(editData.supplier_type);
      $('#company_name').text(editData.company_name);
      $('#address').text(editData.address);
      $('#area').text(editData.area);
      $('#city').text(editData.city);
      $('#county').val(editData.county);
      $('#contact_name_1').text(editData.contact_name_1);
      $('#contact_name_2').text(editData.contact_name_2);
      $('#contact_phone_1').text(editData.contact_phone_1);
      $('#contact_phone_2').text(editData.contact_phone_2);
    //   $('#edit_email').text(editData.email);
    //   $('#edit_discount').text(editData.discount);
    //   $('#edit_product_select').text(editData.product);
    //   $('#edit_physical_location').text(editData.physical_location);
      $('#google_location').text(editData.google_location);
      
   
  
    
      // Clear the data from localStorage
      localStorage.removeItem('editData');
    });
  
    
    
    /*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
 