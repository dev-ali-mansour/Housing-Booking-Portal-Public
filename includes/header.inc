<?php

// Load configuration file & basic libraries
require_once('../models/config.php');
require_once('../models/Database.php');
require_once('../models/Settings.php');
require_once('../models/UsersGroup.php');
require_once('../models/User.php');
require_once('../models/Member.php');
require_once('../models/Project.php');
require_once('../models/Reservation.php');
require_once('../models/Deposit.php');
require_once('../models/Pagination.php');
require_once('../models/Message.php');

//Start session if not already started
session_status() == PHP_SESSION_NONE ? session_start() : null;

User::applyPermissions(basename($_SERVER['PHP_SELF']));
User::autoLogout();
User::authorize(basename($_SERVER['PHP_SELF']));

$settings = Settings::getSettings();
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $settings['description']; ?>">
    <meta name="author" content="TibaDev">
    <meta name="keyword" content="<?php echo $settings['keywords']; ?> ">


    <title><?php echo "{$title} - {$settings['site_name']}"; ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href=<?php echo "/" . BASE_DIRECTORY . "/favicon.png"; ?>>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/bootstrap.css"; ?>>
    <link rel=" stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/bootstrap-rtl.css"; ?>>
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href= <?php echo "/" . BASE_DIRECTORY . "/assets/font-awesome/css/font-awesome.css"; ?>>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href= <?php echo "/" . BASE_DIRECTORY . "/assets/css/style.css"; ?>>
    <link rel="stylesheet" type="text/css" href= <?php echo "/" . BASE_DIRECTORY . "/assets/css/style-responsive.css"; ?>>

    <!-- JS Scripts -->
    <link rel=" stylesheet"
          href=<?php echo "/" . BASE_DIRECTORY . "/assets/jquery-ui-themes-1.12.1/themes/redmond/jquery-ui.min.css"; ?>>
    <script src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/jquery-ui.min.js"; ?>></script>
    <script src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/jquery.js"; ?>></script>
    <script type="text/javascript" src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/bootstrap.min.js"; ?>></script>

    <!-- Jquery DatePicker script -->
    <script>
        $(function () {
            $(" #datepicker ").datepicker().datepicker(" setDate ", new Date());
        });
    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[ if lt IE 9 ]> <script src = "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" ></script>
    <scriptsrc = "https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" ></script>
    <![endif]-->
</head>

<body>
<section id="container">
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="home" class="logo"><b>الجمعية التعاونية للبناء و الإسكان</b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-menu">
            <ul class="nav pull-left top-menu">
                <li><a class="logout" href=<?php echo "/" . BASE_DIRECTORY . "/logout"; ?>><span
                                class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;تسجيل
                        الخروج</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->