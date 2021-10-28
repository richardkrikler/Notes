<?php

namespace RichardKrikler\CodingNotes\Folder;

use RichardKrikler\CodingNotes\DB\FoldersDB;

require_once __DIR__ . '/../DB/FoldersDB.php';

if (isset($_GET['name'])) {
    FoldersDB::createFolder($_GET['name']);
}
header('Location: /index.php');
