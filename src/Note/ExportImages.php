<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\FilesDB;
use ZipArchive;

require_once __DIR__ . '/../DB/FilesDB.php';


$zipname = 'Note-Images.zip';
$zip = new ZipArchive();
$res = $zip->open($zipname, ZipArchive::CREATE);

foreach (FilesDB::getFileNames() as $fileName) {
    $zip->addFromString($fileName . '.png', FilesDB::getFile($fileName));
}

$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
