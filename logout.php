<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/17/2017
 * Time: 3:25 AM
 */

// Load basic libraries
require_once('models/User.php');

//Start session if not already started
session_status() == PHP_SESSION_NONE ? session_start() : null;

// Logout current logged in user
User::logout();
