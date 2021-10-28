<?php

namespace RichardKrikler\CodingNotes\Folder;

use RichardKrikler\CodingNotes\DB\FoldersDB;

require_once __DIR__ . '/../DB/FoldersDB.php';

if (isset($_GET['folder_id']) && isset($_GET['name'])) {
    FoldersDB::renameFolder($_GET['folder_id'], $_GET['name']);
}
header('Location: /notesViewer.php?folder=' . $_GET['folder_id']);
