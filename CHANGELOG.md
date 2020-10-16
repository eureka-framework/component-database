# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [5.0.0] - 2020 (unreleased)
### Changed
 * New require PHP 7.4+
 * Setup CI
### Added
 * Add new ConnectionFactory class to create or retrieve existing active connection
### Removed
 * Remove deprecated Database & NoDataException classes


## [2.x.y] - 2017-09-11
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