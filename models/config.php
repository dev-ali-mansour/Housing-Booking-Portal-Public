<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/21/2017
 * Time: 5:29 PM
 */

// Database Constants
defined('DB_SERVER') ? null : define('DB_SERVER', "SERVER_IP_ADDRESS");
defined('DB_NAME') ? null : define('DB_NAME', "DATABASE_NAME");
defined('DB_USER') ? null : define('DB_USER', "USER_NAME");
defined('DB_PASS') ? null : define('DB_PASS', "PASSWORD");

// Project Structure
defined('BASE_DIRECTORY') ? null : define('BASE_DIRECTORY', 'Housing');
defined('ADMIN_DIRECTORY') ? null : define('ADMIN_DIRECTORY', 'admin');

// Auto Logout Period Constant (by seconds)
defined('AUTO_LOGOUT') ? null : define('AUTO_LOGOUT', 900);

// Time that user can login after set of failed attempts
defined('RELOGIN_TIME') ? null : define('RELOGIN_TIME', 900);

// Maximum records count per page
defined('MAX_RECORDS') ? null : define('MAX_RECORDS', 25);