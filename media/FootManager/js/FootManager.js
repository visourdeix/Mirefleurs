/**
 * @package         NoNumber Framework
 * @version         16.4.304
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2016 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

var FM = null;
var base64 = null;
var unloading = false;

(function ($) {
    "use strict";

    $(window).unload(function () { unloading = true; });

    $(document).ready(function () {
        if (typeof FastClick !== "undefined")
            FastClick.attach(document.body);

        // add color classes to chosen field based on value
        $('select[class^="fm-chzn-states"], select[class*=" fm-chzn-states"]').on("liszt:ready", function () {
            var select = $(this);
            var cls = this.className.replace(/^.(fm-chzn-states[a-z0-9-_]*)$.*/, 1);
            var container = select.next(".chzn-container").find(".chzn-single");
            container.addClass(cls).attr("rel", "value_" + select.val());
            select.on("change click", function () {
                container.attr("rel", "value_" + select.val());
            });
        });

        // Toggles All
        $(".fmtoggles .all .btn").on("click", function () {
            var val = $(this).hasClass("active") ? "off" : "on";
            $(this).closest(".fmtoggles").find('li:not(.all) input[type="checkbox"]').bootstrapToggle(val);
            if (val === "off") $(this).removeClass("active"); else $(this).addClass("active");
        });

        // Lazy
        $("img.fm-img-async").lazy();

        // Social buttons
        /**
 * jQuery function to prevent default anchor event and take the href * and the title to make a share pupup
 *
 * @param  {[object]} e           [Mouse event]
 * @param  {[integer]} intWidth   [Popup width defalut 500]
 * @param  {[integer]} intHeight  [Popup height defalut 400]
 * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
 */
        $.fn.openPopup = function (e, intWidth, intHeight, blnResize) {
            // Prevent default anchor event
            e.preventDefault();

            // Set values for window
            intWidth = intWidth || '500';
            intHeight = intHeight || '400';
            var strResize = (blnResize ? 'yes' : 'no');

            // Set title and open popup with focus on it
            var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
                strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,
                objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
        }

        $(document).ready(function ($) {
            $('.fm-social-share a:not(.fm-mail)').on("click", function (e) {
                $(this).openPopup(e);
            });
        });
    });

    FM = {
        startLoading: function (selectorLoading) {
            if (jQuery(selectorLoading).find('.cssload-loader').length === 0)
                jQuery(selectorLoading).append(jQuery('<div class="cssload-loader"></div>'));

            jQuery(selectorLoading).css("position", "relative").css("min-height", "150px").css("opacity", "0.5");
        },

        endLoading: function (selectorLoading) {
            jQuery(selectorLoading + " .cssload-loader").remove();
            jQuery(selectorLoading).css("min-height", "").css("opacity", "");
        },

        loadAjax: function (url, data, callbackSuccess, selectorLoading, callbackAlways) {
            if (selectorLoading !== undefined && selectorLoading !== "")
                FM.startLoading(selectorLoading);

            var jqxhr = jQuery.ajax(url, { data: data })

                .done(function (result) {
                    if (callbackSuccess !== undefined)
                        callbackSuccess(result);
                })

                .fail(function (result) {
                    if (unloading) return;
                    alert('Error: ' + jqxhr.status + ' ' + jqxhr.statusCode() + ' ' + result.responseText);
                })

                .always(function (result) {
                    if (callbackAlways !== undefined)
                        callbackAlways(result);

                    if (selectorLoading !== undefined && selectorLoading !== "")
                        FM.endLoading(selectorLoading);
                });
        },

        loadAjaxModule: function (module, data, callbackSuccess) {
            var url = 'index.php?option=com_ajax&module=' + module + '&format=json';
            FM.loadAjax(url, data, callbackSuccess);
        },

        loadAjaxPlugin: function (group, plugin, data, callbackSuccess) {
            var url = 'index.php?option=com_ajax&group=' + group + '&plugin=' + plugin + '&format=json';
            FM.loadAjax(url, data, callbackSuccess);
        },

        displayAjax: function (url, data, target, callbackSuccess, callbackAlways) {
            var success = function (result) {
                var content;
                if (jQuery.type(result) === "string")
                    content = jQuery.parseJSON(result).data;
                else {
                    content = result.data;
                }

                var div = jQuery(target);
                div.html(jQuery(content).fadeIn('slow'));

                div.find("table").bootstrapTable();
                div.find(".hasTooltip").tooltip();
                div.find('img.fm-img-async').lazy({ bind: "event" });

                if (callbackSuccess !== undefined)
                    callbackSuccess();
            };

            FM.loadAjax(url, data, success, target, callbackAlways);
        },

        displayContent: function (customParams, callbackSuccess, callbackAlways) {
            var id = jQuery("#fm-id").val();
            var view = jQuery("#fm-view").val();
            var component = jQuery("#fm-component").val();
            var paramsStr = base64.decode(jQuery("#fm-params").val());
            var customParamsStr = base64.decode(jQuery("#fm-custom-params").val());

            var params = (paramsStr == undefined || paramsStr === '') ? {} : JSON.parse(paramsStr);
            var custom = (customParamsStr == undefined || customParamsStr === '') ? {} : JSON.parse(customParamsStr);

            jQuery.extend(params, custom, customParams);

            if (id == undefined) id = 0;

            if (view !== undefined && component !== undefined) {
                var url = 'index.php?option=' + component + '&task=' + view + '.displayContent';

                var data = {
                    id: id,
                    params: base64.encode(JSON.stringify(params)),
                    model: view
                };

                FM.displayAjax(url, data, "#fm-content", callbackSuccess, callbackAlways);
            }
        },

        displayModule: function (module, id, customParams, itemid, callbackSuccess, callbackAlways) {
            var paramsStr = base64.decode(jQuery("#" + id + " #fm-module-params").val());
            var customParamsStr = base64.decode(jQuery("#" + id + " #fm-module-custom-params").val());

            var params = (paramsStr == undefined || paramsStr === "") ? {} : JSON.parse(paramsStr);
            var custom = (customParamsStr == undefined || customParamsStr === '') ? {} : JSON.parse(customParamsStr);

            jQuery.extend(params, custom, customParams);

            if (id == undefined) id = 0;

            if (itemid == undefined) itemid = jQuery("#" + id + " #fm-itemid").val();

            var url = 'index.php?option=com_ajax&module=' + module + '&format=json';

            var data = {
                params: base64.encode(JSON.stringify(params)),
                Itemid: itemid
            };

            FM.displayAjax(url, data, "#" + id + " #fm-content", callbackSuccess, callbackAlways);
        },

        loadAjaxData: function (functionName, data, callbackSuccess, selectorLoading, callbackAlways) {
            var dataToSend = { data: data, func: functionName };
            var component = jQuery("#fm-component").val();
            var url = 'index.php?option=' + component + '&task=data.getData';

            var success = function (result) {
                var returnData;
                if (jQuery.type(result) === "string")
                    returnData = jQuery.parseJSON(result).data;
                else {
                    returnData = result.data;
                }

                callbackSuccess(returnData);
            };

            FM.loadAjax(url, dataToSend, success, selectorLoading, callbackAlways);
        },

        updateNavigation: function (id) {
            var newPage = $('#' + id + ' #fm-page').val();
            newPage = (newPage === undefined) ? 0 : parseInt(newPage);
            var totalPages = $('#' + id + ' #fm-total-pages').val();
            totalPages = (totalPages === undefined) ? 0 : parseInt(totalPages);
            $('#' + id + ' #fm-previous').attr("data-page", newPage - 1);
            $('#' + id + ' #fm-next').attr("data-page", newPage + 1);

            if (newPage <= 1) {
                $('#' + id + ' #fm-previous').attr("data-page", 1);
                $('#' + id + ' #fm-previous').addClass("fm-disabled");
            } else {
                $('#' + id + ' #fm-previous').removeClass("fm-disabled");
            }

            if (newPage >= totalPages) {
                $('#' + id + ' #fm-next').attr("data-page", totalPages);
                $('#' + id + ' #fm-next').addClass("fm-disabled");
            } else {
                $('#' + id + ' #fm-next').removeClass("fm-disabled");
            }

            if (totalPages === 0) {
                $('#' + id + ' #fm-next').addClass("fm-disabled");
                $('#' + id + ' #fm-previous').addClass("fm-disabled");
            }
        },

        toggleSelectListSelection: function (id) {
            var el = document.getElement('#' + id);
            if (el && el.options) {
                for (var i = 0; i < el.options.length; i++) {
                    if (!el.options[i].disabled) {
                        el.options[i].selected = !el.options[i].selected;
                    }
                }
            }
        },

        in_array: function (needle, haystack, casesensitive) {
            if ({}.toString.call(needle).slice(8, -1) !== 'Array') {
                needle = [needle];
            }
            if ({}.toString.call(haystack).slice(8, -1) !== 'Array') {
                haystack = [haystack];
            }

            for (var h = 0; h < haystack.length; h++) {
                for (var n = 0; n < needle.length; n++) {
                    if (casesensitive) {
                        if (haystack[h] === needle[n]) {
                            return true;
                        }
                    } else {
                        if (haystack[h].toLowerCase() === needle[n].toLowerCase()) {
                            return true;
                        }
                    }
                }
            }
            return false;
        },

        getObjectFromXML: function (xml) {
            if (!xml) {
                return false;
            }

            var obj = [];
            $(xml).find("extension").each(function () {
                var el = [];
                $(this).children().each(function () {
                    el[this.nodeName.toLowerCase()] = String($(this).text()).trim();
                });
                if (typeof (el.alias) !== "undefined") {
                    obj[el.alias] = el;
                }
                if (typeof (el.extname) !== "undefined" && el.extname !== el.alias) {
                    obj[el.extname] = el;
                }
            });

            return obj;
        },

        initCheckAll: function (checkbox, parent) {
            $(checkbox).attr("checked", FM.allChecked(parent));

            $(parent).find("input:checkbox").click(function () {
                $(checkbox).attr("checked", FM.allChecked(parent));
            });

            $(checkbox).click(function () {
                var checked = $(checkbox).attr("checked");
                if (checked) {
                    FM.checkAll(parent);
                } else {
                    FM.uncheckAll(parent);
                }
            });
        },

        allChecked: function (parent) {
            return $(parent).find("input:checkbox:not(:checked)").length < 1;
        },

        checkAll: function (parent) {
            $(parent).find("input:checkbox").attr("checked", true);
        },

        uncheckAll: function (parent) {
            $(parent).find("input:checkbox").attr("checked", false);
        },

        toggleAll: function (parent) {
            $(parent).find("input:checkbox").click(function () {
                $(this).attr("checked", !$(this).attr("checked"));
            });
        },

        show: function (selector) {
            $(selector).show();
        },

        hide: function (selector) {
            $(selector).hide();
        },

        toggleVisibility: function (field, valueForShow, selector) {
            $(field).on("change", function () {
                if ($(field).val() === valueForShow)
                    FM.show(selector);
                else {
                    FM.hide(selector);
                }
            }).trigger("change");
        },

        getEditorSelection: function (editorname) {
            var editorTextarea = document.getElementById(editorname);

            if (!editorTextarea) {
                return "";
            }

            var iframes = editorTextarea.parentNode.getElementsByTagName("iframe");

            if (!iframes.length) {
                return "";
            }

            var editorFrame = iframes[0];
            var contentWindow = editorFrame.contentWindow;

            if (typeof contentWindow.getSelection != "undefined") {
                var sel = contentWindow.getSelection();

                if (sel.rangeCount) {
                    var container = contentWindow.document.createElement("div");
                    var len = sel.rangeCount;
                    for (var i = 0; i < len; ++i) {
                        container.appendChild(sel.getRangeAt(i).cloneContents());
                    }

                    return container.innerHTML;
                }

                return "";
            }

            if (typeof contentWindow.document.selection != "undefined") {
                if (contentWindow.document.selection.type === "Text") {
                    return contentWindow.document.selection.createRange().htmlText;
                }

                return "";
            }

            return "";
        },

        getValue: function (key) {
            var element = $(key);
            if (!element) {
                return null;
            }
            var elementLength = element.length;
            if (element.type === 'select-one' || !elementLength) {
                if (element.type === 'checkbox' && !element.checked) {
                    return '';
                }
                return element.value;
            } else {
                for (var i = 0; i < elementLength; i++) {
                    if ((element.type === 'checkbox' && element[i].checked) || (element.type !== 'checkbox' && element[i].selected)) {
                        return element[i].value;
                    }
                }
            }
            return '';
        },

        setValue: function (key, value) {
            var $els = $(key);

            $els.each(function (i, el) {
                var $el = $(el);

                if (el.type !== 'text' && el.type !== 'textarea' && el.type !== 'url') {
                    $el.removeAttr("selected").removeAttr("checked");
                    $el.find("option:selected").removeAttr("selected");
                }
            });

            $els.each(function (index, el) {
                var $el = $(el);

                if (el.type === 'text' || el.type === 'textarea' || el.type === 'url') {
                    $el.val(value.toString());
                } else {
                    var values = value.toString().split(',');
                    var valuesLength = values.length;
                    for (var i = 0; i < valuesLength; i++) {
                        var val = values[i].toString();
                        if (el.type.substr(0, 6) === 'select') {
                            $el.find('option[value="' + val + '"]').attr("selected", "selected");
                            $el.trigger('liszt:updated');
                        } else {
                            if ($el.val() === val) {
                                $('label[for="' + $el.attr('id') + '"]').trigger('click');
                                $el.attr("checked", "checked");
                            }
                        }
                    }
                }
                $el.change();
            });
        },

        rgbWithAlfa: function (hexValue, alpha) {
            var rgb = FM.hexToRGB(hexValue);
            if (!rgb)
                return null;
            return "rgba(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ", " + alpha + ")";
        },

        hexToRGB: function (hex) {
            hex = parseInt(((hex.indexOf("#") > -1) ? hex.substring(1) : hex), 16);
            return {
                /* jshint ignore:start */
                r: hex >> 16,
                g: (hex & 0x00FF00) >> 8,
                b: (hex & 0x0000FF)
                /* jshint ignore:end */
            };
        }
    };

    /**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/
    base64 = {
        // private property
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

        // public method for encoding
        encode: function encode(input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            if (input !== undefined) {
                input = base64._utf8_encode(input);

                while (i < input.length) {
                    chr1 = input.charCodeAt(i++);
                    chr2 = input.charCodeAt(i++);
                    chr3 = input.charCodeAt(i++);

                    enc1 = chr1 >> 2;
                    enc2 = (chr1 & 3) << 4 | chr2 >> 4;
                    enc3 = (chr2 & 15) << 2 | chr3 >> 6;
                    enc4 = chr3 & 63;

                    if (isNaN(chr2)) {
                        enc3 = enc4 = 64;
                    } else if (isNaN(chr3)) {
                        enc4 = 64;
                    }

                    output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
                }
            }

            return output;
        },

        // public method for decoding
        decode: function decode(input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            if (input !== undefined) {
                input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

                while (i < input.length) {
                    enc1 = this._keyStr.indexOf(input.charAt(i++));
                    enc2 = this._keyStr.indexOf(input.charAt(i++));
                    enc3 = this._keyStr.indexOf(input.charAt(i++));
                    enc4 = this._keyStr.indexOf(input.charAt(i++));

                    chr1 = enc1 << 2 | enc2 >> 4;
                    chr2 = (enc2 & 15) << 4 | enc3 >> 2;
                    chr3 = (enc3 & 3) << 6 | enc4;

                    output = output + String.fromCharCode(chr1);

                    if (enc3 !== 64) {
                        output = output + String.fromCharCode(chr2);
                    }
                    if (enc4 !== 64) {
                        output = output + String.fromCharCode(chr3);
                    }
                }

                output = base64._utf8_decode(output);
            }

            return output;
        },

        // private method for UTF-8 encoding
        _utf8_encode: function utf8Encode(string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if (c > 127 && c < 2048) {
                    utftext += String.fromCharCode(c >> 6 | 192);
                    utftext += String.fromCharCode(c & 63 | 128);
                } else {
                    utftext += String.fromCharCode(c >> 12 | 224);
                    utftext += String.fromCharCode(c >> 6 & 63 | 128);
                    utftext += String.fromCharCode(c & 63 | 128);
                }
            }

            return utftext;
        },

        // private method for UTF-8 decoding
        _utf8_decode: function utf8Decode(utftext) {
            var string = "";
            var i = 0;
            var c2;
            var c;
            while (i < utftext.length) {
                c = utftext.charCodeAt(i);

                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                } else if (c > 191 && c < 224) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode((c & 31) << 6 | c2 & 63);
                    i += 2;
                } else {
                    c2 = utftext.charCodeAt(i + 1);
                    var c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode((c & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                    i += 3;
                }
            }

            return string;
        }
    };
})(jQuery);