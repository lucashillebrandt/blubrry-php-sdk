<?php
spl_autoload_register(function ($class) {
    $prefix = 'Blubrry\\';

    $class = substr($class, strlen($prefix)); // removes the prefix
    $class = str_replace('\\', '/', $class);  // fixes directory separator

    $file = dirname(__FILE__) . '/' . $class . '.php';

    if (!file_exists($file)) {
        return false;
    }

    require_once($file); // import the class
});
