<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/21/2017
 * Time: 5:44 PM
 */
require_once('config.php');
require_once('Database.php');

class User
{
    public static $errors = array();
    public static $success;

    // User Authentication
    public static function authenticate($username, $password)
    {
        try {
            $db = new Database();
            if (isset($_SESSION['last_fail']) && (time() - $_SESSION['last_fail']) < RELOGIN_TIME) {
                $wait = intval(($_SESSION['last_fail'] + RELOGIN_TIME - time()) / 60) + 1;
                self::$errors[] = "لقد استنفذت 5 محاولات فاشلة لتسجيل الدخول ! يرجى المحاولة بعد {$wait} دقيقة";

            } else {
                // Check username & password for login
                if (empty($username) || empty($password)) {
                    self::$errors[] = "يرجى إدخال اسم المستخدم و كلمة المرور";
                } else {
                    $query = "CALL sp_user_authentication(:userName,:userPass)";
                    $stmt = $db->getConnection()->prepare($query);
                    $stmt->bindParam(':userName', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':userPass', $password, PDO::PARAM_STR);
                    $stmt->execute();
                    $count = $stmt->fetchColumn();
                    if ($count > 0) {
                        // Get Current user details
                        $query = "CALL sp_get_user_details(:userName,:userPass)";
                        $stmt = $db->getConnection()->prepare($query);
                        $stmt->bindParam(':userName', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':userPass', $password, PDO::PARAM_STR);
                        $stmt->execute();
                        $row = $stmt->fetch();
                        if ($row['is_disabled']) {
                            self::$errors[] = "هذا الحساب معطل! يرجى مراجعة الإدارة";
                        } elseif ($row['is_locked']) {
                            self::$errors[] = "تم تعطيل هذا الحساب لأسباب أمنية! يرجى مراجعة الإدارة";
                        } else {
                            // Store account user details in session variables
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['full_name'] = $row['full_name'];
                            $_SESSION['admin_permission'] = $row['admin_permission'];
                            $_SESSION['add_permission'] = $row['add_permission'];
                            $_SESSION['update_permission'] = $row['update_permission'];
                            $_SESSION['view_permission'] = $row['view_permission'];
                            $_SESSION['last_activity'] = time();

                            // Redirect to admin portal
                            if (isset($_SESSION['current'])) {
                                header("Location:" . $_SESSION['current']);
                            } else {
                                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
                            }
                        }
                    } else {
                        self::$errors[] = "اسم المستخدم أو كلمة السر غير صحيحة";
                        if (isset($_SESSION['failed_attempts'])) {
                            $_SESSION['failed_attempts'] += 1;
                        } else {
                            $_SESSION['failed_attempts'] = 1;
                        }
                    }
                    if (!empty($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 5) {
                        $_SESSION['last_fail'] = time();
                    }
                }
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Add new user to database
    public static function add($fullName, $userName, $password, $email, $userGroup, $isDisabled, $notes)
    {
        try {
            $db = new Database();
            if (!empty($fullName) && !empty($userName) && !empty($password) && !empty($email) && $userGroup != 0) {
                $query = "CALL `sp_add_user`(:fullName,:userName,:userPass,:email,:userGroup,:isDisabled,:notes)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
                $u_stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
                $u_stmt->bindParam(':userPass', $password, PDO::PARAM_STR);
                $u_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $u_stmt->bindParam(':userGroup', $userGroup, PDO::PARAM_INT);
                $u_stmt->bindParam(':isDisabled', $isDisabled, PDO::PARAM_INT);
                $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                $u_stmt->execute();
                self::$success = "تم إضافة حساب المستخدم بنجاح";
            } else {
                if (empty($fullName)) self::$errors[] = "يرجى إدخال الاسم الكامل لصاحب الحساب !";
                if (empty($userName)) self::$errors[] = "يرجى إدخال اسم المستخدم !";
                if (empty($password)) self::$errors[] = "يرجى إدخال كلمة المرور !";
                if (empty($email)) self::$errors[] = "يرجى إدخال البريد الإلكتروني !";
                if ($userGroup == 0) self::$errors[] = "يرجى اختيار مجموعة مستخدمين !";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Update user by ID
    public static function update($id, $fullName, $userName, $password, $email, $userGroup, $isDisabled, $notes)
    {
        try {
            $db = new Database();
            if (!empty($id) && !empty($fullName) && !empty($userName) && !empty($password) && !empty($email) && $userGroup != 0) {
                $id = (int)$id;
                if (($id == 1 || $id == 2) && ($isDisabled == 1)) {
                    self::$errors[] = "لا يمكن تعطيل هذا الحساب حيث أنه محمي من قبل النظام!";
                } else {
                    // Check if user password was updated or not
                    if ($password == self::getOldPassword($id)) {
                        $new_password = $password;
                    } else {
                        $new_password = md5($password);
                    }
                    $query = "CALL `sp_update_user`(:fullName,:userName,:userPass,:email,:userGroup,:isDisabled,:notes,:id)";
                    $u_stmt = $db->getConnection()->prepare($query);
                    $u_stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
                    $u_stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
                    $u_stmt->bindParam(':userPass', $new_password, PDO::PARAM_STR);
                    $u_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $u_stmt->bindParam(':userGroup', $userGroup, PDO::PARAM_INT);
                    $u_stmt->bindParam(':isDisabled', $isDisabled, PDO::PARAM_INT);
                    $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                    $u_stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $u_stmt->execute();
                    self::$success = "تم تحديث بيانات الحساب بنجاح";
                }
            } else {
                if (empty($id)) self::$errors[] = "لم يتم تحديد حساب !";
                if (empty($fullName)) self::$errors[] = "يرجى إدخال الاسم الكامل لصاحب الحساب !";
                if (empty($userName)) self::$errors[] = "يرجى إدخال اسم المستخدم !";
                if (empty($password)) self::$errors[] = "يرجى إدخال كلمة المرور !";
                if (empty($email)) self::$errors[] = "يرجى إدخال البريد الإلكتروني !";
                if ($userGroup == 0) self::$errors[] = "يرجى اختيار مجموعة مستخدمين !";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get Old password for user account by ID
    public static function getOldPassword($id)
    {
        try {
            $id = (int)$id;
            $db = new Database();
            $query = "CALL `sp_get_old_password`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch();
            return $user['user_pass'];
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Delete user by ID
    public static function delete($id)
    {
        try {
            $db = new Database();
            if ($id == 1 || $id == 2) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/3");
            } else {
                $query = "CALL `sp_delete_user`(:id)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                self::$success = "تم حذف حساب المستخدم بنجاح ";
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/users/list");
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get user data by ID
    public static function findById($id)
    {
        try {
            $id = (int)$id;
            $db = new Database();
            $query = "CALL `sp_find_user_by_id`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch();
            return $user;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get All users data from database
    public static function findAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_find_all_users`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get All users data from database with pagination
    public static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $userOffset = (int)$offset;
            $db = new Database();
            $query = "CALL `sp_paginate_users`(:perPage,:userOffset)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':userOffset', $userOffset, PDO::PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count all users
    public static function countAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_all_users`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count active users
    public static function countActive()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_active_users`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count inactive (disabled / locked) users
    public static function countInactive()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_inactive_users`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // redirect user to login page if he is not signed in & to admin portal if he is signed in
    public static function authorize($page_name)
    {
        if ($page_name == "login.php") {
            if (isset($_SESSION['id'])) {
                if (isset($_SESSION['current'])) {
                    header("Location:" . $_SESSION['current']);
                } else {
                    header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/home");
                }
            }
        } else {
            !isset($_SESSION['id']) ? header("Location:" . "/" . BASE_DIRECTORY . "/login") : null;
        }
    }

    // Apply user permission for the current page
    public static function applyPermissions($page_name)
    {
        if ($page_name == "new-user.php" || $page_name == "update_user.php" || $page_name == "view-users.php"
            || $page_name == "new-user-group.php" || $page_name == "update_user_group.php"
            || $page_name == "view-user-groups.php") {
            // Check Settings permission
            if (!$_SESSION['admin_permission']) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/2");
            }
        } elseif ($page_name == "new-member.php" || $page_name == "new-project.php" || $page_name == "new-flat-reservation.php") {
            // Check Add permission
            if (!$_SESSION['add_permission']) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/2");
            }
        } elseif ($page_name == "update_member.php" || $page_name == "update_deposit.php" || $page_name == "update_project.php"
            || $page_name == "update_flat_reservation.php") {
            if (!$_SESSION['update_permission']) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/2");
            }
        } elseif ($page_name == "view-members.php" || $page_name == "view-deposit.php" || $page_name == "view-deposits.php"
            || $page_name == "view-projects.php" || $page_name == "view_flat_reservation.php" || $page_name == "reserved_flats_report.php"
            || $page_name == "deposits_report.php" || $page_name == "member_deposits_report.php" || $page_name == "report-members-list.php"
            || $page_name == "new-deposit.php") {
            if (!$_SESSION['view_permission']) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/2");
            }
        }
    }

    // Logout user
    public static function logout()
    {
        session_destroy();
        header("Location:" . "/" . BASE_DIRECTORY . "/login");
    }

    // Auto logout user after a while
    public static function autoLogout()
    {
        if ((time() - $_SESSION['last_activity']) > AUTO_LOGOUT) {
            session_destroy();

            //Start session if not already started
            session_status() == PHP_SESSION_NONE ? session_start() : null;

            $_SESSION['current'] = $_SERVER['REQUEST_URI'];
            header("Location:" . "/" . BASE_DIRECTORY . "/login");
        } else {
            $_SESSION['last_activity'] = time();
        }
    }
}