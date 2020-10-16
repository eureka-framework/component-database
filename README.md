# component-database

[![Current version](https://img.shields.io/packagist/v/eureka/component-database.svg?logo=composer)](https://packagist.org/packages/eureka/component-database)
[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=%5E7.4&color=777bb4)](https://packagist.org/packages/eureka/component-database)
![CI](https://github.com/eureka-framework/component-database/workflows/CI/badge.svg)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_component-database&metric=alert_status)](https://sonarcloud.io/dashboard?id=eureka-framework_component-database)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_component-database&metric=coverage)](https://sonarcloud.io/dashboard?id=eureka-framework_component-database)


PHP PDO abstraction with factory to handle reconnection & connections to multiple databases.

## Usage
```php
<?php

use Eureka\Component\Database\ConnectionFactory;

$factory = new ConnectionFactory(
    [
        'common' => [
            'dsn'      => 'mysql:dbname=my_database;host=localhost;charset=UTF8',
            'user'     => 'user',
            'password' => 'pass',
            'options'  => null,
        ],
    ]
);

$connection = $factory->getConnection('common');
$connection->query('SELECT * FROM my_table');
```


## Installation

You can install the component (for testing) with the following command:
```bash
make install
```

## Update

You can update the component (for testing) with the following command:
```bash
make update
```


## Testing

You can test the component with the following commands:
```bash
make phpcs
make tests
make testdox
```