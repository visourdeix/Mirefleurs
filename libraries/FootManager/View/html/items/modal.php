<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = \JFactory::getApplication();

if ($app->isSite())
{
	\JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}

JHtml::_('behavior.framework', true);
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen', 'select');

$function  = $app->input->getCmd('function', 'fmSelectItem');

$listLink = \JRoute::_('index.php?option='.$this->component.'&view='.$this->getName().'&layout=modal&tmpl=component&function=' . $function . '&' . JSession::getFormToken() . '=1');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>

<form action="<?php echo $listLink; ?>" method="post" name="adminForm" id="adminForm">

    <!-- Sidebar -->
    <button  onclick="if (window.parent) { var ids = []; jQuery('#itemsList tbody input[name=\'cid[]\']:checked').each(function(){ids.push(jQuery(this).val());}); window.parent.<?php echo $this->escape($function);?>(ids); }" class="btn btn-small btn-success pull-right" style="margin-top:13px;margin-right:13px">
        <span class="icon-plus icon-white"></span><?php echo JText::_('FMLIB_ADD_ITEMS'); ?>
    </button>

    <!-- Body -->
    <div id="j-main-container">

        <!-- Search Tools -->
        <div class="fm-margin-bottom-10">
            <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
        </div>

        <div class="clearfix"></div>

        <!-- Items -->
        <?php if (empty($this->items)) : ?>

        <!-- Empty List -->
        <div class="alert alert-no-items">
            <?php echo \JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
        </div>

        <?php else : ?>

        <!-- Table -->
        <table class="table table-striped" id="itemsList">
            <?php echo $this->loadTemplate("header"); ?>
            <?php echo $this->loadTemplate("body"); ?>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php endif;?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo \JHtml::_('form.token'); ?>
    </div>
</form>