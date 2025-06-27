<?php

include('config/constants.php'); // Assuming this connects to your database ($conn)
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php'); // Include TCPDF library

// Check if start_date and end_date are provided via POST
if (!isset($_POST['start_date']) || !isset($_POST['end_date'])) {
    echo 'Start date and end date are required.';
    exit; // Stop execution if dates are missing
}

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Initialize TCPDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false); // No header
$pdf->setPrintFooter(false); // No footer
$pdf->SetAutoPageBreak(TRUE, 10); // Auto page break with 10mm bottom margin
$pdf->SetFont('helvetica', '', 10); // Default font size for the PDF

// --- SQL Query for Project Payments ---
$pdf_query_project = "SELECT
    tpp.project_id,
    tpp.payment_date,
    tpp.payment_post_date,
    tpp.payment_type,
    tpp.payment_code,
    tpp.amount,
    tpp.part_final,
    tp.customer_name
FROM
    tbl_project_payment AS tpp
INNER JOIN
    tbl_project AS tp ON tpp.project_id = tp.id
WHERE
    tpp.payment_post_date >= '$start_date' AND tpp.payment_post_date <= '$end_date'
ORDER BY
    tpp.payment_type, tp.customer_name"; // Order by payment_type first for grouping

// Execute the query
$pdf_results_project = mysqli_query($conn, $pdf_query_project);

// Check for SQL errors
if (!$pdf_results_project) {
    die('SQL Error for Project Payments: ' . mysqli_error($conn) . '<br>Query: ' . htmlspecialchars($pdf_query_project));
}

// Function to truncate a string (defined only if it doesn't already exist)
if (!function_exists('truncateString')) {
    function truncateString($string, $maxLength) {
        if (strlen($string) > $maxLength) {
            $string = substr($string, 0, $maxLength) . '...';
        }
        return $string;
    }
}

// --- Project Payment Report Content Generation ---
$pdf->AddPage(); // Add a new page for this report

