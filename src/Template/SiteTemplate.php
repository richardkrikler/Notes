<?php

namespace RichardKrikler\CodingNotes\Template;

use RichardKrikler\CodingNotes\DB\SettingsDB;

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/shortcut.js" defer></script>
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
