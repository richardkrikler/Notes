<?php

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use RichardKrikler\Notes\DB\SettingsDB;
use RichardKrikler\Notes\Elements\NoteViewerNav;
use RichardKrikler\Notes\Note\Note;
use RichardKrikler\Notes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/NoteViewerNav.php';
require_once 'Note/Notes.php';
require_once 'DB/NotesDB.php';
require_once 'DB/FoldersDB.php';
require_once 'DB/SettingsDB.php';


if (!isset($_GET['note'])) {
    header('Location: index.php');
}

$note_id = $_GET['note'];
$folder = FoldersDB::getFolderFromNoteID($note_id);
$note = new Note($note_id, $folder->getPkFolderId(), NotesDB::getTitleFromID($note_id));

$note_content = NotesDB::getContentFromID($note_id);
$themeMode = SettingsDB::getStateSetting(1);
$highlightStyle = $themeMode == 1 ? 'github.css' : 'github-dark.css';
$content = <<<NOTE_CONTENT
<script src="/bower_components/showdown/index.js"></script>
<link rel="stylesheet" href="/css/$highlightStyle">
<script src="/bower_components/highlight.min/index.js"></script>

<div class="note-content container-lg pt-5 mb-5 px-3" id="note-content">
$note_content
</div>
NOTE_CONTENT;


print(SiteTemplate::render((new NoteViewerNav($folder, $note)), $content));
