<?php

namespace RichardKrikler\CodingNotes;

use RichardKrikler\CodingNotes\DB\SettingsDB;
use RichardKrikler\CodingNotes\Elements\SettingsNav;
use RichardKrikler\CodingNotes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/SettingsNav.php';

$themeOptions = SettingsDB::getOptionsStateSetting(1);
$optionElements = '';
foreach ($themeOptions as $themeOption) {
    $optionElements .= '<option value="' . $themeOption[0] . '" ' . ($themeOption[2] == 1 ? "selected" : "") . '>' . $themeOption[1] . '</option>';
}

print(SiteTemplate::render(new SettingsNav(), <<<SETTINGS
<div class="container mt-5">
    <h1>Settings</h1>
    
    <div class="col-9 col-sm-7 col-lg-4 col-xxl-3">
        <div class="mb-1">
            <label for="theme-mode" class="form-label">Theme Mode</label>
            <select class="form-select" name="theme-mode" onchange="updateStateSetting(1, this.value)">
                {$optionElements}
            </select>
        </div>
    
        <!--<div class="mb-1">
            <input type="checkbox" id="dark-mode" name="darkmode" checked>
            <label for="dark-mode">Dark Mode</label>
        </div>-->
    </div>
</div>
SETTINGS
));
