/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        $('.mod-fmmanager-findpersons #filter input').on('keypress', function (event) {
            if (event.which === 13)
                updatePersons($(this).closest('.mod-fmmanager-findpersons').attr('id'));
        });

        $('.mod-fmmanager-findpersons #filter .btn').on('click', function () {
            updatePersons($(this).closest('.mod-fmmanager-findpersons').attr('id'));
        });
    });

    function updatePersons(id) {
        var name = $('#' + id + ' input[name*="[name]"]').val();
        FM.displayModule('fmmanager_findpersons', id, { name: name });

        return false;
    }
})(jQuery)