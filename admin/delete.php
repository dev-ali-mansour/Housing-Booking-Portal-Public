<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/23/2017
 * Time: 6:49 PM
 */

require_once('../models/config.php');
require_once('../models/Database.php');
require_once('../models/User.php');
require_once('../models/UsersGroup.php');
require_once('../models/Member.php');
require_once('../models/Project.php');
require_once('../models/Reservation.php');
require_once('../models/Deposit.php');

if (isset($_GET['target']) && isset($_GET['id'])) {
    $target = trim($_GET['target']);
    $id = trim($_GET['id']);
    if (is_numeric($id)) {
        switch ($target) {
            case 'group':
                UsersGroup::delete($id);
                break;
            case 'user':
                User::delete($id);
                break;
            case 'member':
                Member::delete($id);
                break;
            case 'project':
                Project::delete($id);
                break;
            case 'reservation':
                Reservation::delete($id);
                break;
            case 'deposit';
                Deposit::delete($id);
                break;
            default:
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
                break;
        }
    } else {
        header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/1");
    }
} else {
    header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
}