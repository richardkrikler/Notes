<?php

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\DB\NotesDB;
use RichardKrikler\CodingNotes\DB\SettingsDB;
use RichardKrikler\CodingNotes\Elements\NoteViewerNav;
use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.js" integrity="sha512-bvV1V1YSjP1fbfKJjTlNmdnUO2XpsLYUdKwmz5UXBi5U+x40rx9JpA0ooQUMZfpz1MaaBC0ydNLoC6r0sitPUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="css/{$highlightStyle}">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script>hljs.highlightAll();</script>

<div class="note-content container-lg pt-5 mb-5 px-3" id="note-content">
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

</script>
NOTE_CONTENT;


print(SiteTemplate::render((new NoteViewerNav($folder, $note)), $content));
