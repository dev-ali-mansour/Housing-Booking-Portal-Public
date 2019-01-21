<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/24/2017
 * Time: 2:33 AM
 */

require_once('Database.php');

class Deposit
{
    public static $errors = array();
    public static $success;

    // Add new deposit to database
    public static function add($memberId, $projectId, $bankDate, $bankNo, $pre, $monthly, $quarterly, $semi_annual, $annual, $contract, $allocation, $receipt, $total, $description)
    {
        try {
            $db = new Database();
            if ($memberId != 0 && $projectId != 0 && !empty($memberId) && $total != 0) {
                $depositId = self::getDepositNo();
                $date = (new DateTime())->format('Y-m-d');
                $bankDate = date('Y-m-d', strtotime($bankDate));
                $query = "CALL `sp_add_deposit`(:depositId,:memberId, :projectId, :date,:bankDate,:bankNo,:pre,:monthly,:quarterly,:semi_annual,:annual,:contract,:allocation,:receipt,:description)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':depositId', $depositId, PDO::PARAM_INT);
                $stmt->bindParam(':memberId', $memberId, PDO::PARAM_STR);
                $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':bankDate', $bankDate, PDO::PARAM_STR);
                $stmt->bindParam(':bankNo', $bankNo, PDO::PARAM_STR);
                $stmt->bindParam(':pre', $pre, PDO::PARAM_STR);
                $stmt->bindParam(':monthly', $monthly, PDO::PARAM_STR);
                $stmt->bindParam(':quarterly', $quarterly, PDO::PARAM_STR);
                $stmt->bindParam(':semi_annual', $semi_annual, PDO::PARAM_STR);
                $stmt->bindParam(':annual', $annual, PDO::PARAM_STR);
                $stmt->bindParam(':contract', $contract, PDO::PARAM_STR);
                $stmt->bindParam(':allocation', $allocation, PDO::PARAM_STR);
                $stmt->bindParam(':receipt', $receipt, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['deposit_id'] = $depositId;
                // Redirect to view deposit page to print it
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/print");
            } else {
                if ($memberId == 0 || empty($memberId)) self::$errors[] = "عفواً لم يتم اختيار عضو!";
                if ($projectId == 0 || !empty($projectId)) self::$errors[] = "عفواً لم يتم اختيار مشروع!";
                if ($total == 0) self::$errors[] = "عفواً لم يتم تحديد قيمة الإيداع النقدي!";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get the max deposit id from database and increment to set the current deposit id
    private static function getDepositNo()
    {
        try {
            $db = new Database();
            $query = "SELECT MAX(`id`) FROM `deposits`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $lastId = $stmt->fetchColumn();
            return $lastId + 1;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Update deposit data by ID
    public static function update($depositId, $memberId, $projectId, $bankDate, $bankNo, $pre, $monthly, $quarterly, $semi_annual, $annual, $contract, $allocation, $receipt, $total, $description)
    {
        try {
            $db = new Database();
            if ($memberId != 0 && $projectId != 0 && !empty($memberId) && $total != 0) {
                $date = (new DateTime())->format('Y-m-d');
                $query = "CALL `sp_update_deposit`(:depositId, :memberId, :projectId, :date,:bankDate,:bankNo,:pre,:monthly,:quarterly,:semi_annual,:annual,:contract,:allocation,:receipt,:description)";
                $stmt = $db->getConnection()->prepare($query);
                $stmt->bindParam(':depositId', $depositId, PDO::PARAM_INT);
                $stmt->bindParam(':memberId', $memberId, PDO::PARAM_STR);
                $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':bankDate', $bankDate, PDO::PARAM_STR);
                $stmt->bindParam(':bankNo', $bankNo, PDO::PARAM_STR);
                $stmt->bindParam(':pre', $pre, PDO::PARAM_STR);
                $stmt->bindParam(':monthly', $monthly, PDO::PARAM_STR);
                $stmt->bindParam(':quarterly', $quarterly, PDO::PARAM_STR);
                $stmt->bindParam(':semi_annual', $semi_annual, PDO::PARAM_STR);
                $stmt->bindParam(':annual', $annual, PDO::PARAM_STR);
                $stmt->bindParam(':contract', $contract, PDO::PARAM_STR);
                $stmt->bindParam(':allocation', $allocation, PDO::PARAM_STR);
                $stmt->bindParam(':receipt', $receipt, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['deposit_id'] = $depositId;
                // Redirect to view deposit page to print it
                header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/print");
            } else {
                if ($memberId == 0 || empty($memberId)) self::$errors[] = "عفواً لم يتم اختيار عضو!";
                if ($projectId == 0 || !empty($projectId)) self::$errors[] = "عفواً لم يتم اختيار مشروع!";
                if ($total == 0) self::$errors[] = "عفواً لم يتم تحديد قيمة الإيداع النقدي!";
            }

        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Delete deposit by ID
    public static function delete($id)
    {
        try {
            $db = new Database();
            $query = "DELETE FROM `deposits` WHERE `id` = :id";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location:" . "/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/deposits/list");
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get deposit data by ID for editing
    public static function findById($id)
    {
        try {
            $id = (int)$id;
            $db = new Database();
            $query = "SELECT `deposits`.`member_id`, `deposits`.`project_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d') AS 'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre` + `deposits`.`monthly` + `deposits`.`quarterly` + `deposits`.`semi_annual` + `deposits`.`annual` + `deposits`.`contract` + `deposits`.`allocation` + `deposits`.`receipt`) AS 'total', `deposits`.`description` FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` WHERE `deposits`.`id` = :id";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $deposit = $stmt->fetch();
            return $deposit;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get deposit data by ID for printing
    public static function viewById($id)
    {
        try {
            $id = (int)$id;
            $db = new Database();
            $query = "SELECT `deposits`.`member_id`, `projects`.`name` AS `project_name`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d') AS 'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre` + `deposits`.`monthly` + `deposits`.`quarterly` + `deposits`.`semi_annual` + `deposits`.`annual` + `deposits`.`contract` + `deposits`.`allocation` + `deposits`.`receipt`) AS 'total', `deposits`.`description` FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` INNER JOIN `projects` ON `deposits`.`project_id` = `projects`.`id` WHERE `deposits`.`id` = :id";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $deposit = $stmt->fetch();
            return $deposit;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get all deposits data from database
    public static function findAll()
    {
        try {
            $db = new Database();
            $query = "SELECT `deposits`.`id`, `deposits`.`member_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d') AS 'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre` + `deposits`.`monthly` + `deposits`.`quarterly` + `deposits`.`semi_annual` + `deposits`.`annual` + `deposits`.`contract` + `deposits`.`allocation` + `deposits`.`receipt`) AS 'total', `deposits`.`description` FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` GROUP BY `deposits`.`id` ORDER BY `deposits`.`id`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $deposits = $stmt->fetchAll();
            return $deposits;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get member deposits by member id
    public static function findMemberDeposits($memberId)
    {
        try {
            $memberId = (int)$memberId;
            $db = new Database();

            $query = "SELECT `deposits`.`id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS 'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, SUM(`deposits`.`pre` + `deposits`.`monthly` + `deposits`.`quarterly` + `deposits`.`semi_annual` + `deposits`.`annual` + `deposits`.`contract` + `deposits`.`allocation`+`deposits`.`receipt`) AS 'total', `deposits`.`description` FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` WHERE `deposits`.`member_id` = :memberId GROUP BY `deposits`.`id` ORDER BY `deposits`.`id`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
            $stmt->execute();
            $deposits = $stmt->fetchAll();
            return $deposits;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get member deposits statistics by member id
    public static function getMemberDepositsStatistics($memberId)
    {
        try {
            $memberId = (int)$memberId;
            $db = new Database();
            $query = "SELECT `members`.`full_name`, SUM(`pre`) AS `pre`, SUM( `monthly`) AS `monthly`, SUM( `quarterly`) AS `quarterly`, SUM( `semi_annual`) AS `semi_annual`, SUM(`annual`)      AS `annual`, SUM( `contract`)    AS `contract`, SUM( `allocation`)  AS `allocation`, SUM( `receipt`)     AS `receipt`, SUM(`pre` + `monthly` + `quarterly` + `semi_annual` + `annual` + `contract` + `allocation` + `receipt`) AS 'total' FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` WHERE `deposits`.`member_id` = :memberId";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
            $stmt->execute();
            $statistics = $stmt->fetch();
            return $statistics;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Count all deposits
    public static function countAll()
    {
        try {
            $db = new Database();
            $query = "SELECT COUNT(*) FROM `deposits`";
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

    // Get deposits amounts statistics
    public static function getStatistics()
    {
        try {
            $db = new Database();
            $query = "SELECT SUM(`pre`)     AS `pre`, SUM( `monthly`) AS `monthly`, SUM( `quarterly`) AS `quarterly`, SUM( `semi_annual`) AS `semi_annual`, SUM(`annual`)  AS `annual`, SUM( `contract`) AS `contract`, SUM( `allocation`) AS `allocation`, SUM( `receipt`) AS `receipt`, SUM(`pre` + `monthly` + `quarterly` + `semi_annual` + `annual` + `contract` + `allocation` + `receipt`) AS 'total' FROM `deposits`";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $statistics = $stmt->fetch();
            return $statistics;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Get All deposits data from database with pagination
    public static function paginateAll($offset)
    {
        try {
            $perPage = (int)MAX_RECORDS;
            $deprOffset = (int)$offset;
            $db = new Database();
            $query = "SELECT `deposits`.`id`, `deposits`.`member_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d') AS 'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre` + `deposits`.`monthly` + `deposits`.`quarterly` + `deposits`.`semi_annual` + `deposits`.`annual` + `deposits`.`contract` + `deposits`.`allocation` + `deposits`.`receipt`) AS 'total', `deposits`.`description` FROM `deposits` INNER JOIN `members` ON `deposits`.`member_id` = `members`.`id` GROUP BY `deposits`.`id` ORDER BY `deposits`.`id` DESC LIMIT :perPage OFFSET :deprOffset";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':deprOffset', $deprOffset, PDO::PARAM_INT);
            $stmt->execute();
            $deposits = $stmt->fetchAll();
            return $deposits;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }
}