<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "مجموعات المستخدمين";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_user_groups.inc";
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
                        <div class="content-panel">
                            <table class="table table-responsive table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th><i class="glyphicon glyphicon-folder-open"></i> اسم المجموعة</th>
                                    <th><i class="glyphicon glyphicon-cog"></i> صلاحية الإدارة</th>
                                    <th><i class="glyphicon glyphicon-plus"></i> صلاحية الإضافة</th>
                                    <th><i class=" fa fa-edit"></i> صلاحية التعديل</th>
                                    <th><i class="glyphicon glyphicon-tasks"></i> صلاحية العرض</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sign_right = "<td><span class='glyphicon glyphicon-ok'></span></td>";
                                $sign_wrong = "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                foreach ($groups as $group) {
                                    echo " <tr> <td>{$group['name']}</td>";
                                    echo $group['admin_permission'] == 0 ? $sign_wrong : $sign_right;
                                    echo $group['add_permission'] == 0 ? $sign_wrong : $sign_right;
                                    echo $group['update_permission'] == 0 ? $sign_wrong : $sign_right;
                                    echo $group['view_permission'] == 0 ? $sign_wrong : $sign_right;
                                    echo " <td><div>
                                                    <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/update/{$group['id']}'> <i class='glyphicon glyphicon-pencil'></i></a>
                                                    <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/delete/{$group['id']}'> <i class='glyphicon glyphicon-trash'></i></a>
                                                    </div></td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            // Pagination Links
                            $pagination->paginate("user-groups");
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