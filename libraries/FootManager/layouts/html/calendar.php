<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$sources = JArrayHelper::getValue($displayData, "sources", array());
$params = JArrayHelper::getValue($displayData, "params", array());
$show_today = JArrayHelper::getValue($displayData, "show_today", true);
$views = JArrayHelper::getValue($displayData, "views", "month,agendaWeek");
$default_view = JArrayHelper::getValue($displayData, "default_view", "month");
$firstDay = JArrayHelper::getValue($displayData, "firstDay", "1");
$id = JArrayHelper::getValue($displayData, "id", uniqid());

?>

<div id="<?php echo $id ?>" class="fm-calendar"></div>

<?php
$options = array();

if($sources) {
    $sources_array  = array();
    foreach ((array)$sources as $source)
    {
        $sources_array[] =  FootManager\Utilities\HtmlHelper::getJSObject($source);
    }

    $options["eventSources"] = "\\[
        ".
            implode(", ", $sources_array)
        ."
    ]";
}

if($show_today) $options["header"]["left"] = 'today';
$options["header"]["center"] = 'prev,title,next';
$options["header"]["right"] = $views;

$options["defaultView"] = $default_view;
$options["firstDay"] = $firstDay;
$options["eventLimit"] = true;
$options["eventLimitText"] = "";
$options["fixedWeekCount"] = false;
$options["aspectRatio"] = 1.2;
$options["timeFormat"] = "H:mm";
$options["slotDuration"] = "01:00:00";
$options["minTime"] = "07:00:00";

$options["views"]["week"]["columnFormat"] = "ddd D";

$lang = JFactory::getLanguage();
$language = explode("-",$lang->getTag())[0];

$options["lang"] = $language;

$options["loading"] = "\\function( isLoading, view ) {
	if(isLoading) {
		FM.startLoading('.fc-view-container > .fc-view > table > tbody > tr > .fc-widget-content');
	} else {
        FM.endLoading('.fc-view-container > .fc-view > table > tbody > tr > .fc-widget-content');
    }
}";

$options["eventMouseover"] = "\\function( event, jsEvent, view ) {
	if(event.color) {
		jQuery(jsEvent.currentTarget).css('background-color', event.color);
		jQuery(jsEvent.currentTarget).css('color', 'white');
	}
}";

$options["eventMouseout"] = "\\function( event, jsEvent, view ) {
	if(event.color) {
		jQuery(jsEvent.currentTarget).css('background-color', FM.rgbWithAlfa(event.color, 0.15));
		jQuery(jsEvent.currentTarget).css('color', event.textColor);
	}
}";

$options["eventRender"] = "\\function( event, element, view ) {

        var date = (event.end) ? event.end : event.start;
        var title = '<span class=\"fm-text-tradegothic fm-text-130\" style=\"color:' + event.color + '\">' + event.category + '</span>';
	    if(date < new Date()) jQuery(element).css('opacity', 0.65);
        if(event.state > 1) jQuery(element).css('opacity', 0.5);

        jQuery(element).css('background-color', FM.rgbWithAlfa(event.color, 0.15));

		jQuery(element).find('.fc-title').html(event.title);

        jQuery(element).qtip({
                    id:event.id,
                    content: {
                        text: event.content,
                        title: event.category
                    },
                    position: {
                        my: 'bottom center',
                        at: 'top center'
                    },
                    style: {
                            classes: 'qtip-rounded qtip-shadow fm-calendar-tooltip',
                            tip: {
                                        corner: true,
                                        width: 16,
                                        height: 10
                                    }
                        },
                    events: {
                            render: function(jsEvent, api) {
                                api.tooltip.find('.qtip-titlebar').attr('style', 'background-color: ' + event.color + '!important');
                            }
                        },
                    hide: {
                        fixed: true,
                        delay: 100
                    }
                });

    }";

FootManager\UI\Loader::qTip();
FootManager\UI\ui::calendar("#".$id, $options);
?>