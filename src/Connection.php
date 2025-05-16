<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Eureka\Component\Database;

/**
 * Class Connection
 *
 * @author  Romain Cottard
 * @codeCoverageIgnore
 */
class Connection extends \PDO
{
    private string $name = '';

    /**
     * Class constructor.
     *
     * @param string $dsn
     * @param string|null $username
     * @param string|null $password
     * @param array<string|int>|null $options
     * @param string $name
     */
    public function __construct(string $dsn, ?string $username = null, ?string $password = null, ?array $options = null, string $name = 'common')
    {
        parent::__construct($dsn, $username, $password, $options);

        $this->setName($name);
        $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
    }

    /**
     * Set connection name.
     *
     * @param  string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return connection name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
