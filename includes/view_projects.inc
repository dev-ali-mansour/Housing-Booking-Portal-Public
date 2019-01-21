<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// Count all projects
$totalCount = Project::countAll();
// Projects pagination
$pagination = new Pagination($page, $totalCount);
$projects = Project::paginateAll($pagination->offset());

// Retrieve errors & success messages from UsersGroup class
if (!empty(Project::$success)) $success = Project::$success;
if (!empty(Project::$errors)) {
    foreach (Project::$errors as $error) {
        $errors[] = $error;
    }
}