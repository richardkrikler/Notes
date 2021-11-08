<?php

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use RichardKrikler\Notes\Note\Note;

require_once 'Note/Notes.php';
require_once 'DB/NotesDB.php';
require_once 'DB/FoldersDB.php';


$note_id = $_GET['note'];
$folder = FoldersDB::getFolderFromNoteID($note_id);
$note = new Note($note_id, $folder->getPkFolderId(), NotesDB::getTitleFromID($note_id));
$note_content = NotesDB::getContentFromID($note_id);

$file = $note->getName();

header("Content-Type: text/markdown");
header('Content-Disposition: attachment; filename="' . $note->getName() . '.md"');

print($note_content);

