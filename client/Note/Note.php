<?php

namespace RichardKrikler\CodingNotes\Note;

class Note
{
    private $pk_note_id;
    private $fk_pk_folder_id;
    private $name;

    /**
     * @param int $pk_note_id
     * @param int $fk_pk_folder_id
     * @param string $name
     */
    public function __construct(int $pk_note_id, int $fk_pk_folder_id, string $name)
    {
        $this->pk_note_id = $pk_note_id;
        $this->fk_pk_folder_id = $fk_pk_folder_id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPkNoteId(): int
    {
        return $this->pk_note_id;
    }

    /**
     * @return int
     */
    public function getFkPkFolderId(): int
    {
        return $this->fk_pk_folder_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}