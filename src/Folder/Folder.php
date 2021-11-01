<?php

namespace RichardKrikler\CodingNotes\Folder;

class Folder
{
    private $pkFolderId;
    private $name;

    /**
     * @param int $pkFolderId
     * @param string $name
     */
    public function __construct(int $pkFolderId = 0, string $name = '')
    {
        $this->pkFolderId = $pkFolderId;
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
        return $this->pkFolderId;
    }

    /**
     * @param int $pkFolderId
     */
    public function setPkFolderId(int $pkFolderId)
    {
        $this->pkFolderId = $pkFolderId;
    }
}