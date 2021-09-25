<?php

namespace RichardKrikler\CodingNotes\Template\IndexTemplate;

class IndexTemplate
{
    static function render(string $main): string
    {
        $template_head = <<<TEMPLATE_HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingNotes</title>

    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
</head>

<body>
<nav>
    <div class="nav-left">
        <h1><a href="index.php">CodingNotes</a></h1>
        <div class="vertical-divider"></div>
        <div class="add-folder-icon nav-icon"><i class="fas fa-folder-plus"></i></div>
    </div>
    <div class="nav-right">
        <div class="settings-menu-icon nav-icon"><i class="fas fa-cog"></i></div>
    </div>
</nav>
<main>
TEMPLATE_HEAD;

        $template_footer = <<<TEMPLATE_FOOTER
</main>

<div class="modal-box" id="add-folder-modal-box">
    <div class="inner-modal-div">
        <h2>Add new Folder</h2>
        <input type="text" name="folder_name" id="folder_name">
        <div class="modal-buttons-div">
            <button>Confirm</button>
            <button class="cancel-modal-box">Cancel</button>
        </div>
    </div>
</div>

</body>
</html>
TEMPLATE_FOOTER;

        return $template_head . $main . $template_footer;
    }
}




