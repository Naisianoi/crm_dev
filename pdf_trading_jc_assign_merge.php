<?php
include('config/constants.php');
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php'); // Adjust the path if needed

// Create a new PDF document
//$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); // P for Portrait, A4

$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);  
//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
$pdf->SetDefaultMonospacedFont('helvetica');  
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
$pdf->setPrintHeader(false);  
$pdf->setPrintFooter(false);  
$pdf->SetAutoPageBreak(TRUE, 10);  
$pdf->SetFont('helvetica', '', 12);  
//$pdf->AddPage(); //default A4
//$pdf->AddPage('P','A5'); //when you require custome page size

// Set document information (optional)
/*$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Double-Sided Document');
$pdf->SetSubject('Document for double-sided printing');

// Remove header and footer (optional, adjust as needed)
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default font
$pdf->SetFont('helvetica', '', 12);*/


$MST_ID = $_GET['id'];
$pdf_query_page1 = "SELECT id, jc_create_date, jc_assigned_to, business, commerce, jc_lead_by, jc_type, customer_type, company_name, customer_name, address, 
                    area, county, city, contact_name_1, contact_name_2, contact_number_1, contact_number_2, sales_agent, product_name, brand, last_jc_number, last_jc_date, 
                    last_assigned_to, last_jc_type, work_statement, customer_word, amount FROM tbl_service_jc WHERE id = $MST_ID ";

// MPESA NUMBER QUERY
$mpesaQuery_page1 = "SELECT number, name FROM tbl_mpesa_number";

$pdf_results_page1 = mysqli_query($conn, $pdf_query_page1);
$mpesa_results_page1 = mysqli_query($conn, $mpesaQuery_page1);//Mpesa

$count_page1 = mysqli_num_rows($pdf_results_page1);
$count2_page1 = mysqli_num_rows($mpesa_results_page1);//Mpesa

$pdf_query_page2 = "SELECT * FROM tbl_service_jc_item WHERE service_jc_id = $MST_ID ";
$pdf_results_page2 = mysqli_query($conn, $pdf_query_page2);

$count_page2 = mysqli_num_rows($pdf_results_page2);


// --- Page 1 ---
$pdf->AddPage();

if ($count_page1 > 0 && $count2_page1 > 0) {
    $pdf_data_row_page1 = mysqli_fetch_array($pdf_results_page1, MYSQLI_ASSOC);

    // MPESA Data
    $numbersAndNames_page1 = array();
    while ($row_page1 = mysqli_fetch_array($mpesa_results_page1, MYSQLI_ASSOC)) {
        $numbersAndNames_page1[] = $row_page1["number"] . ' (' . $row_page1["name"] . ')';
    }
    $displayText_page1 = implode(', ', $numbersAndNames_page1);

    $content_page1 = <<<EOD
<style>
    .address { font-size: 7px; }
    .data { font-size: 10px; }
    table, tr, td { padding: 2px; }
</style>

<table>
    <tbody>
        <tr>
            <td><img src="images/img/Aquashine_logo.png" height="40px" /></td>
            <td style="color: green;"><br/><h3>TRADING JOB CARD</h3></td>
            <td align="right" class="address">
                <strong>Aquashine Limited</strong><br/>
                P.O Box 461-00623<br/>
                Mob: +254 714 776 325<br/>
                Email: info@aquashine.co.ke<br/>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted white;"></td>
        </tr><br/>
    </tbody>
</table>

<table class="data">
    <tbody>
        <tr>
            <td><strong>JOB CARD:</strong> D-{$pdf_data_row_page1['id']}</td>
            <td><strong>JC Date:</strong> {$pdf_data_row_page1['jc_create_date']}</td>
            <td><strong>Assigned To:</strong> {$pdf_data_row_page1['jc_assigned_to']}</td>
        </tr>
        <tr>
            <td><strong style="color: green;">Business:</strong> {$pdf_data_row_page1['business']}</td>
            <td><strong style="color: green;">Commerce:</strong> {$pdf_data_row_page1['commerce']}</td>
            <td><strong style="color: green;">Lead By:</strong> {$pdf_data_row_page1['jc_lead_by']}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td><strong style="color: green;">CUSTOMER DETAILS: </strong></td>
            <td></td>
            <td><strong>Customer Type:</strong> {$pdf_data_row_page1['customer_type']}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong> {$pdf_data_row_page1['customer_name']}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Address:</strong> {$pdf_data_row_page1['address']}, {$pdf_data_row_page1['area']}, <strong> {$pdf_data_row_page1['county']} </strong>, {$pdf_data_row_page1['city']}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Person 1:</strong> {$pdf_data_row_page1['contact_name_1']} - {$pdf_data_row_page1['contact_number_1']}</td>
            <td><strong>Company:</strong> {$pdf_data_row_page1['company_name']}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Person 2:</strong> {$pdf_data_row_page1['contact_name_2']} - {$pdf_data_row_page1['contact_number_2']}</td>
            <td><strong>Ref:</strong> {$pdf_data_row_page1['sales_agent']}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td><strong style="color: green;">PRODUCT DETAILS</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong style="color: green;">Product:</strong> {$pdf_data_row_page1['product_name']}</td>
            <td><strong style="color: green;">Brand:</strong> {$pdf_data_row_page1['brand']}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td><strong style="color: green;">JOB DETAILS: </strong></td>
            <td><strong style="color: green;">Job Type:</strong> {$pdf_data_row_page1['jc_type']}</td>
            <td><strong style="color: green;">Last JC Type:</strong> {$pdf_data_row_page1['last_jc_type']}</td>
        </tr>
        <tr>
            <td><strong style="color: green;">Last JC:</strong> {$pdf_data_row_page1['last_jc_number']}</td>
            <td><strong style="color: green;">JC Date:</strong> {$pdf_data_row_page1['last_jc_date']}</td>
            <td><strong style="color: green;">Assigned To:</strong> {$pdf_data_row_page1['last_assigned_to']}</td>
        </tr>
        <tr>
            <td colspan="8"><strong>Work Statement:</strong> {$pdf_data_row_page1['work_statement']}</td>
        </tr><br/>
        <tr>
            <td colspan="8"><strong>Extra Word/ Request By Client:</strong> {$pdf_data_row_page1['customer_word']}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td colspan="4"><strong style="color: green;">To be filled by technician:</strong> Work Done Date: _________ Time Start: ______ Time Completed: ______</td>
        </tr>
        <tr><td colspan="8">Job Description/Findings: </td>

        </tr><br/><br/><br/><br/><br/><br/>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td colspan="2"><strong style="color: green;">PAYMENTS:</strong></td>
            <td colspan="2"><strong style="color: green;">Amount Agreed:</strong> <strong>KES {$pdf_data_row_page1['amount']}</strong></td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr>
            <td colspan="2"><strong style="color: green;">CUSTOMER CARE:</strong></td>
        </tr>
        <tr>
            <td colspan="8"><strong>Client Comments:</strong> ___________________________________________________________________________</td>
        </tr>
        <tr>
            <td colspan="4">__________________________________________________________________________________________</td>
        </tr><br/>
        <tr>
            <td>Work done satisfactorily? YES / NO</td>
        </tr><br/>
        <tr>
            <td colspan="2">Client Sign: _____________________</td>
            <td>Date: ______________________</td>
        </tr>
        <tr>
            <td colspan="2">Rate Our Service (1 to 10): _____</td>
        </tr>
        <tr>
            <td colspan="4" align="center"><strong>MPESA NUMBER: {$displayText_page1}</strong></td>
        </tr>
    <tbody>
</table>
EOD;

    $pdf->writeHTML($content_page1, true, false, true, false, '');
} 


