<?php

namespace RichardKrikler\CodingNotes;

use RichardKrikler\CodingNotes\DB\FoldersDB;
use RichardKrikler\CodingNotes\Template\IndexTemplate;

require_once 'DB/FoldersDB.php';
require_once 'Template/IndexTemplate.php';

print(IndexTemplate::render(FoldersDB::getFolders()->getUnorderedListHTML()));
