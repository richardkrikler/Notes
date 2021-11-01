<?php

namespace RichardKrikler\CodingNotes\Note;

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
        $result = '<div class="container mt-5"><div id="folder-grid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 gap-5 justify-content-center mx-4 pb-5">';
        foreach ($this->notes as $note) {
            $result .= '<div class="folder-box col d-flex justify-content-center flex-column rounded">
                        <a class="text-center text-decoration-none h4 mb-0 px-2 py-2 fw-normal" href="noteViewer.php?note=' . $note->getPkNoteId() . '">' . $note->getName() . '</a>
                        </div>';
        }
        $result .= '</div></div>';

        return $result;
    }
}