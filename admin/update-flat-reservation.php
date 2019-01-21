<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "تعديل بيانات حجز وحدة سكنية";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/update_flat_reservation.inc";
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
                                               class="form-control round-form centered" autofocus
                                               value="<?php if (!empty($memberId)) echo $memberId; ?>">
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
                                        <select id="project_id" name="project_id" class="form-control" id="user_group">
                                            <option value="0">اختر المشروع من هنا</option>
                                            <?php
                                            foreach ($projects as $project) {
                                                echo "<option value='" . $project['id'] . "'";
                                                if (!empty($projectId)) {
                                                    if ($projectId == $project['id']) {
                                                        echo "selected='selected'";
                                                    }
                                                }
                                                echo ">" . $project['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">رقم العمارة</label>
                                    <div class="col-sm-6">
                                        <input id="building_no" name="building_no" type="text"
                                               class="form-control round-form"
                                               value="<?php if (!empty($buildingNo)) echo $buildingNo; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">رقم الدور</label>
                                    <div class="col-sm-6">
                                        <input id="floor_no" name="floor_no" type="number" min="1"
                                               class="form-control round-form"
                                               value="<?php if (!empty($floorNo)) echo $floorNo; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">رقم الشقة</label>
                                    <div class="col-sm-6">
                                        <input id="flat_no" name="flat_no" type="number" min="1"
                                               class="form-control round-form"
                                               value="<?php if (!empty($flatNo)) echo $flatNo; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">مساحة الشقة</label>
                                    <div class="col-sm-5">
                                        <input id="area" name="area" class="form-control round-form" type="number"
                                               min="1" value="<?php if (!empty($area)) echo $area; ?>">
                                    </div>
                                    <label class="col-sm-1 control-label">م2</label>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ملاحظات</label>
                                    <div class="col-sm-6">
                                        <textarea id="notes" name="notes" class="form-control"
                                                  rows="5"><?php if (!empty($notes)) echo $notes; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="centered amount">
                                            <button type="submit" name="update"
                                                    class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-floppy-disk"></span> &nbsp;تحديث
                                            </button>
                                            <a class="btn btn-danger btn-lg" href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/list";?>
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