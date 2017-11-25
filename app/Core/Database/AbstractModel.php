<?php

namespace Core\Database;

/**
 * Abstract database model class
 */
abstract class AbstractModel
{
    /**
     * @return string
     */
    abstract function getDatabaseName();

    /**
     * @return string
     */
    abstract function getTableName();

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return PdoInstances::getPdo($this->getDatabaseName());
    }
}