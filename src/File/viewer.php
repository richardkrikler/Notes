<?php

namespace RichardKrikler\Notes\File;

use RichardKrikler\Notes\DB\FilesDB;

require_once __DIR__ . '/../DB/FilesDB.php';


if (isset($_GET['name'])) {
    $data = FilesDB::getFile($_GET['name']);
    $f = finfo_open();
    $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
    header('Content-type: ' . $mime_type);
    $encoded = base64_encode($data);
    echo file_get_contents('data:' . $mime_type . ';base64,' . $encoded);
}
