// fetch data number when sales agent name selected


document.addEventListener("DOMContentLoaded", function () {
    const agentNameSelect = document.getElementById("agent_name_select");
    const agentNumberInput = document.getElementById("agent_number_input");

    agentNameSelect.addEventListener("change", function () {
        const selectedAgentName = agentNameSelect.value;

        // Send an AJAX request to your PHP script to fetch the agent number
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_data_project_sales_agent.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Check if the response contains an agent number
                if (response.agent_number) {
                    agentNumberInput.value = response.agent_number;
                } else {
                    // Handle the case where no agent number was found
                    agentNumberInput.value = "Agent number not found";
                }
            }
        };

        // Send the selected agent name to the PHP script
        const data = "agent_name=" + encodeURIComponent(selectedAgentName);
        xhr.send(data);
    });
});

// fetch data brand & business when product selected
  
// fetch data of customer name when customer type is selected
document.addEventListener("DOMContentLoaded", function () {
    const customerTypeSelect = document.getElementById("customer_type");
    const customerNameSelect = document.getElementById("customer_name");

    customerTypeSelect.addEventListener("change", function () {
        const selectedCustomerType = customerTypeSelect.value;

        // Send an AJAX request to fetch customer names based on the selected type
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_data_project_customer_name.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Clear existing options
                customerNameSelect.innerHTML = '<option selected="selected" disabled value="">Choose Customer Name</option>';

                // Populate options with retrieved customer names
                response.customerNames.forEach(function (customerName) {
                    const option = document.createElement("option");
                    option.value = customerName;
                    option.textContent = customerName;
                    customerNameSelect.appendChild(option);
                });
            }
        };

        // Send the selected customer type to the PHP script
        const data = "customer_type=" + encodeURIComponent(selectedCustomerType);
        xhr.send(data);
    });
});
// fetch data of customer name when customer type is selected


  
// // fetch data for auto-filling for customer details in the form

// document.addEventListener("DOMContentLoaded", function () {
// console.log("running cust");
//     const customerTypeSelect = document.getElementById("customer_type");
//     const customerNameSelect = document.getElementById("customer_name");
//     const customerIdInput = document.getElementById("customer_id");
//     const customerAddressInput = document.getElementById("address");
//     const customerCityInput = document.getElementById("city");
//     const customerCompanyInput = document.getElementById("company_name");
//     const customerGoogleInput = document.getElementById("google_location");
//     const customerContact1Input = document.getElementById("contact_name_one");
//     const customerPhone1Input = document.getElementById("contact_phone_one");
//     const customerContact2Input = document.getElementById("contact_name_two");
//     const customerPhone2Input = document.getElementById("contact_phone_two");

//     // Add event listeners to both the "Customer Type" and "Customer Name" dropdowns
//     customerTypeSelect.addEventListener("change", updateCustomerDetails);
//     customerNameSelect.addEventListener("change", updateCustomerDetails);

//     function updateCustomerDetails() {
//         const selectedCustomerType = customerTypeSelect.value;
//         const selectedCustomerName = customerNameSelect.value;

//         // Send an AJAX request to retrieve customer details
//         const xhr = new XMLHttpRequest();
//         xhr.open("POST", "fetch_data_project_customer_details.php", true);
//         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 const response = JSON.parse(xhr.responseText);

//                 // Populate input fields with retrieved customer details
//                 customerIdInput.value = response.customer_id;
//                 customerAddressInput.value = response.address;
//                 customerCityInput.value = response.city;
//                 customerCompanyInput.value = response.company_name;
//                 customerGoogleInput.value = response.google_location;
//                 customerContact1Input.value = response.contact_name_one;
//                 customerPhone1Input.value = response.contact_phone_one;
//                 customerContact2Input.value = response.contact_name_two;
//                 customerPhone2Input.value = response.contact_phone_two;
//             }
//         };

//         // Send both selected customer type and name to the PHP script
//         const data = "customer_type=" + encodeURIComponent(selectedCustomerType) +
//                      "&customer_name=" + encodeURIComponent(selectedCustomerName);
//         xhr.send(data);
//     }

//     // Call the updateCustomerDetails function initially to populate based on initial values
//     updateCustomerDetails();
// });


// // fetch data for auto-filling for customer details in the form