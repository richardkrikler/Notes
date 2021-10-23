<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\Folder\Folder;

require_once 'SiteTemplate.php';
require_once 'NavElement.php';
require_once __DIR__ . '/../Folder/Folder.php';

class NotesViewerTemplate
{
    static function render(Folder $folder, string $content): string
    {
        $nav = (new NavElement())->setFolder($folder);
        return SiteTemplate::render($nav, $content);
    }
}




