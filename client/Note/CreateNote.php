<?php

namespace RichardKrikler\CodingNotes\Note;

use RichardKrikler\CodingNotes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

if (isset($_GET['folder_id']) && isset($_GET['title'])) {
    NotesDB::createNote($_GET['folder_id'], $_GET['title']);
    header('Location: /notesViewer.php?folder=' . $_GET['folder_id']);
} else {
    header('Location: /index.php');
}
