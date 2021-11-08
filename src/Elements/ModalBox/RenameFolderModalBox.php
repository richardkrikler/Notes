<?php

namespace RichardKrikler\Notes\ModalBox;

use AbstractModalBox;
use RichardKrikler\Notes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../FormElement.php';

class RenameFolderModalBox extends AbstractModalBox
{
    public function __construct(int $folderId, $folderName)
    {
        parent::__construct(
            'rename-folder-modal-box',
            'Rename Folder',
            FormElement::getInputElement('folder-name', 'name', 'Folder Name', $folderName, $folderName) .
            FormElement::getHiddenInputElement('folderId', $folderId)
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('rename-folder-form', 'Folder/RenameFolder.php', 'get'))->addContent($this->getModalBox());
    }
}
