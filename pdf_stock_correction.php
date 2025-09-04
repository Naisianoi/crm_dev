<?php
include('config/constants.php');
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');

// // Custom function to generate the footer content
// function customFooter($pdf) {
//     $business = isset($_GET['business']) ? $_GET['business'] : '';
//     $pageNumber = $pdf->getAliasNumPage();
//     return sprintf('Business: %s | Page %d', $business, $pageNumber);
// }

// Custom function to generate the footer content
function customFooter($pdf) {
    $business = isset($_GET['business']) ? $_GET['business'] : '';
    $pageNumber = $pdf->getAliasNumPage();
    return sprintf('Business: %s | Page %d', $business, $pageNumber);
}

// Create a PDF instance with portrait orientation
$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setHeaderData('', '', 'Stock Report', ''); // Set the header data
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 12);


// Add a page for "Aquashine"
$pdf->AddPage();

$content = '
<table cellspacing="0" cellpadding="0" border="0" style="height:100%; width:100%;">
    <tr>
        <td align="center" valign="middle">
            <h1 style="color: #1997D4; font-size:50px;"><br/><br/>
                <img src="images/img/Aquashine_logo.png" height="100px"/><br/><br/>
                STOCK REPORT
            </h1><br/>
            <h1 style="color: #1997D4; font-size:35px;">Date: ' . date('Y-m-d') . '</h1>
        </td>
    </tr>
</table>';
$pdf->writeHTML($content, true, false, true, false, '');

/*$content = '
<table cellspacing="0" cellpadding="0" border="0" style="height:100%; width:100%;">
    <tr>
        <td align="center" valign="middle">
            <h1 style="color: #1997D4; font-size:50px;"><br/><br/>
                <img src="images/img/Aquashine_logo.png" height="100px"/><br/><br/>
                AQUASHINE LIMITED
            </h1><br/>
            <h1 style="color: #6C3BAA; font-size:50px;"><br/><br/><br/>PRICE LIST</h1>
        </td>
    </tr>
</table>';*/



/*$pdf->AddPage();
$content = ' <br><br><br><br><br><br><br><br>
            <h1 align="center" style="color: #1997D4; font-size:50px;"><img src="images/img/Aquashine_logo.png" height="100px"/><br/>AQUASHINE LIMITED</h1>';
$pdf->writeHTML($content);

$content = '<h1 align="center" style="color: #6C3BAA; font-size:50px;"><br/>PRICE LIST</h1>';
$pdf->writeHTML($content);*/


// Fetch unique business types from both tbl_item and tbl_product tables
$business_query = "SELECT DISTINCT business FROM (SELECT business FROM tbl_item UNION SELECT business FROM tbl_product) AS combined";
$business_results = mysqli_query($conn, $business_query);

