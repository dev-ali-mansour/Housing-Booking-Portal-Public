<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

// Retrieve website settings from database
$settings = Settings::getSettings();
$site_name = $settings['site_name'];
$description = $settings['description'];
$keywords = $settings['keywords'];
$email = $settings['email'];
$status = $settings['site_status'];

//Update website settings
if (isset($_POST['update'])) {
    $siteName = trim($_POST['site_name']);
    $description = trim($_POST["description"]);
    $keywords = trim($_POST["keywords"]);
    $email = trim($_POST['email']);
    $status = isset($_POST["status"]);
    Settings::updateSettings($siteName, $description, $keywords, $email, $status);
}

// Retrieve errors & success messages from User class
if (isset(User::$success)) $success = User::$success;
if (isset(User::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
}