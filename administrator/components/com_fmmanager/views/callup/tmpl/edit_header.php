<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<?php echo FootManager\Helpers\Layout::render("callup.title", array("event" => $this->item->event)) ?>

<input type="hidden" name="event_id" value="<?php echo $this->event_id ?>" />
<input type="hidden" name="type" value="<?php echo base64_encode($this->type) ?>" />