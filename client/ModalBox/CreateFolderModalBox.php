<?php

namespace RichardKrikler\CodingNotes\ModalBox;

use AbstractModalBox;
use RichardKrikler\CodingNotes\Template\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../Template/FormElement.php';

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
        return (new FormElement('Folder/CreateFolder.php', 'get'))->addContent($this->getModalBox());
    }
}