/**
* @package     Joomla.Administrator
* @subpackage  Templates.isis
* @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
* @since       3.0
*/

"use strict";

(function ($) {
    $(document).ready(function () {
        // Turn radios into btn-group
        $("#button-coord").on("click", function (e) {
            if ($('#jform_postal_code').val() || $('#jform_city').val()) {
                var address = $('#jform_address').val() + ' ' + $('#jform_postal_code').val() + " " + $('#jform_city').val();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': address }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();

                        $('#jform_latitude').val(latitude);
                        $('#jform_longitude').val(longitude);
                    }
                });
            }
        });
    });
})(jQuery);