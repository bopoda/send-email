<?php

class Autoloader
{
    /**
     * Autoload class by name
     *
     * @param string $className
     * @return bool
     */
    public static function autoload($className)
    {
        $classPath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR,
                $className) . '.php';

        if (file_exists($classPath)) {
            require_once $classPath;
        } else {
            return false;
        }
    }
}

spl_autoload_register(['Autoloader', 'autoload']);
