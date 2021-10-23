<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\Folder\Folder;
use RichardKrikler\CodingNotes\Note\Note;

require_once __DIR__ . '/../Folder/Folder.php';
require_once __DIR__ . '/../Note/Note.php';

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
        }
        else {
            return $this->getDefaultElements();
        }
    }

    private function getDefaultElements(): string
    {
        return <<<DEFAULT_NAV
        <div class="add-folder-icon nav-icon"><i class="fas fa-folder-plus"></i></div>
DEFAULT_NAV;

    }

    private function getFolderElements(): string
    {
        return <<<FOLDER_NAV
        <h2><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">{$this->folder->getName()}</a></h2>
        <div class="vertical-divider"></div>
FOLDER_NAV;
    }

    private function getNoteElements(): string
    {
        return <<<NOTE_NAV_ELEMENTS
        <h2><a href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$this->folder->getPkFolderId()}">{$this->folder->getName()}</a></h2>
        <div class="vertical-divider"></div>
        <h2>{$this->note->getName()}</h2>
NOTE_NAV_ELEMENTS;

    }

    public function __toString()
    {
        return <<<NAV
<nav>
    <div class="nav-left">
        <h1><a href="index.php">CodingNotes</a></h1>
        <div class="vertical-divider"></div>
        {$this->getSpecificElements()}
    </div>
    <div class="nav-right">
        <div class="settings-menu-icon nav-icon"><i class="fas fa-cog"></i></div>
    </div>
</nav>
NAV;
    }
}

;
