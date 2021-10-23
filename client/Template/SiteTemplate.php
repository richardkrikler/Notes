<?php

namespace RichardKrikler\CodingNotes\Template;

class SiteTemplate
{
    static function render(string $nav, string $main): string
    {
        return <<<TEMPLATE
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingNotes</title>

    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="node_modules/showdown/dist/showdown.js"></script>
    <script src="script.js" defer></script>
</head>

<body>

{$nav}

<main>
{$main}
</main>

</body>
</html>
TEMPLATE;
    }
}
