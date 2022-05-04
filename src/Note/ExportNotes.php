<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use ZipArchive;

require_once __DIR__ . '/../DB/NotesDB.php';
require_once __DIR__ . '/../DB/FoldersDB.php';


$zipname = 'Notes.zip';
$zip = new ZipArchive();
$res = $zip->open($zipname, ZipArchive::CREATE);

foreach (FoldersDB::getFolders()->getFolders() as $folder) {
    foreach (NotesDB::getNotesFromFolderID($folder->getPkFolderId())->getNotes() as $note) {
        $zip->addFromString($folder->getName() . '/' . $note->getName() . '.md', NotesDB::getContentFromID($note->getPkNoteId()));
    }
}

$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
