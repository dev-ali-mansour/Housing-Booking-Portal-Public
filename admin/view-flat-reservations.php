<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "عرض استمارات الحجز";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_flat_reservations.inc";
?>
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-responsive table-striped table-advance table-hover">
                            <hr>
                            <thead>
                            <tr>
                                <th><i class="glyphicon glyphicon-pencil"></i> اسم العضو</th>
                                <th><i class="glyphicon glyphicon-tasks"></i> اسم المشروع</th>
                                <th><i class="glyphicon glyphicon-home"></i> رقم المبنى</th>
                                <th><i class="glyphicon glyphicon-home"></i> رقم الدور</th>
                                <th><i class="glyphicon glyphicon-home"></i> رقم الشقة</th>
                                <th><i class="glyphicon glyphicon-home"></i> مساحة الشقة</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($reservations as $reservation) {
                                echo "
                               <tr>
                                <td>{$reservation['full_name']}</td>
                                <td>{$reservation['name']}</td>
                                <td>{$reservation['building_no']}</td>
                                <td>{$reservation['floor_no']}</td>
                                <td>{$reservation['flat_no']}</td>
                                <td>{$reservation['area']}</td>
                                <td><div>
                                        <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/update/{$reservation['id']}'> <i class='glyphicon glyphicon-pencil'></i></a>
                                        <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/update/{$reservation['id']}'> <i class='glyphicon glyphicon-trash'></i></a>
                                    </div>
                               </tr>
                                ";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        // Pagination Links
                        $pagination->paginate("reservation/flats");
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </section>

<?php
require_once "../includes/footer.inc";
?>