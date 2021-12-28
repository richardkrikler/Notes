<?php

namespace RichardKrikler\Notes\Elements;

class FormElement
{
    private $formId;
    private $action;
    private $method;
    private $classes;
    private $content;

    /**
     * @param string $formId
     * @param string $action
     * @param string $method
     */
    public function __construct(string $formId, string $action, string $method)
    {
        $this->formId = $formId;
        $this->action = $action;
        $this->method = $method;
    }

    public function addClasses(string $classes): FormElement
    {
        $this->classes .= $classes;
        return $this;
    }

    public function addContent(string $content): FormElement
    {
        $this->content .= $content;
        return $this;
    }

    public static function getInputElement(string $inputId, string $inputName, string $inputLabel, string $inputValue, string $inputPlaceholder): string
    {
        return <<<INPUT
<div class="mb-3">
    <label for="$inputId" class="form-label">$inputLabel</label>
    <input id="$inputId" name="$inputName" class="form-control" required placeholder="$inputPlaceholder" value="$inputValue">
</div>
INPUT;
    }

    public static function getHiddenInputElement(string $inputName, string $value): string
    {
        return <<<HIDDEN_INPUT
    <input name="$inputName" required hidden value="$value">
HIDDEN_INPUT;
    }

    // TODO: input for variable option-tags
    public static function getSelectElement(string $selectId, string $selectName, string $selectText): string
    {
        return <<<DROPDOWN
<div class="mb-3">
<label for="$selectId" class="form-label">$selectText</label>
<select class="form-select" name="$selectName">
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
<form id="$this->formId" action="$this->action" method="$this->method" class="$this->classes">$this->content</form>
FORM;
    }
}