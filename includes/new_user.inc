<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve user groups from database
$user_groups = UsersGroup::findAll();

// Add new user to database
if (isset($_POST["add"])) {
    $full_name = trim($_POST["full_name"]);
    $user_name = trim($_POST["user_name"]);
    $password = trim($_POST["password"]);
    $email = trim($_POST['email']);
    $group = trim($_POST["user_group"]);
    $is_disabled = isset($_POST["is_disabled"]);
    $notes = trim($_POST["notes"]);
    User::add($full_name, $user_name, $password, $email, $group, $is_disabled, $notes);
}

// Retrieve errors & success messages from User & UsersGroup classes
if (!empty(User::$success)) $success = User::$success;
if (isset(UsersGroup::$success)) $success = UsersGroup::$success;
if (!empty(User::$errors) || !empty(UsersGroup::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
    foreach (UsersGroup::$errors as $error) {
        $errors[] = $error;
    }
}