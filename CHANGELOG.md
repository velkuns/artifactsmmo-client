# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

```yaml
## [tag] - YYYY-MM-DD
[tag]: https://github.com/velkuns/artifactsmmo-client/compare/1.0.0...master
### Changed
- Change 1
### Added
- Added 1
### Removed
- Remove 1
```

----

## [1.1.0] - 2024-08-22
[1.1.0]: https://github.com/velkuns/artifactsmmo-client/compare/1.0.2...1.1.0
### Added
- Add new Custom Api Exception based on error from API
- PHP 8.3 support
### Changed
- Now handle retry request when timeout or when bank / G.E already are in transaction

## [1.0.2] - 2024-08-11
[1.0.2]: https://github.com/velkuns/artifactsmmo-client/compare/1.0.1...1.0.2
### Changed
- Fix typo in package name for packagist

## [1.0.1] - 2024-08-11
[1.0.1]: https://github.com/velkuns/artifactsmmo-client/compare/1.0.0...1.0.1
### Changed
- Fix package name for packagist
- Better endpoint path build
### Added
- README: add example with body VO usage

## [1.0.0] - 2024-08-09
### Added
- Builder to generate Client, Formatter & VOs
- Base Abstract Client, Formatter interface & Formatter trait
- Script to generate code
- All CI config
- Some sample code & tests
