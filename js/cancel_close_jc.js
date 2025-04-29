
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('reset-button').addEventListener('click', function() {
//         // Reset the input values to 0 for both products and items
//         var productQuantityInputs = document.querySelectorAll('input[name="product_quantity[]"]');
//         var itemQuantityInputs = document.querySelectorAll('input[name="item_quantity[]"]');

//         // Loop through product quantity inputs and reset their values
//         for (var i = 0; i < productQuantityInputs.length; i++) {
//             productQuantityInputs[i].value = 0;
//         }

//         // Loop through item quantity inputs and reset their values
//         for (var j = 0; j < itemQuantityInputs.length; j++) {
//             itemQuantityInputs[j].value = 0;
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('reset-button').addEventListener('click', function() {
        // Reset the input values to 0 for both products and items with the "reset-me" class
        var resetInputs = document.querySelectorAll('.reset-me');

        for (var i = 0; i < resetInputs.length; i++) {
            resetInputs[i].value = 0;
        }
    });
});

