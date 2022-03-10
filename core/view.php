<?php
function view($name, $arg = []) {
    ob_start();
    include_once 'views/' . $name . '.php';
    $content = ob_get_contents();
    ob_clean();
    return $content;
}