<?php
spl_autoload_register(function($class_name) {
    include_once "core/" . $class_name . ".php";
});