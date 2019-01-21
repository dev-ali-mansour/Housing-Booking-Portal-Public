<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/24/2017
 * Time: 2:57 AM
 */

require_once('Database.php');
class Settings
{
    public static $success;
    public static $errors = array();

    // Get site settings from database
    public static function getSettings()
    {
        try {
            $db = new Database();
            $query = "CALL `sp_get_settings`()";
            $stmt = $db->getConnection()->prepare($query);
            $stmt->execute();
            $admin = $stmt->fetch();
            return $admin;
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // update site settings
    public static function updateSettings($siteName, $description, $keywords, $email, $isActive)
    {
        try {
            if (!empty($siteName) && !empty($description) && !empty($keywords) && !empty($email)) {
                // Check if user password was updated or not
                $db = new Database();
                $query = "CALL `sp_update_settings`(:siteName,:description,:keywords,:email,:status)";
                $u_stmt = $db->getConnection()->prepare($query);
                $u_stmt->bindParam(':siteName', $siteName, PDO::PARAM_STR);
                $u_stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $u_stmt->bindParam(':keywords', $keywords, PDO::PARAM_STR);
                $u_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $u_stmt->bindParam(':status', $isActive, PDO::PARAM_INT);
                $u_stmt->execute();
                self::$success = "تم تحديث بيانات الحساب بنجاح";
            } else {
                if (empty($siteName)) self::$errors[] = "يرجى إدخال اسم الموقع";
                if (empty($description)) self::$errors[] = "يرجى إدخال وصف الموقع";
                if (empty($keywords)) self::$errors[] = "يرجى إدخال الكلمات الدلالية للموقع";
                if (empty($email)) self::$errors[] = "يرجى إدخال البريد الإلكتروني";
            }
        } catch (Exception $e) {
            self::$errors[] = $e->getMessage();
        } finally {
            if (isset($db)) $db->closeConnection();
        }
    }

    // Backup database
    public static function backupDatabase()
    {
        $date = (new DateTime())->format('d-m-Y');
        $mysqldump = 'C:\xampp\mysql\bin\mysqldump.exe';
        $location = $_SERVER['DOCUMENT_ROOT'] . '\\'.BASE_DIRECTORY.'\backup';
        $fileName = "backup-assoc-$date.sql";
        exec($mysqldump . ' --host=' . DB_SERVER . ' --port=3306 --user=' . DB_USER . ' --password=' . DB_PASS . ' ' . DB_NAME . ' -R > ' . $location . '\\' . $fileName);
        // Download backup file
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"" . basename($fileName) . "\";");
        readfile($location . '\\' . $fileName);
    }

    // Auto backup database
    public static function autoBackupDatabase()
    {
        $date = (new DateTime())->format('d-m-Y');
        $mysqldump = 'C:\xampp\mysql\bin\mysqldump.exe';
        $location = 'C:\xampp\htdocs\Housing\backup';
        $fileName = "auto-backup-assoc-$date.sql";
        exec($mysqldump . ' --host=' . DB_SERVER . ' --port=3306 --user=' . DB_USER . ' --password=' . DB_PASS . ' ' . DB_NAME . ' -R > ' . $location . '\\' . $fileName);
    }

}