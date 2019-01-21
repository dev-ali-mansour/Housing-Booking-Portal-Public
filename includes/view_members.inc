<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// Count all user accounts
$total_count = Member::countAll();
// User Accounts pagination
$pagination = new Pagination($page, $total_count);

if (isset($_POST['search_id'])) {
    if (!empty($_POST['member_id'])) {
        $id = trim($_POST['member_id']);
        $members = Member::findById($id);
    } else {
        $errors[] = "عفواً لم يتم إدخال رقم العضوية !<br>&nbsp;&nbsp;سيتم عرض بيانات جميع الأعضاء";
        $members = Member::paginateAll($pagination->offset());
    }

} elseif (isset($_POST['search_name'])) {
    if (!empty($_POST['member_name'])) {
        $memberName = trim($_POST['member_name']);
        $members = Member::findByFullName($memberName);
    } else {
        $errors[] = "عفواً لم يتم إدخال اسم العضو !<br>&nbsp;&nbsp;سيتم عرض بيانات جميع الأعضاء";
        $members = Member::paginateAll($pagination->offset());
    }
}else{
    // View all members
    $members = Member::paginateAll($pagination->offset());
    if (isset($_POST['report'])) {
        die('report');
    }elseif (isset($_POST['update'])) {
        die('report');
    }elseif (isset($_POST['delete'])) {
        die('report');
    }
}
// Retrieve errors & success messages from Member class
if (!empty(Member::$success)) $success = Member::$success;
if (!empty(Member::$errors)) {
    foreach (Member::$errors as $error) {
        $errors[] = $error;
    }
}