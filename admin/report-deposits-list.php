<?php
$title = 'تقرير الإيداعات النقدية';
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/report_deposits_list.inc";
?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="col-lg-12">
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <!-- View deposit pdf report if it is already exist -->
                        <div class='centered'>
                            <iframe src="<?php echo "/" . BASE_DIRECTORY . '/reports/deposits-list.pdf'; ?>" width="95%" height="500px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php
require_once "../includes/footer.inc";
?>