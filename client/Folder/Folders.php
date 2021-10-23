<?php

namespace RichardKrikler\CodingNotes\Folder;

use RichardKrikler\CodingNotes\Folder\Folder;

require_once 'Folder.php';

class Folders
{
    private $folders;

    public function __construct()
    {
        $this->folders = [];
    }

    /**
     * @return array
     */
    public function getFolders(): array
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
            $result .= '<li class="folder-box"><a href="notesViewer.php?folder=' . $folder->getPkFolderId() . '">' . $folder->getName() . '</a></li>';
        }
        $result .= '</ul>';

        return $result;
    }
}