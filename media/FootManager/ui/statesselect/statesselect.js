/**
 * @package		Joomla.JavaScript
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

(function (factory) {

    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.
        if (typeof jQuery === 'undefined') {
            throw 'statesselect requires jQuery to be loaded first';
        }
        factory(jQuery);
    }
}(function ($) {

    var statesselect = function (element) {
 
        if (element !== undefined) {
            var cls = element.attr("class").replace(/^.(fm-chzn-states[a-z0-9-_]*)$.*/, 1);
            var container = element.next('.chzn-container').find('.chzn-single');

            if (container !== undefined) {
                container.addClass(cls + ' center').attr('rel', 'value_' + element.val());
                container.attr('title', container.find("span").text());
                container.tooltip({ placement: 'right' });
                element.on('change click liszt:updated', function () {
                    container.attr('rel', 'value_' + element.val());
                    container.attr('data-original-title', container.find("span").text());
                });
            }
        }

        return element;

    };


    /********************************************************************************
     *
     * jQuery plugin constructor and defaults object
     *
     ********************************************************************************/

    $.fn.statesselect = function () {
        return this.each(function () {
            var $this = $(this);
            if (!$this.data('statesselect')) {
                // create a private copy of the defaults object
                $this.data('statesselect', statesselect($this));
            }
        });
    };

}));
