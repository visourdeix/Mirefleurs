<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$params = $this->params;

?>

<div class="<?php echo ($params->get("show_filters", true)) ? "" : "hidden" ?>">
    <!-- Button Filter -->
    <?php echo FootManager\Helpers\Layout::render("html.collapse.filter", array("target" => "fm-calendar-filters")); ?>

    <!-- Form Filters -->
    <form id="fm-calendar-filters" class="collapse fm-margin-bottom-15 fm-filters">

        <div class="fm-filters-buttons">
            <?php
            echo FootManager\Helpers\Layout::render("html.checkboxes.checkbox", array("id" => "fm-select-all", "text" => JText::_("FM_LIB_SELECT_UNSELECT_ALL"), "checked" => true));
            ?>
        </div>

        <div class="fm-filters-inputs">
            <!-- Types -->
            <?php
            $checkboxes_types = array();
            foreach ($this->item->types as $key => $type)
                $checkboxes_types[] = array("id" => "type-".$key, "text" => $type["title"], "icon" => $type["icon"], "value" => $key, "name" => "types[]", "checked" => true);

            echo FootManager\Helpers\Layout::render("html.checkboxes.list", array("checkboxes" => $checkboxes_types));

            ?>

            <!-- Categories -->
            <?php
            $checkboxes_categories = array();
            foreach ($this->item->categories as $key => $category)
            {
                $image = '<span class="fm-thumbnail-color fm-thumbnail-color-rounded fm-thumbnail-color-small">
                            <span style="background-color:'.$category["color"].'"></span>
                        </span>';
                $checkboxes_categories[] = array("id" => "type-".$key, "text" => $category["title"], "image" => $image, "value" => $key, "name" => "categories[]", "checked" => true);
            }

            echo FootManager\Helpers\Layout::render("html.checkboxes.list", array("checkboxes" => $checkboxes_categories));

            ?>
        </div>
    </form>
</div>

<?php
$data = "\\function() {

	var typesValues = new Array();
		jQuery('input[name=\"types[]\"]:checked').each(function(i) {
			typesValues.push(jQuery(this).val());
		});
    var categoriesValues = new Array();
		jQuery('input[name=\"categories[]\"]:checked').each(function(i) {
			categoriesValues.push(jQuery(this).val());
		});
	return {
		types : typesValues,
        categories : categoriesValues
	}

}";
echo FootManager\Helpers\Layout::render("html.calendar", array("id" => "fm-calendar", "sources" => array(array("url" => 'index.php?option=com_fmevents&task=calendar.getEvents', "data" => $data))));

?>