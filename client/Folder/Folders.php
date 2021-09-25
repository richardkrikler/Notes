<?php

namespace RichardKrikler\CodingNotes\Folder\Folders;

use RichardKrikler\CodingNotes\Folder\Folder\Folder;

require_once 'Folder.php';

class Folders
{
    private $folders;

    /**
     * @return Folders
     */
    public function getFolders(): Folders
    {
        return $this->folders;
    }

    /**
     * @param Folders $folders
     */
    public function setFolders(Folders $folders)
    {
        $this->folders = $folders;
    }

    /**
     * @param Folder $folder
     */
    public function addFolder(Folder $folder)
    {
        $this->folders[] = $folder;
    }

    /**
     * @return string
     */
    public function getUnorderedListHTML(): string
    {
        $result = '<ul id="folder-grid">';
        foreach ($this->folders as $folder) {
            $result .= '<li class="folder-box"><p>' . $folder->getName() . '</p></li>';
        }
        $result .= '</ul>';

        return $result;
    }
}