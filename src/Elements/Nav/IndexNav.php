<?php

namespace RichardKrikler\Notes\Elements;

use RichardKrikler\Notes\ModalBox\CreateFolderModalBox;

require_once 'AbstractNav.php';
require_once __DIR__ . '/../ModalBox/CreateFolderModalBox.php';

class IndexNav extends AbstractNav
{
    public function __construct()
    {
        parent::__construct();
        $createFolderModalBox = new CreateFolderModalBox();
        parent::addContent(<<<NOTES_NAV
        <div class="nav-icon">
            <i class="fas fa-folder-plus" data-bs-toggle="modal" data-bs-target="#create-folder-modal-box"></i>
            <p>$createFolderModalBox</p>
        </div>
NOTES_NAV
        );
    }
}