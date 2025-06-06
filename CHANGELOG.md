# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [3.4.0] - 2025-05-16
[3.4.0]: https://github.com/eureka-framework/component-database/compare/3.3.0...3.4.0
### Changed
- Now compatible with PHP 8.4
- Update GitHub workflow
- Update makefile
- Update configs

## [3.3.0] - 2024-02-06
[3.3.0]: https://github.com/eureka-framework/component-database/compare/3.2.0...3.3.0
### Changed
- Now compatible with PHP 8.3
- Update GitHub workflow

## [3.2.0] - 2023-06-14
[3.2.0]: https://github.com/eureka-framework/component-database/compare/3.1.0...3.2.0
### Changed
- Now compatible with PHP 8.2
- Update Makefile
- Update composer.json
- Update GitHub workflow
### Added
- Add phpstan config for PHP 8.2 compatibility

## [3.1.0] - 2022-03-09
[3.1.0]: https://github.com/eureka-framework/component-database/compare/3.0.0...3.1.0
### Changed
 * CI improvements (php compatibility check, makefile, github workflow)
 * Now compatible with PHP 7.4, 8.0 & 8.1
 * Fix phpdoc + some return type according to phpstan analysis
### Added
 * phpstan for static analysis
### Removed
 * phpcompatibility (no more maintained)

## [3.0.0] - 2020-10-29
[3.0.0]: https://github.com/eureka-framework/component-database/compare/2.0.0...3.0.0
### Changed
 * New require PHP 7.4+
 * Setup CI
 * Upgrade phpcodesniffer to v0.7 for composer 2.0 
### Added
 * Add new ConnectionFactory class to create or retrieve existing active connection
### Removed
 * Remove deprecated Database & NoDataException classes

----

## [2.1.1] - 2017-09-11
[2.1.1]: https://github.com/eureka-framework/component-database/compare/1.0.0...2.1.1
### Added
 * Add Connection class (extension of PDO)
 * Pass name to constructor
 * Auto-enable exception mode
 * Add require pdo extension in composer.json
### Changed
 * Move code in parent directory
 * Update phpdoc

## [1.0.0] - 2019-04-03
### Added
  * Add Breadcrumb item & controller aware trait
  * Add Flash notification service & controller aware trait
  * Add Menu item & controller aware trait
  * Add meta controller aware trait
  * Add Notification item
