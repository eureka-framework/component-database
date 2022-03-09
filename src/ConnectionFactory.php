<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Eureka\Component\Database;

use Eureka\Component\Database\Exception\UnknownConfigurationException;

/**
 * Class ConnectionHandler
 *
 * @author  Romain Cottard
 */
class ConnectionFactory
{
    /** @var Connection[] $connections */
    private static array $connections = [];

    /** @var array<string, array<string, string|array<string|int>>> $configs */
    private array $configs;

    /**
     * Class constructor.
     *
     * @param array<string, array<string, string|array<string|int>>> $configs
     */
    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @return void
     *
     * @codeCoverageIgnore
     */
    public function __destroy()
    {
        foreach (self::$connections as $name => $connection) {
            unset(self::$connections[$name]);
        }

        self::$connections = [];
    }

    /**
     * @param string $name
     * @param bool $forceReconnection
     * @return Connection
     */
    public function getConnection(string $name, bool $forceReconnection = false): Connection
    {
        if (!isset($this->configs[$name])) {
            throw new UnknownConfigurationException('Configuration with name "' . $name . '" is unknown', 1000);
        }

        //~ Force unset to close existing connection & destroy instance if required
        if ($forceReconnection) {
            $this->closeConnection($name); // @codeCoverageIgnore
        }

        //~ Connection already set & id alive
        if (isset(self::$connections[$name])) {
            return self::$connections[$name];  // @codeCoverageIgnore
        }

        $dsn = $this->configs[$name]['dsn'] ?? null;
        if (empty($dsn) || !is_string($dsn)) {
            throw new UnknownConfigurationException('Missing or not string value for "dsn" config', 1001);
        }

        $username = $this->configs[$name]['username'] ?? null;
        if (!is_string($username) &&  $username !== null) {
            throw new UnknownConfigurationException('Not string value for "username" config', 1002);
        }

        $password = $this->configs[$name]['password'] ?? null;
        if (!is_string($password) &&  $password !== null) {
            throw new UnknownConfigurationException('Not string value for "password" config', 1003);
        }

        $options = $this->configs[$name]['options'] ?? null;
        if (!is_array($options) &&  $options !== null) {
            throw new UnknownConfigurationException('Not array values for "options" config', 1004);
        }

        //~ Create & store connection
        // @codeCoverageIgnoreStart
        self::$connections[$name] = new Connection(
            $dsn,
            $username,
            $password,
            $options,
            $name,
        );

        return self::$connections[$name];
        // @codeCoverageIgnoreEnd
    }

    /**
     * @param string $name
     * @return ConnectionFactory
     *
     * @codeCoverageIgnore
     */
    public function closeConnection(string $name): ConnectionFactory
    {
        //~ Connection already set & id alive
        if (isset(self::$connections[$name])) {
            unset(self::$connections[$name]);
        }

        return $this;
    }
}
