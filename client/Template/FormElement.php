<?php

namespace RichardKrikler\CodingNotes\Template;

class FormElement
{
    private $action;
    private $method;
    private $content;

    /**
     * @param $action
     * @param $method
     */
    public function __construct($action, $method)
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function addContent(string $content): FormElement
    {
        $this->content .= $content;
        return $this;
    }

    public static function getInputElement(string $inputId, string $inputName, string $inputLabel): string
    {
        return '<label for="' . $inputId . '" class="form-label">' . $inputLabel . '</label>
                <input id="' . $inputId . '" name="' . $inputName . '" class="form-control">';
    }

    public function __toString(): string
    {
        return <<<FORM
<form action="{$this->action}" method="{$this->method}">
{$this->content}
</form>
FORM;
    }
}