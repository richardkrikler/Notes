<?php

namespace RichardKrikler\CodingNotes\ModalBox;

use AbstractModalBox;
use RichardKrikler\CodingNotes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../FormElement.php';

class CreateFolderModalBox extends AbstractModalBox
{
    public function __construct()
    {
        parent::__construct(
            'create-folder-modal-box',
            'Create new Folder',
            FormElement::getInputElement('folder-name', 'name', 'Folder Name')
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('create-folder-form', 'Folder/CreateFolder.php', 'get'))->addContent($this->getModalBox());
    }
}