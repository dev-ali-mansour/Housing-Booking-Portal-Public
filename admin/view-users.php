<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "حسابات المستخدمين";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_users.inc";
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
                            <h4>عدد المستخدمين: </h4>
                            <table class="table table-responsive table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th><i class="glyphicon glyphicon-pencil"></i> الاسم الكامل</th>
                                    <th><i class="glyphicon glyphicon-user"></i> اسم المستخدم</th>
                                    <th><i class="glyphicon glyphicon-envelope"></i> البريد الإلكتروني</th>
                                    <th><i class="glyphicon glyphicon-folder-open"></i> المجموعة</th>
                                    <th><i class="glyphicon glyphicon-ban-circle"></i> معطل</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Set right and wrong signs to use them later
                                $sign_right = "<td><span class='glyphicon glyphicon-ok'></span></td>";
                                $sign_wrong = "<td><span class='glyphicon glyphicon-remove'></span></td>";
                                // Load user data into table
                                foreach ($users as $user) {
                                    echo " <tr>
                                            <td>{$user['full_name'] }</td>
                                            <td>{$user['user_name']}</td>
                                            <td>{$user['email']}</td>
                                            <td>{$user['name']}</td>";
                                    echo $user['is_disabled'] == 0 ? $sign_wrong : $sign_right;
                                    echo " <td><div>
                                        <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/update/{$user['id']}'> <i class='glyphicon glyphicon-pencil'></i></a>
                                        <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/delete/{$user['id']}'> <i class='glyphicon glyphicon-trash'></i></a>
                                    </div></td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            // Pagination Links
                            $pagination->paginate("users");
                            ?>
                        </div>
                    </div>
                </div>
        </section>
    </section>

<?php
require_once "../includes/footer.inc";
?>