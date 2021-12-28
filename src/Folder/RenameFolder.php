<?php

namespace RichardKrikler\Notes\Folder;

use RichardKrikler\Notes\DB\FoldersDB;

require_once __DIR__ . '/../DB/FoldersDB.php';

if (isset($_GET['folderId']) && isset($_GET['name'])) {
    FoldersDB::renameFolder($_GET['folderId'], $_GET['name']);
}
header('Location: /folder/' . $_GET['folderId']);
