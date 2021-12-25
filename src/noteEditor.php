<?php

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use RichardKrikler\Notes\Elements\NoteEditorNav;
use RichardKrikler\Notes\Note\Note;
use RichardKrikler\Notes\Template\SiteTemplate;

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
<textarea id="content-textarea" name="content" class="editor-area container-lg h-100 px-3 py-5 border-0" placeholder="Start writing..." onkeydown="editorHelper(event)">$note_content</textarea>
NOTE_CONTENT;

print(SiteTemplate::render((new NoteEditorNav($folder, $note)), $content));

