<?php

namespace RichardKrikler\Notes\Elements;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateNoteModalBox.php';

class NoteViewerNav extends AbstractNav
{
    public function __construct($folder, $note)
    {
        parent::__construct();
        parent::addContent(<<<NOTE_NAV
        <script src="/js/noteViewer.js" defer></script>
<!--        <script>window.addEventListener('load', () => scrollToSavedYScrollPos('main-element'))</script>-->
        <h4 class="folder-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center nav-icon" href="/folder/{$folder->getPkFolderId()}">
                <i class="fas fa-folder me-md-2"></i>
            </a>
            <a class="align-self-center" href="/folder/{$folder->getPkFolderId()}">
                <p class="align-self-center mb-0 d-md-block d-none">{$folder->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <h4 class="note-name mb-0 fw-normal d-inline-flex">
            <a class="align-self-center nav-icon" href="/note/{$note->getPkNoteId()}">
                <i class="fas fa-file-alt me-2"></i>
            </a>
            <a class="align-self-center" href="/note/{$note->getPkNoteId()}">
                <p class="align-self-center mb-0">{$note->getName()}</p>
            </a>
        </h4>
        
        <div class="vertical-divider"></div>
        
        <div data-bs-toggle="modal" data-bs-target="#tocModal">
            <div class="nav-icon"><i class="fas fa-list"></i></div>
            
            <div class="modal" id="tocModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{$note->getName()} - Table of Contents</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="note-toc"></div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        
        <a class="" href="{$note->getPkNoteId()}/edit">
            <div class="nav-icon"><i class="fas fa-file-signature"></i></div>
        </a>
        
<!--        <span onclick="saveYScrollPos('main-element'); window.location = '/noteEditor.php?note=' + getNoteId()">-->
<!--            <div class="nav-icon"><i class="fas fa-file-signature"></i></div>-->
<!--        </span>-->

        <div class="nav-icon dropdown-toggle" id="exportDropdownButton" role="button" data-bs-toggle="dropdown"><i class="fas fa-external-link-alt"></i></div>
        <ul class="dropdown-menu py-0" aria-labelledby="exportDropdownButton" style="min-width: 0">
            <li><a href="{$note->getPkNoteId()}/print"><div class="nav-icon d-flex justify-content-center p-2"><i class="fas fa-print"></i></div></a></li>
            <li><a href="{$note->getPkNoteId()}/markdown"><div class="nav-icon p-2"><i class="fab fa-markdown"></i></div></a></li>
        </ul>
NOTE_NAV
        );
    }
}