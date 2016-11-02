<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

?>

<form enctype="multipart/form-data" action="<?php echo JRoute::_('index.php?option='.$this->component.'&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Header -->
    <div class="form-inline form-inline-header">
        <?php echo $this->loadTemplate("header"); ?>
    </div>

    <!-- Body -->
    <div class="form-horizontal">
        <?php echo $this->loadTemplate("body"); ?>
    </div>

    <!-- Footer -->
    <?php echo $this->loadTemplate("footer"); ?>

    <?php
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-id", "value" => $this->item->id));
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-view", "value" => $this->getName()));
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-component", "value" => $this->component));
    echo \FootManager\UI\Html\Form::hidden(array("name" => "task", "value" => ""));
    echo \FootManager\UI\Html\Form::hidden(array("name" => "return_page", "value" => base64_encode($this->return_page)));
    echo JHtml::_('form.token');
    ?>
</form>