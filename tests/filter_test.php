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
 * @author     2022 Sascha Vogel, Fernfachhochschule Schweiz (FFHS) <sascha.vogel@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_fontawesome;

/**
 * Unit tests for filter_fontawesome.
 *
 * Test the square brackets parsing used by the Fontawesome icons filter.
 *
 * @copyright  2014 Damyon Wiese
 * @author     2019 Adrian Perez, Fernfachhochschule Schweiz (FFHS) <adrian.perez@ffhs.ch>
 * @author     2022 Sascha Vogel, Fernfachhochschule Schweiz (FFHS) <sascha.vogel@ffhs.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class filter_test extends \advanced_testcase {

    /** @var object $filter contains the instance */
    protected $filter;

    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest(true);
        $this->filter = new text_filter(\context_system::instance(), []);
    }

    /**
     * Translate the text for a single fontawesome icon into the rendered value.
     *
     * @param string $content contains the fontawesome icon class
     * @param bool $filtershouldrun does this run must success or not
     */
    public function run_with_content(string $content, bool $filtershouldrun) {
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

    /**
     * Test some icon contents.
     *
     * @covers \filter_fontawesome\text_filter
     * @return void
     */
    public function test_cases(): void {
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
        $this->run_with_content('fad fa-angel', true);
        $this->run_with_content('fal fa-child fa-2x', true);
        $this->run_with_content('fas fa-smile', true);
        $this->run_with_content('far fa-book', true);
        // Now test some cases that shouldn't be executed.
        $this->run_with_content('Some text fa-check', false);
        $this->run_with_content('fas-check', false);
        $this->run_with_content('far-check', false);
        $this->run_with_content('fal-check', false);
        $this->run_with_content('fab-telegram', false);
        $this->run_with_content('f-check', false);
        $this->run_with_content('fa-check onmouseover="alert(1)"', false);
        $this->run_with_content('fa-check" onmouseover="alert(1)""', false);
        $this->run_with_content('fad-angel', false);
    }

    /**
     * Data provider for fontawesome filtering tests.
     */
    public static function fontawesome_testcases(): array {
        return [
            'Filter an icon in a text' => [
                'Hello [fa-world] world',
                'Hello <i class="fa fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with fa prefix' => [
                'Hello [fa fa-world] world',
                'Hello <i class="fa fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with short version of solid style' => [
                'Hello [fas fa-world] world',
                'Hello <i class="fas fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with solid style' => [
                'Hello [fa-solid fa-world] world',
                'Hello <i class="fa-solid fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon, suffixed with regular style' => [
                'Hello [fa-world fa-regular] world',
                'Hello <i class="fa-world fa-regular" aria-hidden="true"></i> world',
            ],
            'Filter an icon with redundant spaces' => [
                'Hello [fa-solid  fa-world] world',
                'Hello <i class="fa-solid fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with icon class' => [
                'Hello [icon fa-world] world',
                'Hello <i class="icon fa fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with fa and icon class' => [
                'Hello [icon fa fa-world] world',
                'Hello <i class="icon fa fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with short style and icon class' => [
                'Hello [icon fas fa-world] world',
                'Hello <i class="icon fas fa-world" aria-hidden="true"></i> world',
            ],
            'Filter an icon with long style and icon class' => [
                'Hello [icon fa-solid fa-world] world',
                'Hello <i class="icon fa-solid fa-world" aria-hidden="true"></i> world',
            ],
            'No filter in <nolink> tag' => [
                'Hello <nolink>[fa-world]</nolink> world, hello <nolink>[fa-star] stars</nolink>',
                'Hello <nolink>[fa-world]</nolink> world, hello <nolink>[fa-star] stars</nolink>',
            ],
            'No filter in nolink span tag' => [
                'Hello <span class="nolink">[fa-world]</span> world',
                'Hello <span class="nolink">[fa-world]</span> world',
            ],
            'No filter in extended nolink span tag' => [
                'Hello <span id="test" class="anotherclass1 nolink anotherclass2">[fa-world]</span> world',
                'Hello <span id="test" class="anotherclass1 nolink anotherclass2">[fa-world]</span> world',
            ],
            'No filter in whole text' => [
                '<nolink>Hello [fa-world] world</nolink>',
                '<nolink>Hello [fa-world] world</nolink>',
            ],
            'Mix filter and no filter' => [
                'Hello [fa-world],
                hello <span class="nolink">[fa-sun]</span>, hello <nolink>[fa-star]</nolink> stars',
                'Hello <i class="fa fa-world" aria-hidden="true"></i>,
                hello <span class="nolink">[fa-sun]</span>, hello <nolink>[fa-star]</nolink> stars',
            ],
            'Nest nolink tags and span tags' => [
                'Hello [fa-world],
                hello <span class="nolink">[fa-sun], hello <nolink>[fa-star]</nolink> stars</span>',
                'Hello <i class="fa fa-world" aria-hidden="true"></i>,
                hello <span class="nolink">[fa-sun], hello <nolink>[fa-star]</nolink> stars</span>',
            ],
        ];
    }

    /**
     * Check that all texts are filtered correctly.
     *
     * @covers \filter_fontawesome\text_filter
     * @dataProvider fontawesome_testcases
     * @param string $text
     * @param string $expected
     * @return void
     */
    public function test_filter_fontawesome(string $text, string $expected): void {
        $result = $this->filter->filter($text);
        $this->assertEquals($expected, $result);
    }
}
