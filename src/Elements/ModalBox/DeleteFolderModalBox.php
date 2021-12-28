<?php

namespace RichardKrikler\Notes\ModalBox;

use AbstractModalBox;
use RichardKrikler\Notes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../FormElement.php';

class DeleteFolderModalBox extends AbstractModalBox
{
    public function __construct(int $folderId)
    {
        parent::__construct(
            'delete-folder-modal-box',
            'Delete Folder',
            FormElement::getHiddenInputElement('folderId', $folderId)
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('delete-folder-form', '/Folder/DeleteFolder.php', 'get'))->addContent($this->getModalBox());
    }
}