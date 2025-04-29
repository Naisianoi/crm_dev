$(document).ready(function (){
    $('.project_jc_btn').click(function(e) {
       e.preventDefault(); /*-----edit button on click-------*/
    //function updateProduct() {
      var project_id = $(this).closest('tr').find('.project_id').text();
    
      $.ajax({
        type: "POST",
        url: "edit_project_jc.php",
        data: {
          'checking_project_jc_btn': true,
          'project_id': project_id,
        },
        success: function(response) {
        //    console.log(response);
      // Parse the response JSON object
      var data = JSON.parse(response);
      
    //   $('#edit_customer_type_select').val(data.customer_type);
      $('#customer_name').val(data.customer_name);
      $('#customer_id').val(data.customer_id);
      $('#project_id').val(data.project_id);
      $('#project_type').val(data.project_type);
      $('#company_name').val(data.company_name);
      $('#address').val(data.address);
    //   $('#area').val(data.area);
      $('#city').val(data.city);
      $('#county').val(data.county);
      $('#contact_name_one').val(data.contact_name_one);
      $('#contact_name_two').val(data.contact_name_two);
      $('#contact_phone_one').val(data.contact_phone_one);
      $('#contact_phone_two').val(data.contact_phone_two);
    //   $('#edit_email').val(data.email);
      $('#agent_name').val(data.agent_name);
    //   $('#edit_discount').val(data.discount);
    //   $('#edit_product_select').val(data.product);
    //   $('#edit_physical_location').val(data.physical_location);
      $('#google_location').val(data.google_location);
      $('#site_name').val(data.site_name);
      $('#project_name').val(data.project_name);
      $('#area').val(data.area);
      $('#site_address').val(data.site_address);
      $('#site_city').val(data.site_city);
      $('#site_county').val(data.site_county);
      $('#site_g_location').val(data.site_g_location);
      $('#site_contact_name_1').val(data.site_contact_name_1);
      $('#site_contact_number_1').val(data.site_contact_number_1);
      $('#site_contact_name_2').val(data.site_contact_name_2);
      $('#site_contact_number_2').val(data.site_contact_number_2);
      $('#project_details').val(data.project_details);

   
     
        // Prepare URL parameters
        var params = new URLSearchParams();
        // params.append('edit_customer_type_select', data.customer_type);
        params.append('customer_id', data.customer_id);
        params.append('project_id', data.project_id);
        params.append('project_type', data.project_type);
        params.append('customer_name', data.customer_name);
        params.append('company_name', data.company_name);
        params.append('address', data.address);
        params.append('area', data.area);
        params.append('city', data.city);
        params.append('county', data.county);
        params.append('contact_name_one', data.contact_name_one);
        params.append('contact_name_two', data.contact_name_two);
        params.append('contact_phone_one', data.contact_phone_one);
        params.append('contact_phone_two', data.contact_phone_two);
        // params.append('edit_email', data.email);
        params.append('agent_name', data.agent_name);
        // params.append('edit_discount', data.discount);
        // params.append('edit_product_select', data.product);
        // params.append('edit_physical_location', data.physical_location);
        params.append('google_location', data.google_location);
        params.append('site_name', data.site_name);
        params.append('project_name', data.project_name);
        params.append('site_address', data.site_address);
        params.append('site_city', data.site_city);
        params.append('site_county', data.site_county);
        params.append('site_g_location', data.site_g_location);
        params.append('site_contact_name_1', data.site_contact_name_1);
        params.append('site_contact_number_1', data.site_contact_number_1);
        params.append('site_contact_name_2', data.site_contact_name_2);
        params.append('site_contact_number_2', data.site_contact_number_2);
        params.append('project_details', data.project_details);
        
        
    
        // Store the data in localStorage
        localStorage.setItem('editData', JSON.stringify(data));
    
        // Redirect to the success page
        window.location.href = 'project-jc-page.php';
          
        }
      });
    });
    });
    
    $(document).ready(function () {
      // Retrieve data from localStorage
      var editData = JSON.parse(localStorage.getItem('editData'));
    
      // Populate form fields with the data
    //   $('#edit_customer_type_select').text(editData.customer_type);
      $('#customer_name').text(editData.customer_name);
      $('#customer_id').text(editData.customer_id);
      $('#project_id').text(editData.project_id);
      $('#project_type').text(editData.project_type);
      $('#company_name').text(editData.company_name);
      $('#address').text(editData.address);
      $('#area').text(editData.area);
      $('#city').text(editData.city);
      $('#county').val(editData.county);
      $('#contact_name_one').text(editData.contact_name_one);
      $('#contact_name_two').text(editData.contact_name_two);
      $('#contact_phone_one').text(editData.contact_phone_one);
      $('#contact_phone_two').text(editData.contact_phone_two);
    //   $('#edit_email').text(editData.email);
      $('#agent_name').text(editData.agent_name);
    //   $('#edit_discount').text(editData.discount);
    //   $('#edit_product_select').text(editData.product);
    //   $('#edit_physical_location').text(editData.physical_location);
      $('#google_location').text(editData.google_location);
      $('#site_name').text(editData.site_name);
      $('#project_name').text(editData.project_name);
      $('#site_address').text(editData.site_address);
      $('#site_city').text(editData.site_city);
      $('#site_county').text(editData.site_county);
      $('#site_g_location').text(editData.site_g_location);
      $('#site_contact_name_1').text(editData.site_contact_name_1);
      $('#site_contact_number_1').text(editData.site_contact_number_1);
      $('#site_contact_name_2').text(editData.site_contact_name_2);
      $('#site_contact_number_2').text(editData.site_contact_number_2);
      $('#project_details').text(editData.project_details);
   
  
    
      // Clear the data from localStorage
      localStorage.removeItem('editData');
    });
  
    
    
    /*--------------------------ajax for EDITING data when edit clicked---------------------------------*/
 