<?php
    include "connect.php";
    require_once('TCPDF/tcpdf.php');
$subtotal = 0;
    $vat = 0;
    $total = 0;
    $change = 0;

// create new PDF document
    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //page orientation p for portrait and l for landscape
    //pdf unit mm for milimeter
    //page format sizes like A4, legal
    //tcpdf class is default kung gagamit ng header and footer need gumawa ng bagong class, use the class tapos extends si tcpdf
    $pdf = new TCPDF('p', PDF_UNIT, 'A6', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Name');
    $pdf->SetTitle('Reciept');
    // $pdf->SetSubject('');
    // $pdf->SetKeywords('');
    //this is optional kung gagamit ng header or footer
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    //default font
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    //margin ng page(left, top, right)
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    //optional if isasama sila header at footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    //matic na adding ng page if ma reach yung sinet na footer margin
    $pdf->SetAutoPageBreak(TRUE, 10);
    //font ng buong page (font theme, font style, font size)
    $pdf->SetFont('helvetica', 'BI', 9);
    //eto yung pag add ng page./no of page
    $pdf->AddPage();
    //dito yung mismong code
    $html = '
            <h1>Name</h1>
            <hr>
            <table>
                        <thead>
                            <tr>
                                <th>id </th>
                                <th> invoice_id </th>
                                <th> Total Price</th>
                                <th>Date Create</th>
                            </tr>
                            <tr><th></th></tr>
                        </thead>
                    <tbody>';
                            include 'connect.php';
                                $sql1 = "SELECT * FROM transaction";
                                $result=mysqli_query($con, $sql1);
                                while ($rows = mysqli_fetch_assoc($result)) {
                                        # code...
                                    $html .='<tr>
                                        <td>'.$rows['id'].'</td>
                                        <td>'.$rows['invoice_id'].'</td>
                                        <td>'.$rows['total_price'].'</td>
                                        <td>'.$rows['date_create'].'</td>
                                    </tr>';
                                    
                                }
                            

                $html .='
                    </tbody>
                    </table>
                    
';

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->writeHTML($html);

    $pdf->Output('usersreport	.pdf', 'I');


?>