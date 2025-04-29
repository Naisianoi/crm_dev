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
const purchaseModeProduct = document.getElementById('purchase_mode_product');
const purchasePriceInput = document.getElementById('purchase_price_product');
// const INRPriceInput = document.getElementById('INR_price_product');
// const weightInput = document.getElementById('weight_product');
const outputDiv = document.getElementById('output-product');

// Material data
const receiveddtInputProduct = document.getElementById('received_dt');
const idInputProduct = document.getElementById('id');
const docnoInputProduct = document.getElementById('doc_no');
// Material data

let selectedData = [];

showInputButton.addEventListener('click', function() {
    const selectedProduct = document.querySelector('.product').value;
    const selectedQuantity = parseInt(quantityInput.value);
    const selectedPurchaseModeProduct = purchaseModeProduct.value;
    const purchasePrice = parseFloat(purchasePriceInput.value);
    // const INRPrice = INRPriceInput.value ? parseFloat(INRPriceInput.value) : null;
    // const weight = weightInput.value ? parseFloat(weightInput.value) : null;
    // const weight = weightInput.value ? weightInput.value.trim() : null;

    // Material data
    const receiveddt = receiveddtInputProduct.value;
    const id = idInputProduct.value;
    const docno = docnoInputProduct.value;
    // Material data

    if (selectedQuantity > 0 && selectedProduct && purchasePrice >= 0) {
        selectedData.push({
            product: selectedProduct,
            quantity: selectedQuantity,
            purchasePrice: purchasePrice >= 0 ? purchasePrice : null,
            purchaseModeProduct: selectedPurchaseModeProduct,
            // INRPrice: INRPrice,
            // weight: weight,
            receiveddt: receiveddt,
            id: id,
            docno: docno,

            date: getCurrentDate(), // Add the current date to the data
        });

        // const outputHTML = selectedData.map(data => `
        //     <div class="row">
        //         <div class="col-4">
        //             <strong>Product:</strong> ${data.product}
        //         </div>
        //         <div class="col-2">
        //             <strong>Quantity:</strong> ${data.quantity}
        //         </div>
        //         <div class="col">
        //             <strong>Purchase:</strong> ${data.purchaseModeProduct !== null ? data.purchaseModeProduct : 'null'}
        //         </div>
        //         <div class="col">
        //             <strong>Purchase Price:</strong> ${data.purchasePrice !== null ? data.purchasePrice : 'null'}
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
                    <th style="width: 35%;">Product</th>
                    <th style="width: 8%;">Quantity</th>
                    <th style="width: 10%;">Purchase</th>
                    <th style="width: 8%;">Purchase Price</th>
                    <th style="width: 10%;">Date</th>

                    <th style="width: 10%;">Received dt</th>
                    <th style="width: 10%;">Material Id</th>
                    <th style="width: 10%;">Doc No</th>
                </tr>
            </thead>
            <tbody>
                ${selectedData.map(data => `
                    <tr>
                        <td>${data.product}</td>
                        <td>${data.quantity}</td>
                        <td>${data.purchaseModeProduct !== null ? data.purchaseModeProduct : 'null'}</td>
                        <td>${data.purchasePrice !== null ? data.purchasePrice : 'null'}</td>
                        <td>${data.date}</td>

                        <td>${data.receiveddt !== null ? data.receiveddt : 'null'}</td>
                        <td>${data.id !== null ? data.id : 'null'}</td>
                        <td>${data.docno !== null ? data.docno : 'null'}</td>
                    </tr>
                `).join('')}
            </tbody>
        </table>`;


        outputDiv.innerHTML = outputHTML;

        // Reset the input fields
        quantityInput.value = '0';
        purchasePriceInput.value = '';
        purchaseModeProduct.value = '';
        // INRPriceInput.value = '';
        // weightInput.value = '';
        document.querySelector('.product').selectedIndex = 0;
    }
});
// TEST 2


// Autofill Purchase Mode
        // PRODUCTS
        // Get references to the select and input elements
        var productSelect = document.getElementById("product_select");
        var purchaseModeInputProduct = document.getElementById("purchase_mode_product");

        // Add event listener to the select element
        productSelect.addEventListener("change", function() {
            // Get the selected product name
            // console.log('purchase mode');
            var selectedProductName = productSelect.value;

            // Fetch the purchase mode for the selected product from the database
            fetchPurchaseModeProduct(selectedProductName);
        });

        // Function to fetch purchase mode from the database
        function fetchPurchaseModeProduct(productName) {
            // Send an AJAX request to fetch the purchase mode for the selected product
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_data_purchase_mode.php?productName=" + encodeURIComponent(productName), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the purchase mode input field with the fetched purchase mode
                    purchaseModeInputProduct.value = xhr.responseText;
                }
            };
            xhr.send();
        }

    
        // ITEMS 
        // Get references to the select and input elements
        var itemSelect = document.getElementById("item_select");
        var purchaseModeInput = document.getElementById("purchase_mode_item");

        // Add event listener to the select element
        itemSelect.addEventListener("change", function() {
            // Get the selected item name
            var selectedItemName = itemSelect.value;

            // Fetch the purchase mode for the selected item from the database
            fetchPurchaseMode(selectedItemName);
        });

        // Function to fetch purchase mode from the database
        function fetchPurchaseMode(itemName) {
            // Send an AJAX request to fetch the purchase mode for the selected item
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_data_purchase_mode.php?itemName=" + encodeURIComponent(itemName), true);
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the purchase mode input field with the fetched purchase mode
                purchaseModeInput.value = xhr.responseText;
            }
            };
            xhr.send();
        }
    
// Autofill Purchase Mode