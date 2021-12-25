<?php

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\DB\NotesDB;
use RichardKrikler\Notes\Note\Note;

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
<link rel="stylesheet" href="/css/style.css">
<link href="/bower_components/bootstrap-css/index.css" rel="stylesheet">
<script src="/bower_components/bootstrap-js/index.js"></script>
<script src="/bower_components/highlight.min/index.js"></script>
<link rel="stylesheet" href="/css/github.css">
<script src="/bower_components/showdown/index.js"></script>
<script>hljs.highlightAll();</script>

<title>{$note->getName()}</title>
<div class="note-content" id="note-content">
{$note_content}
</div>
<script>
showdown.setFlavor('github')
showdown.setOption('simplifiedAutoLink', true)
showdown.setOption('tables', true)
showdown.setOption('ghMentions', true)
showdown.setOption('tasklists', true)

function unescapeHTML(text) {
    return text.replace( /&amp;/g, "&" )
	    .replace( /&lt;/g, "<" )
		.replace( /&gt;/g, ">" )
		.replace( /&quot;/g, "\"" )
		.replace( /&#39;/g, "'" )
}

const noteContentElement = document.getElementById('note-content')
const converter = new showdown.Converter()
noteContentElement.innerHTML = converter.makeHtml(unescapeHTML(noteContentElement.innerHTML))

window.print()
</script>
<style>
pre {
    margin: 0 2px;
}
</style>
NOTE_CONTENT;

print($content);