// Loop through each unique business
while ($business_row = mysqli_fetch_assoc($business_results)) {
    $currentBusiness = $business_row['business'];

    // Add a new page for the current business
    $pdf->AddPage();
    // Map business codes to their full names
$businessNames = [
    "DWS" => "Drinking Water System <br> (DWS)",
    "IEL" => "Industrial Electrical <br> (IEL)",
    "IWT" => "Industrial Water Treatment <br> (IWT)",
    "WTW" => "Water Treatment Wholesale <br> (WTW)"
];

// Check if $currentBusiness exists in the map, otherwise, use $currentBusiness itself
$businessName = isset($businessNames[$currentBusiness]) ? $businessNames[$currentBusiness] : $currentBusiness;
    
// Generate content with the business name
$content = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h1 align="center" style="color: #1997D4; font-size:50px;">' . $businessName . '</h1>';
    // $content = '<h1 align="center" style="color: #1997D4; font-size:50px;">' . $currentBusiness . '</h1>';
    
    $pdf->writeHTML($content);

   
    // Fetch unique brands for the current business from tbl_product table
    $brand_query = "SELECT DISTINCT brand FROM tbl_product WHERE business = '$currentBusiness' ORDER BY brand ASC";
    $brand_results = mysqli_query($conn, $brand_query);
    $pdf->AddPage();


    $content = '<img src="images/img/Aquashine_logo.png" height="40px"/>';
    $pdf->writeHTML($content);

    $content = '<h1 style="color: red; font-size:13px; text-align: left;">PRODUCTS</h1>';
    $pdf->writeHTML($content);

    // Loop through each unique brand
    while ($brand_row = mysqli_fetch_assoc($brand_results)) {
        $currentBrand = $brand_row['brand'];

        // Add a new page for the current brand
        
        
        //$content = '<h1 style="color: #1997D4; font-size:13px;">' . $currentBrand . '</h1>';
        $sectionHeader = ' 
            <h1 style="font-size:13px;">
                <span>' . htmlspecialchars($currentBusiness) . '</span> -
                <span style="color: #1997D4;">' . htmlspecialchars($currentBrand) . '</span> 
            </h1>';
        $pdf->writeHTML($sectionHeader);

        // Fetch data from the tbl_item table
        $product_query = "SELECT id, business, brand, name, stock_qty, min_stock 
                          FROM tbl_product
                          WHERE business = '$currentBusiness' AND brand = '$currentBrand'
                          ORDER BY name ASC";
        $product_results = mysqli_query($conn, $product_query);

        // Check if there are products for the current business and brand
        if (mysqli_num_rows($product_results) > 0) {
            // Add the table and table header for products
            $content = ' 
             <style>
            .faint-border {
                border-collapse: collapse;
            }
            
            .faint-border th,
            .faint-border td {
                border: 1px solid #e0e0e0; /* Change the color code to whatever faint color you prefer */
            }
            </style>
                            <table class="faint-border" align="center">
                            <thead>
                                <tr>
                                    <th width="10%"><strong>ID</strong></th>
                                    <th width="70%"><strong>Product Name</strong></th>
                                    <th width="20%"><strong>Todays Qty</strong></th>
                                </tr>
                            </thead>
                            <tbody>';
                            
            // Loop through products and add them to the table
            while ($row = mysqli_fetch_assoc($product_results)) {
                $content .= '<tr>
                                <td align="center" width="10%" style="font-size:10px; line-height:2;">' . $row['id'] . '</td>
                                <td align="left" width="70%" style="font-size:10px; line-height:2;">' . $row['name'] . '</td>
                                <td align="center" width="20%" style="font-size:10px; line-height:2;"></td>
                            </tr>';
            }

            // Close the table for products
            $content .= '</tbody></table>';

            // Add the content to the current page
           
            $pdf->writeHTML($content);
             
        }   
        
    } 

    
    
// Fetch unique categories for the current business from tbl_item table
$category_query = "SELECT DISTINCT category FROM tbl_item WHERE business = '$currentBusiness' ORDER BY category ASC";
$category_results = mysqli_query($conn, $category_query);

// Add first page and logo
$pdf->AddPage();
$pdf->writeHTML('<img src="images/img/Aquashine_logo.png" height="40px"/>');

// Add heading
$pdf->writeHTML('<h1 style="color: red; font-size:13px; text-align: left;">ITEMS</h1>');

// Loop through each unique category
while ($category_row = mysqli_fetch_assoc($category_results)) {
    $currentCategory = $category_row['category'];

    // Fetch unique subcategories for the current category
    $sub_category_query = "SELECT DISTINCT sub_category FROM tbl_item WHERE business = '$currentBusiness' AND category = '$currentCategory' ORDER BY sub_category ASC";
    $sub_category_results = mysqli_query($conn, $sub_category_query);

    while ($sub_category_row = mysqli_fetch_assoc($sub_category_results)) {
        $currentSubCategory = $sub_category_row['sub_category'];

        // Section header for category and subcategory
        $sectionHeader = ' 
            <h1 style="font-size:13px;">
                <span>' . htmlspecialchars($currentBusiness) . '</span> -
                <span style="color: #1997D4;">' . htmlspecialchars($currentCategory) . '</span>: 
                <span style="color: green;">' . htmlspecialchars($currentSubCategory) . '</span><br>
            </h1>';
        $pdf->writeHTML($sectionHeader);


        /*$sectionHeader = '
            <h1 style="font-size:13px;">
                <span style="color: #1997D4;">' . htmlspecialchars($currentCategory) . '</span>: 
                <span style="color: green;">' . htmlspecialchars($currentSubCategory) . '</span>
            </h1>';
        $pdf->writeHTML($sectionHeader);*/
        /*$sectionHeader = '
            <h1 style="color: #1997D4; font-size:13px;">' . htmlspecialchars($currentCategory) . '</h1> 
            <h1 style="color: green; font-size:13px;">' . htmlspecialchars($currentSubCategory) . '</h1>';
        $pdf->writeHTML($sectionHeader);*/

        // Fetch items for the current business, category, and subcategory
        $item_query = "SELECT id, item_name,brand, stock_qty, min_stock
                       FROM tbl_item
                       WHERE business = '$currentBusiness'
                       AND category = '$currentCategory'
                       AND sub_category = '$currentSubCategory'
                       ORDER BY item_name ASC";
        $item_results = mysqli_query($conn, $item_query);

        if (mysqli_num_rows($item_results) > 0) {
            // Table styles and structure
            $tableContent = '
                <style>
                    .faint-border {
                        border-collapse: collapse;
                    }
                    .faint-border th, .faint-border td {
                        border: 1px solid #e0e0e0;
                        padding: 4px;
                    }
                </style>
                <div>
                <table class="faint-border" align="center">
                    <thead>
                        <tr>
                            <th width="10%"><strong>ID</strong></th>
                            <th width="55%"><strong>Item Name</strong></th>
                            <th width="15%"><strong>Brand</strong></th>
                            <th width="20%"><strong>Todays Qty</strong></th>
                        </tr>
                    </thead>
                    <tbody>';

            // Loop through items and add them to the table
            while ($item_row = mysqli_fetch_assoc($item_results)) {
                $tableContent .= '<style>
                                    .item-pdf-stock td {
                                                font-size: 10px;
                                                line-height: 2;
                                                text-align: center;
                                            }
                                    .item-pdf-stock td.name-pdf {
                                                text-align: left;
                                            }
                                    .item-pdf-stock td.brand-pdf {
                                                text-align: left;
                                            }
                                  </style>
                                <tr class="item-pdf-stock"> 
                                    <td width="10%">' . $item_row['id'] . '</td>
                                    <td class="name-pdf" width="55%">' . $item_row['item_name'] . '</td>
                                    <td class="brand-pdf"width="15%">' . $item_row['brand'] . '</td>
                                    <td width="20%"></td>
                                </tr>';


                /*$itemName = htmlspecialchars($item_row['item_name']);
                $price = number_format($item_row['price_list_price']);
                $tableContent .= "
                    <tr>
                        <td align='left' width='70%'>$itemName</td>
                        <td align='right' width='15%'>$price</td>
                    </tr>";*/
            }

            $tableContent .= '</tbody></table></div>';

            // Output the table to the PDF
            $pdf->writeHTML($tableContent);
        }
    }
}


    // $content .= '<p align="left">Page ' . $pdf->getAliasNumPage() . ' | ' . $currentBusiness .'</p>'; // Add page number
    // // $content = customFooter($pdf);
    // $pdf->writeHTML($content);

    
}



// Output or save the PDF based on the requested action
$datetime = date('dmY_hms');
$file_name = "PriceList_" . rand(0000, 9999) . ".pdf";
ob_end_clean();

if ($_GET['ACTION'] == 'VIEW') {
    $pdf->Output($file_name, 'I'); // I means Inline view
} else if ($_GET['ACTION'] == 'DOWNLOAD') {
    $pdf->Output($file_name, 'D'); // D means download
} else if ($_GET['ACTION'] == 'UPLOAD') {
    $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
    echo "Upload successfully!!";
}

//----- End Code for generating PDF
?>
