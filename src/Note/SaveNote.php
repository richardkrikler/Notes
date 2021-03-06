<?php

namespace RichardKrikler\Notes\Note;

use RichardKrikler\Notes\DB\NotesDB;

require_once __DIR__ . '/../DB/NotesDB.php';

$json_data = file_get_contents('php://input');
$obj = json_decode($json_data);

NotesDB::saveNote($obj->noteId, $obj->content);
