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
            throw 'radio requires jQuery to be loaded first';
        }
        factory(jQuery);
    }
}(function ($) {

    var radio = function (element) {

        var resetInput = function () {
            element.find('input[type="radio"]').each(function () {
                var button = element.find('button[for="' + $(this).attr("id") + '"]');
                button.removeClass('active ' + button.attr('active_class'));
            });
        },
        updateInput = function (input) {
            var button = element.find('button[for="' + input.attr("id") + '"]');
            if (input.prop('checked')) {
                resetInput();
                button.addClass('active ' + button.attr('active_class'));
            }
        }
        
        element.addClass('btn-group');
        
        element.find('input[type="radio"]').each(function () {
            var button = element.find('button[for="' + $(this).attr("id") + '"]');

            button.addClass('hasTooltip btn');
            $(this).hide();

                if (button.attr('active_class') == "" || button.attr('active_class') == undefined) {
                    if ($(this).val() == '') {
                        button.attr('active_class', 'btn-primary');
                    } else if ($(this).val() == 0) {
                        button.attr('active_class', 'btn-danger');
                    } else {
                        button.attr('active_class', 'btn-success');
                    }
                }
                updateInput($(this));

                button.click(function () {
                    var buttonSource = $(this);
                    var inputTarget = element.find('#' + buttonSource.attr('for'));
                    if (!element.hasClass("disabled") && !buttonSource.hasClass("active") && !buttonSource.hasClass("disabled")) {
                        if (!inputTarget.prop('checked')) {
                            inputTarget.prop('checked', true);
                            inputTarget.trigger('change');
                        }
                    }

                    return false;
                });
        });

        element.find('input[type="radio"]').on("change", function () {
            updateInput($(this));
        });

        return element;

    };


    /********************************************************************************
     *
     * jQuery plugin constructor and defaults object
     *
     ********************************************************************************/

    $.fn.radio = function () {
        return this.each(function () {
            var $this = $(this);
            if (!$this.data('radio')) {
                // create a private copy of the defaults object
                $this.data('radio', radio($this));
            }
        });
    };

}));
