<?php
    $title = 'Регистрация в системе';
    $css = [
        'register/main.css'
    ];
    @include_once 'header.php';
?>

<?= ( isset($_GET['error_password'])
    ? "<div class='error'>Пароли не совпали!</div>"
    : "" )
?>
<form action="" method="POST">
    <input type="text" name="name" placeholder="Фамилия Имя Отчество" required>
    <input type="text" name="login" placeholder="Укажите логин:" required>
    <input type="password" name="passsword" placeholder="Укажите пароль:" required>
    <input type="password" name="passsword_confirmed" placeholder="Укажите пароль повторно:" required>
    <input type="submit" value="Регистрация">
</form>

<?php @include_once 'footer.php'; ?>