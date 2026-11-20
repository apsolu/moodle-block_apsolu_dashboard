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
 * Gère l'enregistrement des préferences de l'onglet "Mes enseignements".
 *
 * @package   block_apsolu_dashboard
 * @copyright 2026 Université Rennes 2
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

require_login($courseorid = null, $autologinguest = false);

$context = context_user::instance($USER->id);
$PAGE->set_context($context);

foreach (block_apsolu_dashboard_user_preferences() as $key => $preference) {
    if (str_starts_with($key, 'block_apsolu_dashboard_teachings_') === false) {
        continue;
    }

    $value = optional_param($key, 0, $preference['type']);

    if ($key === 'block_apsolu_dashboard_teachings_sort_order' && in_array($value, ['name', 'time'], $strict = true) === false) {
        continue;
    }

    set_user_preference($key, $value);
}

redirect($CFG->wwwroot . '/my#teachings');
