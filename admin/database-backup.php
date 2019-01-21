<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/23/2017
 * Time: 6:49 PM
 */

// Load configuration file
require_once("../models/config.php");
require_once("../models/Settings.php");
Settings::backupDatabase();