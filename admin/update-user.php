<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "إتعديل بيانات مستخدم";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/update_user.inc";
?>

    <!--main content-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="col-lg-12">
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <?php
                            if (!empty($success)) {
                                echo '<div class="alert alert-success"
                      style="margin-right: 360px; margin-left: 360px"> ' . $success . '</div>';
                            } elseif (!empty($errors)) {
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
                                    <label for="user_group" class="col-sm-3 control-label">الاسم الكامل</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="full_name" class="form-control round-form"
                                               value="<?php if (!empty($fullName)) echo $fullName; ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-3 control-label">اسم المستخدم</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="user_name" class="form-control round-form"
                                               value="<?php if (!empty($userName)) echo $userName; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-3 control-label">كلمة المرور</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control round-form"
                                               value="<?php if (!empty($userPass)) echo $userPass; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-3 control-label">البريد الإلكتروني</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" class="form-control round-form"
                                               value="<?php if (!empty($email)) echo $email; ?>"
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-3 control-label">مجموعة المستخدمين</label>
                                    <div class="col-sm-6">
                                        <select name="user_group" class="form-control" id="user_group">
                                            <option value="0">اختر مجموعة المستخدمين من هنا</option>
                                            <?php
                                            foreach ($user_groups as $user_group) {
                                                echo "<option value='" . $user_group['id'] . "'";
                                                if (!empty($groupId)) {
                                                    if ($groupId == $user_group['id']) {
                                                        echo "selected='selected'";
                                                    }
                                                }
                                                echo ">" . $user_group['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">معطل</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="is_disabled"
                                                <?php
                                                if (isset($isDisabled)) {
                                                    echo($isDisabled == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="col-sm-3 control-label">ملاحظات</label>
                                    <div class="col-sm-6">
                                            <textarea name="notes" class="form-control" rows="5" id="notes"><?php
                                                if (!empty($notes)) echo trim($notes); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <div class="centered">
                                            <button type="submit" name="update"
                                                    class="btn btn-primary btn-lg" <?php if (!isset($_GET['id'])) echo "disabled"; ?>><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;تحديث
                                            </button>
                                            <a class="btn btn-danger btn-lg" href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/list";?>
                                               style="margin-right: 20px">
                                                <span class="glyphicon glyphicon-remove-sign"></span>&nbsp;إلغاء</a>
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