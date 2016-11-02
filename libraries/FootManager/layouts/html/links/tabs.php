<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$tabs = isset($displayData["tabs"]) ? $displayData["tabs"] : array();
$class = isset($displayData["class"]) ? $displayData["class"] : "";

?>

<?php if($tabs) : ?>

<ul class="fm-tabs <?php echo $class ?>">
    <?php foreach ($tabs as $tab)
          {
              echo $this->sublayout('tab', $tab);
          }
    ?>
</ul>

<?php endif; ?>