<?php
    $title = 'Моя главная страница';
    $javascript = [
        ['src' => 'user.js', 'defer' => true]
    ];
    @include_once 'header.php'
?>
<h2>Мой первый проект</h2>
<ul>
    <li><a href="/login">Авторизация</a></li>
    <li><a href="/register">Регистрация</a></li>
</ul>
<?php
@include_once 'footer.php'
?>