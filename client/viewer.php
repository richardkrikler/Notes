<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\Template\ViewerTemplate;
use RichardKrikler\CodingNotes\DB\DB;

require_once 'Template/ViewerTemplate.php';
require_once 'Note/Notes.php';
require_once 'DB/FoldersDB.php';
require_once 'DB/NotesDB.php';


$DB = DB::getDB();

$note_id = 0;
$folder = new Folder();
if (isset($_GET['folder'])) {
    $folder = FoldersDB::getFolderFromID($_GET['folder']);
} else if (isset($_GET['note'])) {
    $note_id = $_GET['note'];
    $folder = FoldersDB::getFolderFromNoteID($note_id);

} else {
    header('Location: index.php');
}

$notes = NotesDB::getNotesFromFolderID($folder->getPkFolderId())->getUnorderedListHTML();


$main = $notes;
if ($note_id > 0) {
    $main .= '<div id="content"></div>';
    $main .= '<script>document.getElementById("content").innerHTML = marked("' . NotesDB::getContentFromID($note_id) . '")</script>';
}

print(ViewerTemplate::render($main, $folder->getName()));
