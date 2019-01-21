<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "تعديل بيانات مجموعة مستخدمين";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/update_user_group.inc";
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
                            <form class="form-horizontal style-form" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">اسم المجموعة</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="group_name" class="form-control round-form"
                                               value="<?php if (!empty($group_name)) echo $group_name; ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">صلاحية الإدارة</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="admin_permission"
                                                <?php
                                                if (!empty($admin_permission)) {
                                                    echo($admin_permission == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">صلاحية الإضافة</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="add_permission"
                                                <?php
                                                if (!empty($add_permission)) {
                                                    echo($add_permission == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">صلاحية التعديل</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="update_permission"
                                                <?php
                                                if (!empty($update_permission)) {
                                                    echo($update_permission == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">صلاحية العرض</label>
                                    <div class="col-sm-6 text-center">
                                        <div class="switch switch-square"
                                             data-on-label="<i class=' fa fa-check'></i>"
                                             data-off-label="<i class='fa fa-times'></i>">
                                            <input type="checkbox" name="view_permission"
                                                <?php
                                                if (!empty($view_permission)) {
                                                    echo($view_permission == 1 ? 'checked' : '');
                                                } ?>
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="col-sm-2 control-label">ملاحظات</label>
                                    <div class="col-sm-6">
                                            <textarea name="notes" class="form-control" rows="5"
                                                      id="notes"><?php if (!empty($notes)) echo $notes; ?>
                                            </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="centered">
                                            <button type="submit" name="update_group"
                                                    class="btn btn-primary btn-lg"<?php if (empty($_GET['id'])) echo "disabled"; ?>><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;تحديث
                                            </button>
                                            <a class="btn btn-danger btn-lg" href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/list";?>
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