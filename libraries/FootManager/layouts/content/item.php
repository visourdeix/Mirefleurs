<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_content' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR .'route.php';

$article = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_time = JArrayHelper::getValue($params, "show_time", true);
$show_image = JArrayHelper::getValue($params, "show_image", true);
$show_category = JArrayHelper::getValue($params, "show_category", true);
$show_intro = JArrayHelper::getValue($params, "show_intro", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
$default_image = JArrayHelper::getValue($params, "default_image", "");
?>

<?php if($article) :
          $slug = $article->id . ':' . $article->alias;
?>

<a class="fm-content-item fm-row fm-row-border fm-hover-panel fm-hover-panel-vertical" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($slug, $article->catid, $article->language)); ?>">

    <!-- Date -->
    <?php if($show_date) : ?>
    <div>
        <?php echo FootManager\Helpers\Layout::render("html.date", array("date" => $article->publish_up, "show_day" => false, "show_time" => $show_time)) ?>
    </div>
    <?php endif ?>

    <div class="fm-row fm-row-responsive">

        <!-- Image -->
        <?php if($show_image) :
                  $image = isset($article->images["image_intro"]) && $article->images["image_intro"] ? $article->images["image_intro"] : $default_image;
        ?>
        <div class="fm-photo">
            <?php echo FootManager\Utilities\ImageHelper::render(JPATH_ROOT.DS.$image, array(), !$ajax) ?>
        </div>
        <?php endif ?>

        <div class="fm-info">

            <!-- Category -->
            <?php if($show_category) : ?>
            <div class="fm-article-category">
                <?php echo $article->category->title; ?>
            </div>
            <?php endif ?>

            <!-- Title -->
            <div class="fm-article-title">
                <?php echo $article->title; ?>
            </div>

            <!-- Intro -->
            <?php if($show_intro) : ?>
            <div class="fm-article-intro">
                <?php echo $article->introtext; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</a>
<?php endif; ?>