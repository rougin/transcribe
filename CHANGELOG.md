# Changelog

All notable changes to `Transcribe` will be documented in this file.

## [0.4.0](https://github.com/rougin/transcribe/compare/v0.3.1...v0.4.0) - Unreleased

### Added
- `SourceCollection::add`
- `SourceInterface::words`
- `Transcribe::all`
- `Transcribe::get`

### Changed
- Minimum version of PHP to `v5.3.0`

### Deprecated
- `SourceCollection::addSource`
- `SourceInterface::getWords`
- `Transcribe::getText`
- `Transcribe::getVocabulary`

### Removed
- `CONTRIBUTING.md`
- `tebru/multi-array` package

## [0.3.1](https://github.com/rougin/transcribe/compare/v0.3.0...v0.3.1) - 2016-09-11

### Added
- StyleCI for conforming code to PSR standards

## [0.3.0](https://github.com/rougin/transcribe/compare/v0.2.2...v0.3.0) - 2016-07-29

### Added
- `Source\SourceCollection`

### Deprecated
- `Source\MultipleSource`

## [0.2.2](https://github.com/rougin/transcribe/compare/v0.2.1...v0.2.2) - 2016-03-12

### Added
- Tests

## [0.2.1](https://github.com/rougin/transcribe/compare/v0.2.0...v0.2.1) - 2015-09-30

### Added
- `tebru/multi-array` package for handling multidimensional arrays

## [0.2.0](https://github.com/rougin/transcribe/compare/v0.1.1...v0.2.0) - 2015-09-27

### Added
- [Source](https://github.com/rougin/transcribe/tree/master/src/Source) directory for handling data from different sources

### Fixed
- Conformed code structure to [SOLID](https://en.wikipedia.org/wiki/SOLID_(object-oriented_design))-based design

### Deprecated
- Complex constructors in instantiating the library

## [0.1.1](https://github.com/rougin/transcribe/compare/v0.1.0...v0.1.1) - 2015-07-19

### Added
- `LICENSE.md` file

## 0.1.0 - 2015-06-21

### Added
- `Transcribe` library