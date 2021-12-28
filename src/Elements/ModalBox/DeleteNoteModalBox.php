<?php

namespace RichardKrikler\Notes\ModalBox;

use AbstractModalBox;
use RichardKrikler\Notes\Elements\FormElement;

require_once 'AbstractModalBox.php';
require_once __DIR__ . '/../FormElement.php';

class DeleteNoteModalBox extends AbstractModalBox
{
    public function __construct(int $noteId, int $folderId)
    {
        parent::__construct(
            'delete-note-modal-box',
            'Delete Note',
            FormElement::getHiddenInputElement('noteId', $noteId) .
            FormElement::getHiddenInputElement('folderId', $folderId)
        );
        $this->setFooterConfirmCancel();
    }

    public function __toString(): string
    {
        return (new FormElement('delete-note-form', '/Note/DeleteNote.php', 'get'))->addContent($this->getModalBox());
    }
}