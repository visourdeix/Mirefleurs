<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$number = JArrayHelper::getValue($displayData, "number");

?>

<?php if($number) : ?>
<span class="fm-player-number"><?php echo $number ?></span>
<?php endif; ?>