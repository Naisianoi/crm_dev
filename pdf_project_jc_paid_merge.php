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
$pdf_query_page1 = "SELECT id, jc_create_date, jc_assigned_to, business, commerce, jc_lead_by, jc_type, company_name, customer_name, address, 
                    city, county, contact_name_1, contact_name_2, contact_number_1, contact_number_2, sales_agent, product_name, brand, last_jc_number, last_jc_date, 
                    last_assigned_to, last_jc_type, work_statement, customer_word, project_id, project_name, project_type, project_name, site_name, site_address, site_city, site_county, site_contact_name_1, 
                    site_contact_number_1, site_contact_name_2, site_contact_number_2, work_done_date, job_finding, work_satisfactory, client_sign, jc_conclude_date,
                    payment_type, payment_code, payment_date, total_paid_amount FROM tbl_service_jc WHERE id = $MST_ID ";
$pdf_results_page1 = mysqli_query($conn, $pdf_query_page1);
$count_page1 = mysqli_num_rows($pdf_results_page1);

$pdf_query_page2 = "SELECT * FROM tbl_service_jc_item WHERE service_jc_id = $MST_ID ";
$pdf_results_page2 = mysqli_query($conn, $pdf_query_page2);
$count_page2 = mysqli_num_rows($pdf_results_page2);


