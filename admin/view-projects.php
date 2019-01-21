<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "عرض المشروعات";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_projects.inc";
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
                                    <th><i class="glyphicon glyphicon-tasks"></i> اسم المشروع</th>
                                    <th><i class="glyphicon glyphicon-info-sign"></i> الوصف</th>
                                    <th><i class="glyphicon glyphicon-home"></i> عدد الوحدات</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($projects as $project) {
                                    echo "
                                <tr>
                                    <td>{$project['name']}</td>
                                    <td>{$project{'description'}}</td>
                                    <td>{$project['flat_count']}</td>
                                    <td>
                                        <div>
                                            <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/update/{$project['id']}'> <i class='glyphicon glyphicon-pencil'></i></a>
                                            <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/delete/{$project['id']}'> <i class='glyphicon glyphicon-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                    ";
                                } ?>
                                </tbody>
                            </table>
                            <?php
                            // Pagination Links
                            $pagination->paginate("projects");
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