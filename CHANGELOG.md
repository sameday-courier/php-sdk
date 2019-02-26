# CHANGELOG

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).


## [1.3.0](https://github.com/sameday-courier/php-sdk/compare/1.2.0...1.3.0)

### Added

- AWB status history
- Update post parcel response

### Changed

- City and county now accepts ids

## [1.2.0](https://github.com/sameday-courier/php-sdk/compare/1.1.0...1.2.0)

### Added

- Download PDF for an existing AWB

### Changed

- Removed `pdfLink` from `Sameday\Responses\SamedayPostAwbResponse`

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
