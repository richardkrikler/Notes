<?php

namespace RichardKrikler\CodingNotes\DB;

use PDO;
use PDOException;
use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Note\Notes;

require_once 'DB.php';

class NotesDB
{
    static function getNotesFromFolderID($folder_id): Notes
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_note_id, fk_pk_folder_id, title FROM notes WHERE fk_pk_folder_id = :folder_id');
            $stmt->bindParam(":folder_id", $folder_id, PDO::PARAM_INT);
            $notes = new Notes();
            if ($stmt->execute()) {
                while ($row = $stmt->fetch()) {
                    $notes->addNote(new Note((int)$row['pk_note_id'], (int)$row['fk_pk_folder_id'], $row['title']));
                }
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $notes;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getContentFromID($note_id): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT content FROM notes WHERE pk_note_id = :note_id');
            $stmt->bindParam(":note_id", $note_id, PDO::PARAM_INT);
            $content = '';
            if ($stmt->execute()) {
                $content = $stmt->fetch()['content'];
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $content;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}