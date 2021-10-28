<?php

abstract class AbstractModalBox
{
    private $id;
    private $title;
    private $body;
    private $footer;

    /**
     * @param string $id
     * @param string $title
     * @param string $body
     */
    public function __construct(string $id, string $title, string $body)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @param mixed $footer
     */
    public function setFooter($footer): void
    {
        $this->footer = $footer;
    }

    public function setFooterConfirmCancel(): AbstractModalBox
    {
        $this->footer = <<<FOOTER
<button type="submit" class="btn btn-primary">Confirm</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
FOOTER;
        return $this;
    }

    public function getModalBox(): string
    {
        return <<<MODAL_BOX
<div class="modal fade" id="{$this->id}" tabindex="-1" aria-labelledby="{$this->id}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{$this->id}Label">{$this->title}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {$this->body}
      </div>
      <div class="modal-footer">
        {$this->footer}
      </div>
    </div>
  </div>
</div>

MODAL_BOX;

    }
}