<?php
namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload')); // __CLASS__ donne le nom de la classe, ici Autoloader
    }

    static function autoload($className)
    {
        if (strpos($className, __NAMESPACE__ . '\\') === 0)
        {
            $className = str_replace(__NAMESPACE__, '', $className); // __NAMESPACE__ donne le nom du namespace, ici SansGodasse
            $className = str_replace('\\', '/', $className);

            require __DIR__ . '/' . $className . '.php';
        }
    }
}