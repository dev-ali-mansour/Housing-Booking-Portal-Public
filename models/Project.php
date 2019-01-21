<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/24/2017
 * Time: 2:33 AM
 */

require_once ('Database.php');
class Project
{
    public static $errors = array();
    public static $success;

    // Add new project to database
    public static function add($name, $description, $flatCount)
    {
        try {
            $db = new Database();
            if (!empty($name) && !empty($flatCount)) {
                $flatCount = (int)$flatCount;
                $query = "CALL `sp_add_project`(:name,:description,:units)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $u_stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $u_stmt->bindParam(':units', $flatCount, PDO::PARAM_INT);
                $u_stmt->execute();
                self::$success = "تم إضافة بيانات المشروع بنجاح";
            } else {
                if (empty($fullName)) self::$errors[] = "يرجى إدخال اسم المشروع";
                if (empty($nationalId)) self::$errors[] = "يرجى إدخال عدد وحدات المشروع";;
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Update project by ID
    public static function update($id, $name, $description, $flatCount)
    {
        try {
            $db = new Database();
            if (!empty($id) && !empty($name) && !empty($flatCount)) {
                $id = (int)$id;
                $query = "CALL `sp_update_project`(:name,:description,:units,:id)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $u_stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $u_stmt->bindParam(':units', $flatCount, PDO::PARAM_INT);
                $u_stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $u_stmt->execute();
                self::$success = "تم تحديث بيانات المشروع بنجاح";
            } else {
                if (empty($id)) self::$errors[] = "لم يتم تحديد مشروع";
                if (empty($fullName)) self::$errors[] = "يرجى إدخال اسم المشروع";
                if (empty($nationalId)) self::$errors[] = "يرجى إدخال عدد وحدات المشروع";;
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Delete project by ID
    public static function delete($id)
    {
        try {
            $db = new Database();
            // Check first if that group has not any users before delete
            $query = " CALL `sp_count_project_reservations`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $projectReservations = $stmt->fetchColumn();
            if ($projectReservations == 0) {
                $query = "CALL `sp_delete_project`(:id)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                self::$success = "تم حذف بيانات المشروع بنجاح ";
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/projects/list");
            }else{
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/message/6");
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get project data by ID
    public static function findById($id)
    {
        try {
            $db = new Database();
            $id = (int)$id;
            $query = "CALL `sp_find_project_by_id`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $member = $stmt->fetch();
            return $member;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get all projects data from database
    public static function findAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_find_all_projects`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $members = $stmt->fetchAll();
            return $members;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count all projects
    public static function countAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_all_projects`()";
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

    // Get All projects data from database with pagination
    public static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $userOffset = (int)$offset;
            $db = new Database();
            $query = "CALL `sp_paginate_projects`(:perPage,:userOffset)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':userOffset', $userOffset, PDO::PARAM_INT);
            $stmt->execute();
            $members = $stmt->fetchAll();
            $db->closeConnection();
            return $members;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }
}