# component-database

[![Current version](https://img.shields.io/packagist/v/eureka/component-database.svg?logo=composer)](https://packagist.org/packages/eureka/component-database)
[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=7.4-8.4&color=777bb4)](https://packagist.org/packages/eureka/component-database)
![CI](https://github.com/eureka-framework/component-database/workflows/CI/badge.svg)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_component-database&metric=alert_status)](https://sonarcloud.io/dashboard?id=eureka-framework_component-database)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_component-database&metric=coverage)](https://sonarcloud.io/dashboard?id=eureka-framework_component-database)


PHP PDO abstraction with factory to handle reconnection & connections to multiple databases.

## Installation

If you wish to install it in your project, require it via composer:

```bash
composer require eureka/component-database
```

You can install the component (for testing) with the following command:
```bash
make install
```

## Update

You can update the component (for testing) with the following command:
```bash
make update
```

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

## Testing & CI (Continuous Integration)

You can run tests on your side with following commands:
```bash
make php/tests   # run tests with coverage
make php/test    # run tests with coverage
make php/testdox # run tests without coverage reports but with prettified output
```

You also can run code style check or code style fixes with following commands:
```bash
make php/check   # run checks on check style
make php/fix     # run check style auto fix
```

To perform a static analyze of your code (with phpstan, lvl 9 at default), you can use the following command:
```bash
make php/analyze # Same as phpstan but with CLI output as table
```

To ensure you code still compatible with current supported version and futures versions of php, you need to
run the following commands (both are required for full support):
```bash
make php/min-compatibility # run compatibility check on current minimal version of php we support
make php/max-compatibility # run compatibility check on last version of php we will support in future
```

And the last "helper" commands, you can run before commit and push is:
```bash
make ci
```
This command clean the previous reports, install component if needed and run tests (with coverage report),
check the code style and check the php compatibility check, as it would be done in our CI.

## Contributing

See the [CONTRIBUTING](CONTRIBUTING.md) file.

## License

This project is currently under The MIT License (MIT). See [LICENCE](LICENSE) file for more information.
