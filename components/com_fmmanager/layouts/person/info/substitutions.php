<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$substitutions = JArrayHelper::getValue($displayData, "substitutions", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$person = JArrayHelper::getValue($displayData, "person");

?>

<?php if(count($substitutions)) : ?>

<span class="fm-substitutions">
    <?php foreach($substitutions as $substitution) : ?>
    <?php
              if($person->id == $substitution->playerOut_id) {
                  $class ="fa-arrow-down fm-out";
                  $title = JText::sprintf("FM_SUBSTITUTION_REPLACED_BY", $substitution->playerIn->name);
              } else {
                  $class ="fa-arrow-up fm-in";
                  $title = JText::sprintf("FM_SUBSTITUTION_REPLACE", $substitution->playerOut->name);
              }

    ?>
    <i class="hasTooltip fm-substitution fa <?php echo $class ?>" title="<?php echo ($substitution->minute) ? $substitution->minute."' : ".$title : $title ?>"></i>
    <?php endforeach; ?>
</span>

<?php endif; ?>