<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve projects from database
$projects = Project::findAll();

// Add new member to database
if (isset($_POST['add'])) {
    $memberId = trim($_POST['member_id']);
    $projectId = trim($_POST['project_id']);
    $bankDate = $_POST['bank_date'];
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
    Deposit::add($memberId, $projectId, $bankDate, $bankNo, $pre, $monthly, $quarterly, $semi_annual, $annual, $contract, $allocation, $receipt, $total, $description);
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