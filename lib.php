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
 * Library of interface functions and constants.
 *
 * @package     mod_extdeletecaps
 * @copyright   2022 Scott Verbeek <scottverbeek@catalyst-it.net
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Callback to add additional capabilities.
 *
 * @param int $cmid
 * @return array return an array of capabilities
 */
function extdeletecaps_extended_delete_capabilities($cmid) {
    return ["mod/extdeletecaps:delinstance"];
}


/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
function extdeletecaps_supports($feature) {
    switch ($feature) {
        case FEATURE_BACKUP_MOODLE2: return true;
        case FEATURE_MOD_INTRO:      return true;

        default: return null;
    }
}

/**
 * Saves a new instance of the mod_extdeletecaps into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_extdeletecaps_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function extdeletecaps_add_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timecreated = time();

    $id = $DB->insert_record('extdeletecaps', $moduleinstance);

    return $id;
}

/**
 * Updates an instance of the mod_extdeletecaps in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_extdeletecaps_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function extdeletecaps_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('extdeletecaps', $moduleinstance);
}

/**
 * Removes an instance of the mod_extdeletecaps from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function extdeletecaps_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('extdeletecaps', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('extdeletecaps', array('id' => $id));

    return true;
}
