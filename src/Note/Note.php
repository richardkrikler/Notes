<?php

namespace RichardKrikler\CodingNotes\Note;

class Note
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