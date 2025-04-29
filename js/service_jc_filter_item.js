// Filter Item
var businessSelectItem = document.getElementById('business_select_item');
var categorySelect = document.getElementById('category_select');
var subcategorySelect = document.getElementById('subcategory_select');
var itemSelect = document.getElementById('item_select');

businessSelectItem.addEventListener('change', function() {
    // Clear the options in all other selects
    categorySelect.innerHTML = '<option selected disabled>Choose Category</option>';
    subcategorySelect.innerHTML = '<option selected disabled>Choose Sub-Category</option>';
    itemSelect.innerHTML = '<option selected disabled>Choose Item</option>';

    // Get the selected value from the business select
    var selectedBusiness = businessSelectItem.value;

    // Make an AJAX request to fetch the options for the category select
    var xhrCategory = new XMLHttpRequest();
    xhrCategory.open('GET', 'fetch_data_service_jc_filter_category.php?business=' + selectedBusiness, true);
    xhrCategory.onreadystatechange = function() {
        if (xhrCategory.readyState === XMLHttpRequest.DONE && xhrCategory.status === 200) {
            // Parse the response as JSON
            var categories = JSON.parse(xhrCategory.responseText);

            // Populate options for the category select
            for (var i = 0; i < categories.length; i++) {
                var categoryOption = document.createElement('option');
                categoryOption.value = categories[i].value;
                categoryOption.textContent = categories[i].label;
                categorySelect.appendChild(categoryOption);
            }
        }
    };
    xhrCategory.send();
});


categorySelect.addEventListener('change', function() {
    // Clear the options in subcategory and item selects
    subcategorySelect.innerHTML = '<option selected disabled>Choose Sub-Category</option>';
    itemSelect.innerHTML = '<option selected disabled>Choose Item</option>';

    // Get the selected value from the category select
    var selectedCategory = categorySelect.value;

    // Make an AJAX request to fetch the options for the subcategory select
    var xhrSubcategory = new XMLHttpRequest();
    xhrSubcategory.open('GET', 'fetch_data_service_jc_filter_subcategory.php?category=' + selectedCategory, true);
    xhrSubcategory.onreadystatechange = function() {
        if (xhrSubcategory.readyState === XMLHttpRequest.DONE && xhrSubcategory.status === 200) {
            // Parse the response as JSON
            var subcategories = JSON.parse(xhrSubcategory.responseText);

            // Populate options for the subcategory select
            for (var i = 0; i < subcategories.length; i++) {
                var subcategoryOption = document.createElement('option');
                subcategoryOption.value = subcategories[i].value;
                subcategoryOption.textContent = subcategories[i].label;
                subcategorySelect.appendChild(subcategoryOption);
            }
        }
    };
    xhrSubcategory.send();
});

subcategorySelect.addEventListener('change', function() {
    // Clear the options in the item select
    itemSelect.innerHTML = '<option selected disabled>Choose Item</option>';

    // Get the selected value from the subcategory select
    var selectedSubcategory = subcategorySelect.value;
    var selectedBusiness = businessSelectItem.value;
    
    // Make an AJAX request to fetch the options for the item select
    var xhrItem = new XMLHttpRequest();
    xhrItem.open('GET', 'fetch_data_service_jc_filter_item.php?subcategory=' + selectedSubcategory + '&business=' + selectedBusiness, true);
    // xhrItem.open('GET', 'fetch_data_service_jc_filter_item.php?subcategory=' + selectedSubcategory, true);
    xhrItem.onreadystatechange = function() {
        if (xhrItem.readyState === XMLHttpRequest.DONE && xhrItem.status === 200) {
            // Parse the response as JSON
            var items = JSON.parse(xhrItem.responseText);

            // Populate options for the item select
            for (var i = 0; i < items.length; i++) {
                var itemOption = document.createElement('option');
                itemOption.value = items[i].value;
                itemOption.textContent = items[i].label;
                itemSelect.appendChild(itemOption);
            }
        }
    };
    xhrItem.send();
});
// Filter ITem

// Item select and quantity input
const showInputButtonItem = document.getElementById('showInputItem');
const quantityInputItem = document.getElementById('quantityInputItem');
const outputDivItem = document.getElementById('output-item');
let selectedDataItem = [];

showInputButtonItem.addEventListener('click', function() {
  console.log("Button Clicked");
   
    const selectedItem = document.querySelector('.item').value;
    const selectedQuantity = parseInt(quantityInputItem.value);

    if (selectedQuantity > 0 && selectedItem) {
        selectedDataItem.push({
            
            item: selectedItem,
            quantity: selectedQuantity
        });

        const outputHTML = selectedDataItem.map(data =>`
            <div class="row">
                
                <div class="col">
                    <strong>Item:</strong> ${data.item}
                </div>
                <div class="col">
                    <strong>Quantity:</strong> ${data.quantity}
                </div>
                <div class="col">
                    
                </div>
            </div>
        `).join('<br>');

        outputDivItem.innerHTML = outputHTML;

        // Reset the input fields
        quantityInputItem.value = '0';
        document.querySelector('.item').selectedIndex = 0;
    }
});
// Item select and quantity input
