<?php
// name of the service from docker-compose.yml -> "db"
$server = "db";

// database name
$dbname = "CodingNotes";

// credentials also defined in docker-compose.yml
$username = "root";
$password = "CodingNotesPW";
$DB;

try {
    // Create a new Database Object for mysql
    // Connect with: Server, User, Password, Database
    $DB = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);

    // because we have default errormode_silent we change to ERRMODE_EXCEPTION
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e;
    exit();
}



