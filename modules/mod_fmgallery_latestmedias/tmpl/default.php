<?php
/**
 * @package     mod_fmgallery_latestmedias
 * @subpackage  default.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$toDisplay = "category";
$theme = "masonry";
$toDisplay = JArrayHelper::getValue($paramsToArray, "to_display", "items");
$theme = JArrayHelper::getValue($paramsToArray, "theme", "masonry");
$typeSearched = JArrayHelper::getValue($paramsToArray, "type_searched", "photos");
$columns = JArrayHelper::getValue($paramsToArray, "columns", 2);
$category = $data->category;
$medias = $data->medias;

if(count($medias)) {
    
    switch ($toDisplay)
    {
        case "categories_with_sub_items";
            foreach ($medias as $cat)
            {

                $date = "";
                if(\FootManager\Utilities\DateHelper::isValid($cat->category->date))
                {
                    $date = $cat->category->date->format("d M. Y");
                }
?>
<div class="fm-margin-bottom-30 fm-columns-<?php echo $columns ?>">

    <?php
    
                                                 $header = '    <div class="fm-category-header">';
                                                 $header .= '       <h3 class="fm-category">'.$cat->category->parent_category->title.'</h3>';
                                                 $header .= '       <h2 class="fm-title">'.$cat->category->title.'</h2>';
                                                 $header .=         '<a href="'.FmgalleryHelperRoute::$typeSearched($cat->category->id).'" class="pull-right fm-button">'.JText::_("COM_FMGALLERY_SEE_DIAPORAMA").'</a>';
                                                 $header .= '       <h4 class="fm-subtitle">'.$date.'</h4>';

                                                 $header .= '    </div>';
                                                 echo FootManager\Helpers\Layout::render("medias.".$theme, array("thumbnails" => $cat->thumbnails, "last" => array($header), "params" => $paramsToArray), "");
    ?>
</div>
<?php
                                             }

                                             break;

        default:
                                             echo FootManager\Helpers\Layout::render("medias.".$theme, array("thumbnails" => $medias, "params" => $paramsToArray), "");
                                     }

?>

<?php if($params->get('show_link', true)) : ?>
<div class="text-right fm-margin-top-10">
    <a class="fm-button" href="<?php echo FmgalleryHelperRoute::$typeSearched($category->id) ?>">
        <span class="fa fa-folder-open fm-margin-right-10"></span>
        <?php echo JText::_("COM_FMGALLERY_SEE_ALL_CATEGORIES") ?>
    </a>
</div>
<?php endif ?>
<?php

  } else
      echo FootManager\Helpers\Layout::render("messages.nodata");