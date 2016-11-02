<?php defined('_JEXEC') or die('Restricted access');

?>

<?php if($this->state->folder) : ?>
<legend class="fm-text-italic">
    <?php echo $this->state->folder; ?>
</legend>
<?php endif; ?>
<ul class="fm-thumbnails">
    <?php

    echo "<li>".$this->loadTemplate('up')."</li>";

    if (count($this->folders) > 0) { ?>
    <?php for ($i=0,$n=count($this->folders); $i<$n; $i++) :
              $this->folder = $this->folders[$i];
              echo "<li>".$this->loadTemplate('folder')."</li>";
          endfor; ?>

    <?php } else {
        echo FootManager\Helpers\Layout::render('messages.nodata');
    } ?>
</ul>
<div class="clearfix"></div>

<?php

echo $this->loadTemplate('createfolder');
?>