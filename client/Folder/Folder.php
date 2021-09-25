<?php

namespace RichardKrikler\CodingNotes\Folder\Folder;

class Folder
{
    private $pk_folder_id;
    private $name;

    /**
     * @param int $pk_folder_id
     * @param string $name
     */
    public function __construct(int $pk_folder_id, string $name)
    {
        $this->pk_folder_id = $pk_folder_id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPkFolderId(): int
    {
        return $this->pk_folder_id;
    }
}