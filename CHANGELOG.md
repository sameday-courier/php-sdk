# CHANGELOG

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [1.1.0](https://github.com/sameday-courier/php-sdk/compare/1.0.0...1.1.0) - 2019-01-15

### Fixed

- Fix for get parcel status history response missing field
- Documentation

### Added

- Create new parcel for an existing AWB

### Changed

- Renamed `Sameday\Requests\SamedayPostAwbRequest::getParcels()` method to `getParcelsDimensions()`
- Renamed `Sameday\Requests\SamedayPostAwbRequest::setParcels()` method to `setParcelsDimensions()`
- Renamed `Sameday\Objects\Request\ParcelObject` to `Sameday\Objects\ParcelDimensionsObject`
