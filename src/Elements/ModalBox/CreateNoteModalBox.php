<?php

namespace RichardKrikler\CodingNotes\ModalBox;

use AbstractModalBox;
use RichardKrikler\CodingNotes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../FormElement.php';

class CreateNoteModalBox extends AbstractModalBox
{
    public function __construct(int $folderId)
    {
        parent::__construct(
            'create-note-modal-box',
            'Create new Note',
            FormElement::getInputElement('note-title', 'title', 'Note Title', '', '').
            FormElement::getHiddenInputElement('folder_id', $folderId)
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('create-note-form', 'Note/CreateNote.php', 'get'))->addContent($this->getModalBox());
    }
}