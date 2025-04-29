
// REDIRECT TO SELECTED PURCHASE MODE


// REDIRECT TO SELECTED PURCHASE MODE

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
// xhrItem.open('GET', 'fetch_data_service_jc_filter_item.php?subcategory=' + selectedSubcategory, true);
xhrItem.open('GET', 'fetch_data_service_jc_filter_item.php?subcategory=' + selectedSubcategory + '&business=' + selectedBusiness, true);
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

// TEST
function getCurrentDate() {
const today = new Date();
const year = today.getFullYear();
let month = today.getMonth() + 1;
let day = today.getDate();

// Add leading zero for months and days less than 10
month = month < 10 ? '0' + month : month;
day = day < 10 ? '0' + day : day;

return `${year}-${month}-${day}`;
}

// // Item select and quantity input
// const showInputButtonItem = document.getElementById('showInputItem');
// const quantityInputItem = document.getElementById('quantityInputItem');
// const purchasePriceInputItem = document.getElementById('purchase_price_item');
// const outputDivItem = document.getElementById('output-item');
// let selectedDataItem = [];

// showInputButtonItem.addEventListener('click', function() {
//     console.log("Button Clicked");

//     const selectedItem = document.querySelector('.item').value;
//     const selectedQuantity = parseInt(quantityInputItem.value);
//     const purchasePrice = parseFloat(purchasePriceInputItem.value);

//     if (selectedQuantity > 0 && selectedItem && purchasePrice >= 0) {
//         selectedDataItem.push({
//             item: selectedItem,
//             quantity: selectedQuantity,
//             purchasePrice: purchasePrice,
//             date: getCurrentDate(), // Add the current date to the data
//         });

//         const outputHTML = selectedDataItem.map(data => `
//             <div class="row">
//                 <div class="col-4">
//                     <strong>Item:</strong> ${data.item}
//                 </div>
//                 <div class="col-2">
//                     <strong>Quantity:</strong> ${data.quantity}
//                 </div>
//                 <div class="col">
//                     <strong>Purchase Price:</strong> ${data.purchasePrice}
//                 </div>
//                 <div class="col">
//                     <strong>Date:</strong> ${data.date}
//                 </div>
//             </div>
//         `).join('<br>');

//         outputDivItem.innerHTML = outputHTML;

//         // Reset the input fields
//         quantityInputItem.value = '0';
//         purchasePriceInputItem.value = '';
//         document.querySelector('.item').selectedIndex = 0;
//     }
// });
// TEST

// TEST 2
// Item select and quantity input
const showInputButtonItem = document.getElementById('showInputItem');
const quantityInputItem = document.getElementById('quantityInputItem');
// const purchasePriceInputItem = document.getElementById('purchase_price_item');
const purchaseModeItem = document.getElementById('purchase_mode_item');
const INRPriceInputItem = document.getElementById('INR_price_item');
// const weightInputItem = document.getElementById('weight_item');

// Material data
const receiveddtInputItem = document.getElementById('received_dt');
const idInputItem = document.getElementById('id');
const docnoInputItem = document.getElementById('doc_no');
// Material data

const outputDivItem = document.getElementById('output-item');
let selectedDataItem = [];

showInputButtonItem.addEventListener('click', function() {
console.log("Button Clicked");

const selectedItem = document.querySelector('.item').value;
const selectedQuantity = parseInt(quantityInputItem.value);
// const purchasePrice = parseFloat(purchasePriceInputItem.value);
const selectedPurchaseModeItem = purchaseModeItem.value;
const INRPrice = INRPriceInputItem.value ? parseFloat(INRPriceInputItem.value) : null;
// const weight = weightInputItem.value ? parseFloat(weightInputItem.value) : null;
// const weight = weightInputItem.value ? weightInputItem.value.trim() : null;

// Material data
const receiveddt = receiveddtInputItem.value;
const id = idInputItem.value;
const docno = docnoInputItem.value;
// Material data


if (selectedQuantity > 0 && selectedItem && INRPrice > 0) {
    selectedDataItem.push({
        item: selectedItem,
        quantity: selectedQuantity,
        // purchasePrice: purchasePrice >= 0 ? purchasePrice : null,
        purchaseModeItem: selectedPurchaseModeItem,
        INRPrice: INRPrice,
        // weight: weight,

        receiveddt: receiveddt,
        id: id,
        docno: docno,

        date: getCurrentDate(), // Add the current date to the data
    });

    // const outputHTML = selectedDataItem.map(data => `
    //     <div class="row">
    //         <div class="col-4">
    //             <strong>Item:</strong> ${data.item}
    //         </div>
    //         <div class="col-2">
    //             <strong>Quantity:</strong> ${data.quantity}
    //         </div>
    //         <div class="col">
    //             <strong>Purchase:</strong> ${data.purchaseModeItem !== null ? data.purchaseModeItem : 'null'}
    //         </div>
    //         <div class="col">
    //             <strong>INR Price:</strong> ${data.INRPrice !== null ? data.INRPrice : 'null'}
    //         </div>
            
    //         <div class="col">
    //             <strong>Date:</strong> ${data.date}
    //         </div>
    //     </div>
    // `).join('<br>');

    const outputHTML = `
    <table>
        <thead>
            <tr>
                <th style="width: 35%;">Item</th>
                <th style="width: 8%;">Quantity</th>
                <th style="width: 10%;">Purchase</th>
                <th style="width: 8%;">INR Price</th>
                <th style="width: 10%;">Date</th>

                <th style="width: 10%;">Received dt</th>
                <th style="width: 10%;">Material Id</th>
                <th style="width: 10%;">Doc No</th>
            </tr>
        </thead>
        <tbody>
            ${selectedDataItem.map(data => `
                <tr>
                    <td>${data.item}</td>
                    <td>${data.quantity}</td>
                    <td>${data.purchaseModeItem !== null ? data.purchaseModeItem : 'null'}</td>
                    <td>${data.INRPrice !== null ? data.INRPrice : 'null'}</td>
                    <td>${data.date}</td>

                    <td>${data.receiveddt !== null ? data.receiveddt : 'null'}</td>
                    <td>${data.id !== null ? data.id : 'null'}</td>
                    <td>${data.docno !== null ? data.docno : 'null'}</td> 
                </tr>
            `).join('')}
        </tbody>
    </table>`;

    outputDivItem.innerHTML = outputHTML;

    // Reset the input fields
    quantityInputItem.value = '0';
    // purchasePriceInputItem.value = '';
    purchaseModeItem.value = '';
    INRPriceInputItem.value = '';
    // weightInputItem.value = '';
    document.querySelector('.item').selectedIndex = 0;
}
});

// TEST 2


// AJAX selecting the product or item
$(document).ready(function () {

$('.receive-material-btn').click(function(e) {
    console.log('clicked receive material');

    // console.log('running close jc');
    e.preventDefault();


var selectedProducts = selectedData; // Ensure this data is correctly populated
var selectedItems = selectedDataItem; // Ensure this data is correctly populated
    // console.log(selectedItems);
var requestData = {

    'selected_products': selectedProducts,
    'selected_items': selectedItems
};

$.ajax({
    type: 'POST',
    url: 'edit_receive_material_sea.php',
    data: requestData,
    dataType: 'json',
    success: function(response) {
        console.log('AJAX Response:', response);
        if (response.status === 'success') {
            window.location.href = 'receive-material-supplier.php'; // Redirect on success
        }
    },
    error: function(xhr, status, error) {
        console.log('AJAX Error:', error);
        console.log('AJAX Error:', xhr, status, error);
    }
});
});
});
// AJAX selecting the product or item

