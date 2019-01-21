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
$total_count = User::countAll();
// User Accounts pagination
$pagination = new Pagination($page, $total_count);
$users = User::paginateAll($pagination->offset());

// Retrieve errors & success messages from User class
if (!empty(User::$success)) $success = User::$success;
if (!empty(User::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
}