<?php

namespace RichardKrikler\Notes\Folder;

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
        $result = '<div class="container mt-5"><div id="folder-grid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 gap-5 justify-content-center mx-4 pb-5">';
        foreach ($this->folders as $folder) {
            $result .= '<a class="folder-box col d-flex justify-content-center flex-column rounded text-decoration-none p-0" href="folder/' . $folder->getPkFolderId() . '">
                            <span class="text-center h4 mb-0 px-2 py-2 fw-normal">' . $folder->getName() . '</span>
                        </a>';
        }
        $result .= '</div></div>';

        return $result;
    }
}