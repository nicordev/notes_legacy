<?php

namespace MyNotes;

use PDO;

class Database
{
    private static $pdo;

    private const CONFIG_PATH = "/config/config.cfg";

    private function __construct()
    {
        // Disabled
    }

    /**
     * Create a PDO object using the configuration file
     *
     * @return PDO
     * @throws \Exception
     */
    public static function getPdo()
    {
        if (!self::$pdo) {
            $configParameters = self::readConfigFile();
            self::$pdo = new PDO('mysql:host=' . $configParameters['host'] . ';dbname=' . $configParameters['dbname'] . ';charset=' . $configParameters['charset'], $configParameters['user'], $configParameters['password']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    /**
     * Read the config file and extract data
     *
     * @return array
     * @throws \Exception
     */
    private static function readConfigFile()
    {
        $configParameters = [];

        if (!$configFile = fopen(ROOT_PATH . self::CONFIG_PATH, "r")) {
            throw new \Exception("Can not open the config.cfg file in ". self::CONFIG_PATH, 500);
        } else {
            while (!feof($configFile)) {
                $line = fgets($configFile);
                if ($line[0] !== '#') {
                    $parts = explode("=", $line);
                    $configParameters[$parts[0]] = rtrim($parts[1]);
                }
            }
            fclose($configFile);
        }
        return $configParameters;
    }
}
