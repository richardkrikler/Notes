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
    static function getNotesFromFolderID($folderId): Notes
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_note_id, fk_pk_folder_id, title FROM notes WHERE fk_pk_folder_id = :folderId');
            $stmt->bindParam(":folderId", $folderId, PDO::PARAM_INT);
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

    static function getContentFromID($noteId): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT content FROM notes WHERE pk_note_id = :noteId');
            $stmt->bindParam(":noteId", $noteId, PDO::PARAM_INT);
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

    static function getTitleFromID($noteId): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT title FROM notes WHERE pk_note_id = :noteId');
            $stmt->bindParam(":noteId", $noteId, PDO::PARAM_INT);
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

    static function createNote($folderId, $title): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO notes (fk_pk_folder_id, title, content) VALUE (:fkPkFolderId, :title, \'\') ');
            $stmt->bindParam(":fkPkFolderId", $folderId, PDO::PARAM_INT);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function saveNote($noteId, $content): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE notes SET content = :content WHERE pk_note_id = :pkNoteId');
            $stmt->bindParam(":pkNoteId", $noteId, PDO::PARAM_INT);
            $stmt->bindParam(":content", $content);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}