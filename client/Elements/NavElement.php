<?php

namespace RichardKrikler\CodingNotes\Elements;

use RichardKrikler\CodingNotes\Note\Note;
use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\ModalBox\CreateFolderModalBox;
use RichardKrikler\CodingNotes\ModalBox\CreateNoteModalBox;

require_once __DIR__ . '/../Folder/Folder.php';
require_once __DIR__ . '/../Note/Note.php';
require_once __DIR__ . '/ModalBox/CreateFolderModalBox.php';
require_once __DIR__ . '/ModalBox/CreateNoteModalBox.php';

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
        <div class="nav-icon">
            <i class="fas fa-folder-plus" data-bs-toggle="modal" data-bs-target="#create-folder-modal-box"></i>
            <p>{$createFolderModalBox}</p>
        </div>
DEFAULT_NAV;
    }

    private function getFolderElements(): string
    {
        $createNoteModalBox = new CreateNoteModalBox($this->folder->getPkFolderId());
        return <<<FOLDER_NAV
        <h4 class="mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">
                <i class="fas fa-folder-open me-sm-2"></i>
            </a>
            <p class="align-self-center mb-0 d-sm-block d-none">{$this->folder->getName()}</p>
        </h4>
        <div class="vertical-divider"></div>
        <div class="nav-icon"><i class="fas fa-plus-square" data-bs-toggle="modal" data-bs-target="#create-note-modal-box"></i>{$createNoteModalBox}</div>
FOLDER_NAV;
    }

    private function getNoteElements(): string
    {
        return <<<NOTE_NAV_ELEMENTS
        <h4 class="folder-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">
                <i class="fas fa-folder me-md-2"></i>
            </a>
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">
                <p class="align-self-center mb-0 d-md-block d-none">{$this->folder->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <h4 class="note-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/noteViewer.php?note={$this->note->getPkNoteId()}">
                <i class="fas fa-file-alt me-2"></i>
            </a>
            <p class="align-self-center mb-0">{$this->note->getName()}</p>
        </h4>
        
        <div class="vertical-divider"></div>
        <div class="nav-icon"><i class="fas fa-file-signature"></i></div>
NOTE_NAV_ELEMENTS;
    }

    public function __toString(): string
    {
        return <<<NAV
<nav class="w-100 shadow d-flex justify-content-between px-3 py-2">
    <div class="nav-left d-flex">
        <h3 class="mb-0"><a href="../index.php">Notes</a></h3>
        <div class="vertical-divider"></div>
        {$this->getSpecificElements()}
    </div>
    <div class="nav-right d-flex ms-2">
        <div class="settings-menu-icon nav-icon"><i class="fas fa-cog"></i></div>
    </div>
</nav>
NAV;
    }
}
