<?php

namespace Core;

use Core\Exception\LogicException;
use Core\Exception\NotFoundException;

class Config
{
    /**
     * @var array
     */
    private static $config;

    public static function applyConfig()
    {
        $iniConfig = ROOT_DIR . '/config/default.ini';
        if (!file_exists($iniConfig)) {
            throw new NotFoundException('Config file not found: ' . $iniConfig);
        }

        static::$config = parse_ini_file($iniConfig, true);

        if (static::$config === false) {
            throw new LogicException('Cat not parse ini config file: ' . $iniConfig);
        }

        self::initDisplayErrors();
    }

    /**
     * Get full config
     *
     * @return array
     */
    public static function getConfig()
    {
        return static::$config;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws NotFoundException
     */
    public static function getConfigValue($key)
    {
        if (isset(static::$config[$key])) {
            return static::$config[$key];
        }

        throw new NotFoundException('Key ' . $key . ' not found in config');
    }

    private static function initDisplayErrors()
    {
        if (isset(static::$config['parameters']['displayErrors'])) {
            ini_set('display_errors', static::$config['parameters']['displayErrors']);
        }
    }
}