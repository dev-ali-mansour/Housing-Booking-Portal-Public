<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Add new member to database
if (isset($_POST["add"])) {
    $fullName = trim($_POST["full_name"]);
    $nationalId = trim($_POST["national_id"]);
    $membership = trim($_POST["membership"]);
    $telephone = trim($_POST['telephone']);
    $notes = trim($_POST["notes"]);
    Member::add($fullName, $nationalId, $membership, $telephone, $notes);
}

// Retrieve errors & success messages from Member class
if (!empty(Member::$success)) $success = Member::$success;
if (!empty(Member::$errors)) {
    foreach (Member::$errors as $error) {
        $errors[] = $error;
    }
}