<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "عرض الإيداعات النقدية";
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/view_deposits.inc";
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
                                <th><i class="glyphicon glyphicon-barcode"></i> رقم الإيصال</th>
                                <th><i class="glyphicon glyphicon-user"></i> اسم العضو</th>
                                <th><i class="glyphicon glyphicon-calendar"></i> تاريخ إيصال البنك</th>
                                <th><i class="glyphicon glyphicon-credit-card"></i> رقم إيصال البنك</th>
                                <th><i class="glyphicon glyphicon-usd"></i> إجمالي المبلغ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($deposits as $deposit) {
                                echo "
                                           <tr>
                                            <td>{$deposit['id']}</td>
                                            <td>{$deposit['full_name']}</td>
                                            <td>{$deposit['bank_receipt_date']}</td>
                                            <td>{$deposit['bank_receipt_no']}</td>
                                            <td>{$deposit['total']}</td>
                                            <td><div>
                                            <form action='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/print' method='post'>
                                                    <input type='hidden' name='deposit_id' value='{$deposit['id']}'>
                                                    <button type='submit' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-print'></i></button>
                                                    <a class='btn btn-primary btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/update/{$deposit['id']}'><i class='glyphicon glyphicon-pencil'></i></a>
                                                    <a class='btn btn-danger btn-xs' href='/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/delete/{$deposit['id']}'><i class='glyphicon glyphicon-trash'></i></a>
                                            </form>
                                                    </div>
                                            </td>
                                           </tr>
                                    ";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        // Pagination Links
                        $pagination->paginate("deposits");
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </section>

<?php
require_once "../includes/footer.inc";
?>