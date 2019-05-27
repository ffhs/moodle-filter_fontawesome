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
 * Unit test for the filter_fontawesome.
 *
 * @package    filter_fontawesome
 * @copyright  2014 Damyon Wiese
 * @author     2019 Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/filter/fontawesome/filter.php');

/**
 * Unit tests for filter_fontawesome.
 *
 * Test the square brackets parsing used by the Fontawesome icons filter.
 *
 * @copyright  2014 Damyon Wiese
 * @author     2019 Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_fontawesome_testcase extends advanced_testcase {

    /** @var object $filter contains the instance */
    protected $filter;

    protected function setUp() {
        parent::setUp();
        $this->resetAfterTest(true);
        $this->filter = new filter_fontawesome(context_system::instance(), array());
    }

    /**
     * Translate the text for a single fontawesome icon into the rendered value.
     *
     * @param string $content contains the fontawesome icon class
     * @param bool $filtershouldrun does this run must success or not
     */
    public function run_with_content($content, $filtershouldrun) {
        $pre = 'Some pre text';
        $post = 'Some post text';

        $before = $pre . ' [' . $content . '] ' . $post;

        $after = trim($this->filter->filter($before));

        if ($filtershouldrun) {
            $this->assertNotEquals($after, $before);
        } else {
            $this->assertEquals($after, $before);
        }
    }

    public function test_cases() {
        // First test the list of supported content.
        $this->run_with_content('fa-check', true);
        $this->run_with_content('fa-check fa-2x', true);
        $this->run_with_content('fa-check fa-spin', true);
        $this->run_with_content('fa-check fa-flip', true);
        $this->run_with_content('fa-check fa-3x fa-fw', true);
        $this->run_with_content('icon fa-check', true);
        $this->run_with_content('icon fa-check fa-4x', true);
        $this->run_with_content('fab fa-telegram', true);
        $this->run_with_content('fab fa-telegram fa-5x', true);
        // Now test some cases that shouldn't be executed.
        $this->run_with_content('Some text fa-check', false);
        $this->run_with_content('fas-check', false);
        $this->run_with_content('far-check', false);
        $this->run_with_content('fal-check', false);
        $this->run_with_content('fab-telegram', false);
        $this->run_with_content('f-check', false);
        $this->run_with_content('fa-check onmouseover="alert(1)"', false);
        $this->run_with_content('fa-check" onmouseover="alert(1)""', false);
    }
}
