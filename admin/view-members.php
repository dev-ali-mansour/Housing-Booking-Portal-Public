<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "عرض بيانات الأعضاء";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_members.inc";
?>

    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-md-12">
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
                                           class="form-control round-form centered" placeholder="أدخل رقم العضوية"
                                           value="<?php if (isset($_POST['search_id']) && !empty($_POST['member_id'])) echo $_POST['member_id']; ?>">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" name="search_id"
                                            class="btn btn-primary" style="margin-right: 5px"><span
                                                class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">اسم العضو</label>
                                </div>

                                <div class="col-sm-4">
                                    <input id="member_name" type="text" name="member_name"
                                           class="form-control round-form centered"
                                           min="1" placeholder="أدخل اسم العضو"
                                           value="<?php if (isset($_POST['search_name']) && !empty($_POST['member_name'])) echo $_POST['member_name']; ?>">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" name="search_name"
                                            class="btn btn-primary" style="margin-right: 5px"><span
                                                class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="centered amount">
                                <a class="btn btn-primary btn-lg" href="view-members.php"
                                   style="margin-right: 20px">
                                    <span class="glyphicon glyphicon-align-justify"></span>&nbsp;&nbsp;عرض الكل</a>
                            </div>
                        </form>
                        <div class="content-panel">
                            <table class="table table-responsive table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th><i class="glyphicon glyphicon-list"></i> رقم العضوية</th>
                                    <th><i class="glyphicon glyphicon-pencil"></i> الاسم الكامل</th>
                                    <th><i class="glyphicon glyphicon-credit-card"></i> الرقم القومي</th>
                                    <th><i class="glyphicon glyphicon-folder-open"></i> العضوية</th>
                                    <th><i class="glyphicon glyphicon-ban-circle"></i> هاتف</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($members as $member) {
                                    if ($member['membership'] == 1) {
                                        $membership = "عضو مؤسس";
                                    } elseif ($member['membership' == 2]) {
                                        $membership = "عضو عامل";
                                    }
                                    echo "<tr>
                                            <td>{$member['id']}</td>
                                            <td>{$member['full_name']}</td>
                                            <td>{$member['national_id']}</td>";
                                    if (isset($membership)) echo "<td>{$membership}</td> ";
                                    echo "  <td>{$member['telephone']}</td>
                                    <td><div>
                                            <form action='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reports/member-deposits' method='post'>
                                                    <input type='hidden' name='member_id' value='{$member['id']}'>
                                                    <button type='submit' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-usd'></i></button>
                                                    <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/update/{$member['id']}'> <i class='glyphicon glyphicon-pencil'></i></a>
                                                    <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/delete/{$member['id']}'> <i class='glyphicon glyphicon-trash'></i></a>
                                            </form>                                        
                                    </div></td></tr>
                                    ";
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            // Pagination Links
                            if (empty($_POST['member_id']) && empty($_POST['member_name'])) {
                                $pagination->paginate("members");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

<?php
require_once "../includes/footer.inc";
?>