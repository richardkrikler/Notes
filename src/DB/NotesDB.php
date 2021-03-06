<?php

namespace RichardKrikler\Notes\DB;

use PDO;
use PDOException;
use RichardKrikler\Notes\Note\Note;
use RichardKrikler\Notes\Note\Notes;

require_once __DIR__ . '/../Note/Note.php';
require_once __DIR__ . '/../Note/Notes.php';
require_once 'DB.php';
require_once 'SettingsDB.php';

class NotesDB
{
    static function getNotesFromFolderID(int $folderId): Notes
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_note_id, fk_pk_folder_id, title FROM notes WHERE fk_pk_folder_id = :folderId');
            $stmt->bindParam(":folderId", $folderId);
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

    static function getContentFromID(int $noteId): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT content FROM notes WHERE pk_note_id = :noteId');
            $stmt->bindParam(":noteId", $noteId);
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

    static function getTitleFromID(int $noteId): string
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT title FROM notes WHERE pk_note_id = :noteId');
            $stmt->bindParam(":noteId", $noteId);
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

    static function createNote(int $folderId, string $title): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO notes (fk_pk_folder_id, title, content) VALUE (:fkPkFolderId, :title, \'\') ');
            $stmt->bindParam(":fkPkFolderId", $folderId);
            $stmt->bindParam(":title", $title);
            if ($stmt->execute()) {
                self::saveNote($DB->lastInsertId(), '# ' . $title . PHP_EOL);
            }
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function updateNoteTitle(int $noteId, string $title): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE notes SET title = :title WHERE pk_note_id = :pkNoteId');
            $stmt->bindParam(":pkNoteId", $noteId);
            $stmt->bindParam(":title", $title);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function saveNote(int $noteId, string $content): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE notes SET content = :content WHERE pk_note_id = :pkNoteId');
            $stmt->bindParam(":pkNoteId", $noteId);
            $stmt->bindParam(":content", $content);
            if ($stmt->execute()) {
                if (SettingsDB::getBooleanSetting(2) === true) {
                    $noteTitleMatch = preg_match('/(#)\s?(.+)/m', $content, $titleMatches);
                    if ($noteTitleMatch) {
                        self::updateNoteTitle($noteId, $titleMatches[2]);
                    }
                }
            }
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function deleteNote(int $noteId)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('DELETE FROM notes WHERE pk_note_id = :pkNoteId');
            $stmt->bindParam(":pkNoteId", $noteId);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}