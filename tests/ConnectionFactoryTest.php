<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Eureka\Component\Database\Tests;


use Eureka\Component\Database\ConnectionFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionFactoryTest
 *
 * @author Romain Cottard
 */
class ConnectionFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanInstantiateConnectionFactory()
    {
        $factory = new ConnectionFactory([]);

        $this->assertInstanceOf(ConnectionFactory::class, $factory);
    }
}
