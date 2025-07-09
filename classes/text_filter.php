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
 * @author     2019 onwards Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @author     2022 onwards Sascha Vogel, Fernfachhochschule Schweiz (FFHS) <sascha.vogel@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_fontawesome;

if (class_exists('\core_filters\text_filter')) {
    class_alias('\core_filters\text_filter', 'fontawesome_base_text_filter');
} else {
    class_alias('\moodle_text_filter', 'fontawesome_base_text_filter');
}

/**
 * Fontawesome icons filter class.
 *
 * @copyright  2013 Julian Ridden <julian@moodleman.net>
 * @author     2019 onwards Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @author     2022 onwards Sascha Vogel, Fernfachhochschule Schweiz (FFHS) <sascha.vogel@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class text_filter extends \fontawesome_base_text_filter {

    /**
     * Override this function to actually implement the filtering.
     *
     * Filter developers must make sure that filtering done after text cleaning
     * does not introduce security vulnerabilities.
     *
     * @param string $text some HTML content to process.
     * @param array $options options passed to the filters
     * @return string the HTML content after the filtering has been applied.
     */

    /**
     * Replace all square brackets occurrences.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = []) {
        // Extract the parts that should not be processed.
        // Does not support span in span tags.
        $filterignoretagsopen  = ['<nolink[^>]*>', '<span[^>]+?class="([^"]*\s)?nolink(\s[^"]*)?"[^>]*?>'];
        $filterignoretagsclose = ['</nolink>', '</span>'];
        $ignoretags = [];
        filter_save_ignore_tags($text, $filterignoretagsopen, $filterignoretagsclose, $ignoretags);

        // We should search only for reference to FontAwesome icons and if optional icon and fab classes are set.
        $search = '(\[((?:icon\s+)?)((?:fa[a-z]*\s+)?)(fa-[a-z0-9 -]+)\])is';
        $result = preg_replace_callback($search, [$this, 'filter_fontawesome_callback'], $text);

        // Put back extracted parts.
        if (!empty($ignoretags)) {
            $ignoretags = array_reverse($ignoretags);
            $result = str_replace(array_keys($ignoretags), $ignoretags, $result);
        }

        return $result;
    }

    /**
     * Callback used by filter.
     *
     * @param array $matches list of icon keywords to be processed
     * @return string $embed the modified result
     */
    private function filter_fontawesome_callback(array $matches): string {

        $addbefore = '<i class="';
        $addafter = '" aria-hidden="true"></i>';

        $hasstyleclass = false;

        $classes = [];

        $iconclass = trim($matches[1]);
        if ($iconclass) {
            $classes[] = $iconclass;
        }

        $shortstyleclass = trim($matches[2]);
        if ($shortstyleclass && $shortstyleclass != 'fa') {
            $classes[] = $shortstyleclass;
            $hasstyleclass = true;
        }

        $otherclasses = trim(preg_replace('/\s+/', ' ', $matches[3]));

        // Remove fa.
        $otherclasses = preg_replace('/^fa /', '', $otherclasses);
        $otherclasses = preg_replace('/ fa /', '', $otherclasses);
        $otherclasses = preg_replace('/ fa$/', '', $otherclasses);

        $otherclassesarray = preg_split('/\s/', $otherclasses);
        foreach ($otherclassesarray as $class) {
            // If there are font family or style classes, no need for adding a fa class.
            if (preg_match('/^fa-(solid|regular|light|thin|classic|duotone|sharp|sharp-duotone)$/i', $class)) {
                $hasstyleclass = true;
            }
        }

        // Add fa class only when no other style class exists.
        if (!$hasstyleclass) {
            $classes[] = 'fa';
        }

        $classes = array_merge($classes, $otherclassesarray);

        return $addbefore . implode(' ', $classes) . $addafter;
    }
}
