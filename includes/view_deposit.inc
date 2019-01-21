<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/examples/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

// Get deposit id from search form
if (!empty($_POST['deposit_id'])) {
    $id = $_POST['deposit_id'];
}

// Get deposit id from session variable after adding new deposit to database
if (!empty($_SESSION['deposit_id'])) {
    $id = $_SESSION['deposit_id'];
    unset($_SESSION['deposit_id']);
}

// Get deposit data from database
if (!empty($id)) {
    $deposit = Deposit::viewById($id);
    $memberId = $deposit['member_id'];
    $projectId = $deposit['project_name'];
    $fullName = $deposit['full_name'];
    $depositDate = $deposit['date'];
    $bankReceiptDate = $deposit['bank_receipt_date'];
    $bankReceiptNo = $deposit['bank_receipt_no'];
    $pre = $deposit['pre'];
    $monthly = $deposit['monthly'];
    $quarterly = $deposit['quarterly'];
    $semiAnnual = $deposit['semi_annual'];
    $annual = $deposit['annual'];
    $contract = $deposit['contract'];
    $allocation = $deposit['allocation'];
    $receipt = $deposit['receipt'];
    $total = $deposit['total'];
    $description = $deposit['description'];
} else {
    header("Location:view-deposits.php");
}

class DepositPDF extends TCPDF
{
    // Page header
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
//        $this->SetAlpha(0.7);
        $img_file = K_PATH_IMAGES . 'watermark.jpg';
        $this->Image($img_file, 70, 45, 75, 75, '', '', 'C', false, 300, '', false, false, 0);
    }

    // Convert Western numbers to eastern numbers
    function arabic_w2e($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_western, $arabic_eastern, $str);
    }
}

try {
    // create new PDF document
    $pdf = new DepositPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Translate western digits to eastern ones
    if (isset($memberId)) $memberId = $pdf->arabic_w2e($memberId);
    if (isset($fullName)) $fullName = $pdf->arabic_w2e($fullName);
    if (isset($depositDate)) $depositDate = $pdf->arabic_w2e($depositDate);
    if (isset($bankReceiptDate)) $bankReceiptDate = $pdf->arabic_w2e($bankReceiptDate);
    if (isset($bankReceiptNo)) $bankReceiptNo = $pdf->arabic_w2e($bankReceiptNo);
//    if (isset($pre)) $pre = $pdf->arabic_w2e($pre);
//    if (isset($monthly)) $monthly = $pdf->arabic_w2e($monthly);
//    if (isset($quarterly)) $quarterly = $pdf->arabic_w2e($quarterly);
//    if (isset($semiAnnual)) $semiAnnual = $pdf->arabic_w2e($semiAnnual);
//    if (isset($annual)) $annual = $pdf->arabic_w2e($annual);
//    if (isset($contract)) $contract = $pdf->arabic_w2e($contract);
//    if (isset($receipt)) $receipt = $pdf->arabic_w2e($receipt);
//    if (isset($total)) $total = $pdf->arabic_w2e($total);
//    if (isset($description)) $description = $pdf->arabic_w2e($description);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('طيبة ديف للبرمجيات');
    $pdf->SetTitle('إيصال إيداع نقدي');
    $pdf->SetSubject('إيصال إيداع نقدي لصالح جمعية البناء و الإسكان للعاملين بالشركة');
    $pdf->SetKeywords('إيصال,إيداع,نقدي,جمعية,طيبة,ديف,برمجيات');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->setPrintFooter(false);
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

    $pdf->AddPage('P');
    $pdf->setRTL(true);
    $pdf->SetFont('aealarabiya', 'B', 16);

    // set bill title
    if (isset($id)) $id = $pdf->arabic_w2e($id);
    $billTitle = isset($id) ? "<h3><B>إيصال دفع رقم (&nbsp;$id&nbsp;)</B></h3>" : null;
    $pdf->writeHTML($billTitle, 1, 1, 1, 1, 'C');

    // set font
    $pdf->SetFont('aefurat', 'B', 12);

    $html = '';
    if (isset($depositDate) && isset($memberId) && isset($fullName) && isset($bankReceiptDate) && isset($bankReceiptNo) && isset($description) && isset($pre) && isset($monthly) && isset($quarterly) && isset($semiAnnual) && isset($annual) && isset($contract) && isset($allocation) && isset($receipt) && isset($total)) {
        $html .= <<<EOF
                    <style>
                    table 
                    {
                        border-collapse:separate;
                        border-spacing:0 5px;
                    }                    
                    </style>
                    <table cellpadding="6">
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">اسم المشروع</td>
                    <td width="40%">&nbsp;$projectId</td>
                    <td width="15%" align="center" bgcolor="#DDDDDD">دفعة مقدمة</td>
                    <td width="18%">&nbsp;$pre</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">التاريخ</td>
                    <td width="40%">&nbsp;$depositDate</td>
                    <td width="15%" align="center" bgcolor="#DDDDDD">قسط شهري</td>
                    <td width="18%">&nbsp;$monthly</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">رقم العضوية</td>
                    <td width="40%">&nbsp;$memberId</td>
                    <td width="15%" align="center" bgcolor="#DDDDDD">ربع سنوي</td>
                    <td width="18%">&nbsp;$quarterly</td>                    
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">اسم الزميل</td>
                    <td width="40%">&nbsp;$fullName</td>
                    <td width="15%"  align="center" bgcolor="#DDDDDD">نصف سنوي</td>
                    <td width="18%">&nbsp;$semiAnnual</td>                    
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">تاريخ إيصال البنك </td>
                    <td width="40%">&nbsp;$bankReceiptDate</td>
                    <td width="15%"  align="center" bgcolor="#DDDDDD">سنوي</td>
                    <td width="18%">&nbsp;$annual</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">رقم إيصال البنك</td>
                    <td width="40%">&nbsp;$bankReceiptNo</td>
                    <td width="15%" align="center" bgcolor="#DDDDDD">دفعة تعاقد</td>
                    <td width="18%">&nbsp;$contract</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="20%" align="center" bgcolor="#DDDDDD">البيان</td>
                    <td width="40%" rowspan="2">$description</td>
                    <td width="15%"  align="center" valign="" bgcolor="#DDDDDD">دفعة تخصيص</td>
                    <td width="18%">&nbsp;$allocation</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="60%"></td>                    
                    <td width="15%"  align="center" valign="" bgcolor="#DDDDDD">دفعة استلام</td>
                    <td width="18%">&nbsp;$receipt</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <tr>
                    <td width="30%" align="center">أمين الصندوق</td>
                    <td width="30%" align="center">رئيس الجمعية</td>
                    <td width="15%"  align="center" bgcolor="#DDDDDD">الإجمالي</td>
                    <td width="18%">&nbsp;$total</td>
                    <td width="7%">جنيهاً</td>
                    </tr>
                    <br>
                    <tr>
                    <td width="30%" align="center"> </td>
                    <td width="30%" align="center"> </td>
                    <td width="4%"></td>
                    </tr> 
                    </table>
EOF;
        $pdf->writeHTML($html, true, false, true, false, 'R');
    }

    $pdf->Output(__DIR__ . '/../reports/deposit.pdf', 'F');

} catch
(Exception $e) {
    $errors[] = $e->getMessage();
}