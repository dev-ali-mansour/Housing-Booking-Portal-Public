<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve user groups from database
$user_groups = UsersGroup::findAll();

//Get current user details
if (!empty($_GET['id'])) {
    $currentUser = User::findById($_GET['id']);
    $fullName = $currentUser['full_name'];
    $userName = $currentUser['user_name'];
    $userPass = $currentUser['user_pass'];
    $email = $currentUser['email'];
    $groupId = $currentUser['group_id'];
    $isDisabled = $currentUser['is_disabled'];
    $notes = $currentUser['notes'];
} else {
    // Redirect toe view users page
    echo '<script>location = view-users.php;</script>';
}

//Update user details
if (isset($_POST['update'])) {
    $id = (int)$_GET['id'];
    $fullName = trim($_POST["full_name"]);
    $userName = trim($_POST["user_name"]);
    $password = trim($_POST["password"]);
    $email = trim($_POST['email']);
    $group = trim($_POST["user_group"]);
    $isDisabled = isset($_POST["is_disabled"]);
    $notes = trim($_POST["notes"]);
    // Update user details
    User::update($id, $fullName, $userName, $password, $email, $group, $isDisabled, $notes);
}


// Retrieve errors & success messages from User class
if (!empty(User::$success)) $success = User::$success;
if (!empty(User::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
}