<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Database;

/**
 * Class Connection
 *
 * @author  Romain Cottard
 */
class Connection extends \PDO
{
    /** @var string $name */
    private $name = '';

    /**
     * Connection constructor.
     *
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param array $options
     * @param string $name
     */
    public function __construct($dsn, $username, $password, $options, $name = 'common')
    {
        $realOptions = [];
        foreach ($options as $optionName => $value) {
            if (0 === strpos($optionName, 'Connection::')) {
                $realOptions[constant('\Eureka\Component\Database\\' . $optionName)] = $value;
            }
        }

        parent::__construct($dsn, $username, $password, $realOptions);

        $this->setName($name);
        $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
    }

    /**
     * Set connection name.
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return connection name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasCountRows()
    {
        return false;
    }
}
