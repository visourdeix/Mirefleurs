/**
* @package     Joomla.Administrator
* @subpackage  Templates.isis
* @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
* @since       3.0
*/

'use strict';

(function ($) {
    $(document).ready(function () {
        var displayContent = function () {
            var type = $('input[name="type"]:checked').val();
            var competitions = [];

            $('input[name="competitions[]"]').each(function () {
                if ($(this).attr('checked') === 'checked') competitions.push($(this).val());
            });

            FM.displayContent({ type: type, competitions: competitions });
        }

        $('input[name="type"], input[name="competitions[]"]').on('change', function () {
            displayContent();
        });
        displayContent();
    });
})(jQuery);