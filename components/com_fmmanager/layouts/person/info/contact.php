<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$contact = JArrayHelper::getValue($displayData, "contact");
$show_value = JArrayHelper::getValue($displayData, "show_value", false);

?>

<?php if($contact) : ?>

<?php
          switch($contact->type) {

              case \FootManager\Constants::MOBILE:
                  $link = 'tel:'.$contact->value;
                  $title = JText::sprintf('COM_FMMANAGER_CALL_AT', $contact->value);
                  $icon = 'phone';
                  break;

              case \FootManager\Constants::FIXE:
                  $link = 'tel:'.$contact->value;
                  $title = JText::sprintf('COM_FMMANAGER_CALL_AT', $contact->value);
                  $icon = 'tty';
                  break;

              case \FootManager\Constants::MAIL:
                  $link = 'mailto:'.$contact->value;
                  $title = JText::sprintf('COM_FMMANAGER_SEND_MAIL_AT', $contact->value);
                  $icon = 'envelope-o';
                  break;

              default:
                  continue;
          }

?>

<?php if($show_value) : ?>

<div class="fm-contact">
    <span>
        <?php echo $contact->value ?>
    </span>
    <a class="fm-bull fm-bull-green hasTooltip" href="<?php echo $link ?>" title="<?php echo $title ?>">
        <i class="fa fa-<?php echo $icon ?>"></i>
    </a>
</div>

<?php else : ?>

<a class="hasTooltip fm-bull fm-bull-green" href="<?php  echo $link ?>" title="<?php echo $title ?>">
    <i class="fa fa-<?php echo $icon ?>"></i>
</a>

<?php endif; ?>

<?php endif; ?>