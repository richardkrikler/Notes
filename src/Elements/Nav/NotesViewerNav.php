<?php

namespace RichardKrikler\Notes\Elements;

use RichardKrikler\Notes\ModalBox\CreateNoteModalBox;
use RichardKrikler\Notes\ModalBox\DeleteFolderModalBox;
use RichardKrikler\Notes\ModalBox\RenameFolderModalBox;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';
require_once __DIR__ . '/../ModalBox/RenameFolderModalBox.php';
require_once __DIR__ . '/../ModalBox/DeleteFolderModalBox.php';

class NotesViewerNav extends AbstractNav
{
    public function __construct($folder)
    {
        parent::__construct();
        $createNoteModalBox = new CreateNoteModalBox($folder->getPkFolderId());
        $renameNoteModalBox = new RenameFolderModalBox($folder->getPkFolderId(), $folder->getName());
        $deleteFolderModalBox = new DeleteFolderModalBox($folder->getPkFolderId());
        parent::addContent(<<<NOTES_NAV
        <script src="/js/notesViewer.js" defer></script>
        <h4 class="mb-0 fw-normal d-inline-flex">
            <a class="align-self-center nav-icon" href="/folder/{$folder->getPkFolderId()}">
                <i class="fas fa-folder-open me-sm-2"></i>
            </a>
            <a class="align-self-center" href="/folder/{$folder->getPkFolderId()}">
                <p class="align-self-center mb-0 d-sm-block d-none">{$folder->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <div class="nav-icon"><i class="fas fa-i-cursor" data-bs-toggle="modal" data-bs-target="#rename-folder-modal-box"></i>$renameNoteModalBox</div>
        
        <div class="nav-icon"><i class="fas fa-plus-square" data-bs-toggle="modal" data-bs-target="#create-note-modal-box"></i>$createNoteModalBox</div>

        <div class="nav-icon"><i class="fas fa-trash" data-bs-toggle="modal" data-bs-target="#delete-folder-modal-box"></i>$deleteFolderModalBox</div>
NOTES_NAV
        );
    }
}