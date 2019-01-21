<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "الإعدادات العامة";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/settings.inc";
?>

    <!--main content-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="col-lg-12">
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <?php
                            if (isset($success)) {
                                echo '<div class="alert alert-success"
                      style="margin-right: 360px; margin-left: 360px"> ' . $success . '</div>';
                            } elseif (isset($errors)) {
                                echo '<div class="alert alert-danger"
                     style="margin-right: 360px; margin-left: 360px">';
                                foreach ($errors as $error) {
                                    echo "* " . $error . "<br>";
                                }
                                echo '</div>';
                            }
                            ?>
                            <form class="form-horizontal style-form" action="" method="post">
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-2 control-label">اسم الموقع</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="site_name" class="form-control round-form"
                                               value="<?php if (isset($site_name)) echo $site_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-2 control-label">وصف الموقع</label>
                                    <div class="col-sm-6">
                                            <textarea name="description" class="form-control" rows="5" id="description"><?php
                                                if (isset($description)) echo trim($description); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-2 control-label">الكلمات الدلالية</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="keywords" class="form-control round-form"
                                               value="<?php if (isset($keywords)) echo $keywords; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-2 control-label">بريد صاحب الموقع</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" class="form-control round-form"
                                               value="<?php if (isset($email)) echo $email; ?>"
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">حالة الموقع</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="status" disabled
                                                <?php
                                                if (isset($status)) {
                                                    echo($status == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="row mt centered">
                                            <button type="submit" name="update"
                                                    class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;تحديث
                                            </button>
                                            <button type="button" name="cancel" class="btn btn-danger btn-lg"
                                                    style="margin-right: 20px">
                                                <a href="index.php">
                                                    <span class="glyphicon glyphicon-remove-sign"></span>
                                                    &nbsp;إلغاء</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

<?php
require_once "../includes/footer.inc";
?>