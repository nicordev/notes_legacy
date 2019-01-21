<?php
namespace MyNotes;

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($className)
    {
        if (strpos($className, __NAMESPACE__ . '\\') === 0)
        {
            $className = str_replace(__NAMESPACE__, '', $className);
            $className = str_replace('\\', '/', $className);

            require __DIR__ . '/' . $className . '.php';
        }
    }
}