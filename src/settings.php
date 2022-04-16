<?php

namespace RichardKrikler\Notes;

use RichardKrikler\Notes\DB\SettingsDB;
use RichardKrikler\Notes\Elements\SettingsNav;
use RichardKrikler\Notes\Template\SiteTemplate;

require_once 'Template/SiteTemplate.php';
require_once 'Elements/Nav/SettingsNav.php';

$themeOptions = SettingsDB::getOptionsStateSetting(1);
$themeOptionElements = '';
foreach ($themeOptions as $themeOption) {
    $themeOptionElements .= '<option value="' . $themeOption[0] . '" ' . ($themeOption[2] == 1 ? "selected" : "") . '>' . $themeOption[1] . '</option>';
}

$headerUpdateModeChecked = SettingsDB::getBooleanSetting(2) ? 'checked' : '';

print(SiteTemplate::render(new SettingsNav(), <<<SETTINGS
<div class="container mt-5">
    <h1>Settings</h1>
    
    <div class="col-9 col-sm-7 col-lg-4 col-xxl-3">
        <div class="mb-1">
            <label for="theme-mode" class="form-label">Theme Mode</label>
            <select class="form-select" name="theme-mode" onchange="updateStateSetting(1, this.value)">
                $themeOptionElements
            </select>
        </div>
    
        <div class="mb-1 mt-4">
            <label for="header-update-mode" class="form-label">Update Note-Header to first H1</label><br>
            <input class="form-check-input" type="checkbox" id="header-update-mode" name="header-update-mode" $headerUpdateModeChecked onchange="updateBooleanSetting(2, this.checked)">
        </div>
    </div>
    <div class="mt-5">
        <h2>Keyboard-Shortcut List</h2>
        <table class="table table-striped table-bordered rounded-1 mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Cmd + ,</th>
                    <td>View Settings</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Option + N</th>
                    <td>Create new Folder (in index) / Note (in folder)</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + E</th>
                    <td>Switch between Note Viewer and Editor</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Up</th>
                    <td>Folder/Viewer: Upper Directory</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + G</th>
                    <td>Viewer: Toggle Table-of-Contents Modal</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Esc</th>
                    <td>Viewer: clear URL from Header-ID</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Option + O</th>
                    <td>Viewer: Open Previous Note</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Option + P</th>
                    <td>Viewer: Open Next Note</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + S</th>
                    <td>Editor: Save Note</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + B</th>
                    <td>Editor: Bold-Text (insert **)</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + D</th>
                    <td>Editor: Duplicate Selection or Line</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + K</th>
                    <td>Editor: Italic-Text (insert *)</td>
                </tr>
                <tr>
                    <th scope="row">Cmd + Option + C</th>
                    <td>Editor: Code-Block (insert ''')</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
SETTINGS
));
