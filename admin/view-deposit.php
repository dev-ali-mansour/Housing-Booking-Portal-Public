<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */

$title = "عرض إيصال إيداع";
require_once '../includes/header.inc';
require_once '../includes/sidebar.inc';
require_once "../includes/view_deposit.inc";
?>
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="col-lg-12">
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" method="post">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <input type="number" name="deposit_id" class="form-control round-form centered"
                                               min="1" <?php if (empty($memberId)) echo 'autofocus'; ?>
                                               style="margin-right: 30px">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" name="search"
                                                class="btn btn-primary" style="margin-right: 5px"><span
                                                    class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            // View deposit pdf report if it is already exist
                            if (!empty($memberId)) {
                                echo "
                    <div class='centered'>
                        <iframe src='/".BASE_DIRECTORY."/reports/deposit.pdf' width='95%' height='500px'></iframe>
                    </div>
                        ";
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