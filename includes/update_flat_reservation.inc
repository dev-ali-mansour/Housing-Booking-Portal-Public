<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve projects from database
$projects = Project::findAll();
// Get current flat reservation details
if (!empty($_GET['id'])) {
    $current_reservation = Reservation::findById($_GET['id']);
    $memberId = $current_reservation['member_id'];
    $projectId = $current_reservation['project_id'];
    $buildingNo = $current_reservation['building_no'];
    $floorNo = $current_reservation['floor_no'];
    $flatNo = $current_reservation['flat_no'];
    $area = $current_reservation['area'];
    $notes = $current_reservation['notes'];
} else {
    // Redirect toe view members page
    echo '<script>location = vview-flat-reservations.php</script>';
}
// Add new flat reservation to database
if (isset($_POST['update'])) {
    $id = (int)$_GET['id'];
    $memberId = trim($_POST['member_id']);
    $projectId = $_POST['project_id'];
    $buildingNo = trim($_POST['building_no']);
    $floorNo = trim($_POST['floor_no']);
    $flatNo = trim($_POST['flat_no']);
    $area = trim($_POST['area']);
    $notes = trim($_POST['notes']);
    Reservation::update($id, $memberId, $projectId, $buildingNo, $floorNo, $flatNo, $area, $notes);
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