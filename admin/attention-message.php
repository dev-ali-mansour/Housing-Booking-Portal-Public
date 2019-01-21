<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/15/2017
 * Time: 12:47 AM
 */
require_once('../models/config.php');
$title = "إجراء غير مصرح به";
if (isset($_GET['target'])) {
    $target = trim($_GET['target']);
    switch ($target) {
        case 1:
            $message = "خطأ في تحديد المعرف!";
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
            break;
        case 2:
            $message = "عفواً أنت لا تملك صلاحية دخول لهذه الصفحة<br>من فضلك راجع الإدارة!";
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
            break;
        case 3:
            $message = "لا يمكن حذف هذا الحساب حيث أنه محمي من قبل النظام!";
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/list");
            break;
        case 4:
            $message = "لا يمكن حذف هذا المجموعة حيث أنها محمية من قبل النظام!";
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/list");
            break;
        case 5:
            $message = " لا يمكن حذف هذا المجموعة حيث أنها تحتوي على عدد من المستخدمين!<br>يجب حذف المستخدمين المنتمين لهذه المجموعة أولاً";
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/list");
            break;
        case 6:
            $message = " لا يمكن حذف هذا المشروع لوجود عمليات حجز وحدات<br>( أو ) إيداعات نقدية تابعة له!<br>يجب حذف عمليات حجز الوحدات و الإيداعات التي تخص هذا المشروع أولاً";
            header("Refresh: 10;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/list");
            break;
        default:
            $message = "Target: " . $target;
            header("Refresh: 5;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
            break;
    }
} else {
    header("Refresh: 3;url=" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");

}

include "../includes/header.inc";
include "../includes/sidebar.inc";
?>
    <div class='modal fade' id='messageModal' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h3 class='modal-title'>رسالة إدارية</h3>
                </div>
                <div class='modal-body centered'>
                    <p><?php echo $message."<br>سيتم إعادة توجيهك تلقائياً"; ?></p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-success' data-dismiss='modal'>موافق</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('#messageModal').modal('show');
    </script>
<?php
include "../includes/footer.inc";
?>