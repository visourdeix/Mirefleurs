<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general'));

      echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('FMLIB_TAB_GENERAL', true));
?>
<div class="row-fluid">
    <div class="span4">
        <?php
        echo $this->form->renderField("catid");
        echo $this->form->renderField('title');
        echo $this->form->renderField('date_option');
        ?>
        <div id="edit_date" style="display: none">
            <?php echo $this->form->renderField('date'); ?>
        </div>

        <?php
        echo $this->form->renderField('state');
        echo $this->form->renderField('tags');
        ?>
    </div>
    <div class="span8">
        <?php echo $this->form->getField('uploader')->input; ?>
    </div>
</div>
<?php
echo JHtml::_('bootstrap.endTab');

echo JHtml::_('bootstrap.endTabSet'); ?>