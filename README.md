# Moodle FontAwesome Filter [![Build Status](https://travis-ci.org/adpe/moodle-filter_fontawesome.svg?branch=master)](https://travis-ci.org/adpe/moodle-filter_fontawesome)

## Introduction
This filter allows you to use fontawesome icons in the Moodle text editor without worrying about having your div's stripped out by the Moodle Atto/TinyMCE HTML cleaner. 

> Furthermore it's `important` to know, that this plugin doesn't supply the [free FontAwesome icon set](https://fontawesome.com/free).  This is the responsibility of Moodle or your theme developer. So it can be, that not all FA icons will be displayed, for more information consult these links:
> - [Latest Release](https://fontawesome.com/changelog/latest)
> - [Details of all changes](https://github.com/FortAwesome/Font-Awesome/blob/master/CHANGELOG.md)

## Requirements
Your site/theme must have FontAwesome embedded already. This filter does not provide the font.
* Moodle 3.3 upwards 

## Installation
Install the plugin like any other plugin to folder `filter/fontawesome`

Use git to install this plugin: 
```bash
cd /var/www/html/moodle
git clone https://github.com/adpe/moodle-filter_fontawesome.git filter/fontawesome
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
* You can "pull" the icon to the left or right. If it is "pulled" to the left text will wrap to the right. e.g.: `[fa-camera-retro pull-left]`
* All the settings above can be mixed and matched e.g.: `[fa-quote-left fa-4x pull-left fa-muted]`

## Further information
* [Official plugin](https://moodle.org/plugins/filter_fontawesome) in Moodle plugins repository

## License
* Written by Julian (@moodleman) Ridden. Visit the blog at http://www.moodleman.net
* Updated by David Bezemer. Visit his company page at http://www.uplearning.nl
* Updated to FontAwesome version 4.7 by Usman Asar
* Keep up-to-date by [Adrian Perez Rodriguez](https://github.com/adpe)