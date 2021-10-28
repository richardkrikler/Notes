<?php

namespace RichardKrikler\CodingNotes\Note;

use RichardKrikler\CodingNotes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

if (isset($_GET['note']) && isset($_GET['content'])) {
    NotesDB::saveNote($_GET['note'], $_GET['content']);
    header('Location: /noteEditor.php?note=' . $_GET['note']);
} else {
    header('Location: /index.php');
}
