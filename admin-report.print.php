<?php
// Generate and print the PDF
include 'connect.php';
require_once('TCPDF/tcpdf.php');
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

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
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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
            <h1>WEBDEV-ELIBRARY</h1>
            <hr>
            <table>
                        <thead>
                            <tr>
                                <th>Book Name </th>
                                <th> Qty </th>
                                <th>Book Price</th>
                                <th>Total Price</th>
                            </tr>
                            <tr><th></th></tr>
                        </thead>
                    <tbody>';
include 'connect.php';

// Prepare and execute the SQL query
$sql = "SELECT * FROM transaction WHERE date_create BETWEEN ? AND ?";
$stmt = $con->prepare($sql);

// Bind parameters and execute
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die("Error: " . $stmt->error);
}

$result = $stmt->get_result();


while ($rows = mysqli_fetch_array($result)) {
    # code...
    $html .= '<tr>
                                        <td>' . $rows['invoice_id'] . '</td>
                                        <td>' . $rows['date_create'] . '</td>
                                        <td>' . $rows['total_price'] . '</td>
                                    </tr>';
    $subtotal += $rows['total_price'];
    $vat = ($subtotal / 100) * 12;
    $total = $subtotal + $vat;
    // $change = $payment-$total;

}


$html .= '
                    </tbody>
                    </table>
                    <hr>
                    <p>Sub Total: ' . $subtotal . '</p>
                    <p>VATax: ' . $vat . '</p>
                    <p>Total: ' . $total . '</p>
';

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// $pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTML($html);

$pdf->Output('usersreport	.pdf', 'I');