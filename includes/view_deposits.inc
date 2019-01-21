<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// Count all deposits
$total_count = Deposit::countAll();
// User Accounts pagination
$pagination = new Pagination($page, $total_count);
$deposits = Deposit::paginateAll($pagination->offset());

// Retrieve errors & success messages from Member class
if (!empty(Deposit::$success)) $success = Deposit::$success;
if (!empty(Deposit::$errors)) {
    foreach (Deposit::$errors as $error) {
        $errors[] = $error;
    }
}