<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// Count all user groups
$totalCount = UsersGroup::countAll();
// User groups pagination
$pagination = new Pagination($page, $totalCount);
$groups = UsersGroup::paginateAll($pagination->offset());

// Retrieve errors & success messages from UsersGroup class
if (!empty(UsersGroup::$success)) $success = UsersGroup::$success;
if (!empty(UsersGroup::$errors)) {
    foreach (UsersGroup::$errors as $error) {
        $errors[] = $error;
    }
}