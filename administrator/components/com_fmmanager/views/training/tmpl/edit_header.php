<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php	echo $this->form->renderField("date");	?>
<?php	echo $this->form->getInput("start_time");	?>
<span>&nbsp;&nbsp;-&nbsp;&nbsp;</span>
<?php	echo $this->form->getInput("end_time");	?>