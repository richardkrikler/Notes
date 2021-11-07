<?php

namespace RichardKrikler\CodingNotes\Elements;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

class NoteViewerNav extends AbstractNav
{
    public function __construct($folder, $note)
    {
        parent::__construct();
        parent::addContent(<<<NOTE_NAV
        <script src="js/noteViewer.js" defer></script>
        <h4 class="folder-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center nav-icon" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$folder->getPkFolderId()}">
                <i class="fas fa-folder me-md-2"></i>
            </a>
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/notesViewer.php?folder={$folder->getPkFolderId()}">
                <p class="align-self-center mb-0 d-md-block d-none">{$folder->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <h4 class="note-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center nav-icon" href="http://{$_SERVER["HTTP_HOST"]}/noteViewer.php?note={$note->getPkNoteId()}">
                <i class="fas fa-file-alt me-2"></i>
            </a>
            <a class="align-self-center" href="http://{$_SERVER["HTTP_HOST"]}/noteViewer.php?note={$note->getPkNoteId()}">
                <p class="align-self-center mb-0">{$note->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <a class="" href="http://{$_SERVER["HTTP_HOST"]}/noteEditor.php?note={$note->getPkNoteId()}">
            <div class="nav-icon"><i class="fas fa-file-signature"></i></div>
        </a>

        <div class="nav-icon dropdown-toggle" id="exportDropdownButton" role="button" data-bs-toggle="dropdown"><i class="fas fa-external-link-alt"></i></div>
        <ul class="dropdown-menu py-0" aria-labelledby="exportDropdownButton" style="min-width: 0">
            <li><a href="notePrintViewer.php?note={$note->getPkNoteId()}"><div class="nav-icon d-flex justify-content-center p-2"><i class="fas fa-print"></i></div></a></li>
            <li><a href="noteMarkdownDownload.php?note={$note->getPkNoteId()}"><div class="nav-icon p-2"><i class="fab fa-markdown"></i></div></a></li>
        </ul>
NOTE_NAV
        );
    }
}