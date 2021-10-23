<?php

namespace RichardKrikler\CodingNotes\Template;

require_once 'SiteTemplate.php';
require_once 'NavElement.php';

class IndexTemplate
{
    static function render(string $content): string
    {
        return SiteTemplate::render(new NavElement(), $content);
    }
}




