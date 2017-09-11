<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Database;

/**
 * Configuration class.
 *
 * @author Romain Cottard
 */
class Database
{
    /** @var string ENGINE_PHP_PDO Engine PDO from native PHP class. */
    const ENGINE_PHP_PDO = 'PDO';

    /** @var string ENGINE_PHP_CONNECTION Engine Connection (extend PHP \PDO engine). */
    const ENGINE_PHP_CONNECTION = 'Connection';

    /** @var Database $instance Class instance (singleton) */
    protected static $instance = null;

    /** @var array $config Configuration for database(s) */
    protected $config = array();

    /** @var array $connections List of instantiated connections */
    protected $connections = array();

    /** Factory constructor. */
    protected function __construct()
    {
        $this->connections = array();
    }

    /**
     * Get Factory instance (singleton)
     *
     * @return $this
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            $class = get_called_class();

            static::$instance = new $class();
        }

        return static::$instance;
    }

    /**
     * Get connection (short way)
     *
     * @param  string $name
     * @return \PDO|Connection
     * @throws \Exception
     */
    public static function get($name = null)
    {
        return self::getInstance()->getConnection($name);
    }

    /**
     * Set configuration
     *
     * @param  array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config += $config;

        return $this;
    }

    /**
     * Create or get existing connection.
     *
     * @param  string $name
     * @return \PDO|Connection
     * @throws \Exception
     */
    public function getConnection($name = null)
    {
        if ($name === null) {
            reset($this->config);
            $name = key($this->config);
        }

        if (!isset($this->config[$name])) {
            throw new \Exception('Configuration name does not exists !');
        }

        if (!isset($this->config[$name]['engine'])) {
            throw new \Exception('Engine not specified in configuration !');
        }

        $engine = $this->config[$name]['engine'];

        if (!isset($this->connections[$engine][$name])) {
            $method = 'new' . $engine;
            if (!method_exists($this, $method)) {
                throw new \Exception('Engine does not exists ! (engine: ' . $engine . ')');
            }

            $this->connections[$engine][$name] = $this->$method($name);
        }

        return $this->connections[$engine][$name];
    }

    /**
     * Create new PDO connection
     *
     * @param  string $name Config name
     * @return \PDO
     * @throws \Exception
     */
    protected function newPDO($name)
    {
        if (!isset($this->config[$name]) || !is_array($this->config[$name])) {
            throw new \Exception('Config not found ! (config: ' . $name . ')');
        }

        $config = $this->config[$name];

        if (!isset($config['dsn'])) {
            throw new \Exception('"dsn" parameter is not defined !');
        }

        if (!isset($config['user'])) {
            throw new \Exception('"user" parameter is not defined !');
        }

        if (!isset($config['pass'])) {
            throw new \Exception('"pass" parameter is not defined !');
        }

        $config['options'] = isset($config['options']) ? $config['options'] : array();

        $options = array();
        foreach ($config['options'] as $name => $value) {
            if (0 === strpos($name, 'PDO::')) {
                $options[constant($name)] = $value;
            }
        }

        $connection = new \PDO($config['dsn'], $config['user'], $config['pass'], $options);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

    /**
     * Create new PDO connection
     *
     * @param  string $name Config name
     * @return Connection
     * @throws \Exception
     */
    protected function newConnection($name)
    {
        if (!isset($this->config[$name]) || !is_array($this->config[$name])) {
            throw new \Exception('Config not found ! (config: ' . $name . ')');
        }

        $config = $this->config[$name];

        if (!isset($config['dsn'])) {
            throw new \Exception('"dsn" parameter is not defined !');
        }

        if (!isset($config['user'])) {
            throw new \Exception('"user" parameter is not defined !');
        }

        if (!isset($config['pass'])) {
            throw new \Exception('"pass" parameter is not defined !');
        }

        $config['options'] = isset($config['options']) ? $config['options'] : array();

        $options = array();
        foreach ($config['options'] as $optionName => $value) {
            if (0 === strpos($optionName, 'Connection::')) {
                $options[constant('\Eureka\Component\Database\\' . $optionName)] = $value;
            }
        }

        $connection = new Connection($config['dsn'], $config['user'], $config['pass'], $options);
        $connection->setName($name);
        $connection->setAttribute(Connection::ATTR_ERRMODE, Connection::ERRMODE_EXCEPTION);

        return $connection;
    }
}
