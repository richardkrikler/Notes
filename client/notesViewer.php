<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\Template\NavElement;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Template/NavElement.php';
require_once 'Note/Notes.php';
require_once 'DB/NotesDB.php';
require_once 'DB/FoldersDB.php';


if (!isset($_GET['folder'])) {
    header('Location: index.php');
}

$folder = FoldersDB::getFolderFromID($_GET['folder']);

$content = NotesDB::getNotesFromFolderID($folder->getPkFolderId())->getUnorderedListHTML();

print(SiteTemplate::render((new NavElement())->setFolder($folder), $content));
