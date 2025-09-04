<?php
include('config/constants.php');
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Create a PDF instance with landscape orientation
$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
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
$pdf->AddPage();

$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : null;
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

// Validate and sanitize input (you should perform additional validation)
$item_id = filter_var($item_id, FILTER_VALIDATE_INT);
// $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
// $end_date = filter_var($end_date, FILTER_SANITIZE_STRING);

// Check if $item_id is valid
if ($item_id !== false) {

     // Format the start_date and end_date to "d-m-y" format
     $formatted_start_date = date("d-m-Y", strtotime($start_date));
     $formatted_end_date = date("d-m-Y", strtotime($end_date));


    // Build the SQL query
    $item_query = "SELECT i.item_name, i.item_quantity, i.item_id, i.service_jc_id
                    FROM tbl_service_jc_item i
                    WHERE i.item_id = $item_id
                        AND i.work_done_date >= '$start_date'
                        AND i.work_done_date <= '$end_date'";

    // Execute the query
    $item_results = mysqli_query($conn, $item_query);

    // Initialize the total quantity variable outside the while loop
    $total_qty_used = 0;
    
    // Start HTML content
    $content = '<h1 align="left">STOCK MOVEMENT - ITEM</h1> 
                    <div class="row">
                        <div class="col">
                            <label style="font-size: 15px;">Report Date From: <strong>' . $formatted_start_date . '</strong>&nbsp;&nbsp;&nbsp;To: <strong>' . $formatted_end_date . '</strong></label>
                        </div>
                    </div>

                
                <table border="0" align="center">
                    <thead>
                        <tr>
                            <th width="5%"><strong>JC#</strong></th>
                            <th width="15%"><strong>JC Dt</strong></th>
                            <th align="left" width="20%"><strong>Customer Name</strong></th>
                            <th width="20%"><strong>Qty Used</strong></th>
                        </tr>
                    </thead>
                    <tbody>';

    // Fetch rows from the $item_results result set
    while ($row = mysqli_fetch_assoc($item_results)) {
        $item_name = $row['item_name'];
        

        // Fetch stock quantity from tbl_item based on item_id
        $item_id = $row['item_id'];
        $stock_query = "SELECT stock_qty FROM tbl_item WHERE id = $item_id";
        $stock_result = mysqli_query($conn, $stock_query);
        $stock_row = mysqli_fetch_assoc($stock_result);
        $stock_qty = $stock_row ? $stock_row['stock_qty'] : 0;

        // Fetch additional data from tbl_service_jc based on service_jc_id
        $service_jc_id = $row['service_jc_id'];
        $additional_data_query = "SELECT id, jc_create_date, customer_name FROM tbl_service_jc WHERE id = $service_jc_id";
        $additional_data_result = mysqli_query($conn, $additional_data_query);
        $additional_data_row = mysqli_fetch_assoc($additional_data_result);

        $content .= '<tr>
                        
                        <td align="center" width="5%">' . $additional_data_row['id'] . '</td>
                        <td align="center" width="15%">' . date('d-m', strtotime($additional_data_row['jc_create_date'])) . '</td>
                        <td align="left" width="20%">' . $additional_data_row['customer_name'] . '</td>
                        <td align="center" width="20%">' . $row['item_quantity'] . '</td>
                    </tr>';

        // Update the total quantity
        $total_qty_used += $row['item_quantity'];
        $item_name = $row['item_name'];
    }

    // Calculate remaining stock quantity after fetching all items
    $remaining_stock_qty = $stock_qty - $total_qty_used;

    $content .= '</tbody></table>';

    // Add a new row with a line break
    $content .= '<tr><td><br/></td></tr>';
    
    // Display the total quantity and remaining stock at the end of the table
    $content .= '<tr>
                    <td align="left" colspan="4"><strong>' . $item_name . '</strong></td>
                
                </tr>';

    // Add a new row with a line break
    $content .= '<tr><td><br/></td></tr>';
    
    $content .= '<tr>
                    <td align="left" colspan="3"><strong>Total Qty Used:</strong></td>
                    <td align="center"><strong>' . $total_qty_used . '</strong></td>
                </tr>'; 

    // Add a new row with a line break
    $content .= '<tr><td><br/></td></tr>';

    $current_date = date("d-m-Y");
    $content .= '<tr>
                    <td align="left" colspan="3"><strong>Bal Stock Qty ('. $current_date .'):</strong></td>
                    <td align="center" style="color: #0000FF;"><strong>' . $stock_qty . '</strong></td>
                </tr>'; 
    // $content .= '<tr>
    //                 <td align="left" colspan="3"><strong>Bal Stock Qty:</strong></td>
    //                 <td align="center"><strong>' . $remaining_stock_qty . '</strong></td>
    //             </tr>'; 

    // Add the content to the current page
    $pdf->writeHTML($content);
} else {
    // Handle the case where $item_id is not valid
    $content .= 'Invalid item ID.';
}

$datetime = date('dmY_hms');
$file_name = "ItemsStockMvmt_" . rand(0000, 9999) . ".pdf";
ob_end_clean();

if ($_GET['ACTION'] == 'VIEW') {
    $pdf->Output($file_name, 'I'); // I means Inline view
} elseif ($_GET['ACTION'] == 'DOWNLOAD') {
    $pdf->Output($file_name, 'D'); // D means download
} elseif ($_GET['ACTION'] == 'UPLOAD') {
    $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
    echo "Upload successfully!!";
}
?>
