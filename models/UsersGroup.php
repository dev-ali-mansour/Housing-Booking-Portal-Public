<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/21/2017
 * Time: 10:15 PM
 */

require_once('Database.php');

class UsersGroup
{
    public static $errors = array();
    public static $success;

    // Add new users group to database
    public static function add($group_name, $admin_permission, $add_permission, $update_permission, $view_permission, $notes)
    {
        try {
            if (!empty($group_name)) {
                $db = new Database();
                $query = "CALL `sp_add_users_group`(:group_name, :admin_permission, :add_permission, :update_permission, :view_permission, :notes)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':group_name', $group_name, PDO::PARAM_STR);
                $u_stmt->bindParam(':admin_permission', $admin_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':add_permission', $add_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':update_permission', $update_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':view_permission', $view_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                $u_stmt->execute();
                self::$success = "تم إضافة مجموعة المستخدمين بنجاح";
            } else {
                if (empty($group_name)) self::$errors[] = "يرجى إدخال اسم مجموعة المستخدمين";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Update users group by ID
    public static function update($id, $group_name, $admin_permission, $add_permission, $update_permission, $view_permission, $notes)
    {
        try {
            if (!empty($group_name)) {
                $db = new Database();
                $query = " CALL `sp_update_users_group`(:group_name, :admin_permission, :add_permission, :update_permission, :view_permission, :notes, :id)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':group_name', $group_name, PDO::PARAM_STR);
                $u_stmt->bindParam(':admin_permission', $admin_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':add_permission', $add_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':update_permission', $update_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':view_permission', $view_permission, PDO::PARAM_INT);
                $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                $u_stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $u_stmt->execute();
                self::$success = "تم تحديث بيانات مجموعة المستخدمين بنجاح";
            } else {
                if (empty($group_name)) self::$errors[] = "يرجى إدخال اسم مجموعة المستخدمين";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Delete users group by ID
    public static function delete($id)
    {
        try {
            if ($id == 1 || $id == 2 || $id == 3 || $id == 4) {
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/4");
            } else {
                $db = new Database();
                // Check first if that group has not any users before delete
                $query = " CALL `sp_count_group_users`(:id)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $groupUsers = $stmt->fetchColumn();
                if ($groupUsers == 0) {
                    $query = "CALL `sp_delete_users_group`(:id)";
                    $stmt = $db->getConnection()->prepare($query);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    self::$success = "تم حذف مجموعة المستخدمين بنجاح ";
                    header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/user-groups/list");
                } else {
                    header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/5");
                }
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get users group data by ID
    public static function findById($id)
    {
        try {
            $db = new Database();
            $query = "CALL `sp_find_users_group_by_id`(:id)";
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

    // Get all users groups data from database
    public static function findAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_find_all_users_groups`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $groups = $stmt->fetchAll();
            return $groups;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count all users groups
    public static function countAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_all_users_groups`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $groups = $stmt->fetchColumn();
            return $groups;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get All users groups data from database with pagination
    public static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $gOffset = (int)$offset;
            $db = new Database();
            $query = "CALL `sp_paginate_users_groups`(:perPage, :gOffset)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':gOffset', $gOffset, PDO::PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }
}