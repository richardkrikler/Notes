<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\Note\Note;

require_once 'SiteTemplate.php';
require_once __DIR__ . '/../Folder/Folder.php';
require_once __DIR__ . '/../Note/Note.php';

class NoteViewerTemplate
{
    static function render(Folder $folder, Note $note, string $content): string
    {
        $nav = (new NavElement())->setFolderAndNote($folder, $note);
        return SiteTemplate::render($nav, $content);
    }
}




