<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\ModalBox\CreateFolderModalBox;
use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\ModalBox\CreateNoteModalBox;
use RichardKrikler\CodingNotes\Note\Note;

require_once __DIR__ . '/../Folder/Folder.php';
require_once __DIR__ . '/../Note/Note.php';
require_once __DIR__ . '/../ModalBox/CreateFolderModalBox.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

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
        $createFolderModalBox = new CreateFolderModalBox();
        return <<<DEFAULT_NAV
        <div class="nav-icon"><i class="fas fa-folder-plus" data-bs-toggle="modal" data-bs-target="#create-folder-modal-box"></i>{$createFolderModalBox}</div>
DEFAULT_NAV;
    }

    private function getFolderElements(): string
    {
        $createNoteModalBox = new CreateNoteModalBox($this->folder->getPkFolderId());
        return <<<FOLDER_NAV
        <h4 class="mb-0 fw-normal"><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}"><div class="nav-icon"><i class="fas fa-folder-open me-2"></i></div></a>{$this->folder->getName()}</h4>
        <div class="vertical-divider"></div>
        <div class="nav-icon"><i class="fas fa-file-signature" data-bs-toggle="modal" data-bs-target="#create-note-modal-box"></i>{$createNoteModalBox}</div>
FOLDER_NAV;
    }

    private function getNoteElements(): string
    {
        return <<<NOTE_NAV_ELEMENTS
        <h4 class="mb-0 fw-normal"><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}"><div class="nav-icon"><i class="fas fa-folder me-2"></i></div>{$this->folder->getName()}</a></h4>
        <div class="vertical-divider"></div>
        <h4 class="mb-0 fw-normal"><a href="http://{$_SERVER["HTTP_HOST"]}/noteViewer.php?note={$this->note->getPkNoteId()}"><div class="nav-icon"><i class="fas fa-file-alt me-2"></i></a></div>{$this->note->getName()}</h4>
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
