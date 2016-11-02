<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

?>

<form action="<?php echo JRoute::_('index.php?option='.$this->component.'&view=addphotos') ?>" method="post" name="adminForm" id="adminForm">

    <!-- Header -->
    <div class="form-inline form-inline-header">
        <?php try { echo $this->loadTemplate("header"); } catch (Exception $exception){} ?>
    </div>

    <!-- Body -->
    <div class="form-horizontal">
        <?php try { echo $this->loadTemplate("body"); } catch (Exception $exception){} ?>
    </div>

    <?php
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-view", "value" => $this->getName()));
    echo \FootManager\UI\Html\Form::hidden(array("id" => "fm-component", "value" => $this->component));
    echo \FootManager\UI\Html\Form::hidden(array("name" => "task", "value" => ""));
    echo JHtml::_('form.token');
    ?>
</form>