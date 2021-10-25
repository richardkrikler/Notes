<?php

namespace RichardKrikler\CodingNotes;

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\Elements\NavElement;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

require_once 'DB/FoldersDB.php';
require_once 'Template/SiteTemplate.php';
require_once 'Elements/NavElement.php';


print(SiteTemplate::render(new NavElement(), FoldersDB::getFolders()->getUnorderedListHTML()));
