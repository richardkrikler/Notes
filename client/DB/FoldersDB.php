<?php

namespace RichardKrikler\CodingNotes\DB;

use PDO;
use PDOException;
use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\Folder\Folders;

require_once 'DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Folder/Folders.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Folder/Folder.php';

class FoldersDB
{
    static function getFolders(): Folders
    {
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

        return $folders;
    }

    static function getFolderFromID($folder_id): Folder
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_folder_id, name FROM folders WHERE pk_folder_id = :folder_id');
            $stmt->bindParam(":folder_id", $folder_id, PDO::PARAM_INT);
            $folder = new Folder();
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                $folder->setPkFolderId($row['pk_folder_id']);
                $folder->setName($row['name']);
            }
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $folder;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getFolderFromNoteID($note_id): Folder
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_folder_id, name FROM notes INNER JOIN folders on fk_pk_folder_id = pk_folder_id WHERE pk_note_id = :note_id');
            $stmt->bindParam(":note_id", $note_id, PDO::PARAM_INT);
            $folder = new Folder();
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                $folder->setPkFolderId($row['pk_folder_id']);
                $folder->setName($row['name']);
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $folder;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function createFolder($name): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO folders (name) VALUE (:folder_name) ');
            $stmt->bindParam(":folder_name", $name, PDO::PARAM_STR);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}