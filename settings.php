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
 * @package   block_globalad
 * @copyright 2018, angelitr0 <angelluisfraile@angelitro.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading(
               'headerconfig',
                get_string('headerconfig', 'block_globalad'),
                get_string('descconfig', 'block_globalad')
            ));
    $settings->add(new admin_setting_confightmleditor(
               'globalad/title_globalad',
                get_string('tit', 'block_globalad'),
                get_string('desctit', 'block_globalad'),
                "Ad title"
	        ));
    $settings->add(new admin_setting_confightmleditor(
               'globalad/message_globalad',
                get_string('ad_text', 'block_globalad'),
                get_string('descadtext', 'block_globalad'),
                "Ad content"
            ));
}