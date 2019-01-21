<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/examples/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

function fetch_data()
{
    $output = '';
    $reservations = Reservation::findAll();
    foreach ($reservations as $reservation) {
        $output .= "<tr>  
                          <td>{$reservation['full_name']}</td>  
                          <td>{$reservation['name']}</td>  
                          <td>{$reservation['building_no']}</td> 
                          <td>{$reservation['floor_no']}</td>  
                          <td>{$reservation['flat_no']}</td>  
                          <td>{$reservation['area']}</td>   
                     </tr>  
                          ";
    }
    return $output;
}

try {

    class MYPDF extends TCPDF
    {
        //Page header
        public function Header()
        {
            $this->setRTL(false);
            // Logo
            $image_file = K_PATH_IMAGES . 'logo_example.jpg';
            $this->Image($image_file, 20, 5, 35, 25, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('aealarabiya', 'B', 15);
            // Title
            $this->Cell(0, 0, 'الجمعية التعاونية للبناء والإسكان', 0, 1, 'R');
            $this->Cell(0, 0, 'للعاملين بالشركة', 0, 1, 'R');
            // set bacground image
            $this->SetAlpha(0.7);
            $img_file = K_PATH_IMAGES . 'watermark.jpg';
            $this->Image($img_file, 0, 120, 75, 75, '', '', 'C', false, 300, 'C', false, false, 0);
            $this->setRTL(true);
            $this->SetFont('aealarabiya', '', 18);
            $this->Cell(0, 12, 'تقرير حجز الوحدات', 0, 1, 'C');
        }

        // Page footer
        public function Footer()
        {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('aealarabiya', 'I', 8);
            // Page number
            $this->Cell(150, 10, 'الصفحة ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('طيبة ديف للبرمجيات');
    $pdf->SetTitle('تقرير حجز الوحدات');
    $pdf->SetSubject('تقرير حجز الوحدات لجمعية البناء و الإسكان للعاملين بالشركة');
    $pdf->SetKeywords('تقرير,حجز,وحدات,جمعية,طيبة,ديف,برمجيات');


    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language dependent data:
    $lg = Array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'ar';
    $lg['w_page'] = 'page';

    // set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);

    // add a page

    $pdf->AddPage('P');

    // set font
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->SetFont('aefurat', 'B', 12);


    $content = '';
    $content .= <<<EOF
    <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th width="30%" align="center" bgcolor="#d3d3d3">اسم العضو</th>
                    <th width="25%" align="center" bgcolor="#d3d3d3">اسم المشروع</th>
                    <th width="10%" align="center" bgcolor="#d3d3d3">المبنى</th>
                    <th width="10%" align="center" bgcolor="#d3d3d3">الدور</th>
                    <th width="10%" align="center" bgcolor="#d3d3d3">الشقة</th>
                    <th width="15%" align="center" bgcolor="#d3d3d3">مساحة الشقة</th>
                </tr>
EOF;
    $content .= fetch_data();
    $content .= '</table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output(__DIR__ . '/../reports/reserved-flats.pdf', 'F');
} catch (Exception $e) {
    $errors[] = $e->getMessage();
}