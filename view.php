<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Prints an instance of mod_extdeletecaps.
 *
 * @package     mod_extdeletecaps
 * @copyright   2022 Scott Verbeek <scottverbeek@catalyst-it.net
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot.'/mod/page/lib.php');
require_once($CFG->dirroot.'/mod/page/locallib.php');
require_once($CFG->libdir.'/completionlib.php');

$id  = required_param('id', PARAM_INT); // Course Module ID

if (!$cm = get_coursemodule_from_id('extdeletecaps', $id)) {
    print_error('invalidcoursemodule');
    exit;
}
$module = $DB->get_record('extdeletecaps', array('id' => $cm->instance), '*', MUST_EXIST);
$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);

require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/extdeletecaps:view', $context);

$PAGE->set_url('/mod/extdeletecaps/view.php', array('id' => $cm->id));
$PAGE->add_body_class('limitedwidth');
$PAGE->set_title($course->shortname.': '.$module->name);
$PAGE->set_heading($course->fullname);
$PAGE->set_activity_record($module);

echo $OUTPUT->header();
$formatoptions = new stdClass;
$formatoptions->noclean = true;
$formatoptions->overflowdiv = true;
$formatoptions->context = $context;
$content = format_text($module->content, $module->introformat, $formatoptions);
echo $OUTPUT->box($content, "generalbox center clearfix");

echo $OUTPUT->footer();