// --- Page 2 ---
$pdf->AddPage();
if ($count_page2 > 0) {
    $content_page2 = '
        <style>
        .address, {
            font-size: 7px;
        }

        .data {
            font-size: 10px;
        }

        h3 {
            vertical-align: middle;
            text-align: center;
        }

        table,
        tr,
        td {
            padding: 2px;
        }
        </style>

        <table>
            <tbody>
                <tr>

                    <td align="left"><img src="images/img/Aquashine_logo.png" height="40px" /><br /></td>

                    <td style="color: green;"><br />
                        <h3>TRADING JOB CARD</h3>
                    </td>


                    <td align="right" class="address">
                        <strong>Aquashine Limited</strong><br />
                        P.O Box 461-00623<br />
                        Mob: +254 714 776 325<br />
                        Email: info@aquashine.co.ke<br />

                    </td>

                </tr>
            </tbody>
        </table>';

    $content_page2 .=
        '<table>
        
        <tbody>
        
        <tr class="data">
            <td colspan="2" align="center"><strong><h3>Delivery Note</h3></strong></td>
        </tr>

        <tr class="data">
            <td colspan="2"><strong>JOB CARD:</strong> D-' . $MST_ID . '</td>
        </tr><br/>
        <tr class="data">
        <td colspan="2">Following material is utilised in this job.</td>
        </tr>

        
        
        
        

        
    
        
        
        </tbody>
        </table>';

    // Table header for products
    $content_page2 .= '<table>';
    $content_page2 .= '<tbody>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="2"><strong style="color: green;">PRODUCTS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Quantity</strong></td>';
    $content_page2 .= '</tr>';

    // Loop through each product
    while ($pdf_data_row_page2 = mysqli_fetch_array($pdf_results_page2, MYSQLI_ASSOC)) {
        // Check if the product quantity is greater than 0 before displaying
        if ($pdf_data_row_page2['product_quantity'] > 0) {
            $content_page2 .= '<tr class="data">';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['product_name'] . '</td>';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['product_quantity'] . '</td>';
            $content_page2 .= '</tr>';
        }
    }
    $content_page2 .= '<br/>';
    // Table header for items
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="2"><strong style="color: green;">ITEMS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Quantity</strong></td>';
    $content_page2 .= '</tr>';

    // Reset the results to the beginning
    mysqli_data_seek($pdf_results_page2, 0);

    // Loop through each item
    while ($pdf_data_row_page2 = mysqli_fetch_array($pdf_results_page2, MYSQLI_ASSOC)) {
        // Check if the item quantity is greater than 0 before displaying
        if ($pdf_data_row_page2['item_quantity'] > 0) {
            $content_page2 .= '<tr class="data">';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['item_name'] . '</td>';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['item_quantity'] . '</td>';
            $content_page2 .= '</tr>';
        }
    }

    $content_page2 .= '<br/><br/>';
    $content_page2 .= '<tr class="data">
            <td colspan="1">Aquashine Sign: _____________________</td>
            <td>Date: ________________</td>
            </tr><br/>

            <tr class="data">
            <td colspan="1">Client Sign: _____________________</td>
            <td>Date: ________________</td>
            </tr>';

    $content_page2 .= '</tbody>';
    $content_page2 .= '</table>';

    $pdf->writeHTML($content_page2, true, false, true, false, '');
}
else
{
    //$content_page2 = "No Products/Items assigned to this Job Card.";
    $content_page2 = '
        <style>
        .address, {
            font-size: 7px;
        }

        .data {
            font-size: 10px;
        }

        h3 {
            vertical-align: middle;
            text-align: center;
        }

        table,
        tr,
        td {
            padding: 2px;
        }
        </style>

        <table>
            <tbody>
                <tr>

                    <td align="left"><img src="images/img/Aquashine_logo.png" height="40px" /><br /></td>

                    <td style="color: green;"><br />
                        <h3>TRADING JOB CARD</h3>
                    </td>


                    <td align="right" class="address">
                        <strong>Aquashine Limited</strong><br />
                        P.O Box 461-00623<br />
                        Mob: +254 714 776 325<br />
                        Email: info@aquashine.co.ke<br />

                    </td>

                </tr>
            </tbody>
        </table>';

    $content_page2 .=
        '<table>
        
        <tbody>
        
        <tr class="data">
            <td colspan="2" align="center"><strong><h3>Delivery Note</h3></strong></td>
        </tr>

        <tr class="data">
            <td colspan="2"><strong>JOB CARD:</strong> D-' . $MST_ID . '</td>
        </tr><br/>
        <tr class="data">
        <td colspan="2">Following material is utilised in this job.</td>
        </tr>

        
        
        
        

        
    
        
        
        </tbody>
        </table>';

    // Table header for products
    $content_page2 .= '<table>';
    $content_page2 .= '<tbody>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="2"><strong style="color: green;">PRODUCTS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Quantity</strong></td>';
    $content_page2 .= '</tr>';

    // Loop through each product
    while ($pdf_data_row_page2 = mysqli_fetch_array($pdf_results_page2, MYSQLI_ASSOC)) {
        // Check if the product quantity is greater than 0 before displaying
        if ($pdf_data_row_page2['product_quantity'] > 0) {
            $content_page2 .= '<tr class="data">';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['product_name'] . '</td>';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['product_quantity'] . '</td>';
            $content_page2 .= '</tr>';
        }
    }
    $content_page2 .= '<br/>';
    // Table header for items
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="2"><strong style="color: green;">ITEMS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: green;">Quantity</strong></td>';
    $content_page2 .= '</tr>';

    // Reset the results to the beginning
    mysqli_data_seek($pdf_results_page2, 0);

    // Loop through each item
    while ($pdf_data_row_page2 = mysqli_fetch_array($pdf_results_page2, MYSQLI_ASSOC)) {
        // Check if the item quantity is greater than 0 before displaying
        if ($pdf_data_row_page2['item_quantity'] > 0) {
            $content_page2 .= '<tr class="data">';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['item_name'] . '</td>';
            $content_page2 .= '<td colspan="1">' . $pdf_data_row_page2['item_quantity'] . '</td>';
            $content_page2 .= '</tr>';
        }
    }

    $content_page2 .= '<br/><br/>';
    $content_page2 .= '<tr class="data">
            <td colspan="1">Aquashine Sign: _____________________</td>
            <td>Date: ________________</td>
            </tr><br/>

            <tr class="data">
            <td colspan="1">Client Sign: _____________________</td>
            <td>Date: ________________</td>
            </tr>';

    $content_page2 .= '</tbody>';
    $content_page2 .= '</table>';
    $pdf->writeHTML($content_page2, true, false, true, false, '');
}


// --- Output the PDF ---
$datetime = date('dmY_hms');
$file_name = "TradingJC_" . rand(0000, 9999) . ".pdf";
ob_end_clean();

if ($_GET['ACTION'] == 'VIEW') {
    $pdf->Output($file_name, 'I'); // I means Inline view
} else if ($_GET['ACTION'] == 'DOWNLOAD') {
    $pdf->Output($file_name, 'D'); // D means download
} else if ($_GET['ACTION'] == 'UPLOAD') {
    $file_location = "/path/to/your/upload/directory/";  //  Change this to your actual upload path
    $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
    echo "Upload successfully!!";
}
else
{
	echo 'Record not found for PDF.';
}
?>
