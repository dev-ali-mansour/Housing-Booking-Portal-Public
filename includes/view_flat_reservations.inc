<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

require_once '../models/Reservation.php';

// Get current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// Count all deposits
$total_count = Reservation::countAll();
// User Accounts pagination
$pagination = new Pagination($page, $total_count);
$reservations = Reservation::paginateAll($pagination->offset());

// Retrieve errors & success messages from Member class
if (!empty(Reservation::$success)) $success = Reservation::$success;
if (!empty(Reservation::$errors)) {
    foreach (Deposit::$errors as $error) {
        $errors[] = $error;
    }
}