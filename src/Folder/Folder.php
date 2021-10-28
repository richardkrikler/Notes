<?php

namespace RichardKrikler\CodingNotes\Folder;

class Folder
{
    private $pk_folder_id;
    private $name;

    /**
     * @param int $pk_folder_id
     * @param string $name
     */
    public function __construct(int $pk_folder_id = 0, string $name = '')
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
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPkFolderId(): int
    {
        return $this->pk_folder_id;
    }

    /**
     * @param int $pk_folder_id
     */
    public function setPkFolderId(int $pk_folder_id)
    {
        $this->pk_folder_id = $pk_folder_id;
    }
}