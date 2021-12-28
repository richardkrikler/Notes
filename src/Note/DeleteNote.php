<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

if (isset($_GET['noteId']) && isset($_GET['folderId'])) {
    NotesDB::deleteNote($_GET['noteId']);
    header('Location: /folder/' . $_GET['folderId']);
} else {
    header('Location: /index.php');
}
