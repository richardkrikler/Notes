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
        return <<<INPUT
<div class="mb-3">
    <label for="{$inputId}" class="form-label">{$inputLabel}</label>
    <input id="{$inputId}" name="{$inputName}" class="form-control" required>
</div>
INPUT;
    }

    public static function getHiddenInputElement(string $inputName, string $value): string
    {
        return <<<HIDDEN_INPUT
    <input name="{$inputName}" required hidden value="{$value}">
HIDDEN_INPUT;
    }

    // TODO: input for variable option-tags
    public static function getSelectElement(string $selectId, string $selectName, string $selectText): string
    {
        return <<<DROPDOWN
<div class="mb-3">
<label for="{$selectId}" class="form-label">{$selectText}</label>
<select class="form-select" name="{$selectName}">
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
</div>
DROPDOWN;
    }

    public function __toString(): string
    {
        return <<<FORM
<form action="{$this->action}" method="{$this->method}">{$this->content}</form>
FORM;
    }
}