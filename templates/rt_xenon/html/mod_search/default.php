<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', false, true);

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}

?>
<div class="my-search search<?php echo $moduleclass_sfx ?>">
    <form id="my-mod_search" class="direction-<?php echo $button_pos ?>" action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">

        <?php
        $output = '<div id="input" class=""><input name="searchword" name="search-terms" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="search-query" type="search"' . $width;
        $output .= ' placeholder="' . $text . '" /></div>';

        if ($button) :
            if ($imagebutton) :
                $btn_output = '<div id="label"><label  onclick="this.form.submit();" for="search-terms" id="search-label"><i class="fa fa-search"></i></label></div>';
            else :
                $btn_output = ' <button class="my-icon-search" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
            endif;

        endif;

        switch ($button_pos) :
            case 'bottom' :
            case 'right' :
                $output .= $btn_output;
                break;

            case 'top' :
            case 'left' :
            default :
                $output = $btn_output . $output;
                break;
        endswitch;

        echo $output;
        ?>
        <input type="hidden" name="task" value="search" />
        <input type="hidden" name="option" value="com_search" />
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
    </form>
</div>

<script>
    (function (window) {

        // get vars
        var el = jQuery("#my-mod_search");
        var searchEl = jQuery("#my-mod_search #input");
        var inputEl = jQuery("#my-mod_search #input input");
        var labelEl = jQuery("#my-mod_search #label");

        //labelEl.click(function () {
        //    if(searchEl.hasClass("focus"))
        //    {
        //        searchEl.removeClass("focus");
        //        labelEl.removeClass("active");
        //    } else {
        //        searchEl.addClass("focus");
        //        labelEl.addClass("active");
        //    }
        //});

        el.mouseenter(function () {
                searchEl.addClass("focus");
                labelEl.addClass("active");
        });

        el.mouseleave(function () {
            if (!inputEl.is(":focus")) {
                searchEl.removeClass("focus");
                labelEl.removeClass("active");
            }
        });

        inputEl.blur(function () {
            if (!el.is(":hover")) {
                searchEl.removeClass("focus");
                labelEl.removeClass("active");
            }
        });

        labelEl.click(function (e) {
            if (searchEl.hasClass("focus")) {
                return true;
            }
            return false;
        });

    }(window));
</script>