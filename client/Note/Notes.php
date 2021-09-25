<?php

namespace RichardKrikler\CodingNotes\Note\Note;

require_once 'Note.php';

class Notes
{
    private $notes;

    public function __construct()
    {
        $this->notes = [];
    }

    /**
     * @return array
     */
    public function getNotes(): array
    {
        return $this->notes;
    }

    /**
     * @param Notes $notes
     */
    public function Notes(Notes $notes)
    {
        $this->notes = $notes;
    }

    /**
     * @param Note $note
     */
    public function addNote(Note $note)
    {
        $this->notes[] = $note;
    }

    /**
     * @return string
     */
    public function getUnorderedListHTML(): string
    {
        $result = '<ul id="note-grid">';
        foreach ($this->notes as $note) {
            $result .= '<li class="folder-box"><a href="viewer.php?note=' . $note->getPkNoteId() . '">' . $note->getName() . '</a></li>';
        }
        $result .= '</ul>';

        return $result;
    }
}