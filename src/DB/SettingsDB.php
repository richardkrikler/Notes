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
            $stmt = $DB->prepare('SELECT state FROM state_settings WHERE pk_state_setting_id = :setting_id');
            $stmt->bindParam(":setting_id", $setting_id, PDO::PARAM_INT);
            $state = '';
            if ($stmt->execute()) {
                $state = $stmt->fetch()['state'];
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $state;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}