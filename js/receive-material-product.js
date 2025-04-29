// Filter for product
var businessSelectProduct = document.getElementById('business_select');
var productSelect = document.getElementById('product_select');

businessSelectProduct.addEventListener('change', function() {
    // Clear the options in the product select
    productSelect.innerHTML = '<option selected disabled>Choose Product</option>';

    // Get the selected value from the business select
    var selectedBusinessProduct = businessSelectProduct.value;

    // Make an AJAX request to fetch the options for the product select based on the business
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_data_service_jc_filter_product.php?business=' + selectedBusinessProduct, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the response as JSON
            var products = JSON.parse(xhr.responseText);

            // Populate options for the product select
            for (var i = 0; i < products.length; i++) {
                var productOption = document.createElement('option');
                productOption.value = products[i].value;
                productOption.textContent = products[i].label;
                productSelect.appendChild(productOption);
            }
        }
    };
    xhr.send();
});
// Filter for product



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

// // Product when selected and quantity added
// const showInputButton = document.getElementById('showInput');
// const quantityInput = document.getElementById('quantityInput');
// const purchasePriceInput = document.getElementById('purchase_price_product');
// const outputDiv = document.getElementById('output-product');
// let selectedData = [];

// showInputButton.addEventListener('click', function() {
//     const selectedProduct = document.querySelector('.product').value;
//     const selectedQuantity = parseInt(quantityInput.value);
//     const purchasePrice = parseFloat(purchasePriceInput.value);

//     if (selectedQuantity > 0 && selectedProduct && purchasePrice >= 0) {
//         selectedData.push({
//             product: selectedProduct,
//             quantity: selectedQuantity,
//             purchasePrice: purchasePrice,
//             date: getCurrentDate(), // Add the current date to the data
//         });

//         const outputHTML = selectedData.map(data => `
//             <div class="row">
//                 <div class="col-4">
//                     <strong>Product:</strong> ${data.product}
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

//         outputDiv.innerHTML = outputHTML;

//         // Reset the input fields
//         quantityInput.value = '0';
//         purchasePriceInput.value = '';
//         document.querySelector('.product').selectedIndex = 0;
//     }
// });

// TEST


// TEST 2
// Product when selected and quantity added
const showInputButton = document.getElementById('showInput');
const quantityInput = document.getElementById('quantityInput');
const purchasePriceInput = document.getElementById('purchase_price_product');
const INRPriceInput = document.getElementById('INR_price_product');
const weightInput = document.getElementById('weight_product');
const outputDiv = document.getElementById('output-product');
let selectedData = [];

showInputButton.addEventListener('click', function() {
    const selectedProduct = document.querySelector('.product').value;
    const selectedQuantity = parseInt(quantityInput.value);
    const purchasePrice = parseFloat(purchasePriceInput.value);
    const INRPrice = INRPriceInput.value ? parseFloat(INRPriceInput.value) : null;
    // const weight = weightInput.value ? parseFloat(weightInput.value) : null;
    const weight = weightInput.value ? weightInput.value.trim() : null;

    if (selectedQuantity > 0 && selectedProduct) {
        selectedData.push({
            product: selectedProduct,
            quantity: selectedQuantity,
            purchasePrice: purchasePrice >= 0 ? purchasePrice : null,
            INRPrice: INRPrice,
            weight: weight,
            date: getCurrentDate(), // Add the current date to the data
        });

        const outputHTML = selectedData.map(data => `
            <div class="row">
                <div class="col-4">
                    <strong>Product:</strong> ${data.product}
                </div>
                <div class="col-2">
                    <strong>Quantity:</strong> ${data.quantity}
                </div>
                <div class="col">
                    <strong>Purchase Price:</strong> ${data.purchasePrice !== null ? data.purchasePrice : 'null'}
                </div>
                <div class="col">
                    <strong>INR Price:</strong> ${data.INRPrice !== null ? data.INRPrice : 'null'}
                </div>
                <div class="col">
                    <strong>Weight:</strong> ${data.weight !== null ? data.weight : 'null'}
                </div>
                <div class="col">
                    <strong>Date:</strong> ${data.date}
                </div>
            </div>
        `).join('<br>');

        outputDiv.innerHTML = outputHTML;

        // Reset the input fields
        quantityInput.value = '0';
        purchasePriceInput.value = '';
        INRPriceInput.value = '';
        weightInput.value = '';
        document.querySelector('.product').selectedIndex = 0;
    }
});
// TEST 2
