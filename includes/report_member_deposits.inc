<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/examples/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

// Get member id from search form
if (!empty($_POST['member_id'])) {
    $statistics = Deposit::getMemberDepositsStatistics($_POST['member_id']);
    function fetch_deposits()
    {
        $output = '';
        $deposits = Deposit::findMemberDeposits($_POST['member_id']);
        foreach ($deposits as $deposit) {
            $output .= "<tr>
                          <td>{$deposit['id']}</td>  
                          <td>{$deposit['date']}</td>  
                          <td>{$deposit['bank_receipt_date']}</td>  
                          <td>{$deposit['bank_receipt_no']}</td>  
                          <td>{$deposit['total']}</td>  
                     </tr>  
                          ";
        }
        return $output;
    }
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
            $this->Cell(0, 0, 'تقرير إيداعات عضو بتاريخ '.date('Y-m-d'), 0, 1, 'C');

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
    $pdf->SetTitle('تقرير إيداعات عضو');
    $pdf->SetSubject('تقرير أعضاء جمعية البناء و الإسكان للعاملين بالشركة');
    $pdf->SetKeywords('تقرير,أعضاء,جمعية,طيبة,ديف,برمجيات');


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
    $pdf->SetFont('aefurat', '', 16);
    $pdf->Cell(0, 12, "اسم العضو: {$statistics['full_name']}", 0, 1, 'R');

    $pdf->SetFont('dejavusans', '', 10);
    if (!empty($_POST['member_id'])) {
        $content = '';
        $content .= <<<EOF
          <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th width="15%" align="center" bgcolor="#d3d3d3">رقم الإيصال</th>
                    <th width="15%" align="center" bgcolor="#d3d3d3">التاريخ</th>
                    <th width="15%" align="center" bgcolor="#d3d3d3">تاريخ إيداع البنك</th>
                    <th width="40%" align="center" bgcolor="#d3d3d3">رقم إيصال البنك</th>
                    <th width="15%" align="center" bgcolor="#d3d3d3">إجمالي المبلغ</th>
                </tr>
EOF;
        $content .= fetch_deposits($_POST['member_id']);
        $content .= '</table>';
        $pdf->writeHTML($content, true, false, true, false, '');
    }
    if (!empty($_POST['member_id'])) {
        $pdf->SetFont('dejavusans', '', 10);
        $stats .= <<<EOF
    
                <style>
                table 
                {
                    border-collapse:separate;
                    border-spacing:0 5px;
                }                    
                    </style>
                    <table cellpadding="6">
                <tr>
                    <td width="20%" align="center" bgcolor="#d3d3d3">دفعات مقدمة</td>
                    <th width="30%">{$statistics['pre']}</th>
                    <td width="20%" align="center" bgcolor="#d3d3d3">قسط شهري</td>
                    <th width="30%">{$statistics['monthly']}</th>
                </tr>
                                <tr>
                    <td width="20%" align="center" bgcolor="#d3d3d3">قسط ربع سنوي</td>
                    <th width="30%">{$statistics['quarterly']}</th>
                    <td width="20%" align="center" bgcolor="#d3d3d3">قسط نصف سنوي</td>
                    <th width="30%">{$statistics['semi_annual']}</th>
                </tr>
                <tr>
                    <td width="20%" align="center" bgcolor="#d3d3d3">قسط سنوي</td>
                    <th width="30%">{$statistics['annual']}</th>
                    <td width="20%" align="center" bgcolor="#d3d3d3">دفعة تعاقد</td>
                    <th width="30%">{$statistics['contract']}</th>
                </tr>
                <tr>
                     <td width="20%" align="center" bgcolor="#d3d3d3">دفعة تخصيص</td>
                    <th width="30%">{$statistics['allocation']}</th>
                    <td width="20%" align="center" bgcolor="#d3d3d3">دفعة استلام</td>
                    <th width="30%">{$statistics['receipt']}</th>
                </tr>
                <tr>
                    <td width="20%" align="center" bgcolor="#d3d3d3">إجمالي الإيداعات</td>
                    <th width="30%">{$statistics['total']}</th>
                </tr>
EOF;
        $stats .= '</table>';
        $pdf->writeHTML($stats, true, false, true, false, '');
    }

    $pdf->Output(__DIR__ . '/../reports/member-deposits.pdf', 'F');
} catch (Exception $e) {
    $errors[] = $e->getMessage();
}