<?php

namespace RichardKrikler\CodingNotes\Note;

use RichardKrikler\CodingNotes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

if (isset($_GET['folderId']) && isset($_GET['title'])) {
    NotesDB::createNote($_GET['folderId'], $_GET['title']);
    header('Location: /notesViewer.php?folder=' . $_GET['folderId']);
} else {
    header('Location: /index.php');
}
