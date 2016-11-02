<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

?>

<ul class="fm-social-share">

    <li>
        <span class="fm-share-on">
            <?php echo JText::_("FMLIB_SHARE") ?>
        </span>
    </li>

    <?php if ($this->params->get("show_fb", 1)) { ?>
    <li>
        <a href="<?php echo $socialShare->getLink("facebook", JUri::getInstance()) ?>" rel='nofollow' class="fm-facebook hasTooltip" target="_blank" title="<?php echo $this->params->get("text_fb", "") ?>">
            <i class="fa fa-facebook"></i>
        </a>
    </li>
    <?php } ?>

    <?php if ($this->params->get("show_twitter", 1)) { ?>
    <li>
        <a href="<?php echo $socialShare->getLink("twitter", JUri::getInstance()) ?>" rel='nofollow' class="fm-twitter hasTooltip" target="_blank" title="<?php echo $this->params->get("text_twitter", "") ?>">
            <i class="fa fa-twitter"></i>
        </a>
    </li>
    <?php } ?>

    <?php if ($this->params->get("show_gp", 1)) { ?>
    <li>
        <a href="<?php echo $socialShare->getLink("google", JUri::getInstance()) ?>" rel='nofollow' class="fm-google-plus hasTooltip" target="_blank" title="<?php echo $this->params->get("text_gp", "") ?>">
            <i class="fa fa-google-plus"></i>
        </a>
    </li>
    <?php } ?>

    <?php if ($this->params->get("show_mail", 1)) { ?>
    <li>
        <a href="mailto:?subject=<?php echo $row->title; ?>&body=<?php echo $this->params->get("text_intro_mail", "").JUri::getInstance(); ?>" class="fm-mail hasTooltip" title="<?php echo $this->params->get("text_mail", "") ?>">
            <i class="fa fa-envelope"></i>
        </a>
    </li>
    <?php } ?>
</ul>