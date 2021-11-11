<?php

namespace RichardKrikler\Notes\Template;

use RichardKrikler\Notes\DB\SettingsDB;

require_once __DIR__ . '/../DB/SettingsDB.php';

class SiteTemplate
{
    static function render(string $nav, string $content): string
    {
        $themeSetting = SettingsDB::getStateSetting(1);
        return <<<TEMPLATE
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>

    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <link href="external/bootstrap.min.css" rel="stylesheet">
    <script src="external/bootstrap.bundle.min.js"></script>
    
    <script src="external/shortcut.js" defer></script>
    <script src="js/script.js" defer></script>
</head>

<body class="d-flex flex-column" theme-mode="{$themeSetting}">

{$nav}

<main class="d-flex justify-content-center w-100 h-100 overflow-scroll">
{$content}
</main>

</body>
</html>
TEMPLATE;
    }
}
