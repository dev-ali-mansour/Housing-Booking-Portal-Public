<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "الرئيسية";

// load header and sidebar
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/index.inc";
?>
    <!--main content start-->
    <section id="main-content" xmlns="http://www.w3.org/1999/html">
        <section class="wrapper">
            <div class="row" style="margin-right: 15px">
                <div class="row mt">
                    <div class="col-lg-12">
                        <?php
                        if (isset($_GET['success'])) $success = $_GET['success'];
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
                        <div class="col-md-4 mb">
                            <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/list"; ?>>
                                <div class="white-panel pn" style="height: 320px;">
                                    <div class="white-header">
                                        <h5>إحصائيات المستخدمين</h5>
                                    </div>
                                    <p>
                                        <img src=<?php echo "/" . BASE_DIRECTORY . "/assets/img/users.png"; ?> class="img-circle"
                                             width="80"></p>
                                    <p><b><?php echo "عدد المستخدمين<br>{$users_count}"; ?></b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>حسابات مفعلة</p>
                                            <p><?php echo $active_users_count; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>حسابات غير مفعلة</p>
                                            <p><?php echo $inactive_users_count; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb">
                            <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/list"; ?>>
                                <div class="white-panel pn" style="height: 320px;">
                                    <div class="white-header">
                                        <h5>إحصائيات الأعضاء</h5>
                                    </div>
                                    <p>
                                        <img src=<?php echo "/" . BASE_DIRECTORY . "/assets/img/membrs.png"; ?> class="img-circle"
                                             width="80"></p>
                                    <p><b><?php echo "عدد الأعضاء<br>{$members_count}"; ?></b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>أعضاء مؤسسين</p>
                                            <p><?php echo $founder_members_count; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>أعضاء عاملين</p>
                                            <p><?php echo $worker_members_count; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb">
                            <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/list"; ?>>
                                <div class="white-panel pn" style="height: 320px;">
                                    <div class="white-header">
                                        <h5>إحصائيات حجز الوحدات</h5>
                                    </div>
                                    <p>
                                        <img src=<?php echo "/" . BASE_DIRECTORY . "/assets/img/flats.png"; ?> class="img-circle"
                                             width="80"></p>
                                    <p><b><?php echo "عدد الوحدات<br>{$flats_count}"; ?></b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>الوحدات المحجوزة</p>
                                            <p><?php echo $reserved_flats_count; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>الوحدات الغير محجوزة</p>
                                            <p><?php echo $unreserved_flats_count; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-right: 30px">
                <div class="row mt">
                    <div class="col-lg-4 mb">
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/list"; ?>>
                            <div class="white-panel pn" style="height: 580px;">
                                <div class="white-header">
                                    <h5>إحصائيات الإيداعات النقدية</h5>
                                </div>
                                <p>
                                    <img src=<?php echo "/" . BASE_DIRECTORY . "/assets/img/deposits.png"; ?> class="img-circle"
                                         width="80"></p>
                                <p><b>إجمالي الإيداعات النقدية<br><?php echo !empty($total) ? $total : "0.00"; ?>
                                        جنيه</b></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>الدفعات المقدمة<br><?php echo !empty($pre) ? $pre : "0.00"; ?> جنيه</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>الأقساط الشهرية<br><?php echo !empty($monthly) ? $monthly : "0.00"; ?>
                                            جنيه</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>الأقساط الربع
                                            سنوية<br><?php echo !empty($quarterly) ? $quarterly : "0.00"; ?> جنيه
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>الأقساط النصف
                                            سنوية<br><?php echo !empty($semi_annual) ? $semi_annual : "0.00"; ?>
                                            جنيه</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>الأقساط السنوية<br><?php echo !empty($annual) ? $annual : "0.00"; ?> جنيه
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>دفعات التعاقد<br><?php echo !empty($contract) ? $contract : "0.00"; ?>
                                            جنيه</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>دفعات
                                            التخصيص<br><?php echo !empty($allocation) ? $allocation : "0.00"; ?>
                                            جنيه</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>دفعات الاستلام<br><?php echo !empty($receipt) ? $receipt : "0.00"; ?>
                                            جنيه</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </section>
<?php
require_once "../includes/footer.inc";
?>