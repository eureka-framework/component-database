<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Eureka\Component\Database\Tests\Unit;

use Eureka\Component\Database\ConnectionFactory;
use Eureka\Component\Database\Exception\UnknownConfigurationException;
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
    public function testAnExceptionIsThrownWhenITryToConnectOnUnknownConnectionName(): void
    {
        //~ Given
        $config  = ['common' => ['username' => 'user', 'password' => 'pass']];

        //~ Then
        $this->expectException(UnknownConfigurationException::class);
        $this->expectExceptionCode(1000);

        //~ When
        $factory = new ConnectionFactory($config);
        $factory->getConnection('unknown');
    }

    /**
     * @return void
     */
    public function testAnExceptionIsThrownWhenIOmitDsnConfigurationPart(): void
    {
        //~ Given
        $config  = ['common' => ['username' => 'user', 'password' => 'pass']];

        //~ Then
        $this->expectException(UnknownConfigurationException::class);
        $this->expectExceptionCode(1001);

        //~ When
        $factory = new ConnectionFactory($config);
        $factory->getConnection('common');
    }

    /**
     * @return void
     */
    public function testAnExceptionIsThrownWhenISetAnInvalidUsernameValue(): void
    {
        //~ Given
        $config  = ['common' => ['dsn' => 'mock_value', 'username' => ['user'], 'password' => 'pass']];

        //~ Then
        $this->expectException(UnknownConfigurationException::class);
        $this->expectExceptionCode(1002);

        //~ When
        $factory = new ConnectionFactory($config);
        $factory->getConnection('common');
    }

    /**
     * @return void
     */
    public function testAnExceptionIsThrownWhenISetAnInvalidPasswordValue(): void
    {
        //~ Given
        $config  = ['common' => ['dsn' => 'mock_value', 'username' => 'user', 'password' => ['pass']]];

        //~ Then
        $this->expectException(UnknownConfigurationException::class);
        $this->expectExceptionCode(1003);

        //~ When
        $factory = new ConnectionFactory($config);
        $factory->getConnection('common');
    }

    /**
     * @return void
     */
    public function testAnExceptionIsThrownWhenISetAnInvalidOptionsValue(): void
    {
        //~ Given
        $config  = ['common' => ['dsn' => 'mock_value', 'username' => 'user', 'password' => 'pass', 'options' => '1']];

        //~ Then
        $this->expectException(UnknownConfigurationException::class);
        $this->expectExceptionCode(1004);

        //~ When
        $factory = new ConnectionFactory($config);
        $factory->getConnection('common');
    }
}
