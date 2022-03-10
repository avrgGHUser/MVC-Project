<?php
# Отвечает за работу с HTTP методами и маршрутизацией
class Route
{
    private static function router($method, $uri)
    {
        if($_SERVER['REQUEST_METHOD'] !== $method) return true;
        $url = explode('?', $_SERVER['REQUEST_URI'])[0];
        return ($url != $uri);
    }

    public static function __callStatic($name, $arguments) {
        # Присваеваем ссылку из первого аргумента
        $uri = $arguments[0];
        # Присваеваем контроллер или callback функцию
        $controller = $arguments[1];
        # Делаем буквы заглавными
        $name = strtoupper($name);

        if(self::router($name, $uri)) return;
        if(is_callable($controller)) {
            echo $controller();
            return;
        }
        if(is_array($controller)) {
            $classController = new $controller[0]();
            $nameMethod = $controller[1];
            echo $classController->$nameMethod();
            return;
        }
    }
}