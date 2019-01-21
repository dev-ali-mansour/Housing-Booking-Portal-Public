<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

//Get users statistics
$users_count = User::countAll();
$active_users_count = User::countActive();
$inactive_users_count = User::countInactive();

// Get members statistics
$members_count = Member::countAll();
$founder_members_count = Member::countFounders();
$worker_members_count = Member::countWorkers();

// Get flat reservation statistics
$flats_count = Reservation::countAllFlats();
$reserved_flats_count = Reservation::countReservedFlats();
$unreserved_flats_count = Reservation::countUnReservedFlats();

// Get deposit statistics
$statistics = Deposit::getStatistics();
$total = $statistics['total'];
$pre = $statistics['pre'];
$monthly = $statistics['monthly'];
$quarterly = $statistics['quarterly'];
$semi_annual = $statistics['semi_annual'];
$annual = $statistics['annual'];
$contract = $statistics['contract'];
$allocation = $statistics['allocation'];
$receipt = $statistics['receipt'];

// Retrieve errors & success messages from User class
if (isset(User::$success)) $success = User::$success;
if (isset(User::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
}