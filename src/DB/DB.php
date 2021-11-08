<?php

namespace RichardKrikler\Notes\DB;

use PDO;
use PDOException;

class DB
{
    // name of the service from docker-compose.yml -> "db"
    private static $SERVER = 'db';
    private static $DBNAME = 'Notes';
    private static $USERNAME = 'root';
    private static $PASSWORD = 'NotesPW';

    /**
     * @return PDO
     */
    public static function getDB(): PDO
    {
        $server = self::$SERVER;
        $dbname = self::$DBNAME;
        $username = self::$USERNAME;
        $password = self::$PASSWORD;

        try {
            // Connect with: Server, User, Password, Database
            $DB = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);

            // because default: errormode_silent, change to ERRMODE_EXCEPTION
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $DB;
        } catch (PDOException $e) {
            print('Error: ' . $e);
            exit();
        }
    }
}