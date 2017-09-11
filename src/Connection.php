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
}
