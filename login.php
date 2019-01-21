<?php

// Load configuration file & basic libraries
require_once('models/config.php');
require_once('models/Database.php');
require_once('models/Settings.php');
require_once('models/User.php');

//Start session if not already started
session_status() == PHP_SESSION_NONE ? session_start() : null;

$title = "تسجيل الدخول";
//Get website settings from database
$settings = Settings::getSettings();
//Check if user already logged in and then redirect to admin page
User::authorize(basename($_SERVER['PHP_SELF']));

//user Authentication
if (isset($_POST["login"])) {
    //Check username & password for login
    $user = trim($_POST['username']);
    $password = trim($_POST['password']);
    User::authenticate($user, $password);
    //User Authorization
    User::authorize(basename($_SERVER['PHP_SELF']));
}

// Retrieve errors & success messages from User class
if (isset(User::$success)) $success = User::$success;
if (isset(User::$errors)) {
    foreach (User::$errors as $error) {
        $errors[] = $error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/bootstrap-rtl.css"; ?>>

    <!--external css-->
    <link rel="stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/font-awesome.css"; ?>>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/style.css"; ?>>
    <link rel="stylesheet" href=<?php echo "/" . BASE_DIRECTORY . "/assets/css/style-responsive.css"; ?>>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php
// Check website status
if (isset($settings['site_status'])) {
    if ($settings['site_status'] == 0) {
        echo '
            <div class="container"> <form class="form-login" action="" method="get">
                <h2 class="form-login-heading centered"><b><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;رسالة
                        إدارية</b></h2>
                <div class="login-wrap centered">
                    <p>عفواً الموقع مغلق حالياً لإجراء بعض عمليات الصيانة!<br>يرجى المحاولة لاحقا</p>
                </div> </form> </div> ';
        exit();
    }
}
?>
<div id="login-page">
    <div class="container">
        <form class="form-login" action="" method="post">
            <h2 class="form-login-heading">تسجيل الدخول</h2>
            <div class="login-wrap">
                <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" autofocus>
                <br>
                <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                <!--                <label class="checkbox">
                                        <span class="pull-right">
                                            <a href="forget_password.php"> نسيت كلمة المرور؟</a>

                                        </span>
                                </label>
                -->
                <button name="login" class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> تسجيل
                    الدخول
                </button>
            </div>
        </form>

        <?php
        if (isset($errors)) {
            echo '<div class="alert alert-danger"
                     style="margin-top: 20px; margin-right: 360px; margin-left: 360px">';
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->

<script type="text/javascript" src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/jquery.js"; ?>></script>
<script type="text/javascript" src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/bootstrap.min.js"; ?>></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src=<?php echo "/" . BASE_DIRECTORY . "/assets/js/jquery.backstretch.min.js"; ?>></script>

<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("/housing/assets/img/dubai_building.gif", {speed: 500});
</script>
</body>
</html>