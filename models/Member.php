<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/24/2017
 * Time: 2:33 AM
 */

require_once('Database.php');

class Member
{
    public static $errors = array();
    public static $success;

    // Add new member to database
    public static function add($fullName, $nationalId, $membership, $phone, $notes)
    {
        try {
            $db = new Database();
            if (!empty($fullName) && !empty($nationalId) && $membership != 0) {
                $query = "INSERT INTO `members` (`full_name`, `national_id`, `membership`, `telephone`, `notes`) VALUES (:fullName, :nationalId, :membership, :phone, :notes)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
                $u_stmt->bindParam(':nationalId', $nationalId, PDO::PARAM_STR);
                $u_stmt->bindParam(':membership', $membership, PDO::PARAM_INT);
                $u_stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                $u_stmt->execute();
                self::$success = "تم إضافة بيانات العضو بنجاح";
            } else {
                if (empty($fullName)) self::$errors[] = "يرجى إدخال اسم العضو بالكامل !";
                if (empty($nationalId)) self::$errors[] = "يرجى إدخال الرقم القومي للعضو !";;
                if ($membership == 0) self::$errors[] = "يرجى اختيار نوع العضوية!";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Update member by ID
    public static function update($id, $fullName, $nationalId, $membership, $phone, $notes)
    {
        try {
            $db = new Database();
            if (!empty($id) && !empty($fullName) && !empty($nationalId) && $membership != 0) {
                $id = (int)$id;
                $query = "UPDATE `members` SET `full_name` = :fullName, `national_id` = :nationalId, `membership` = :membership, `telephone` = :phone, `notes` = :notes WHERE `id` = :id";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
                $u_stmt->bindParam(':nationalId', $nationalId, PDO::PARAM_STR);
                $u_stmt->bindParam(':membership', $membership, PDO::PARAM_INT);
                $u_stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $u_stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                $u_stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $u_stmt->execute();
                self::$success = "تم تحديث بيانات العضو بنجاح";
            } else {
                if (empty($id)) self::$errors[] = "لم يتم تحديد عضو !";
                if (empty($fullName)) self::$errors[] = "يرجى إدخال اسم العضو بالكامل !";
                if (empty($nationalId)) self::$errors[] = "يرجى إدخال الرقم القومي للعضو !";
                if ($membership == 0) self::$errors[] = "يرجى اختيار نوع العضوية !";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Delete member by ID
    public static function delete($id)
    {
        try {
            $db = new Database();
            $query = "DELETE FROM `members` WHERE `id` = :id";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            self::$success = "تم حذف حساب العضو بنجاح ";
            header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/members/list");
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get member data by ID
    public static function getById($id)
    {
        try {
            $db = new Database();
            $id = (int)$id;
            $query = "SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes` FROM `members` WHERE `id` = :id";
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

    // Find members by member ID
    public static function findById($id)
    {
        try {
            $db = new Database();
            $id = (int)$id;
            $query = "SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes` FROM `members` WHERE `members`.`id` =:id ORDER BY `members`.`id`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    // Find members by full name
    public static function findByFullName($fullName)
    {
        try {
            $mFullName = "%$fullName%";
            $db = new Database();
            $query = "SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes` FROM `members` WHERE `members`.`full_name` LIKE :fullName ORDER BY `members`.`id`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':fullName', $mFullName, PDO::PARAM_STR);
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

    // Get all member data from database
    public static function findAll()
    {
        try {
            $db = new Database();
            $query = "SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes` FROM `members` ORDER BY `members`.`id`";
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

    // Count all members
    public static function countAll()
    {
        try {
            $db = new Database();
            $query = "SELECT COUNT(*) FROM `members`";
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

    // Count founder members
    public static function countFounders()
    {
        try {
            $db = new Database();
            $query = "SELECT COUNT(*) FROM `members` WHERE `membership` = 1";
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

    // Count worker members
    public static function countWorkers()
    {
        try {
            $db = new Database();
            $query = "SELECT COUNT(*) FROM `members` WHERE `membership` = 2";
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

    // Get All members data from database with pagination
    public static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $userOffset = (int)$offset;
            $db = new Database();
            $query = "SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes` FROM `members` ORDER BY `members`.`id` LIMIT :perPage OFFSET :userOffset";
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