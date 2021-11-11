<?php

use RichardKrikler\Notes\DB\SettingsDB;

require_once __DIR__ . '/../DB/SettingsDB.php';

$json_data = file_get_contents('php://input');
$obj = json_decode($json_data);

SettingsDB::updateStateSetting($obj->settingId, $obj->optionNumber);