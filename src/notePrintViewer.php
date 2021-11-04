<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\Note\Note;

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
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.js" integrity="sha512-bvV1V1YSjP1fbfKJjTlNmdnUO2XpsLYUdKwmz5UXBi5U+x40rx9JpA0ooQUMZfpz1MaaBC0ydNLoC6r0sitPUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="css/github.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
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
