<?php
require_once('models/config.php');
require_once('models/Database.php');
require_once('models/User.php');
//Check if user already logged in and then redirect to admin page
//User::authorize(basename($_SERVER['PHP_SELF']));

if (isset($_POST['send'])) {
    if (empty($_POST["email"])) {
        $error = "يرجى التأكد من إدخال البريد الإلكتروني!";
    } else {
        $success = "تم إرسال رابط استرجاع كلمة المرور على بريدك الإلكتروني";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="TibaDev">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>تسجيل الدخول - الجمعية التعاونية للإسكان و البناء</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-rtl.css" rel="stylesheet">

        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
    <div id="login-page">
        <div class="container">
            <form class="form-login" action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">نسيت كلمة المرور؟</h4>
                    </div>
                    <div class="modal-body">
                        <p>من فضلك أدخل بريدك الإلكتروني لاستعادة كلمة المرور؟</p>
                        <input type="text" name="email" placeholder="البريد الإلكتروني" autocomplete="off"
                               class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button name="send" class="btn btn-theme" type="submit">إرسال</button>
                        <button name="cancel" class="btn btn-default" type="button"><a href="admin/index.php"
                                                                                       style="color: #68dff0">إلغاء</a>
                        </button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($error)) {
                echo '<div class="alert alert-danger"
                     style="margin-top: 20px; margin-right: 360px; margin-left: 360px">' . $error . '</div>';
            }
            if (isset($success)) {
                echo '<div class="alert alert-success"
                     style="margin-top: 20px; margin-right: 360px; margin-left: 360px">' . $success . '</div>';
            }
            ?>
        </div>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/dubai_building.png", {speed: 500});
    </script>
    </body>
    </html>

<?php $conn = null; ?>