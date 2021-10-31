<?php

namespace RichardKrikler\CodingNotes\DB;

use PDO;
use PDOException;

require_once 'DB.php';

class SettingsDB
{
    static function getStateSetting($setting_id): int
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT option_number FROM options_state_settings WHERE fk_pk_state_setting_id = :setting_id AND active_state = true');
            $stmt->bindParam(":setting_id", $setting_id, PDO::PARAM_INT);
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
}