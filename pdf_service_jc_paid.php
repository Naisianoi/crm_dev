<?php
    include('config/constants.php');
    include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');
    
    

    $MST_ID = $_GET['id'];

    //$pdf_query = "SELECT tbl_brand.id, tbl_brand.business, tbl_brand.brand FROM tbl_brand WHERE tbl_brand.id = '".$MST_ID."' ";
    $pdf_query = "SELECT id, jc_create_date, jc_assigned_to, business, commerce, jc_lead_by, jc_type, customer_type, company_name, customer_name, address, 
    area, county, city, contact_name_1, contact_name_2, contact_number_1, contact_number_2, sales_agent, product_name, brand, last_jc_number, last_jc_date, 
    last_assigned_to, last_jc_type, work_statement, customer_word, amount, work_done_date, job_finding, flow_pure, flow_reject, work_satisfactory, client_sign, jc_conclude_date,
    payment_type, payment_code, payment_date, total_paid_amount FROM tbl_service_jc WHERE id = $MST_ID ";
    $pdf_results = mysqli_query($conn, $pdf_query);

    $count = mysqli_num_rows($pdf_results);

    if($count>0){
        $pdf_data_row = mysqli_fetch_array($pdf_results, MYSQLI_ASSOC);

        //----- Code for generate pdf
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
        $pdf->AddPage(); //default A4
        //$pdf->AddPage('P','A5'); //when you require custome page size 
	
        $content = ''; 

        // $content .= '
        // <style type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">';   
        // $content .= '<style type="text/css">
        // @import url("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
        // </style>';


        

        // Begin adding your form elements to the PDF content
        $content .= 

            '<style>
            .address, {
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

                <td style="color: #0D6EFD;">
                
                <span style="color: red; font-weight: bold; text-align: center;">
                    
                 <strong>' . $pdf_data_row['payment_type'] . '</strong> / <strong>' . $pdf_data_row['payment_code'] . '</strong> / <strong>' . $pdf_data_row['total_paid_amount'] . '</strong>
                </span>
                
                    <h3>SERVICE JOB CARD</h3>
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

            $content .= 
            '<table>
            <tbody>
            <tr class="data">
               <td><strong>JOB CARD #: </strong> '.$pdf_data_row['id'].'</td>
               <td><strong>JC Date:</strong> '.$pdf_data_row['jc_create_date'].'</td>
               <td><strong>Assigned To:</strong> '.$pdf_data_row['jc_assigned_to'].'</td>
		    </tr>

            <tr class="data">
               <td><strong style="color: #0D6EFD;">Business: </strong> '.$pdf_data_row['business'].'</td>
               <td><strong style="color: #0D6EFD;">Commerce:</strong> '.$pdf_data_row['commerce'].'</td>
               <td><strong style="color: #0D6EFD;">Lead By:</strong> '.$pdf_data_row['jc_lead_by'].'</td>
		    </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            
            </tbody>
            </table>';
           
            $content .= 
            '<table>
            <tbody>
            <tr class="data">
               <td><strong style="color: #0D6EFD;">CUSTOMER DETAILS: </strong></td>
               <td></td>
               <td><strong>Customer Type:</strong> '.$pdf_data_row['customer_type'].'</td>
		    </tr>

            <tr class="data">
                <td><strong>Name:</strong> '.$pdf_data_row['customer_name'].'</td>
                
                
            </tr>

            <tr class="data">
                <td colspan="3"><strong>Address:</strong> '.$pdf_data_row['address'].'</td>
            </tr>

            <tr class="data">
                <td><strong>Area:</strong> '.$pdf_data_row['area'].'</td>
                <td><strong>County:</strong> '.$pdf_data_row['county'].'</td>
                <td><strong>City:</strong> '.$pdf_data_row['city'].'</td>
            </tr>

            <tr class="data">
                <td><strong>Contact:</td>
            </tr>

            <tr class="data">
                <td><strong>Person 1:</strong> '.$pdf_data_row['contact_name_1'].'</td>
                <td><strong>Contact No.1:</strong> '.$pdf_data_row['contact_number_1'].'</td>
                <td><strong>Company Name:</strong> '.$pdf_data_row['company_name'].'</td>
            </tr>

            <tr class="data">
                <td><strong>Person 2:</strong> '.$pdf_data_row['contact_name_2'].'</td>
                <td><strong>Contact No.2:</strong> '.$pdf_data_row['contact_number_2'].'</td>
                <td><strong>Sales Agent:</strong> '.$pdf_data_row['sales_agent'].'</td>
            </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
               <td><strong style="color: #0D6EFD;">PRODUCT DETAILS: </strong></td>
		    </tr>

            <tr class="data">
                <td colspan="2"><strong style="color: #0D6EFD;">Product:</strong> '.$pdf_data_row['product_name'].'</td>
                <td><strong style="color: #0D6EFD;">Brand:</strong> '.$pdf_data_row['brand'].'</td>
            </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
               <td><strong style="color: #0D6EFD;">JOB DETAILS: </strong></td>
               <td><strong style="color: #0D6EFD;">Job Type:</strong> '.$pdf_data_row['jc_type'].'</td>
               <td><strong style="color: #0D6EFD;">Last JC Type:</strong> '.$pdf_data_row['last_jc_type'].'</td>
           </tr>

            <tr class="data">
               <td><strong style="color: #0D6EFD;">Last JC No: </strong>'.$pdf_data_row['last_jc_number'].'</td>
               <td><strong style="color: #0D6EFD;">Last JC Date: </strong>'.$pdf_data_row['last_jc_date'].'</td>
               <td><strong style="color: #0D6EFD;">Last Assigned:</strong>'.$pdf_data_row['last_assigned_to'].'</td>
		    </tr>

            <tr class="data">
               <td colspan="8"><strong>Work Statement:</strong> '.$pdf_data_row['work_statement'].'</td>
     
		    </tr><br/>

            <tr class="data">
               <td colspan="8"><strong>Extra Word/ Request By Client:</strong> '.$pdf_data_row['customer_word'].'</td>
     
		    </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
                <td colspan="4"><strong style="color: #0D6EFD;">To be filled by Technician:</strong> Work Done Date: <strong>'.$pdf_data_row['work_done_date'].'</strong> Time Started:______Time Completed:_______</td>
                
            </tr>

            <tr class="data">
                <td colspan="8">Job Description / Findings:</td>
                <strong>'.$pdf_data_row['job_finding'].'</strong>
            </tr><br/><br/><br/><br/><br/><br/>

            <tr class="data">
               <td colspan="2">Flow of Water (500ml): <strong style="color: #0D6EFD;">Pure Water:</strong> <strong>'.$pdf_data_row['flow_pure'].'</strong>Sec. </td>
               <td colspan="1"><strong style="color: #0D6EFD;">Reject Water:</strong> <strong>'.$pdf_data_row['flow_reject'].'</strong>Sec. </td>
               
            </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
                <td colspan="2"><strong style="color: #0D6EFD;">PAYMENTS:</strong></td>
                <td colspan="1"><strong style="color: #0D6EFD;">Amount Agreed:</strong> <strong>KES '.$pdf_data_row['amount'].'</strong></td>
                
            </tr>

            <tr class="data">
              <td colspan="4" style="border-bottom: 0.02px dotted #222;"></td>
            </tr><br/>

            <tr class="data">
                <td colspan="2"><strong style="color: #0D6EFD;">CUSTOMER CARE:</strong></td>
                
            </tr>

            <tr class="data">
                <td colspan="8"><strong>Client Comments:</strong>___________________________________________________________________________</td>
                
                
            </tr>

            <tr class="data">
              <td colspan="4">__________________________________________________________________________________________</td>
            </tr><br/>


            <tr class="data">
        
            <td>Work done satisfactorily? <strong>'.$pdf_data_row['work_satisfactory'].'</strong></td>
              
            </tr><br/>

            <tr class="data">
                <td colspan="2">Client Sign: <strong>'.$pdf_data_row['client_sign'].'</strong></td>
                <td>Date: <strong>'.$pdf_data_row['jc_conclude_date'].'</strong></td>
            </tr>

            <tr class="data">
                <td colspan="2">Rate Our Services:(1 to 10) _____</td>
            </tr>

            <tr class="data">
                <td colspan="4" align="center"><strong>BUYS GOODS TILL NUMBER: 9609519</strong></td>
            </tr>

            
            

            




            



           
		
           
            </tbody>
            </table>';
   
        
         
    $pdf->writeHTML($content);

    //$file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
    //$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

    $datetime=date('dmY_hms');
    $file_name = "ServiceJC_".rand(0000,9999).".pdf";
    ob_end_clean();

    if($_GET['ACTION']=='VIEW') 
    {
        $pdf->Output($file_name, 'I'); // I means Inline view
    } 
    else if($_GET['ACTION']=='DOWNLOAD')
    {
        $pdf->Output($file_name, 'D'); // D means download
    }
    else if($_GET['ACTION']=='UPLOAD')
    {
    $pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
    echo "Upload successfully!!";
    }

  //----- End Code for generate pdf
	
}
else
{
	echo 'Record not found for PDF.';
}


    


?>