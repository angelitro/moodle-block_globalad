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
 * @copyright 2018, angelitr0 <angelluisfraile@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_globalad extends block_base {

    public function init(){

        global $CFG;

        $titulo = get_config('globalad', 'title_globalad');
        $this->blockname = get_class($this);
        $this->title = $titulo;
    }

    public function html_attributes() {
        $attributes = parent::html_attributes(); // Get default values
        $attributes['class'] .= ' block_' .  $this->name(); // Append our class to class attribute
        return $attributes;
    }

    public function has_config() {
        return true;
    }

    public function get_content() { // Contenido del bloque.

        global $DB, $COURSE, $CFG, $PAGE;

        if ($this->content !== NULL) {
            return $this->content;
        }        
        
        $this->content = new stdClass;
        $this->content->text = '';

        if (!isloggedin()) {
            return $this->content;
        }

        $course = $COURSE;

        if (!$course) {
            print_error('coursedoesnotexists');
        }

        if ($course->id == SITEID) {
            $context = context_system::instance();
        } else {
            $context = context_course::instance($course->id);
        }

        if (!empty($this->config->text)) {
           $this->content->text = $this->config->text;
        }

        $canview = has_capability('block/globalad:view', $context);
        $canmanage = has_capability('block/globalad:manage', $context) && $PAGE->user_is_editing($this->instance->id);

        $titulo = get_config('globalad', 'title_globalad');
        $anuncio = get_config('globalad', 'message_globalad');
 
        if ($canview) {

             $this->content->text = $anuncio;
        }

        if ($canmanage) { //Editar el anuncio global.

            $url = new moodle_url('/admin/settings.php?section=blocksettingglobalad');
            $this->content->text .= html_writer::start_tag('div');
            $this->content->text .= html_writer::link($url, get_string('modificar', 'block_globalad'));
            $this->content->text .= html_writer::end_tag('div');
        }

        return $this->content;
    }
}