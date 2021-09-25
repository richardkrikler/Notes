<?php

namespace RichardKrikler\CodingNotes;

use PDO;
use PDOException;
use RichardKrikler\CodingNotes\DB\DB;
use RichardKrikler\CodingNotes\Folder\Folder\Folder;
use RichardKrikler\CodingNotes\Folder\Folders\Folders;
use RichardKrikler\CodingNotes\Template\IndexTemplate\IndexTemplate;

require_once 'Folder/Folder.php';
require_once 'Folder/Folders.php';
require_once 'Template/IndexTemplate.php';
require_once 'DB.php';

$DB = DB::getDB();

$folders = new Folders();
try {
    $stmt = $DB->prepare('SELECT pk_folder_id, name FROM folders');
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
            $folders->addFolder(new Folder((int)$row['pk_folder_id'], $row['name']));
        }
    }

    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException  $e) {
    print('Error: ' . $e);
    exit();
}


print(IndexTemplate::render($folders->getUnorderedListHTML()));


