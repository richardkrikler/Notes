<?php

namespace RichardKrikler\Notes;

use RichardKrikler\Notes\DB\FoldersDB;
use RichardKrikler\Notes\Elements\IndexNav;
use RichardKrikler\Notes\Template\SiteTemplate;

require_once 'DB/FoldersDB.php';
require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/IndexNav.php';


print(SiteTemplate::render(new IndexNav(), FoldersDB::getFolders()->getUnorderedListHTML()));
