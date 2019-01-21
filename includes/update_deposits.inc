<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve projects from database
$projects = Project::findAll();

if (!empty($_GET['id'])) {
    // Get current deposit details
    $currentDeposit = Deposit::findById($_GET['id']);
    $memberId = $currentDeposit['member_id'];
    $projectId = $currentDeposit['project_id'];
    $time = strtotime($currentDeposit['bank_receipt_date']);
    $bankDate = date("m/d/Y", $time);
    $bankNo = $currentDeposit['bank_receipt_no'];
    $pre = $currentDeposit['pre'];
    $monthly = $currentDeposit['monthly'];
    $quarterly = $currentDeposit['quarterly'];
    $semi_annual = $currentDeposit['semi_annual'];
    $annual = $currentDeposit['annual'];
    $contract = $currentDeposit['contract'];
    $allocation = $currentDeposit['allocation'];
    $receipt = $currentDeposit['receipt'];
    $total = $currentDeposit['total'];
    $description = $currentDeposit['description'];
} else {
    // Redirect toe view deposits page
    echo '<script>location = vview-deposits.php</script>';
}
// Update existing member data on database
if (isset($_POST['update'])) {
    $id = (int)$_GET['id'];
    $memberId = trim($_POST['member_id']);
    $projectId = trim($_POST['project_id']);
    $bankDate = $_POST['bank_date'];
    $time = strtotime($_POST['bank_date']);
    $bankDate = date("Y-m-d", $time);
    $bankNo = trim($_POST['bank_no']);
    $pre = trim($_POST['pre']);
    $monthly = trim($_POST['monthly']);
    $quarterly = trim($_POST['quarterly']);
    $semi_annual = trim($_POST['semi_annual']);
    $annual = trim($_POST['annual']);
    $contract = trim($_POST['contract']);
    $allocation = trim($_POST['allocation']);
    $receipt = trim($_POST['receipt']);
    $total = trim($_POST['total']);
    $description = trim($_POST['description']);
    Deposit::update($id, $memberId, $projectId, $bankDate, $bankNo, $pre, $monthly, $quarterly, $semi_annual, $annual, $contract, $allocation, $receipt, $total, $description);
}

// Retrieve errors & success messages from Member & Deposit classes
if (!empty(Deposit::$success)) $success = Deposit::$success;
if (!empty(Deposit::$errors) || isset(Member::$errors)) {
    foreach (Deposit::$errors as $error) {
        $errors[] = $error;
    }
    foreach (Member::$errors as $error) {
        $errors[] = $error;
    }
}
?>