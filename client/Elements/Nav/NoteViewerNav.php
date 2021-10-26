<?php

namespace RichardKrikler\CodingNotes\Elements;

use RichardKrikler\CodingNotes\ModalBox\CreateNoteModalBox;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

class NoteViewerNav extends AbstractNav
{
    public function __construct($folder, $note)
    {
        $createNoteModalBox = new CreateNoteModalBox($folder->getPkFolderId());
        parent::addContent(<<<NOTE_NAV
        <h4 class="folder-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$folder->getPkFolderId()}">
                <i class="fas fa-folder me-md-2"></i>
            </a>
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$folder->getPkFolderId()}">
                <p class="align-self-center mb-0 d-md-block d-none">{$folder->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <h4 class="note-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/noteViewer.php?note={$note->getPkNoteId()}">
                <i class="fas fa-file-alt me-2"></i>
            </a>
            <p class="align-self-center mb-0">{$note->getName()}</p>
        </h4>
        
        <div class="vertical-divider"></div>
        <a class="" href="http://{$_SERVER["HTTP_HOST"]}/noteEditor.php?note={$note->getPkNoteId()}">
            <div class="nav-icon"><i class="fas fa-file-signature"></i></div>
        </a>
NOTE_NAV
        );
    }
}