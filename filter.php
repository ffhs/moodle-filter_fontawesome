<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Filter converting defined FontAwesome icons in brackets in to HTML embed code.
 *
 * @package    filter_fontawesome
 * @copyright  2013 Julian Ridden <julian@moodleman.net>
 * @author     2019 Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Fontawesome icons filter class.
 *
 * @copyright  2013 Julian Ridden <julian@moodleman.net>
 * @author     2019 Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_fontawesome extends moodle_text_filter {

    /**
     * Replace all square brackets occurrences.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = array()) {

        // We should search only for reference to FontAwesome icons and if optional icon and fab classes are set.
        $search = "(\[((?:icon\s)?)((?:fa[a-z]\s)?)(fa-[a-z0-9 -]+)\])is";
        $result = preg_replace_callback($search, array($this, 'filter_fontawesome_callback'), $text);

        return $result;
    }

    /**
     * Callback used by filter.
     *
     * @param array $matches list of icon keywords to be processed
     * @return string $embed the modified result
     */
    private function filter_fontawesome_callback($matches) {
        if (!empty($matches[2])) {
            $embed = '<i class="' . $matches[1] . $matches[2] . $matches[3] . '" aria-hidden="true"></i>';
        } else {
            $embed = '<i class="' . $matches[1] . ' fa ' . $matches[3] . '" aria-hidden="true"></i>';
        }

        return $embed;
    }
}
