<?php

namespace RichardKrikler\CodingNotes\DB;

use PDO;
use PDOException;

require_once 'DB.php';

class SettingsDB
{
    static function getStateSetting($settingId): int
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT option_number FROM options_state_settings WHERE fk_pk_state_setting_id = :settingId AND active_state = true');
            $stmt->bindParam(":settingId", $settingId, PDO::PARAM_INT);
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

    static function updateStateSetting($settingId, $optionNumber)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE options_state_settings SET active_state = false WHERE fk_pk_state_setting_id = :settingId;
                                    UPDATE options_state_settings SET active_state = true WHERE fk_pk_state_setting_id = :settingId AND option_number = :optionNumber');
            $stmt->bindParam(":settingId", $settingId, PDO::PARAM_INT);
            $stmt->bindParam(":optionNumber", $optionNumber, PDO::PARAM_INT);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getOptionsStateSetting($settingId): array
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT option_number, option_value, active_state FROM options_state_settings WHERE fk_pk_state_setting_id = :settingId');
            $stmt->bindParam(":settingId", $settingId, PDO::PARAM_INT);
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
}