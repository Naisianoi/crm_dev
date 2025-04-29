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


// Product when selected and quantity added 
    const showInputButton = document.getElementById('showInput');
    const quantityInput = document.getElementById('quantityInput');
    const outputDiv = document.getElementById('output-product');
    let selectedData = [];

    showInputButton.addEventListener('click', function() {
        const selectedProduct = document.querySelector('.product').value;
        const selectedQuantity = parseInt(quantityInput.value);

        if (selectedQuantity > 0 && selectedProduct) {
            selectedData.push({
                product: selectedProduct,
                quantity: selectedQuantity
            });

            const outputHTML = selectedData.map(data =>`
                <div class="row">
                  <div class="col">
                    <strong>Product:</strong> ${data.product}
                  </div>
                    
                  <div class="col">
                    <strong>Quantity:</strong> ${data.quantity}
                  </div>

                  <div class="col"></div>
                    
                </div>
            `).join('<br>');

            outputDiv.innerHTML = outputHTML;

            // Reset the input fields
            quantityInput.value = '0';
            document.querySelector('.product').selectedIndex = 0;
        }
    });

// Product when selected and quantity added

