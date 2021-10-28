<?php

namespace RichardKrikler\CodingNotes\Elements;

abstract class AbstractNav
{
    private $content;

    public function addContent($content)
    {
        $this->content .= $content;
    }

    public function __toString(): string
    {
        return <<<NAV
<nav class="w-100 shadow d-flex justify-content-between px-3 py-2">
    <div class="nav-left d-flex">
        <h3 class="mb-0"><a href="../../index.php">Notes</a></h3>
        <div class="vertical-divider"></div>
        {$this->content}
    </div>
    <div class="nav-right d-flex ms-2">
        <div class="settings-menu-icon nav-icon"><i class="fas fa-cog"></i></div>
    </div>
</nav>
NAV;
    }
}
