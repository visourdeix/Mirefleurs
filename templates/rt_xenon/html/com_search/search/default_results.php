<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<ul class="fm-list search-results <?php echo $this->pageclass_sfx; ?>">
    <?php foreach ($this->results as $result) : ?>
    <li>
        <a class="fm-hover-panel fm-hover-panel-vertical" href="<?php echo JRoute::_($result->href); ?>" <?php if ($result->browsernav == 1) :?> target="_blank" <?php endif;?>>

            <!-- Title -->
            <h5 class="result-title">
                <?php echo $this->pagination->limitstart + $result->count . '. ';?>
                <?php echo $this->escape($result->title);?>
            </h5>

            <!-- Section -->
            <?php if ($result->section) : ?>
            <div class="result-category">
                <span class="small <?php echo $this->pageclass_sfx; ?>">
                    (<?php echo $this->escape($result->section); ?>)
                </span>
            </div>
            <?php endif; ?>

            <!-- Texte -->
            <div class="result-text">
                <?php echo $result->text; ?>
            </div>

            <!-- Date -->
            <?php if ($this->params->get('show_date')) : ?>
            <div class="result-created <?php echo $this->pageclass_sfx; ?>">
                <?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
            </div>
            <?php endif; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

<div class="pagination">
    <?php echo $this->pagination->getPagesLinks(); ?>
</div>