<?php
include('config/constants.php');
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');

// Check if start_date and end_date are set
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Build the SQL query
    $pdf_query = "SELECT
        id,
        jc_create_date,
        customer_name,
        payment_date,
        payment_code,
        payment_type,
        amount, /* Removed FORMAT for raw calculation, will format in PHP */
        total_paid_amount,
        material_cost,
        fuel_cost,
        technician_cost
    FROM tbl_service_jc
    WHERE jc_conclude_date >= '$start_date' AND jc_conclude_date <= '$end_date'
    ORDER BY payment_type, customer_name"; // Changed order for better grouping

    // Execute the query
    $pdf_results = mysqli_query($conn, $pdf_query);

    // Check if records were found
    if ($pdf_results && mysqli_num_rows($pdf_results) > 0) { // Added check for $pdf_results
        // Create a new TCPDF instance
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont('helvetica');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetFont('helvetica', '', 10); // Adjusted base font size for better fit
        $pdf->AddPage(); // Default A4 size page

        // Create the content for the PDF
        $content = '<h2 style="text-align: center;">COLLECTION REPORT (SERVICE AND TRADING) - IWT</h2>';

        // Format and display the date range
        $formatted_start_date = date("d-m-Y", strtotime($start_date));
        $formatted_end_date = date("d-m-Y", strtotime($end_date));

        $content .= '<p style="text-align: center;">Report Date From: <strong>' . $formatted_start_date . '</strong>&nbsp;&nbsp;&nbsp;To: <strong>' . $formatted_end_date . '</strong></p>';

        $summary_total_paid_amount = 0;
        $summary_material_cost = 0;
        $summary_fuel_cost = 0;
        $summary_technician_cost = 0;

        $grouped_data = [];
        $invoice_total = 0;
        $cheque_total = 0;
        $cash_total = 0; // Initialize cash total

        while ($row = mysqli_fetch_array($pdf_results, MYSQLI_ASSOC)) {
            $payment_type = $row['payment_type'];

            if (!isset($grouped_data[$payment_type])) {
                $grouped_data[$payment_type] = [];
            }
            $grouped_data[$payment_type][] = $row;

            // Calculate separate totals
            if ($payment_type === 'Invoice') {
                $invoice_total += $row['total_paid_amount'];
            } elseif ($payment_type === 'Cheque') {
                $cheque_total += $row['total_paid_amount'];
            } else {
                $cash_total += $row['total_paid_amount']; // Summing up other payment types as 'Cash' group
            }
        }

        // Define a function to truncate a string if it doesn't exist
        if (!function_exists('truncateString')) {
            function truncateString($string, $maxLength) {
                if (strlen($string) > $maxLength) {
                    $string = substr($string, 0, $maxLength) . '...'; // Added ellipsis
                }
                return $string;
            }
        }

        // Create the content for the PDF with adjusted font size
        $content .= '<table style="width: 100%; font-size: 9px;" border="0.5" cellpadding="2">';

        foreach ($grouped_data as $payment_type => $group) {
            $content .= '<tr>';
            // Increased colspan for the payment type header
            $content .= '<td colspan="10" style="background-color: #f2f2f2;"><strong>' . $payment_type;

            // Append phone numbers based on payment_type
            switch ($payment_type) {
                case 'M1':
                    $content .= ' - 0714 776 325';
                    break;
                case 'M2':
                    $content .= ' - 0705 776 325';
                    break;
                // Add more cases for other payment_type values if needed
            }
            $content .= ':</strong></td>';
            $content .= '</tr>'; // Removed <br/> here as it's not valid inside <tr>

            $content .= '<tr>';
            $content .= '<th style="width: 7%;"><strong>JC#</strong></th>'; // Adjusted width
            $content .= '<th style="width: 8%;"><strong>JC Dt</strong></th>'; // Adjusted width
            $content .= '<th style="width: 20%;"><strong>Customer Name</strong></th>';
            $content .= '<th style="width: 8%;"><strong>Paid Dt</strong></th>'; // Adjusted width
            $content .= '<th style="width: 10%;"><strong>Payment Code</strong></th>';
            $content .= '<th style="width: 10%;" align="right"><strong>Amount Agreed</strong></th>';
            $content .= '<th style="width: 10%;" align="right"><strong>Amount Paid</strong></th>';
            $content .= '<th style="width: 9%;" align="right"><strong>Material Cost</strong></th>'; // Adjusted width
            $content .= '<th style="width: 9%;" align="right"><strong>Fuel Cost</strong></th>'; // Adjusted width
            $content .= '<th style="width: 9%;" align="right"><strong>Technician Cost</strong></th>'; // Adjusted width
            $content .= '</tr>';

            $group_total_paid_amount = 0;
            $group_material_cost = 0;
            $group_fuel_cost = 0;
            $group_technician_cost = 0;

            foreach ($group as $row) {
                $content .= '<tr>';
                $content .= '<td>' . $row['id'] . '</td>';
                $content .= '<td>' . date('d-m', strtotime($row['jc_create_date'])) . '</td>';
                $content .= '<td style="width: 20%;">' . htmlspecialchars(truncateString($row['customer_name'], 18)) . '</td>';
                $content .= '<td>' . date('d-m', strtotime($row['payment_date'])) . '</td>';
                $content .= '<td>' . $row['payment_code'] . '</td>';
                $content .= '<td align="right">' . number_format((float)$row['amount'], 0) . '</td>'; // Formatted here
                $content .= '<td align="right">' . number_format($row['total_paid_amount'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['material_cost'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['fuel_cost'], 0) . '</td>';
                $content .= '<td align="right">' . number_format($row['technician_cost'], 0) . '</td>';
                $content .= '</tr>';

                // Update the group totals
                $group_total_paid_amount += $row['total_paid_amount'];
                $group_material_cost += $row['material_cost'];
                $group_fuel_cost += $row['fuel_cost'];
                $group_technician_cost += $row['technician_cost'];
            }

            // Display the subtotal for the current group
            $content .= '<tr>';
            $content .= '<td colspan="6" align="right"><strong>Sub-total: ' . $payment_type . '</strong></td>'; // Added payment type to subtotal
            $content .= '<td align="right"><strong>' . number_format($group_total_paid_amount, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_material_cost, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_fuel_cost, 0) . '</strong></td>';
            $content .= '<td align="right"><strong>' . number_format($group_technician_cost, 0) . '</strong></td>';
            $content .= '</tr>';

            // Add a new row with a line break to create spacing between groups
            $content .= '<tr><td colspan="10" style="height: 5px;"></td></tr>'; // Using height for spacing

            // Update the overall summary total
            $summary_total_paid_amount += $group_total_paid_amount;
            $summary_material_cost += $group_material_cost;
            $summary_fuel_cost += $group_fuel_cost;
            $summary_technician_cost += $group_technician_cost;
        }

        // Summary section showing group types with their subtotals
        $content .= '</table>'; // Close the main table before the summary table

        $content .= '<h4>Summary:</h4>';
        $content .= '<table style="width: 60%; font-size: 10px;" border="0.5" cellpadding="2">'; // Adjusted width for summary table
        $content .= '<tr>';
        $content .= '<th style="width: 25%;"><strong>Payment Type</strong></th>';
        $content .= '<th style="width: 15%;" align="right"><strong>Amount Paid</strong></th>';
        $content .= '<th style="width: 15%;" align="right"><strong>Material Cost</strong></th>';
        $content .= '<th style="width: 15%;" align="right"><strong>Fuel Cost</strong></th>';
        $content .= '<th style="width: 20%;" align="right"><strong>Technician Cost</strong></th>';
        $content .= '</tr>';

        // Display individual payment type totals in summary
        if (!empty($grouped_data['Cash'])) {
            $content .= '<tr>';
            $content .= '<td>Cash</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cash'], 'total_paid_amount')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cash'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cash'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cash'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }
        if (!empty($grouped_data['M1'])) {
            $content .= '<tr>';
            $content .= '<td>M-Pesa (M1)</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M1'], 'total_paid_amount')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M1'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M1'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M1'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }
        if (!empty($grouped_data['M2'])) {
            $content .= '<tr>';
            $content .= '<td>M-Pesa (M2)</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M2'], 'total_paid_amount')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M2'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M2'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['M2'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }
        if (!empty($grouped_data['Till'])) {
            $content .= '<tr>';
            $content .= '<td>Till</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Till'], 'total_paid_amount')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Till'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Till'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Till'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }
        if (!empty($grouped_data['Cheque'])) {
            $content .= '<tr>';
            $content .= '<td>Cheque</td>';
            $content .= '<td align="right">' . number_format($cheque_total, 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cheque'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cheque'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Cheque'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }
        if (!empty($grouped_data['Invoice'])) {
            $content .= '<tr>';
            $content .= '<td>Invoice</td>';
            $content .= '<td align="right">' . number_format($invoice_total, 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Invoice'], 'material_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Invoice'], 'fuel_cost')), 0) . '</td>';
            $content .= '<td align="right">' . number_format(array_sum(array_column($grouped_data['Invoice'], 'technician_cost')), 0) . '</td>';
            $content .= '</tr>';
        }

        // Grand totals for all categories
        $content .= '<tr>';
        $content .= '<td><strong>Grand Total:</strong></td>';
        $content .= '<td align="right"><strong>' . number_format($summary_total_paid_amount, 0) . '</strong></td>';
        $content .= '<td align="right"><strong>' . number_format($summary_material_cost, 0) . '</strong></td>';
        $content .= '<td align="right"><strong>' . number_format($summary_fuel_cost, 0) . '</strong></td>';
        $content .= '<td align="right"><strong>' . number_format($summary_technician_cost, 0) . '</strong></td>';
        $content .= '</tr>';
        $content .= '</table>';

        // Add the content to the PDF
        $pdf->writeHTML($content, true, false, true, false, '');

        // Output or download the PDF
        if (isset($_GET['ACTION'])) {
            if ($_GET['ACTION'] == 'VIEW') {
                $pdf->Output('CollectionReport.pdf', 'I'); // Display the PDF
            } elseif ($_GET['ACTION'] == 'DOWNLOAD') {
                $pdf->Output('CollectionReport.pdf', 'D'); // Download the PDF
            } elseif ($_GET['ACTION'] == 'UPLOAD') {
                // Save the PDF to a folder and display a success message
                $file_location = "./uploads/reports/"; // Recommended path, ensure it exists and is writable
                if (!is_dir($file_location)) {
                    mkdir($file_location, 0777, true); // Create directory if it doesn't exist
                }
                $file_name = "CollectionReport_" . date('dmY_His') . ".pdf";
                if ($pdf->Output($file_location . $file_name, 'F')) {
                    echo "Upload successful! File saved as: " . $file_name;
                } else {
                    echo "Failed to upload PDF.";
                }
            } else {
                echo 'Invalid ACTION parameter.';
            }
        } else {
            echo 'ACTION parameter is missing.';
        }
    } else {
        echo '<h2 style="text-align: center;">COLLECTION REPORT (SERVICE AND TRADING) - IWT</h2><p style="text-align: center;">No records found for the selected date range.</p>';
        // Optional: Log the mysqli_error for debugging
        // echo '<br>MySQLi Error: ' . mysqli_error($conn);
    }
} else {
    echo 'Start date and end date are required.';
}
?>