if (mysqli_num_rows($pdf_results_project) > 0) {
    $content_project = '<h2 style="text-align: center;">COLLECTION REPORT (PROJECT AND AMC)</h2>';

    // Format and display the date range
    $formatted_start_date = date("d-m-Y", strtotime($start_date));
    $formatted_end_date = date("d-m-Y", strtotime($end_date));

    $content_project .= '<p style="text-align: center;">Report Date From: <strong>' . $formatted_start_date . '</strong>&nbsp;&nbsp;&nbsp;To: <strong>' . $formatted_end_date . '</strong></p>';

    $summary_grand_total_project = 0; // Renamed for clarity
    $grouped_data_project = [];
    $invoice_total_project = 0;
    $cheque_total_project = 0;
    $cash_other_total_project = 0; // For cash and other non-invoice/cheque types

    while ($row_project = mysqli_fetch_array($pdf_results_project, MYSQLI_ASSOC)) {
        $payment_type = $row_project['payment_type'];

        if (!isset($grouped_data_project[$payment_type])) {
            $grouped_data_project[$payment_type] = [];
        }
        $grouped_data_project[$payment_type][] = $row_project;

        // Summing up totals for summary
        $amount = (float)$row_project['amount']; // Ensure amount is treated as a float
        if ($payment_type === 'Invoice') {
            $invoice_total_project += $amount;
        } elseif ($payment_type === 'Cheque') {
            $cheque_total_project += $amount;
        } else {
            $cash_other_total_project += $amount;
        }
        $summary_grand_total_project += $amount;
    }

    // Set font for the table content
    //$pdf->SetFont('helvetica', '', 9);

    $content_project .= '<table style="width: 100%; font-size: 9px;" border="0.5" cellpadding="2">';

    foreach ($grouped_data_project as $payment_type => $group) {
        // Payment Type Header Row
        $content_project .= '<tr>';
        $content_project .= '<td colspan="6" style="background-color: #f2f2f2;"><strong>' . $payment_type;

        // Append phone numbers for M-Pesa types (if applicable)
        switch ($payment_type) {
            case 'M1':
                $content_project .= ' - 0714 776 325';
                break;
            case 'M2':
                $content_project .= ' - 0705 776 325';
                break;
        }
        $content_project .= ':</strong></td>';
        $content_project .= '</tr>';

        // Table Headers for the current group
        $content_project .= '<tr>';
        $content_project .= '<th style="width: 10%;"><strong>Project#</strong></th>';
        $content_project .= '<th style="width: 25%;"><strong>Customer Name</strong></th>';
        $content_project .= '<th style="width: 15%;"><strong>Paid Dt</strong></th>';
        $content_project .= '<th style="width: 15%;"><strong>Payment Code</strong></th>';
        $content_project .= '<th style="width: 15%;" align="right"><strong>Amount Paid</strong></th>';
        $content_project .= '<th style="width: 20%;"><strong>Payment Status</strong></th>';
        $content_project .= '</tr>';

        $group_subtotal_project = 0; // Initialize subtotal for the current payment type group

        foreach ($group as $row_project) {
            $content_project .= '<tr>';
            $content_project .= '<td>' . htmlspecialchars($row_project['project_id']) . '</td>';
            $content_project .= '<td>' . htmlspecialchars(truncateString($row_project['customer_name'], 20)) . '</td>';
            $content_project .= '<td>' . date('d-m', strtotime($row_project['payment_date'])) . '</td>';
            $content_project .= '<td>' . htmlspecialchars($row_project['payment_code']) . '</td>';
            $content_project .= '<td align="right">' . number_format((float)$row_project['amount'], 0) . '</td>'; // Format amount
            $content_project .= '<td>' . htmlspecialchars($row_project['part_final']) . '</td>';
            $content_project .= '</tr>';
            $group_subtotal_project += (float)$row_project['amount']; // Accumulate subtotal
        }

        // Display the subtotal for the current group
        $content_project .= '<tr>';
        $content_project .= '<td colspan="4" align="right"><strong>Sub-total: ' . $payment_type . '</strong></td>'; // Colspan adjusted
        $content_project .= '<td align="right"><strong>' . number_format($group_subtotal_project, 0) . '</strong></td>';
        //$content_project .= '<td></td>'; // Empty cell for payment status
        $content_project .= '</tr>';

        // Add a small spacing row after each group's subtotal
        $content_project .= '<tr><td colspan="6" style="height: 5px;"></td></tr>';
    }
    $content_project .= '</table>'; // Close the main details table

    // --- Summary Section for Project Payments ---
    $content_project .= '<h3>Summary:</h3>';
    $content_project .= '<table style="width: 50%; font-size: 10px;" border="0.5" cellpadding="2">';
    $content_project .= '<tr>';
    $content_project .= '<th style="width: 50%;">Payment Type</th>';
    $content_project .= '<th style="width: 50%;" align="right">Total Collected Amount</th>';
    $content_project .= '</tr>';

    // Display each payment type total in the summary
    foreach ($grouped_data_project as $payment_type => $group) {
        $group_paid_amount = array_sum(array_column($group, 'amount')); // Sum of amounts for this specific payment type
        $content_project .= '<tr>';
        $content_project .= '<td>' . htmlspecialchars($payment_type);
        // Append phone numbers for M-Pesa types in summary
        switch ($payment_type) {
            case 'M1':
                $content_project .= ' - 0714 776 325';
                break;
            case 'M2':
                $content_project .= ' - 0705 776 325';
                break;
        }
        $content_project .= '</td>';
        $content_project .= '<td align="right">' . number_format($group_paid_amount, 0) . '</td>';
        $content_project .= '</tr>';
    }

    // Display totals for specific categories (Cash/Other, Cheque, Invoice)
    /*$content_project .= '<tr>';
    $content_project .= '<td><strong>Total (Cash/Other):</strong></td>';
    $content_project .= '<td align="right"><strong>' . number_format($cash_other_total_project, 0) . '</strong></td>';
    $content_project .= '</tr>';

    $content_project .= '<tr>';
    $content_project .= '<td><strong>Total (Cheque):</strong></td>';
    $content_project .= '<td align="right"><strong>' . number_format($cheque_total_project, 0) . '</strong></td>';
    $content_project .= '</tr>';

    $content_project .= '<tr>';
    $content_project .= '<td><strong>Total (Invoice):</strong></td>';
    $content_project .= '<td align="right"><strong>' . number_format($invoice_total_project, 0) . '</strong></td>';
    $content_project .= '</tr>';*/

    // Grand Total for all project payments
    $content_project .= '<tr>';
    $content_project .= '<td><strong>Grand Total:</strong></td>';
    $content_project .= '<td align="right"><strong>' . number_format($summary_grand_total_project, 0) . '</strong></td>';
    $content_project .= '</tr>';
    $content_project .= '</table>';

    // Write the generated HTML content to the PDF
    $pdf->writeHTML($content_project, true, false, true, false, '');

} else {
    // Message if no records are found
    $pdf->writeHTML('<h2 style="text-align: center;">COLLECTION REPORT (PROJECT AND AMC)</h2><p style="text-align: center;">No records found for project payments in the selected date range.</p>', true, false, true, false, '');
}

// --- Output/Download/Upload PDF ---
if (isset($_GET['ACTION'])) {
    $action = $_GET['ACTION'];
    $file_name = "Project_AMC_Collection_Report_" . date('dmY_His') . ".pdf";

    switch ($action) {
        case 'VIEW':
            $pdf->Output($file_name, 'I'); // Display PDF in browser
            break;
        case 'DOWNLOAD':
            $pdf->Output($file_name, 'D'); // Download PDF
            break;
        case 'UPLOAD':
            $upload_dir = __DIR__ . "/uploads/reports/"; // Define upload directory
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
            }
            if ($pdf->Output($upload_dir . $file_name, 'F')) {
                echo "Upload successful! File saved to: " . htmlspecialchars($upload_dir . $file_name);
            } else {
                echo "Failed to upload PDF.";
            }
            break;
        default:
            echo 'Invalid ACTION parameter.';
            break;
    }
} else {
    // Default action if none specified (e.g., view in browser)
    $pdf->Output('Project_AMC_Collection_Report.pdf', 'I');
}

?>