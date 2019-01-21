<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 11/11/2017
 * Time: 4:39 PM
 */

require_once('../models/config.php');
require_once('../models/Member.php');

if (isset($_POST["id"])) {
    $member = Member::getById($_POST['id']);
    $fullName = $member['full_name'];
    echo $fullName;
} else {
    header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
}
?>