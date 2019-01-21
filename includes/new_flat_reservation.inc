<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve projects from database
$projects = Project::findAll();

// Add new flat reservation to database
if (isset($_POST['add'])) {
    $memberId = trim($_POST['member_id']);
    $projectId = $_POST['project_id'];
    $buildingNo = trim($_POST['building_no']);
    $floorNo = trim($_POST['floor_no']);
    $flatNo = trim($_POST['flat_no']);
    $area = trim($_POST['area']);
    $notes = trim($_POST['notes']);
    Reservation::add($memberId, $projectId, $buildingNo, $floorNo, $flatNo, $area, $notes);
}

// Retrieve errors & success messages from Member & Deposit classes
if (!empty(Reservation::$success)) $success = Reservation::$success;
if (!empty(Reservation::$errors) || isset(Project::$errors)) {
    foreach (Reservation::$errors as $error) {
        $errors[] = $error;
    }
    foreach (Project::$errors as $error) {
        $errors[] = $error;
    }
}