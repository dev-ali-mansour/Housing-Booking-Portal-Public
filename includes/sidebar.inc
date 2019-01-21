<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <div class="centered"><a href="#">
                    <p class="centered"><img
                                src=<?php echo "/" . BASE_DIRECTORY . "/assets/img/user.png"; ?> class="img-circle"
                                width="60"></p>
                    <h5 class="centered">
                        <?php session_status() == PHP_SESSION_NONE ? session_start() : null;
                        echo $_SESSION['full_name']; ?></h5>
                </a>
            </div>
            <li class="sub-menu">
                <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home"; ?>>
                    <i class="glyphicon glyphicon-home sidebar-menu-item"></i>الرئيسية
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-folder-open sidebar-menu-item"></i>مجموعات المستخدمين
                </a>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>مجموعة جديدة</a></li>
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/list"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض المجموعات</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-user sidebar-menu-item"></i>حسابات المستخدمين
                </a>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>حساب جديد</a></li>
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/list"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض حسابات المستخدمين</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-briefcase sidebar-menu-item"></i>الأعضاء
                </a>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>عضو جديد</a>
                    </li>
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/list"; ?>><i
                                    class=" glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض بيانات الأعضاء</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-tasks sidebar-menu-item"></i>المشروعات
                </a>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>مشروع جديد</a></li>
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/list"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض بيانات المشروعات</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-home sidebar-menu-item"></i>حجز الوحدات
                </a>
                <ul class="sub">
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>حجز وحدة سكنية</a></li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/list"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض استمارات الحجز</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-usd sidebar-menu-item"></i>الإيداعات النقدية
                </a>
                <ul class="sub">
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/new"; ?>><i
                                    class="glyphicon glyphicon-plus sidebar-menu-sub-item"></i>إيداع
                            نقدي جديد</a></li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/print"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض إيصال</a>
                    </li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/list"; ?>><i
                                    class="glyphicon glyphicon-ok sidebar-menu-sub-item"></i>عرض
                            الإيداعات النقدية</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-print sidebar-menu-item"></i>التقارير
                </a>
                <ul class="sub">
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reports/reserved-flats"; ?>><i
                                    class="glyphicon glyphicon-list-alt sidebar-menu-sub-item"></i>استمارات الحجز</a>
                    </li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reports/deposits"; ?>><i
                                    class="glyphicon glyphicon-list-alt sidebar-menu-sub-item"></i>الإيداعات
                            النقدية</a></li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reports/member-deposits"; ?>><i
                                    class="glyphicon glyphicon-list-alt sidebar-menu-sub-item"></i>قائمةإيداعات عضو</a>
                    </li>
                    <li>
                        <a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reports/members"; ?>><i
                                    class="glyphicon glyphicon-list-alt sidebar-menu-sub-item"></i>قائمةالأعضاء</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:">
                    <i class="glyphicon glyphicon-cog sidebar-menu-item"></i>الإعدادات
                </a>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/settings"; ?>><i
                                    class="glyphicon glyphicon-info-sign sidebar-menu-sub-item"></i>معلومات الموقع</a>
                    </li>
                </ul>
                <ul class="sub">
                    <li><a href=<?php echo "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/database/backup"; ?>><i
                                    class="glyphicon glyphicon-hdd sidebar-menu-sub-item"></i>النسخ الاحتياطي</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->