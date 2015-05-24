<?php

spl_autoload_register(function ($class) {



    $prefixPath = explode('\\', $class);

    array_pop($prefixPath);
    // project-specific namespace prefix
    $prefix = implode('\\', $prefixPath);

    // base directory for the namespace prefix
    define('BASE_DIR', __DIR__ . '/src/');


    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = $prefix . substr($class, $len);


    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = BASE_DIR . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
