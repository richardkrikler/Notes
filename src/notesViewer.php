<?php

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use RichardKrikler\Notes\Elements\NotesViewerNav;
use RichardKrikler\Notes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/NotesViewerNav.php';
require_once 'DB/NotesDB.php';
require_once 'DB/FoldersDB.php';


if (!isset($_GET['folder'])) {
    header('Location: index.php');
}

$folder = FoldersDB::getFolderFromID($_GET['folder']);

$content = NotesDB::getNotesFromFolderID($folder->getPkFolderId())->getUnorderedListHTML();

print(SiteTemplate::render((new NotesViewerNav($folder)), $content));
