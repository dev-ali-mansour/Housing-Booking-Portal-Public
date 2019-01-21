<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/24/2017
 * Time: 2:33 AM
 */

require_once('Database.php');
class Reservation
{
    public static $errors = array();
    public static $success;

    // Add new user group to database
    public static function add($memberId, $projectId, $buildingNo, $floorNo, $flatNo, $area, $notes)
    {
        try {
            $db = new Database();
            if ($projectId != 0) {
                $query = "CALL `sp_count_project_unreserved_flats`(:projectId)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                $stmt->execute();
                $available = $stmt->fetchColumn();
                if (!empty($memberId) && $memberId != 0 && $available > 0) {
                    $query = "CALL `sp_add_reservation`(:memberId,:projectId, :buildingNo,:floorNo,:flatNo,:area,:notes)";
                    $stmt = $db->getConnection()->prepare($query);
                    $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
                    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                    $stmt->bindParam(':buildingNo', $buildingNo, PDO::PARAM_STR);
                    $stmt->bindParam(':floorNo', $floorNo, PDO::PARAM_INT);
                    $stmt->bindParam(':flatNo', $flatNo, PDO::PARAM_INT);
                    $stmt->bindParam(':area', $area, PDO::PARAM_STR);
                    $stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                    $stmt->execute();
                    self::$success = "تم إضافة بيانات حجز الوحدة السكنية بنجاح";
                } else {
                    if (empty($memberId) || $memberId == 0) self::$errors[] = "عفواً لم يتم اختيار عضو !";
                    if ($available == 0) self::$errors[] = "عفواً لا يوجد وحدات متاحة ضمن هذا المشروع !";
                }
            } else {
                if ($projectId == 0) self::$errors[] = "عفواً لم يتم اختيار مشروع !";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Update reservation by ID
    public
    static function update($id, $memberId, $projectId, $buildingNo, $floorNo, $flatNo, $area, $notes)
    {
        try {
            $db = new Database();
            if ($projectId != 0) {
                $query = "CALL `sp_count_project_unreserved_flats`(:projectId)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                $stmt->execute();
                $available = $stmt->fetchColumn();
                if (!empty($memberId) && $memberId != 0 && $available > 0) {
                    $query = "CALL `sp_update_reservation`(:id, :memberId,:projectId, :buildingNo,:floorNo,:flatNo,:area,:notes)";
                    $stmt = $db->getConnection()->prepare($query);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
                    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                    $stmt->bindParam(':buildingNo', $buildingNo, PDO::PARAM_STR);
                    $stmt->bindParam(':floorNo', $floorNo, PDO::PARAM_INT);
                    $stmt->bindParam(':flatNo', $flatNo, PDO::PARAM_INT);
                    $stmt->bindParam(':area', $area, PDO::PARAM_STR);
                    $stmt->bindParam(':notes', $notes, PDO::PARAM_STR);
                    $stmt->execute();
                    self::$success = "تم تحديث بيانات حجز الوحدة السكنية بنجاح";
                } else {
                    if (empty($memberId) || $memberId == 0) self::$errors[] = "عفواً لم يتم اختيار عضو !";
                    if ($available == 0) self::$errors[] = "عفواً لا يوجد وحدات متاحة ضمن هذا المشروع !";
                }
            } else {
                if ($projectId == 0) self::$errors[] = "عفواً لم يتم اختيار مشروع !";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Delete user group by ID
    public
    static function delete($id)
    {
        try {
            $db = new Database();
            $query = "CALL `sp_delete_reservation`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/reservation/flats/list");
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Get reservation data by ID
    public
    static function findById($id)
    {
        try {
            $id = (int)$id;
            $db = new Database();
            $query = "CALL `sp_find_reservation_by_id`(:id)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $reservation = $stmt->fetch();
            return $reservation;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Get all reservations data from database
    public
    static function findAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_find_all_reservations`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $reservations = $stmt->fetchAll();
            return $reservations;

        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Count all reservations
    public
    static function countAll()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_all_reservations`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $db->closeConnection();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Count all flats
    public
    static function countAllFlats()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_all_flats`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $db->closeConnection();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Count reserved flats
    public
    static function countReservedFlats()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_reserved_flats`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $db->closeConnection();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Count unreserved flats
    public
    static function countUnReservedFlats()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_count_unreserved_flats`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $db->closeConnection();
            return $count;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

// Get all reservations data from database with pagination
    public
    static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $reservOffset = (int)$offset;
            $db = new Database();
            $query = "CALL `sp_paginate_reservations`(:perPage,:reservOffset)";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':reservOffset', $reservOffset, PDO::PARAM_INT);
            $stmt->execute();
            $reservations = $stmt->fetchAll();
            return $reservations;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }
}