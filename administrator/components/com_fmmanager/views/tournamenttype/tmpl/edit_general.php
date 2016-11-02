<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span5">
        <?php
        echo $this->form->renderField("has_ranking");
        echo $this->form->renderField("by_match");
        ?>
    </div>
</div>