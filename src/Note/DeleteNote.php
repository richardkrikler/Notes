<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

if (isset($_GET['folderId']) && isset($_GET['noteId'])) {
    NotesDB::deleteNote($_GET['noteId']);
    header('Location: /folder/' . $_GET['folderId']);
} else {
    header('Location: /index.php');
}
