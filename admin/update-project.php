<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "تعديل بيانات مشروع";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/update_project.inc";
?>

    <!--main content start-->
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
                                    <label class="col-sm-2 control-label">اسم المشروع</label>
                                    <div class="col-sm-6">
                                        <input name="name" type="text" class="form-control round-form centered"
                                               value="<?php if (!empty($name)) echo $name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">وصف المشروع</label>
                                    <div class="col-sm-6">
                                        <textarea name="description" class="form-control" rows="5"
                                                  id="comment"><?php if (!empty($description)) echo $description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">عدد الوحدات</label>
                                    <div class="col-sm-5">
                                        <input id="flat_count" name="flat_count" type="number" min="1"
                                               class="form-control round-form centered"
                                               value="<?php if (!empty($flatCount)) echo $flatCount; ?>">
                                    </div>
                                    <div class="col-sm-2 control-label">وحدة</div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="centered">
                                            <button type="submit" name="update"
                                                    class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;تحديث
                                            </button>
                                            <a class="btn btn-danger btn-lg" href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/list";?>
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