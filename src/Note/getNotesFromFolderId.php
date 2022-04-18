<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';


if (isset($_GET['folderId'])) {
    print(json_encode(NotesDB::getNotesFromFolderID($_GET['folderId'])));
}
