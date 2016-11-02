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
        $('input[name="type"]').on('change', function () {
            var type = $('input[name="type"]:checked').val();
            FM.displayContent({ type: type });
        });
    });
})(jQuery);