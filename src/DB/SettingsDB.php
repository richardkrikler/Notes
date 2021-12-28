<?php

namespace RichardKrikler\Notes\DB;

use PDO;
use PDOException;

require_once 'DB.php';

class SettingsDB
{
    static function getStateSetting(int $settingId): int
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT option_number FROM options_state_settings WHERE fk_pk_state_setting_id = :settingId AND active_state = true');
            $stmt->bindParam(":settingId", $settingId);
            $state = '';
            if ($stmt->execute()) {
                $state = $stmt->fetch()['option_number'];
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $state;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function updateStateSetting(int $settingId, int $optionNumber)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE options_state_settings SET active_state = false WHERE fk_pk_state_setting_id = :settingId;
                                    UPDATE options_state_settings SET active_state = true WHERE fk_pk_state_setting_id = :settingId AND option_number = :optionNumber');
            $stmt->bindParam(":settingId", $settingId);
            $stmt->bindParam(":optionNumber", $optionNumber);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getOptionsStateSetting(int $settingId): array
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT option_number, option_value, active_state FROM options_state_settings WHERE fk_pk_state_setting_id = :settingId');
            $stmt->bindParam(":settingId", $settingId);
            $options = [];

            if ($stmt->execute()) {
                while ($row = $stmt->fetch()) {
                    $options[] = [$row['option_number'], $row['option_value'], $row['active_state']];
                }
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $options;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getBooleanSetting(int $settingId): bool
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT bool FROM boolean_settings WHERE pk_boolean_setting_id = :settingId');
            $stmt->bindParam(":settingId", $settingId);
            $bool = false;
            $stmt->execute();
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                $bool = $row['bool'];
            }
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bool;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function updateBooleanSetting(int $settingId, bool $bool)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE boolean_settings SET bool = :bool WHERE pk_boolean_setting_id = :settingId');
            $stmt->bindParam(":settingId", $settingId);
            $stmt->bindParam(":bool", $bool, PDO::PARAM_BOOL);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}