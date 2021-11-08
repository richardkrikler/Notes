<?php

namespace RichardKrikler\Notes\Elements;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

class NoteEditorNav extends AbstractNav
{
    public function __construct($folder, $note)
    {
        parent::__construct();
        parent::addContent(<<<NOTE_NAV
        <script src="js/noteEditor.js" defer></script>
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
            <div class="nav-icon"><i class="fas fa-file-alt me-2" onclick="viewer()"></i></div>
            <p class="align-self-center mb-0 pointer-event" onclick="viewer()">{$note->getName()}</p>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <div class="nav-icon" onclick="saveNote()" id="saveNote"><i class="fas fa-save"></i></div>
        
        <div class="vertical-divider"></div>

        <div class="nav-icon" onclick="contentTextarea.insertText('```', '\\n```')"><i class="fas fa-code"></i></div>

        <div class="nav-icon dropdown-toggle" id="imageDropdownButton" role="button" data-bs-toggle="dropdown"><i class="fas fa-image"></i></div>
        <ul class="dropdown-menu py-0" aria-labelledby="imageDropdownButton">
            <li><input type="url" class="dropdown-item" placeholder="URL" id="imageUrlInput" onkeyup="saveFileFromUrl(event, value)"></li>
            <li><input type="file" class="py-1" onchange="saveFileFromInput(event)" id="testId"></li>
        </ul>
NOTE_NAV
        );
    }
}