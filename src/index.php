<?php

namespace RichardKrikler\CodingNotes;

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\Elements\IndexNav;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

require_once 'DB/FoldersDB.php';
require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/IndexNav.php';


print(SiteTemplate::render(new IndexNav(), FoldersDB::getFolders()->getUnorderedListHTML()));
