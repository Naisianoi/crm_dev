//Ajax for filtering the select options (ADD ITEM) - selected Business filter sub-category
// JavaScript code
var categorySelect = document.getElementById('category_select');
var subcategorySelect = document.getElementById('sub_category_select');

categorySelect.addEventListener('change', function() {
    // Clear the options in the category select
    subcategorySelect.innerHTML = '<option selected disabled>Choose Sub-Category</option>';

    // Get the selected value from the business select
    var selectedCategory = categorySelect.value;

    // Make an AJAX request to fetch the options for the category select
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_item_subcategory_ajax.php?category=' + selectedCategory, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var options = JSON.parse(xhr.responseText);

            // Populate options for the category select
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.value = options[i].value;
                option.textContent = options[i].label;
                subcategorySelect.appendChild(option);
            }
            
        }
    };
    xhr.send();
});
//End Ajax for filtering the select options