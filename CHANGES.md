# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v5.0-r2] (Build: 2025090100) - 2025-09-01

## Changed

- Consider fa style classes

## [v5.0-r1] (Build: 2025060200) - 2025-06-02

## Added

- Add support for Moodle 5.0

## [v4.5-r1] (Build: 2024100900) - 2024-10-09

## Added

- Add support for Moodle 4.5

## [v4.0-r1] (Build: 2020111600) - 2022-10-12

## Added

- Release version for Moodle 4.0

## [v3.11-r2] (Build: 2020111600) - 2022-10-12

## Added

- Respect "nolink" tags
- Update CI

## [v3.11-r1] (Build: 2020111600) - 2021-05-26

## Added

- GH Actions support
- Release version for Moodle 3.11

## Removed

- TravisCI support

## [v3.10-r1] (Build: 2020111600) - 2020-11-16

## Added

- Release version for Moodle 3.10

## [v3.9-r1] (Build: 2020062400) + [v3.8-r1] (Build: 2020051000) + [v3.7-r3] (Build: 2019052202)] - 2020-05-10

## Changed

- Release schema in `version.php` (set same as tag)

## [5.0-r1] - 2019-09-25

### Changed

- Updated the PHPunit testcase to support different FA styles (fas, far, fal, fad)
- Alter regex to match different FA styles
- Updated version number to `5.x`

## [4.8.5] - 2019-05-22

### Added

- New branch `MOODLE_37_STABLE`
- Plugin icon
- PHPUnit tests

### Changed

- Improve PHPDocs
- Update `filter.php`: move callback function inside filter class
- Rename `filtersettings.php` to `settings.php`

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
