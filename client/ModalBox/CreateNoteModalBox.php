<?php

namespace RichardKrikler\CodingNotes\ModalBox;

use AbstractModalBox;
use RichardKrikler\CodingNotes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../Elements/FormElement.php';

class CreateNoteModalBox extends AbstractModalBox
{
    public function __construct(int $folder_id)
    {
        parent::__construct(
            'create-note-modal-box',
            'Create new Note',
            FormElement::getInputElement('note-title', 'title', 'Note Title').
            FormElement::getHiddenInputElement('folder_id', $folder_id)
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('Note/CreateNote.php', 'get'))->addContent($this->getModalBox());
    }
}