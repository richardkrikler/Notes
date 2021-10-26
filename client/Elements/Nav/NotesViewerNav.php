<?php

namespace RichardKrikler\CodingNotes\Elements;

use RichardKrikler\CodingNotes\ModalBox\CreateNoteModalBox;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

class NotesViewerNav extends AbstractNav
{
    public function __construct($folder)
    {
        $createNoteModalBox = new CreateNoteModalBox($folder->getPkFolderId());
        parent::addContent(<<<NOTES_NAV
        <h4 class="mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$folder->getPkFolderId()}">
                <i class="fas fa-folder-open me-sm-2"></i>
            </a>
            <p class="align-self-center mb-0 d-sm-block d-none">{$folder->getName()}</p>
        </h4>
        <div class="vertical-divider"></div>
        <div class="nav-icon"><i class="fas fa-plus-square" data-bs-toggle="modal" data-bs-target="#create-note-modal-box"></i>{$createNoteModalBox}</div>
NOTES_NAV
        );
    }
}