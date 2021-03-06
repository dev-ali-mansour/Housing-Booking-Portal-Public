<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "إيداع نقدي جديد";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/new_deposit.inc";
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
                                    <label class="col-sm-2 control-label">رقم العضوية</label>
                                    <div class="col-sm-2">
                                        <input id="member_id" name="member_id" type="number" min="1"
                                               class="form-control round-form centered" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="full_name" name="full_name" type="text" min="0"
                                               class="form-control round-form centered" tabindex="-1"
                                               readonly style="background-color: #5bc0de;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">اسم المشروع</label>
                                    <div class="col-sm-6">
                                        <select name="project_id" class="form-control" id="project_id">
                                            <option value="0">اختر المشروع من هنا</option>
                                            <?php
                                            foreach ($projects as $project) {
                                                echo "<option value='" . $project['id'] . "'";
                                                if ($project['id'] == 1) {
                                                    echo "selected='selected'";
                                                }
                                                echo ">" . $project['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">تاريخ إيصال البنك</label>
                                    <div class="col-sm-3">
                                        <input name="bank_date" type="text" class="form-control round-form"
                                               id="datepicker" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">رقم إيصال البنك</label>
                                    <div class="col-sm-6">
                                        <input id="bank_no" name="bank_no" type="number" min="0"
                                               class="form-control round-form centered">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">دفعة مقدمة</label>
                                    <div class="col-sm-5">
                                        <input id="pre" name="pre" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">قسط شهري</label>
                                    <div class="col-sm-5">
                                        <input id="monthly" name="monthly" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">قسط ربع سنوي</label>
                                    <div class="col-sm-5">
                                        <input id="quarterly" name="quarterly" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">قسط نصف سنوي</label>
                                    <div class="col-sm-5">
                                        <input id="semi_annual" name="semi_annual" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">قسط سنوي</label>
                                    <div class="col-sm-5">
                                        <input id="annual" name="annual" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">دفعة تعاقد</label>
                                    <div class="col-sm-5">
                                        <input id="contract" name="contract" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">دفعة تخصيص</label>
                                    <div class="col-sm-5">
                                        <input id="allocation" name="allocation" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">دفعة استلام</label>
                                    <div class="col-sm-5">
                                        <input id="receipt" name="receipt" type="number" min="0"
                                               class="form-control round-form centered amount">
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">إجمالي قيمة الإيداع</label>
                                    <div class="col-sm-5">
                                        <input id="total" name="total" type="number" min="0"
                                               class="form-control round-form centered" tabindex="-1" readonly>
                                    </div>
                                    <div class="col-sm-2 control-label">جنيه</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">الوصف</label>
                                    <div class="col-sm-6">
                                        <textarea name="description" class="form-control" rows="5"
                                                  id="comment"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="centered amount">
                                            <button type="submit" name="add"
                                                    class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;إضافة
                                            </button>
                                            <a class="btn btn-danger btn-lg"
                                               href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/list"; ?>
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