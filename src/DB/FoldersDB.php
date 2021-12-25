<?php

namespace RichardKrikler\Notes\DB;

use PDO;
use PDOException;
use RichardKrikler\Notes\Folder\Folder;
use RichardKrikler\Notes\Folder\Folders;

require_once 'DB.php';
require_once __DIR__ . '/../Folder/Folders.php';
require_once __DIR__ . '/../Folder/Folder.php';

class FoldersDB
{
    static function getFolders(): Folders
    {
        $DB = DB::getDB();
        $folders = new Folders();
        try {
            $stmt = $DB->prepare('SELECT pk_folder_id, name FROM folders ORDER BY name');
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

    static function getFolderFromID(int $folderId): Folder
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_folder_id, name FROM folders WHERE pk_folder_id = :folderId');
            $stmt->bindParam(":folderId", $folderId);
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

    static function getFolderFromNoteID(int $noteId): Folder
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT pk_folder_id, name FROM notes INNER JOIN folders on fk_pk_folder_id = pk_folder_id WHERE pk_note_id = :noteId');
            $stmt->bindParam(":noteId", $noteId);
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

    static function createFolder(string $name): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO folders (name) VALUE (:name)');
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    public static function renameFolder(int $folderId, string $name): void
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('UPDATE folders SET name = :name WHERE pk_folder_id = :folderId');
            $stmt->bindParam(":folderId", $folderId);
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}