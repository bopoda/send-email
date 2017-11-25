<?php

namespace Core\Database;

use Core\Config;
use Core\Exception\NotFoundException;

class PdoInstances
{
    private static $pdoInstances;

    /**
     * Get instance of PDO
     * Same instance will be used for same database
     *
     * @param string $databaseName
     * @return \PDO
     * @throws NotFoundException
     */
    public static function getPdo($databaseName)
    {
        if (!isset(self::$pdoInstances[$databaseName])) {
            //make config key to ready database credentials from .ini config
            $configKey = 'db_' . $databaseName;
            try {
                $dbCredentials = Config::getConfigValue($configKey);
            } catch (\Exception $e) {
                throw new NotFoundException("Database Config Key $configKey not found in main .ini config", 0, $e);
            }

            $dsn = "mysql:host={$dbCredentials['host']};dbname={$dbCredentials['name']}";
            self::$pdoInstances[$databaseName] = new \PDO(
                $dsn,
                $dbCredentials['username'],
                $dbCredentials['password']
            );
        }

        return self::$pdoInstances[$databaseName];
    }
}