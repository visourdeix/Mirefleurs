<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="form-horizontal">
    <?php echo $this->form->renderField("start_date") ?>
    <?php echo $this->form->renderField("end_date") ?>
    <?php echo $this->form->renderField("categories") ?>
    <?php echo $this->form->renderField("types") ?>
</div>