<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$person = JArrayHelper::getValue($displayData, "person");

?>

<?php if($person) : ?>
<span class="fm-person-name">
    <?php echo $person->last_name.' '.substr($person->first_name, 0, 1).'.'; ?>
</span>
<?php endif; ?>