<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Template\NoteViewerTemplate;

require_once 'Template/NoteViewerTemplate.php';
require_once 'Template/NavElement.php';
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
<script>
showdown.setFlavor('github');
const converter = new showdown.Converter({simplifiedAutoLink: true, tables: true}),
    text      = `{$note_content}`,
    html      = converter.makeHtml(text)
document.write(html)
</script>
NOTE_CONTENT;

print(NoteViewerTemplate::render($folder, $note, $content));
