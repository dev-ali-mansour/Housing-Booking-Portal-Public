<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Get current member details
if (!empty($_GET['id'])) {
    $currentMember = Member::getById($_GET['id']);
    $fullName = $currentMember['full_name'];
    $nationalId = $currentMember['national_id'];
    $membership = $currentMember['membership'];
    $telephone = $currentMember['telephone'];
    $notes = $currentMember['notes'];
} else {
    // Redirect toe view members page
    echo '<script>location = vview-members.php</script>';
}
// Update member details
if (isset($_POST['update'])) {
    $id = (int)$_GET['id'];
    $fullName = trim($_POST["full_name"]);
    $nationalId = trim($_POST["national_id"]);
    $membership = trim($_POST["membership"]);
    $telephone = trim($_POST['telephone']);
    $notes = trim($_POST["notes"]);
    Member::update($id, $fullName, $nationalId, $membership, $telephone, $notes);
}

// Retrieve errors & success messages from User class
if (!empty(Member::$success)) $success = Member::$success;
if (!empty(Member::$errors)) {
    foreach (Member::$errors as $error) {
        $errors[] = $error;
    }
}