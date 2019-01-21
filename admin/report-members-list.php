<?php
$title = 'تقرير أعضاء الجمعية';
require_once "../includes/header.inc";
require_once "../includes/sidebar.inc";
require_once "../includes/report_members_list.inc";
?>

    <section id="main-content" style="margin-left: 20px; margin-right: 220px">
        <section class="wrapper">
            <div class="row">
                <div class="row mt">
                    <div class="col-lg-12">
                        <?php
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
                    </div>
                    <div class="centered">
                        <iframe src="<?php echo "/" . BASE_DIRECTORY . '/reports/members-list.pdf'; ?>" width="95%" height="500px"></iframe>
                    </div>
                </div>
        </section>
    </section>

<?php
include "../includes/footer.inc";
?>