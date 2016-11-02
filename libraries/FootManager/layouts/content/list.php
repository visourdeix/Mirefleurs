<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$articles = JArrayHelper::getValue($displayData, "articles", array());
$params = JArrayHelper::getValue($displayData, "params", array());
$title = JArrayHelper::getValue($params, "title", "FMLIB_SEE_TOO");
$maximum = JArrayHelper::getValue($params, "maximum", 3);

?>

<?php if(count($articles)) : ?>

<?php if($title) : ?>
<div class="fm-title-2">
    <span>
        <?php echo JText::_($title) ?>
    </span>
</div>
<?php endif; ?>

<?php
          $visible_articles = array();
          $more_articles = array();

          if(count($articles) > $maximum) {
              $visible_articles = $articles->slice(0, $maximum);
              $more_articles = $articles->slice($maximum, count($articles) - $maximum);
          } else {
              $visible_articles = $articles;
          }
?>

<div class="fm-collaped-articles">
    <div>
        <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $visible_articles, "layout" => "content.item", "params" => $params)); ?>
    </div>
    <?php if($more_articles) : ?>
    <div id="fm-more-articles" class="collapse">
        <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $more_articles, "layout" => "content.item", "params" => $params)); ?>
    </div>
    <?php echo FootManager\Helpers\Layout::render("html.collapse.more", array("target" => "fm-more-articles")); ?>
    <?php endif; ?>
</div>

<?php endif; ?>