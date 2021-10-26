<?php

namespace RichardKrikler\CodingNotes\DB;

use PDO;
use PDOException;
use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Note\Notes;

require_once __DIR__ . '/../Note/Note.php';
require_once __DIR__ . '/../Note/Notes.php';
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

    static function getTitleFromID($note_id): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT title FROM notes WHERE pk_note_id = :note_id');
            $stmt->bindParam(":note_id", $note_id, PDO::PARAM_INT);
            $title = '';
            if ($stmt->execute()) {
                $title = $stmt->fetch()['title'];
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $title;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function createNote($folder_id, $title): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO notes (fk_pk_folder_id, title, content) VALUE (:fk_pk_folder_id, :title, \'\') ');
            $stmt->bindParam(":fk_pk_folder_id", $folder_id, PDO::PARAM_INT);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}