<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$class = ' class="first"';
$lang  = JFactory::getLanguage();

if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>

<ul class="fm-list articles-categories">
    <?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
    <?php
              if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
                  if (!isset($this->children[$this->category->id][$id + 1])) :
                      $class = ' class="last"';
                  endif;
    ?>
    <li <?php echo $class; ?>>
        <a class="fm-hover-panel fm-hover-panel-vertical" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
            <?php $class = ''; ?>
            <?php if ($lang->isRtl()) : ?>
                <h6 class="item-title">
                    <?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
                </h6>
                <span class="fm-badge fm-badge-green  fm-badge-mini tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
                    <?php echo $child->getNumItems(true); ?>
                </span>
                <?php endif; ?>
                <span>
                    <?php echo $this->escape($child->title); ?>
                </span>
            <?php else : ?>
                <h6 class="item-title">
                    <?php echo $this->escape($child->title); ?>
                </h6>
                <?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
                    <span class="fm-badge fm-badge-green fm-badge-mini tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
                        <?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>&nbsp;
                        <?php echo $child->getNumItems(true); ?>
                    </span>
                <?php endif; ?>
            <?php endif;?>

            <?php if ($this->params->get('show_subcat_desc') == 1) : ?>
            <?php if ($child->description) : ?>
            <div class="category-desc">
                <?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </a>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>

<?php endif;