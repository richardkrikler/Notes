<?php

namespace RichardKrikler\Notes\DB;

use PDO;
use PDOException;

require_once 'DB.php';

class FilesDB
{
    static function createFile($name, $data)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('INSERT INTO files (name, data) VALUE (?, ?)');
            $stmt->execute([$name, $data]);
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getFile($name)
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT data FROM files WHERE name = :name');
            $stmt->bindParam(":name", $name);

            $data = '';
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                $data = $row['data'];
            }
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $data;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }

    static function getFileNames()
    {
        $DB = DB::getDB();
        try {
            $stmt = $DB->prepare('SELECT name FROM files');

            $names = [];
            if ($stmt->execute()) {
                while ($row = $stmt->fetch()) {
                    $names[] = $row['name'];
                }
            }

            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $names;
        } catch (PDOException  $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}