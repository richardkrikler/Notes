<?php

namespace RichardKrikler\CodingNotes\File;

use RichardKrikler\CodingNotes\DB\FilesDB;

require_once __DIR__ . '/../DB/FilesDB.php';

$json_data = file_get_contents('php://input');
$obj = json_decode($json_data);
$data = base64_decode($obj->data);

FilesDB::createFile($obj->name, $data);