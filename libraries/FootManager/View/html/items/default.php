<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen', 'select');

$sort_is_active = $this->order_field !== '';
$listLink = \JRoute::_('index.php?option='.$this->component.'&view='.$this->getName());

if($this->canOrdering()) {

    $saveOrder = strstr($this->order_field, 'ordering') !== false;

    if ($saveOrder)
    {
        $saveOrderingUrl = 'index.php?option='.$this->component.'&task='.$this->getName().'.saveOrderAjax&tmpl=component';
        \JHtml::_('sortablelist.sortable', 'itemsList', 'adminForm', strtolower($this->order_direction), $saveOrderingUrl);
    }

}

?>

<form action="<?php echo $listLink; ?>" method="post" name="adminForm" id="adminForm">

    <!-- Sidebar -->
    <?php if (!empty( $this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <?php endif;?>

    <!-- Body -->
    <div id="j-main-container" class="<?php echo (!empty( $this->sidebar) ? "span10" : "") ?>">

        <!-- Search Tools -->
        <?php echo FootManager\Helpers\Layout::render('joomla.searchtools.default', array('view' => $this)); ?>

        <div class="clearfix"></div>

        <!-- Items -->
        <?php if (count($this->items) == 0) : ?>

        <!-- Empty List -->
        <div class="alert alert-no-items">
            <?php echo \JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
        </div>

        <?php else : ?>

        <!-- Table -->
        <table class="table table-striped" id="itemsList">
            <thead>
                <?php echo $this->loadTemplate("header"); ?>
            </thead>
            <tbody>
                <?php echo $this->loadTemplate("body"); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php endif;?>

        <?php if(!empty($this->batchForm)) : ?>
        <?php
                  try
                  {
                      echo $this->loadTemplate("batch");
                  }
                  catch (Exception $exception)
                  {
                  }
        ?>
        <?php endif; ?>

        <?php echo $this->loadTemplate("footer"); ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo \JHtml::_('form.token'); ?>
    </div>
</form>