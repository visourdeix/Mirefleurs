/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    /* Count the statistic from a column */
    function getSumStatistics(table, column) {
        var sum = 0;

        $(table + ' tr:not(.fm-row-all)').closest("tr").find('td[data-title="' + column + '"] input').each(function () {
            var val = ($(this).val() === '') ? 0 : $(this).val();
            sum += parseInt(val);
        });

        return sum;
    }

    /* Count the statistic from a column */
    function setAllSumStatistics(table) {
        $(table + ' tr.fm-row-all input[name *="statistic"]').each(function () {
            var title = $(this).closest("td").attr("data-title");
            $(this).val(getSumStatistics(table, title));
        });
    }

    $(document).ready(function () {
        // Update match link
        $("#jform_matches_repeater > table > tbody > tr").each(function () {
            $(this).find('input[name="jform[matches][score1]"], input[name="jform[matches][score2]"]').on("change", function () {
                $(this).closest("tr").find('select[name="jform[matches][state]"]').val(1).trigger('liszt:updated');
            });

            var id = $(this).find('input[name="jform[matches][id]"]').val();
            $(this).find("a.fm-edit").attr("href", "index.php?option=com_fmmanager&task=match.edit&id=" + id + "&return_page=" + base64.encode(window.location.href));
        });

        $('#jform_playersStatistics_personstable tr:not(.fm-row-all) .fmtouchspin').TouchSpin();
        $('#jform_playersStatistics_personstable tr.fm-row-all input[id *="_statistic"]').attr('disabled', 'disabled');

        $('table tr.fm-row-all *[name*="[all]"]').each(function () {
            $(this).attr('name', $(this).attr('name').replace('jform', 'all'));
        });

        // Count statistics
        setAllSumStatistics('#jform_playersStatistics_personstable');
        $('#jform_playersStatistics_personstable tr:not(.fm-row-all) input[name *="statistic"]').on("change", function () {
            var inputTot = $('#jform_playersStatistics_personstable tr.fm-row-all td[data-title="' + $(this).closest('td').attr("data-title") + '"] input');
            inputTot.val(getSumStatistics('#jform_playersStatistics_personstable', $(this).closest('td').attr("data-title")));
        });

        $("#jform_matchesToAdd_repeater table tbody").on('change', 'select[name="jform[matchesToAdd][team1_id]"]', function (e) {
            var team_id = $(e.currentTarget).val();

            if (team_id && team_id !== undefined) {
                var dataToSend = { id: team_id };

                var success = function (result) {
                    var tr = $(e.target).closest("tr");
                    var stadium_id = result['stadium_id'];
                    $(tr).find('select[name="jform[matchesToAdd][stadium_id]"]').val(stadium_id).trigger('liszt:updated');
                    $("#jform_matchesToAdd_repeater").data("Repeater").save();
                };

                FM.loadAjaxData("getTeam", dataToSend, success);
            }
        }.bind(this));
    });
})(jQuery);