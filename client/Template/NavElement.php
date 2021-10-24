<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\ModalBox\AddFolderModalBox;
use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\Note\Note;

require_once __DIR__ . '/../Folder/Folder.php';
require_once __DIR__ . '/../Note/Note.php';
require_once __DIR__ . '/../ModalBox/AddFolderModalBox.php';

class NavElement
{
    private $folder;
    private $note;

    public function setFolder(Folder $folder): NavElement
    {
        $this->folder = $folder;
        return $this;
    }

    public function setFolderAndNote(Folder $folder, Note $note): NavElement
    {
        $this->setFolder($folder);
        $this->note = $note;
        return $this;
    }

    private function getSpecificElements(): string
    {
        if (!empty($this->folder) && !empty($this->note)) {
            return $this->getNoteElements();
        } elseif (!empty($this->folder) && empty($this->note)) {
            return $this->getFolderElements();
        } else {
            return $this->getDefaultElements();
        }
    }

    private function getDefaultElements(): string
    {
        $addFolderModalBox = new AddFolderModalBox();
        return <<<DEFAULT_NAV
        <div class="add-folder-icon nav-icon"><i class="fas fa-folder-plus"></i>{$addFolderModalBox}</div>
DEFAULT_NAV;
    }

    private function getFolderElements(): string
    {
        return <<<FOLDER_NAV
        <h3 class="mb-0"><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">{$this->folder->getName()}</a></h3>
        <div class="vertical-divider"></div>
FOLDER_NAV;
    }

    private function getNoteElements(): string
    {
        return <<<NOTE_NAV_ELEMENTS
        <h3 class="mb-0"><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">{$this->folder->getName()}</a></h3>
        <div class="vertical-divider"></div>
        <h3 class="mb-0">{$this->note->getName()}</h3>
NOTE_NAV_ELEMENTS;
    }

    public function __toString(): string
    {
        return <<<NAV
<nav class="w-100 shadow d-flex justify-content-between px-3 py-2 mb-4">
    <div class="nav-left d-flex">
        <h3 class="mb-0"><a href="index.php">CodingNotes</a></h3>
        <div class="vertical-divider"></div>
        {$this->getSpecificElements()}
    </div>
    <div class="nav-right d-flex">
        <div class="settings-menu-icon nav-icon"><i class="fas fa-cog"></i></div>
    </div>
</nav>
NAV;
    }
}
