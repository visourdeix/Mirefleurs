<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<legend><?php	echo $this->item->competition->name;	?></legend>
<?php	echo $this->form->getField("competition_id")->input;	?>
<?php	echo $this->form->renderField("name");	?>