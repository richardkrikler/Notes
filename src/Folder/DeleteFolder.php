<?php

namespace RichardKrikler\Notes\Folder;

use RichardKrikler\Notes\DB\FoldersDB;

require_once __DIR__ . '/../DB/FoldersDB.php';

if (isset($_GET['folderId'])) {
    FoldersDB::deleteFolder($_GET['folderId']);
}
header('Location: /index.php');
