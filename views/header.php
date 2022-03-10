<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= (isset($title) ? $title : 'Главная страница') ?></title>
    <?php
        if(isset($css))
            foreach($css as $item)
                echo "<link rel='stylesheet' href='/assets/css/{$item}'>";
        if(isset($javascript))
            foreach($javascript as $item)
                echo "<script src='/assets/js/{$item['src']}' " . ($item['defer'] ? 'defer' : '' ) . "></script>"
    ?>
</head>
<body>