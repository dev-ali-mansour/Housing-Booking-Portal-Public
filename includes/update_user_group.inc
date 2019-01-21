<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

//Get current user group details
if (!empty($_GET['id'])) {
    $current_group = UsersGroup::findById($_GET['id']);
    $group_name = $current_group["name"];
    $admin_permission = $current_group["admin_permission"];
    $add_permission = $current_group["add_permission"];
    $update_permission = $current_group["update_permission"];
    $view_permission = $current_group["view_permission"];;
    $notes = $current_group["notes"];
} else {
    $errors[] = "لم يتم تحديد مجموعة";
}

// Update user group details
if (isset($_POST['update_group'])) {
    $id = (int)$_GET['id'];
    $group_name = trim($_POST["group_name"]);
    $admin_permission = isset($_POST["admin_permission"]);
    $add_permission = isset($_POST["add_permission"]);
    $update_permission = isset($_POST['update_permission']);
    $view_permission = isset($_POST["view_permission"]);
    $notes = trim($_POST["notes"]);
    // Update user details
    UsersGroup::update($id, $group_name, $admin_permission, $add_permission, $update_permission, $view_permission, $notes);
}

// Retrieve errors & success messages from UsersGroup class
if (!empty(UsersGroup::$success)) $success = UsersGroup::$success;
if (!empty(UsersGroup::$errors)) {
    foreach (UsersGroup::$errors as $error) {
        $errors[] = $error;
    }
}