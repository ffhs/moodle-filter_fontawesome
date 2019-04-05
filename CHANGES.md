# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [4.8.4] - 2019-04-05
### Added
- The filter supports now brands. Please add at the beginning `fab` inside the square brackets.

### Changed
- Remove unnecessary code (globalconfig)
- Rename callback function and cleanup
- Update README

## [4.8.3] - 2019-02-27
These changes only affects the `MOODLE_33_STABLE` branch. The `MOODLE_35_STABLE` branch just get a version bump.

### Changed
- Improve and fix regex filter

### Removed
- Removed hardcoded FA classes `icon` and `fa-fw` for the i tag

## [4.8.2] - 2019-02-01
### Added 
- Add Moodle Privacy API (Issue #3)

### Changed
- Rename filtername (Issue #2) 

## [4.8.1] - 2018-12-13
### Changed
- Improve and fix regex filter
- Make codechecker happy

### Removed
- Removed hardcoded FA classes `icon` and `fa-fw` for the i tag

## [4.8] - 2018-08-30
### Added
- Start using `CHANGES` as changelog

### Changed
- Adapt `README`
- Add FA classes `icon` and `fa-fw` to the i tag
- Add FA attribute `aria-hidden` to the i tag

### Removed
- Removed `fonts` folder and `styles` stylesheet
