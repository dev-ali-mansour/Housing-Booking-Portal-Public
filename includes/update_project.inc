<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current Project details
if (!empty($_GET['id'])) {
    $currentProject = Project::findById($_GET['id']);
    $name = $currentProject['name'];
    $description = $currentProject['description'];
    $flatCount = $currentProject['flat_count'];
}

// Update project details
if (isset($_POST['update'])) {
    $id = (int)$_GET['id'];
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $flatCount = trim($_POST["flat_count"]);
    Project::update($id, $name, $description, $flatCount);
}

// Retrieve errors & success messages from Project classes
if (!empty(Project::$success)) $success = Project::$success;
if (!empty(Project::$errors)) {
    foreach (Project::$errors as $error) {
        $errors[] = $error;
    }
}