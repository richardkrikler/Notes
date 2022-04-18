<?php

namespace RichardKrikler\Notes\Note;

use JsonSerializable;

class Note implements JsonSerializable
{
    private $pkNoteId;
    private $fkPkFolderId;
    private $name;

    /**
     * @param int $pkNoteId
     * @param int $fkPkFolderId
     * @param string $name
     */
    public function __construct(int $pkNoteId, int $fkPkFolderId, string $name)
    {
        $this->pkNoteId = $pkNoteId;
        $this->fkPkFolderId = $fkPkFolderId;
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        return [
            'noteId' => $this->pkNoteId,
            'folderId' => $this->fkPkFolderId,
            'name' => $this->name
        ];
    }

    /**
     * @return int
     */
    public function getPkNoteId(): int
    {
        return $this->pkNoteId;
    }

    /**
     * @return int
     */
    public function getFkPkFolderId(): int
    {
        return $this->fkPkFolderId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}