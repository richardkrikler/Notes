<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\Elements\NoteEditorNav;
use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/NoteEditorNav.php';
require_once 'Note/Notes.php';
require_once 'DB/NotesDB.php';
require_once 'DB/FoldersDB.php';


if (!isset($_GET['note'])) {
    header('Location: index.php');
}

$note_id = $_GET['note'];
$folder = FoldersDB::getFolderFromNoteID($note_id);
$note = new Note($note_id, $folder->getPkFolderId(), NotesDB::getTitleFromID($note_id));

$note_content = NotesDB::getContentFromID($note_id);
$content = <<<NOTE_CONTENT
<textarea class="editor-area container-lg h-100 px-3 pt-4 border-0">{$note_content}</textarea>
NOTE_CONTENT;

print(SiteTemplate::render((new NoteEditorNav($folder, $note)), $content));