// --- Page 1 ---
$pdf->AddPage();
if ($count_page1 > 0) {
    $pdf_data_row_page1 = mysqli_fetch_array($pdf_results_page1, MYSQLI_ASSOC);

    $content_page1 = '
        <style>
        .address {
            font-size: 7px;
        }
        .data {
            font-size: 10px;
        }
        table, tr, td {
            padding: 2px;
        }
        </style>
        <table>
        <tbody>
        <tr>
            <td align="left"><img src="images/img/Aquashine_logo.png" height="40px" /><br /></td>
            <td style="color: orange;">
            <span style="color: red; font-weight: bold; text-align: center;">
                <strong>' . $pdf_data_row_page1['payment_type'] . '</strong> / <strong>' . $pdf_data_row_page1['payment_code'] . '</strong> / <strong>' . $pdf_data_row_page1['total_paid_amount'] . '</strong>
            </span>
                <h3>PROJECT JOB CARD</h3>
            </td>
            <td align="right" class="address">
                <strong>Aquashine Limited</strong><br />
                P.O Box 461-00623<br />
                Mob: +254 714 776 325<br />
                Email: info@aquashine.co.ke<br />
            </td>
        </tr>
        </tbody>
        </table>
        <table>
        <tbody>
        <tr class="data">
            <td><strong>JOB CARD #: </strong> ' . $pdf_data_row_page1['id'] . '</td>
            <td><strong>JC Date:</strong> ' . $pdf_data_row_page1['jc_create_date'] . '</td>
            <td><strong>Assigned To:</strong> ' . $pdf_data_row_page1['jc_assigned_to'] . '</td>
        </tr>
        <tr class="data">
            <td><strong style="color: orange;">Lead By:</strong> ' . $pdf_data_row_page1['jc_lead_by'] . '</td>
        </tr>
        <tr class="data">
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        <tr class="data">
            <td><strong>PROJECT NUMBER #: </strong> ' . $pdf_data_row_page1['id'] . '</td>
            <td colspan="4"><strong style="color: orange;">Project Type:</strong> ' . $pdf_data_row_page1['project_type'] . '</td>
        </tr>
        <tr class="data">
            <td colspan="6"><strong style="color: orange;">Project Name:</strong> ' . $pdf_data_row_page1['project_name'] . '</td>
        </tr>
        <tr class="data">
            <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
        </tr><br/>
        </table>
        <table>
            <tr>
                <td><!-- Left Section (Customer Details) -->
                    <table>
                        <tr class="data">
                            <td><strong style="color: orange;">CUSTOMER DETAILS: </strong></td>
                        </tr>
                        <tr class="data">
                            <td><strong>Customer:</strong> ' . $pdf_data_row_page1['customer_name'] . '</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Company:</strong> ' . $pdf_data_row_page1['company_name'] . '</td>
                        </tr>
                        <tr class="data">
                            <td colspan="3"><strong>Address:</strong> ' . $pdf_data_row_page1['address'] . '</td>
                        </tr>
                        <tr class="data">
                            <td colspan="2"><strong>City:</strong> '.$pdf_data_row_page1['city'].'</td> 
                        </tr>
                        <tr class="data"> 
                            <td><strong>County:</strong> '.$pdf_data_row_page1['county'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Contact 1:</strong> '.$pdf_data_row_page1['contact_name_1'].'</td> 
                        </tr>
                        <tr class="data">
                            <td>'.$pdf_data_row_page1['contact_number_1'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Contact 2:</strong> '.$pdf_data_row_page1['contact_name_2'].'</td>
                        </tr>
                        <tr class="data">
                            <td>'.$pdf_data_row_page1['contact_number_2'].'</td>
                        </tr>
                    </table>
                </td>
                <td><!-- Right Section (Site Details) -->
                    <table>
                        <tr class="data">
                            <td><strong style="color: orange;">SITE DETAILS: </strong></td>
                        </tr>
                        <tr class="data">
                            <td><strong>Site Name:</strong> '.$pdf_data_row_page1['site_name'].'</td>
                        </tr>
                        <tr class="data">
                            <td colspan="3"> '.$pdf_data_row_page1['site_address'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>City:</strong> '.$pdf_data_row_page1['site_city'].'</td> 
                        </tr>
                        <tr class="data">
                            <td><strong>County:</strong> '.$pdf_data_row_page1['site_county'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Contact 1:</strong> '.$pdf_data_row_page1['site_contact_name_1'].'</td> 
                        </tr>
                        <tr class="data">
                            <td> '.$pdf_data_row_page1['site_contact_number_1'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Contact 2:</strong> '.$pdf_data_row_page1['site_contact_name_2'].'</td>
                        </tr>
                        <tr class="data">
                            <td> '.$pdf_data_row_page1['site_contact_number_2'].'</td>
                        </tr>
                        <tr class="data">
                            <td><strong>Sales Agent:</strong> '.$pdf_data_row_page1['sales_agent'].'</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
        <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
               <td colspan=""><strong style="color: orange;">JOB DETAILS: </strong></td>
               <td><strong style="color: orange;">Job Type:</strong> '.$pdf_data_row_page1['jc_type'].'</td>
		       <td><strong style="color: orange;">Last JC Type:</strong> '.$pdf_data_row_page1['last_jc_type'].'</td>
            </tr>
            <tr class="data">
               <td colspan=""><strong style="color: orange;">Last JC No:</strong>'.$pdf_data_row_page1['last_jc_number'].'</td>
               <td><strong style="color: orange;">Last JC Date:</strong>'.$pdf_data_row_page1['last_jc_date'].'</td>
               <td><strong style="color: orange;">Last Assigned:</strong>'.$pdf_data_row_page1['last_assigned_to'].'</td>
		    </tr>
            <tr class="data">
               <td colspan="8"><strong>Work Statement:</strong> '.$pdf_data_row_page1['work_statement'].'</td>
		    </tr><br/>
            <tr class="data">
               <td colspan="8"><strong>Extra Word/ Request By Client:</strong> '.$pdf_data_row_page1['customer_word'].'</td>
		    </tr>
            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>
            <tr class="data">
                <td colspan="4"><strong style="color: orange;">To be filled by Technician:</strong> Work Done Date: <strong>'.$pdf_data_row_page1['work_done_date'].'</strong> Time Started:______Time Completed:_______</td>  
            </tr>
            <tr class="data">
                <td colspan="8">Job Description / Findings:</td>
                <strong>'.$pdf_data_row_page1['job_finding'].'</strong>
            </tr><br/><br/>
            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>
            <tr class="data">
                <td colspan="2"><strong style="color: orange;">CUSTOMER CARE:</strong></td>   
            </tr>
            <tr class="data">
                <td colspan="8"><strong>Client Comments:</strong>___________________________________________________________________________</td>    
            </tr>
            <tr class="data">
              <td colspan="4">__________________________________________________________________________________________</td>
            </tr><br/>
            <tr class="data">
            <td>Work done satisfactorily? <strong>'.$pdf_data_row_page1['work_satisfactory'].'</strong></td> 
            </tr><br/>
            <tr class="data">
                <td colspan="2">Client Sign: <strong>'.$pdf_data_row_page1['client_sign'].'</strong></td>
                <td>Date: <strong>'.$pdf_data_row_page1['jc_conclude_date'].'</strong></td>
            </tr>
            <tr class="data">
                <td colspan="2">Rate Our Services:(1 to 10) _____</td>
            </tr>
        </tbody>
    </table>';
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

                    <td style="color: orange;"><br />
                        <h3>PROJECT JOB CARD</h3>
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
            <td colspan="2"><strong>JOB CARD I: </strong> ' . $MST_ID . '</td>
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
    $content_page2 .= '<td colspan="2"><strong style="color: orange;">PRODUCTS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Quantity</strong></td>';
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
    $content_page2 .= '<td colspan="2"><strong style="color: orange;">ITEMS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Quantity</strong></td>';
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

                    <td style="color: orange;"><br />
                        <h3>PROJECT JOB CARD</h3>
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
            <td colspan="2"><strong>JOB CARD I: </strong> ' . $MST_ID . '</td>
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
    $content_page2 .= '<td colspan="2"><strong style="color: orange;">PRODUCTS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Quantity</strong></td>';
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
    $content_page2 .= '<td colspan="2"><strong style="color: orange;">ITEMS</strong></td>';
    $content_page2 .= '</tr>';
    $content_page2 .= '<tr class="data">';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Name</strong></td>';
    $content_page2 .= '<td colspan="1"><strong style="color: orange;">Quantity</strong></td>';
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
$file_name = "ProjectJC_" . rand(0000, 9999) . ".pdf";
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
