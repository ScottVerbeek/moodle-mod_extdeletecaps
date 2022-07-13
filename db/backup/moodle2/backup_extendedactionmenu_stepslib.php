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
 * @package   mod_extdeletecaps
 * @category  backup
 * @copyright 2022 Scott Verbeek <scottverbeek@catalyst-it.net
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;


/**
 * Define all the backup steps that will be used by the backup_extdeletecaps_activity_task
 */
class backup_extdeletecaps_activity_structure_step extends backup_activity_structure_step {

    protected function define_structure() {

        // To know if we are including userinfo
        $userinfo = $this->get_setting_value('userinfo');

        // Define each element separated
        $module = new backup_nested_element('extdeletecaps', array('id'), array(
            'name', 'intro', 'introformat', 'content', 'timecreated', 'timemodified'));

        // Build the tree
        // (love this)

        // Define sources
        $module->set_source_table('extdeletecaps', array('id' => backup::VAR_ACTIVITYID));

        // Define id annotations
        // (none)

        // Define file annotations
        $module->annotate_files('mod_extdeletecaps', 'intro', null); // This file areas haven't itemid

        // Return the root element, wrapped into standard activity structure
        return $this->prepare_activity_structure($module);
    }
}