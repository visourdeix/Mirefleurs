<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<span class="fm-text-150">
    <?php echo $this->item->matchday->competition->name ?> -
    <span class="fm-text-color-dark-gray">
        <?php echo $this->item->matchday->name ?>
    </span>
</span>
<legend>
    <h2>
        <?php	echo $this->item->team1->small_name;	?> - <?php	echo $this->item->team2->small_name;	?>
    </h2>
</legend>
<?php	echo $this->form->renderField("team1_id");	?>
<?php	echo $this->form->renderField("team2_id");	?>
<?php	echo $this->form->renderField("call_up_id");	?>