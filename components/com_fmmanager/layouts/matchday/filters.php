<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$matchday = JArrayHelper::getValue($displayData, "matchday");
$matchdays = JArrayHelper::getValue($displayData, "matchdays");
$currentSlide = 0;
$id = uniqid();

?>

<!-- Matchdays -->
<div id="<?php echo $id ?>" class="fm-matchdays">
    <?php foreach($matchdays as $i => $md) :
              if($md->id == $matchday->id) $currentSlide = $i;
    ?>
    <div class="fm-slick-matchday">
        <a href="<?php echo FmmanagerHelperRoute::matchday($md) ?>">
            <div class="fm-slick-matchday-name">
                <?php echo $md->name ?>
            </div>
            <div class="fm-date">
                <?php echo $md->datetime->format('d M. Y') ?>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<?php \FootManager\UI\ui::slick("#".$id, array("initialSlide" => $currentSlide)); ?>