# Moodle FontAwesome Filter [![Moodle Plugin CI](https://github.com/ffhs/moodle-filter_fontawesome/actions/workflows/moodle-ci.yml/badge.svg)](https://github.com/ffhs/moodle-filter_fontawesome/actions/workflows/moodle-ci.yml) [![Coverage Status](https://coveralls.io/repos/github/ffhs/moodle-filter_fontawesome/badge.svg?branch=master)](https://coveralls.io/github/ffhs/moodle-filter_fontawesome?branch=master)

## Introduction

This filter allows you to use fontawesome icons in the Moodle text editor without worrying about having your div's stripped out by the Moodle Atto/TinyMCE HTML cleaner.

> This plugin supports the **FontAwesome** version (4, 5, 6, ...) that is built into Moodle core or your theme. The plugin does not contain the **FontAwesome** icon set.

## Requirements

Your site/theme must have FontAwesome embedded already. This filter does not provide the font.

* Moodle 4.1 upwards

## Installation

Install the plugin like any other plugin to folder `filter/fontawesome`

Use git to install this plugin:

```bash
cd /var/www/html/moodle
git clone https://github.com/ffhs/moodle-filter_fontawesome.git filter/fontawesome
```

Then complete upgrade over CLI:

```bash
sudo -u apache /usr/bin/php admin/cli/upgrade.php
```

or GUI.

See [MoodleDocs](https://docs.moodle.org/en/Installing_plugins) for details on installing Moodle plugins

## Configuration

First, activate the filter_tabs plugin in Site Administration -> Plugins -> Filters -> Manage filters

### Additional

filter_fontawesome has a settings page to allow you to limit the filter to only certain text-box formats.

## Usage

To create FontAwesome icons in text fields, use the following syntax: [fa-*] where * is the name of the icon you wish to display.

First you will need to find the icon you wish to use. This [list](http://fontawesome.io/icons) provides a full overview.

Some examples and guide to start:

* Anywhere you wish to add an icon just surround it with square brackets and type in the icon name. e.g.: `[fa-camera-retro]`
* If the icon name is a brand, please add `fab` at the beginning of the square brackets.
* If you wish to make the icon larger you can use a multiplier. e.g.: `[fa-camera-retro fa-2x]` or `[fa-camera-retro fa-4x]`
* If you wish to rotate the icon you can specify how many degrees clockwise. e.g.: `[fa-camera-retro fa-rotate-90]`
* You can also flip an icon horizontally or vertically. e.g.: `[fa-camera-retro fa-flip-horizontal]` or `[fa-camera-retro fa-flip-vertical]`
* You can mute the colour to a dull grey. e.g.: `[fa-camera-retro fa-muted]`
* You can "pull" the icon to the left or right. If it is "pulled" to the left text will wrap to the right. e.g.: `[fa-camera-retro pull-left]`.
  Use float-left or float-right when using Bootstrap 5 (Moodle 5+).
* Add an icon class. e.g.: `[icon fa-world]`
* All the settings above can be mixed and matched e.g.: `[fa-quote-left fa-4x float-left fa-muted]`
* Styles can be added from FontAwesome v5: `[fa-solid fa-world]`
* If some text parts should not be replaced, use `<nolink>` or `<span class="nolink">` e.g.: `[fa-world] <span class="nolink">[fa-world]</span>`

## Further information

* [Official plugin](https://moodle.org/plugins/filter_fontawesome) in Moodle plugins repository

## License

* Written by Julian (@moodleman) Ridden. Visit the blog at http://www.moodleman.net
* Updated by David Bezemer. Visit his company page at http://www.uplearning.nl
* Updated to FontAwesome version 4.7 by Usman Asar
* Updated to FontAwesome version 5 by Adrian Perez Rodriguez
* Keep up-to-date by [FFHS (Fernfachhochschule Schweiz)](https://github.com/ffhs)
