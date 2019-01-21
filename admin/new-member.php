<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "إضافة عضو جديد";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/new_member.inc";
?>
    <!--main content start-->
    <section id="main-content" style="padding-right: 25px">
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
                                    <label for="full_name" class="col-sm-2 control-label">اسم العضو</label>
                                    <div class="col-sm-6">
                                        <input name="full_name" type="text" class="form-control round-form centered"
                                               autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="national_id" class="col-sm-2 control-label">الرقم القومي</label>
                                    <div class="col-sm-6">
                                        <input id="national_id" name="national_id"
                                               class="form-control round-form centered" type="number" min="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="membership" class="col-sm-2 control-label">نوع العضوية</label>
                                    <div class="col-sm-2">
                                        <select name="membership" class="form-control" id="user_group">
                                            <option value="0">اختر نوع العضوية</option>
                                            <option value="1">عضو مؤسس</option>
                                            <option value="2">عضو عامل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telephone" class="col-sm-2 control-label">رقم الهاتف</label>
                                    <div class="col-sm-6">
                                        <input id="telephone" name="telephone" type="number" min="1"
                                               class="form-control round-form centered">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_group" class="col-sm-2 control-label">ملاحظات</label>
                                    <div class="col-sm-6">
                                        <textarea id="notes" name="notes" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="centered">
                                            <button type="submit" name="add"
                                                    class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;إضافة
                                            </button>
                                            <a class="btn btn-danger btn-lg" href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/list";?>
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
    <script src="../assets/js/main.js"></script>
<?php
require_once "../includes/footer.inc";
?>