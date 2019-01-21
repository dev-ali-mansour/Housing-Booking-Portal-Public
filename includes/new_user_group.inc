<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Add new user group to database
if (isset($_POST["add_group"])) {
    $group_name = trim($_POST["group_name"]);
    $admin_permission = !empty($_POST["admin_permission"]);
    $add_permission = !empty($_POST["add_permission"]);
    $update_permission = !empty($_POST["update_permission"]);
    $view_permission = !empty($_POST["view_permission"]);;
    $notes = trim($_POST["notes"]);
    UsersGroup::add($group_name, $admin_permission, $add_permission, $update_permission, $view_permission, $notes);
}

// Retrieve errors & success messages from UsersGroup class
if (!empty(UsersGroup::$success)) $success = UsersGroup::$success;
if (!empty(UsersGroup::$errors)) {
    foreach (UsersGroup::$errors as $error) {
        $errors[] = $error;
    }
}