<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Add new user to database
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $flatCount = trim($_POST['flat_count']);
    Project::add($name, $description, $flatCount);
}

// Retrieve errors & success messages from Project classes
if (!empty(Project::$success)) $success = Project::$success;
if (!empty(Project::$errors)) {
    foreach (Project::$errors as $error) {
        $errors[] = $error;
    }
}