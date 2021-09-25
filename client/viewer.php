<?php

use RichardKrikler\CodingNotes\Note\Note\Note;
use RichardKrikler\CodingNotes\Note\Note\Notes;
use RichardKrikler\CodingNotes\Template\IndexTemplate\ViewerTemplate;
use RichardKrikler\CodingNotes\DB\DB;

require_once 'Template/ViewerTemplate.php';
require_once 'Note/Notes.php';
require_once 'DB.php';


$DB = DB::getDB();

$folder_id = 0;
$note_id = 0;
if (isset($_GET['folder'])) {
    $folder_id = (int)$_GET['folder'];
} else if (isset($_GET['note'])) {
    $note_id = $_GET['note'];
    try {
        $stmt = $DB->prepare('SELECT fk_pk_folder_id FROM notes WHERE pk_note_id = :note_id');
        $stmt->bindParam(":note_id", $note_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $folder_id = $stmt->fetch();
        }

        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException  $e) {
        print('Error: ' . $e);
        exit();
    }
} else {
    header('Location: index.php');
}



$notes = new Notes();
try {
    $stmt = $DB->prepare('SELECT pk_note_id, fk_pk_folder_id, title FROM notes WHERE fk_pk_folder_id = :folder_id');
    $stmt->bindParam(":folder_id", $folder_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
            $notes->addNote(new Note((int)$row['pk_note_id'], (int)$row['fk_pk_folder_id'], $row['title']));
        }
    }

    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException  $e) {
    print('Error: ' . $e);
    exit();
}


print(ViewerTemplate::render($notes->getUnorderedListHTML()));
