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
        $result = '<div class="container"><div id="folder-grid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 gap-5 justify-content-center">';
        foreach ($this->folders as $folder) {
            $result .= '<div class="folder-box col d-flex justify-content-center flex-column bg-light rounded">
                        <a class="text-center text-decoration-none h4 mb-0 px-2 py-2 fw-normal" href="notesViewer.php?folder=' . $folder->getPkFolderId() . '">' . $folder->getName() . '</a>
                        </div>';
        }
        $result .= '</div></div>';

        return $result;
    }
}