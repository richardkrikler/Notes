<?php

abstract class AbstractModalBox
{
    private $id;
    private $title;
    private $content;

    /**
     * @param string $id
     * @param string $title
     * @param string $content
     */
    public function __construct(string $id, string $title, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function __toString()
    {
        return <<<MODAL_BOX
<div class="modal-box" id="{$this->id}">
    <div class="inner-modal-div">
        <h2>{$this->title}</h2>
        {$this->content}
        <div class="modal-buttons-div">
            <button>Confirm</button>
            <button class="cancel-modal-box">Cancel</button>
        </div>
    </div>
</div>
MODAL_BOX;
    }
}